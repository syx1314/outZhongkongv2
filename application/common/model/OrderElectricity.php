<?php
/**
 * Created by PhpStorm.
 * User: 12048
 * Date: 2017-11-14
 * Time: 11:13
 */

namespace app\common\model;

use app\common\enum\BalanceStyle;
use app\common\library\Createlog;
use app\common\library\PayApi;
use app\common\library\Templetmsg;
use app\common\library\Wxrefundapi;
use app\common\library\Yrapilib;
use Recharge\Yuanren;
use Recharge\Yxyou;
use think\Model;
use Util\Http;


class OrderElectricity extends Model
{
    const PR = 'ElE';
    protected $insert = ['status' => 1];
    protected $append = ['status_text', 'pay_way_text', 'create_time_text'];

    public static function subApi($id)
    {
        $data = self::get($id)->toArray();
        if (intval(C('SYS_TYPE')) == 1) {
            $config = M('reapi')->where(['id' => 9])->find();
            $el = new Yxyou($config);
            $res = $el->oth_query($data['order_number'], $data['account'], intval($data['money']), $data['company_num'], 6);
        } else {
            $config = M('reapi')->where(['id' => 4])->find();
            $api = new Yuanren($config);
            $res = $api->ele_recharge($data['order_number'], $data['account'], intval($data['money']), $data['company_id']);
        }
        Createlog::eleOrderLog($id, '电费缴纳api请求结果：' . json_encode($res));
        if ($res['errno'] == 0) {
            return self::apiSus($id, $res['data']);
        } else {
            return self::fail($id, $res['errmsg']);
        }
    }


    public function getStatusTextAttr($value, $data)
    {
        return C('ELE_STATUS')[$data['status']];
    }

    public function getPayWayTextAttr($value, $data)
    {
        return C('PAYWAY')[$data['pay_way']];
    }

    public function getCreateTimeTextAttr($value, $data)
    {
        return time_format($data['create_time']);
    }

    public static function createOrder($cus_id, $account, $money, $name, $company_num, $company_id, $company_name, $city, $integral, $discount, $out_trade_num = '')
    {
        if ($money < floatval(C('ELE_MIN_VALUE')) || $money > floatval(C('ELE_MAX_VALUE'))) {
            return rjson(1, '缴费金额只能在' . C('ELE_MIN_VALUE') . '-' . C('ELE_MAX_VALUE') . '元之间');
        }
        $user = M('customer')->where(['id' => $cus_id])->find();
        $total_price = ($money * floatval($discount) / 100) + floatval(C('ELE_SERVICE_PRICE'));
        $pay_price = $total_price;
        $dk_integral = 0;
        $dk_price = 0;
        if ($integral) {
            $intres = Integral::di_kou_rule($cus_id, $total_price, 'ELE_INT_SWITCH');
            if ($intres['errno'] == 0) {
                $dkres = Integral::expend($cus_id, $intres['data']['integral'], '下单使用积分抵扣');
                if ($dkres['errno'] == 0) {
                    $dk_integral = $intres['data']['integral'];
                    $dk_price = $intres['data']['money'];
                    $pay_price -= $dk_price;
                }
            }
        }

        $order = new OrderElectricity();
        $order->data([
            'order_number' => self::PR . time() . rand(100, 999),
            'customer_id' => $cus_id,
            'account' => $account,
            'money' => $money,
            'name' => $name,
            'company_num' => $company_num,
            'company_id' => $company_id,
            'company_name' => $company_name,
            'city' => $city,
            'total_price' => $total_price,
            'pay_price' => $pay_price,
            'dk_integral' => $dk_integral,
            'dk_price' => $dk_price,
            'service_price' => floatval(C('ELE_SERVICE_PRICE')),
            'create_time' => time(),
            'out_trade_num' => $out_trade_num,
            'weixin_appid' => $user['weixin_appid']
        ], true);
        $order->save();
        if ($order->id) {
            Createlog::eleOrderLog($order->id, '下单成功');
            self::compute_rebate($order->id);
            return rjson(0, '下单成功', $order->get($order->id)->toArray());
        } else {
            return rjson(1, '下单失败');
        }
    }

    //计算返利
    public static function compute_rebate($aid)
    {
        $order = self::where(['id' => $aid])->find();
        $customer = M('customer')->where(['id' => $order['customer_id'], 'is_del' => 0, 'status' => 1])->find();
        if (!$customer) {
            return djson(1, '用户未找到');
        }
        if (!$customer['f_id']) {
            Createlog::eleOrderLog($order['id'], '不返利,没有上级');
            return djson(1, '无上级，无需返利');
        }
        //查上级
        $fcus = M('customer')->where(['id' => $customer['f_id'], 'is_del' => 0, 'status' => 1])->find();
        if (!$fcus) {
            Createlog::eleOrderLog($order['id'], '未查询到上级信息，不返利（上级可能被禁用或者删除）');
            return djson(1, '未查询到上级信息');
        }
        //查上二级
        $f2cus = M('customer')->where(['id' => $fcus['f_id'], 'is_del' => 0, 'status' => 1])->find();
        if ($f2cus) {
            $rebate_price2 = $order['money'] * floatval(C('ZDY_REBATE_RATIO2')) / 100;
            if ($rebate_price2 > 0) {
                self::where(['id' => $order['id']])->setField(['rebate_id2' => $customer['f_id'], 'rebate_price2' => $rebate_price2]);
                Createlog::eleOrderLog($order['id'], '计算出二级返利ID：' . $f2cus['id'] . '，返利金额:￥' . $rebate_price2);
            } else {
                Createlog::eleOrderLog($order['id'], '二级不返利,计算出金额：￥' . $rebate_price2);
            }
        } else {
            Createlog::eleOrderLog($order['id'], '未查询到二级信息，不返利（上上级可能被禁用或者删除）');
        }

        //计算一级返利
        $rebate_price = $order['money'] * floatval(C('ZDY_REBATE_RATIO')) / 100;
        if ($rebate_price <= 0) {
            Createlog::eleOrderLog($order['id'], '一级不返利,计算出金额：￥' . $rebate_price);
            return djson(1, '一级不返利,计算出金额：￥' . $rebate_price);
        }
        self::where(['id' => $order['id']])->setField(['rebate_id' => $customer['f_id'], 'rebate_price' => $rebate_price]);
        Createlog::eleOrderLog($order['id'], '计算上级出返利ID：' . $customer['f_id'] . '，返利金额:￥' . $rebate_price);
        return rjson(0, '返利设置成功');
    }


    //生成支付数据
    public static function create_pay($aid)
    {
        $order = M('order_electricity')->where(['id' => $aid])->find();
        $customer = M('customer')->where(['id' => $order['customer_id']])->find();
        if (!$order || !$customer) {
            return rjson(1, '数据错误');
        }
        if ($order['create_time'] < time() - 60 * 25) {
            return rjson(1, '订单已过期，不可继续支付');
        }
        return PayApi::create_wxpay_wx([
            'appid' => $customer['weixin_appid'],
            'openid' => $customer['wx_openid'],
            'body' => '电费账户' . $order['account'] . '充值金额' . $order['money'],
            'order_number' => $order['order_number'],
            'total_price' => $order['pay_price'],
        ]);
    }

    public static function notify($order_number, $payway, $serial_number)
    {
        $eorder = M('order_electricity')->where(['order_number' => $order_number, 'status' => 1])->find();
        if (!$eorder) {
            return rjson(1, 'no order');
        }
        M('order_electricity')->where(['id' => $eorder['id']])->setField(['status' => 2, 'pay_time' => time(), 'pay_way' => $payway]);
        Templetmsg::paySus($eorder['customer_id'], '电费订单已经提交，正在处理中', $eorder['order_number'], $eorder['money'], '充值户号：' . $eorder['account']);
        queue('app\queue\job\Work@eleSubApi', $eorder['id']);
        return rjson(0, '处理完成');
    }

    public static function cancal($cus_id, $id, $remark = "订单超时")
    {
        $order = self::where(['customer_id' => $cus_id, 'id' => $id, 'status' => 1])->find();
        if (!$order) {
            return rjson(1, '订单不可取消');
        }
        self::where(['id' => $id])->setField(['status' => 7]);
        Createlog::eleOrderLog($id, '订单取消，理由：' . $remark);
        self::refund_integral($id);
        return rjson(0, '取消成功');
    }

    public static function apiNotifyFail($order_number, $remark)
    {
        $order = M('order_electricity')->where(['order_number' => $order_number, 'status' => ['in', '2,3']])->find();
        if (!$order) {
            return rjson(1, '订单未找到');
        }
        Createlog::eleOrderLog($order['id'], $remark);
        return self::fail($order['id'], '接口回调');
    }

    //充值失败
    public static function fail($id, $remark = '')
    {
        $torder = self::where(['id' => $id])->find();
        Templetmsg::chargeFail($torder['customer_id'], '电费订单处理失败', $torder['money'], time_format(time()), '电费缴纳失败，费用将原路退回！');
        self::where(['id' => $id])->setField(['status' => 5, 'remark' => $remark]);
        Createlog::eleOrderLog($id, '订单充值失败|' . $remark);
        self::api_notify($id);
        C('AUTO_REFUND') == 1 && queue('app\queue\job\Work@eleRefund', ['id' => $torder['id'], 'remark' => '退款|系统|自动']);
        return rjson(0, '操作成功');
    }

    //提交成功
    public static function apiSus($id, $ret)
    {
        self::where(['id' => $id])->setField(['status' => 3]);
        Createlog::eleOrderLog($id, '接口提交成功');
        return rjson(0, '操作成功');
    }

    public static function apiNotifySus($order_number, $remark)
    {
        $order = M('order_electricity')->where(['order_number' => $order_number, 'status' => ['in', '2,3']])->find();
        if (!$order) {
            return rjson(1, '订单未找到');
        }
        Createlog::eleOrderLog($order['id'], $remark);
        return self::orderSus($order['id'], '接口回调');
    }

    //缴纳成功
    public static function orderSus($id, $remark)
    {
        $eorder = self::where(['id' => $id])->find();
        Templetmsg::chargeSus($eorder['customer_id'], '电费订单已处理完成!', '电费', $eorder['money'], time_format(time()), '充值户号：' . $eorder['account']);
        self::where(['id' => $id])->setField(['status' => 4]);
        Createlog::eleOrderLog($id, '订单充值成功|' . $remark);
        self::rebate($id);
        self::api_notify($id);
        return rjson(0, '操作成功');
    }

    //退款成功
    public static function refundSus($id)
    {
        $order = self::where(['id' => $id])->find();
        Templetmsg::refund($order['customer_id'], '电费订单' . $order['order_number'] . '退款成功！', $order['total_price'], date('Y-m-d H:i', time()));
        self::where(['id' => $id])->setField(['status' => 6]);
        Createlog::eleOrderLog($id, '退款成功');
        self::refund_integral($id);
        return rjson(0, '操作成功');
    }


    //退款
    public static function refund($id, $remark = "")
    {
        $order = self::where(['id' => $id, 'status' => 5])->find();
        if (!$order) {
            return rjson(1, '订单未找到或订单不可退款');
        }
        Createlog::eleOrderLog($id, $remark);
        switch ($order['pay_way']) {
            case PayApi::PAY_WAY_JSYS:
                $ret = Wxrefundapi::wxpay_h5_refund([
                    'appid' => M('customer')->where(['id' => $order['customer_id']])->value('weixin_appid'),
                    'order_number' => $order['order_number'],
                    'total_price' => $order['pay_price'],
                    'refund_fee' => $order['pay_price']
                ]);
                break;
            case PayApi::PAY_WAY_BLA:
                $ret = Balance::revenue($order['customer_id'], $order['pay_price'], "电费订单:" . $order['order_number'] . "缴费失败退款", Balance::STYLE_REFUND);
                break;
            default:
                $ret = rjson(1, '不支持其他退款方式');
        }
        if ($ret['errno'] != 0) {
            Createlog::eleOrderLog($id, '退款失败|' . $ret['errmsg']);
            return rjson($ret['errno'], $ret['errmsg'], $ret['data']);
        }
        return self::refundSus($id);
    }

    //退积分
    public static function refund_integral($order_id)
    {
        $porder = M('order_electricity')->where(['id' => $order_id, 'status' => ['in', '6,7'], 'dk_integral' => ['gt', 0]])->find();
        if (!$porder) {
            return rjson(1, '订单无需退积分');
        }
        Integral::revenue($porder['customer_id'], $porder['dk_integral'], '电费订单' . $porder['order_number'] . '退回积分');
        Createlog::porderLog($porder['id'], "订单单退积分：" . $porder['dk_integral']);
        return rjson(0, '操作成功');
    }

    /**
     * 返利
     */
    public static function rebate($order_id)
    {
        $order = self::where(['id' => $order_id, 'status' => ['in', '4'], 'rebate_id' => ['gt', 0], 'rebate_price' => ['gt', 0], 'is_del' => 0, 'is_rebate' => 0])->find();
        if ($order) {
            self::where(['id' => $order_id])->setField(['is_rebate' => 1]);
            Balance::revenue($order['rebate_id'], $order['rebate_price'], '用户充值电费返利，单号' . $order['order_number'], BalanceStyle::REWARDS);
        }
    }

    //给下游回调
    private static function api_notify($order_id)
    {
        self::where(['id' => $order_id])->setInc("notification_num", 1);
        $order = self::where(['id' => $order_id, 'status' => ['in', '4,5,6']])->find();
        $customer = M('customer')->where(['id' => $order['customer_id'], 'is_del' => 0, 'status' => 1])->find();
        if (!$order || !$customer) {
            return rjson(1, '订单或用户不存在');
        }
        if (!$order['notify_url']) {
            Createlog::eleOrderLog($order_id, '未设置api回调地址');
            return rjson(1, '未设置api回调地址');
        }
        $state = $order['status'] == 4 ? 1 : 2;
        $data = [
            'order_number' => $order['order_number'],
            'out_trade_num' => $order['out_trade_num'],
            'account' => $order['account'],
            'otime' => time(),
            'state' => $state,
        ];
        ksort($data);
        $sign_str = http_build_query($data) . '&apikey=' . $customer['apikey'];
        $data['sign'] = Yrapilib::sign($sign_str);
        $url = $order['notify_url'] . "?" . http_build_query($data);
        Createlog::eleOrderLog($order_id, '回调链接：' . $url);
        $result = Http::get($url);
        if ($result == 'success') {
            Createlog::eleOrderLog($order_id, 'api回调通知成功');
            self::where(['id' => $order_id])->setField(['is_notification' => 1]);
            return rjson(0, 'api回调通知成功');
        } else {
            Createlog::eleOrderLog($order_id, 'api回调通知失败,响应数据：' . $result);
            return rjson(1, 'api回调通知失败,响应数据：' . $result);
        }
    }

}