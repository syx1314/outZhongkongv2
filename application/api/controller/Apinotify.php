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

    public function ruice() {
        $state = intval(I('state'));
        if ($state == 1) {
            //充值成功,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('ruice', I('out_trade_num'), $_POST);
            $flag && PorderModel::rechargeSusApi(I('out_trade_num'), "充值成功|接口回调|" . json_encode($_POST));
            echo "success";
        } elseif ($state == 2) {
            //充值失败,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('ruice', I('out_trade_num'), $_POST);
            $flag && PorderModel::rechargeFailApi(I('out_trade_num'), "充值失败|接口回调|" . json_encode($_POST));
            echo "success";
        } else {
            echo "fail";
        }
    }

    /**
     * 写日志
     */
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
