<?php

namespace app\api\controller;

use app\common\model\Porder as PorderModel;
use Recharge\LiuLiangTong;
use Recharge\WTLT;
class Apinotify extends Base
{


    //聚合回调
    public function juhe()
    {
        $orderid = addslashes(I('orderid')); //商户的单号
        $sta = addslashes(I('sta')); //充值状态
        if ($sta == '1') {
            //充值成功,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('juhe', $orderid, file_get_contents("php://input"));
            $flag && PorderModel::rechargeSusApi($orderid, "充值成功|接口回调|" . json_encode(file_get_contents("php://input")));
        } elseif ($sta == '9') {
            //充值失败,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('juhe', $orderid, file_get_contents("php://input"));
            $flag && PorderModel::rechargeFail($orderid, "充值失败|接口回调|" . json_encode(file_get_contents("php://input")));
        }
        echo "success";
    }

    //易信友
    public function yxyou()
    {
        $state = intval(I('state'));
        if ($state == 1) {
            //充值成功,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('yxyou', I('ord'), $_GET);
            $flag && PorderModel::rechargeSusApi(I('ord'), "充值成功|接口回调|" . json_encode($_GET));
            echo "success";
        } elseif ($state == 2) {
            //充值失败,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('yxyou', I('ord'), $_GET);
            $flag && PorderModel::rechargeFailApi(I('ord'), "充值失败|接口回调|" . json_encode($_GET));
            echo "success";
        } else {
            echo "fail";
        }
    }

    //猿人
    public function yuanren()
    {
        $state = intval(I('state'));
        if ($state == 1) {
            //充值成功,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('yuanren', I('out_trade_num'), $_POST);
            $flag && PorderModel::rechargeSusApi(I('out_trade_num'), "充值成功|接口回调|" . json_encode($_POST));
            echo "success";
        } elseif ($state == 2) {
            //充值失败,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('yuanren', I('out_trade_num'), $_POST);
            $flag && PorderModel::rechargeFailApi(I('out_trade_num'), "充值失败|接口回调|" . json_encode($_POST));
            echo "success";
        } else {
            echo "fail";
        }
    }


    //jupay
    public function jindong()
    {
        $state = intval(I('status'));
        if ($state == 1) {
            //充值成功,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('jupay', I('order_id'), $_POST);
            $flag && PorderModel::rechargeSusApi(I('order_id'), "充值成功|接口回调|" . json_encode($_POST));
            echo "success";
        } else {
            //充值失败,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('jupay', I('order_id'), $_POST);
            $flag && PorderModel::rechargeFailApi(I('order_id'), "充值失败|接口回调|" . json_encode($_POST));
            echo "success";
        }
    }

    //小哥
    public function xiaoge()
    {
        $state = intval(I('nFlag'));
        if ($state == 2) {
            //充值成功,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('xiaoge', I('szOrderId'), $_POST);
            $flag && PorderModel::rechargeSusApi(I('szOrderId'), "充值成功|接口回调|" . json_encode($_POST));
            echo "ok";
        } else if ($state == 3) {
            //充值失败,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('xiaoge', I('szOrderId'), $_POST);
            $flag && PorderModel::rechargeFailApi(I('szOrderId'), "充值失败|接口回调|" . json_encode($_POST));
            echo "ok";
        }
        echo "ok";
    }
    //一尘慢充
    public function yichenslow()
    {
        $state = intval(I('nFlag'));
        if ($state == 2) {
            //充值成功,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('xiaoge', I('szOrderId'), $_POST);
            $flag && PorderModel::rechargeSusApi(I('szOrderId'), "充值成功|接口回调|" . json_encode($_POST));
            echo "ok";
        } else if ($state == 3) {
            //充值失败,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('xiaoge', I('szOrderId'), $_POST);
            $flag && PorderModel::rechargeFailApi(I('szOrderId'), "充值失败|接口回调|" . json_encode($_POST));
            echo "ok";
        }
    }
    //晓创普通
    public function xcpt()
    {
        $state = I('state');
        if ($state == 'SUCCESS') {
            //充值成功,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('xcpt', I('order_sn'), $_POST);
            $flag && PorderModel::rechargeSusApi(I('szOrderId'), "充值成功|接口回调|" . json_encode($_REQUEST));
            echo "SUCCESS";
        } else {
            //充值失败,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('xcpt', I('order_sn'), $_POST);
            $flag && PorderModel::rechargeFailApi(I('order_sn'), "充值失败|接口回调|" . json_encode($_REQUEST));
            echo "SUCCESS";
        }
    }
    //流量通 慢充 by 呆呆
    public function liuliangtong() {
        $state = intval(I('Status'));
        if ($state == 4) {
            //充值成功,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('liuliangtong', I('OutTradeNo'), $_GET);
            $flag && PorderModel::rechargeSusApi(I('OutTradeNo'), "充值成功|接口回调|" . json_encode($_GET));
            echo "ok";
        } else  {
            //充值失败,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('liuliangtong', I('OutTradeNo'), $_GET);
            $flag && PorderModel::rechargeFailApi(I('OutTradeNo'), "充值失败|接口回调|" . json_encode($_GET));
            echo "ok";
        }
    }
    //WT联通
    public function wtlt() {
        $state = intval(I('status'));
        if ($state == 1) {
            //充值成功,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('wtlt', I('order_id'), $_POST);
            $flag && PorderModel::rechargeSusApi(I('order_id'), "充值成功|接口回调|" . json_encode($_POST));
            echo "success";
        }  {
            //充值失败,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('wtlt', I('order_id'), $_POST);
            $flag && PorderModel::rechargeFailApi(I('order_id'), "充值失败|接口回调|" . json_encode($_POST));
            echo "success";
        }
    }
    //光杨慢充
    public function guangyangman()
    {
        $state = intval(I('nFlag'));
        if ($state == 2) {
            //充值成功,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('guangyangman', I('szOrderId'), $_POST);
            $flag && PorderModel::rechargeSusApi(I('szOrderId'), "充值成功|接口回调|" . json_encode($_POST));
            echo "ok";
        } else if ($state == 3) {
            //充值失败,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('guangyangman', I('szOrderId'), $_POST);
            $flag && PorderModel::rechargeFailApi(I('szOrderId'), "充值失败|接口回调|" . json_encode($_POST));
            echo "ok";
        }
    }
    // 德鑫慢充
    public function dexinslow()
    {
        $state = intval(I('status'));
        if ($state == 3) {
            //充值成功,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('dexinslow', I('out_trade_no'), $_POST);
            $flag && PorderModel::rechargeSusApi(I('out_trade_no'), "充值成功|接口回调|" . json_encode($_POST));
            echo "ok";
        } else  {
            //充值失败,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('dexinslow', I('out_trade_no'), $_POST);
            $flag && PorderModel::rechargeFailApi(I('out_trade_no'), "充值失败|接口回调|" . json_encode($_POST));
            echo "fail";
        }
    }
    //中恒
    public function zhonghen()
    {
        $state = intval(I('status'));
        if ($state == 1) {
            //充值成功,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('zhonghen', I('orderId'), $_GET);
            $flag && PorderModel::rechargeSusApi(I('orderId'), "充值成功|接口回调|" . json_encode($_GET));
            echo "success";
        } else if (in_array($state, [2, 3, 0])) {
            //充值失败,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('zhonghen', I('orderId'), $_GET);
            $flag && PorderModel::rechargeFailApi(I('orderId'), "充值失败|接口回调|" . json_encode($_GET));
            echo "success";
        }
    }
    // WT三网慢充
    public function wtallslow() {
        $state = intval(I('status'));
        if ($state == 1) {
            //充值成功,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('zhonghen', I('partner_order_no'), $_POST);
            $flag && PorderModel::rechargeSusApi(I('partner_order_no'), "充值成功|接口回调|" . json_encode($_POST));
            echo "success";
        } else  {
            //充值失败,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('zhonghen', I('partner_order_no'), $_GET);
            $flag && PorderModel::rechargeFailApi(I('partner_order_no'), "充值失败|接口回调|" . json_encode($_POST));
            echo "success";
        }
    }
    //电信慢充
    public function dianxinslow()
    {
        $res =  json_decode($_POST);
        $this->writelog($res."电信慢充回掉");
        $state = $res['status'];
        if ($state == 'PAID') {
            //充值成功,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('dianxinslow', $res['rechargeOrder'], $_POST);
            $flag && PorderModel::rechargeSusApi($res['rechargeOrder'], "充值成功|接口回调|" . $_POST);
            echo "success";
        } else{
            //充值失败,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('dianxinslow', $res['rechargeOrder'], $_POST);
            $flag && PorderModel::rechargeFailApi($res['rechargeOrder'], "充值失败|接口回调|" . $_POST);
            echo "success";
        }
    }
    //移动分省慢充
    public function yidongprovince()
    {
        $state = I('order_status');
        if ($state == 'success') {
            //充值成功,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('yidongprovince', I('out_trade_no'), $_POST);
            $flag && PorderModel::rechargeSusApi(I('out_trade_no'), "充值成功|接口回调|" . json_encode($_POST));
            echo "success";
        } else {
            //充值失败,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('yidongprovince', I('out_trade_no'), $_POST);
            $flag && PorderModel::rechargeFailApi(I('out_trade_no'), "充值失败|接口回调|" . json_encode($_POST));
            echo "success";
        }
    }

    // 暴龙慢充
    public function baolongslow() {
        $state = I('order_status');
        if ($state == 'success') {
            //充值成功,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('baolongslow', I('order_id'), $_GET);
            $flag && PorderModel::rechargeSusApi(I('order_id'), "充值成功|接口回调|" . json_encode($_GET));
            echo "success";
        } else  {
            //充值失败,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('baolongslow', I('order_id'), $_GET);
            $flag && PorderModel::rechargeFailApi(I('order_id'), "充值失败|接口回调|" . json_encode($_GET));
            echo "success";
        }
    }

    private function writelog($text)
    {
        $myfile = fopen("apinotifylog.txt", "a") or die("Unable to open file!");
        fwrite($myfile, '---------start---------' . "\r\n" . time_format(time()) . "\r\n" . $text . "\r\n---------end---------\r\n\r\n");
        fclose($myfile);
    }

    //存储日志,并检查是否可以执行回调操作
    private function apinotify_log($api, $out_trade_no, $data)
    {
        if (!$out_trade_no) {
            return false;
        }
        $log = M('apinotify_log')->where(['api' => $api, 'out_trade_no' => $out_trade_no])->find();
        M('apinotify_log')->insertGetId([
            'api' => $api,
            'out_trade_no' => $out_trade_no,
            'data' => var_export($data, true),
            'create_time' => time()
        ]);
        if ($log) {
            return false;
        } else {
            return true;
        }
    }
}
