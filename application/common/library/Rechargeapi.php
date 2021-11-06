<?php
/**
 * Created by PhpStorm.
 * User: 12048
 * Date: 2018-03-23
 * Time: 21:42
 */

namespace app\common\library;

use app\common\model\Porder;
use think\Log;

class Rechargeapi
{
    //充值
    public static function recharge($porder_id)
    {
        $res = Porder::getCurApi($porder_id);
        if ($res['errno'] != 0) {
            return rjson($res['errno'], $res['errmsg']);
        }
        $api = $res['data'];
        $porder = M('porder')->where(['id' => $porder_id, 'status' => 2, 'api_open' => 1])->find();
        $config = M('reapi')->where(['id' => $api['reapi_id']])->find();
        $param = M('reapi_param')->where(['id' => $api['param_id']])->find();
        if (!$config || !$param) {
            return rjson(1, '接口未找到');
        }
        M('porder')->where(['id' => $porder_id])->setField(['apireq_time' => time(), 'api_cur_index' => $porder['api_cur_index'] + 1]);
        $ret = self::callApi($porder, $config, $param);
        if ($ret['errno'] != 0) {
            Porder::rechargeFail($porder['order_number'], "提交接口l |" . $config['name'] . '-' . $param['desc'] . "|错误了1|" . $ret['errmsg']);
            return rjson(1, $ret['errmsg']);
        }
        Createlog::porderLog($porder['id'], "提交接口|" . $config['name'] . '-' . $param['desc'] . "|成功|平台返回" . json_encode($ret['data']));
    
        M('porder')->where(['id' => $porder_id])->setField(['status' => 3, 'cost' => $param['cost']]);
        return rjson(0, '提交成功');
    }

    //提交接口
    private static function callApi($porder, $config, $param)
    {
        $classname = 'Recharge\\' . $config['callapi'];
        if (!class_exists($classname)) {
            return rjson(1, '系统错误，接口类:' . $classname . '不存在');
        }
        $model = new $classname($config);
        if (!method_exists($model, 'recharge')) {
            return rjson(1, '系统错误，接口类:' . $classname . '的充值方法（recharge）不存在');
        }
        if ($config['callapi'] == 'RuiCe') {
            // 通过 订单id 拿到产品id 从而拿到睿策 产品id
            $product = M('product')->where(['id' => $porder['api_order_number']])->find();
            Log::error($product);
            return $model->recharge($porder['api_order_number'], $porder['mobile'], $param, $porder['isp'],$product['ruice_product_id']);
        }else if ($config['callapi'] == 'WanNengChong') {
            return $model->recharge($porder['api_order_number'], $porder['mobile'], $param, $porder['isp'],$porder['guishu']);
        }
        return $model->recharge($porder['api_order_number'], $porder['mobile'], $param, $porder['isp'],$porder['guishu']);
    }


}