<?php

namespace app\api\controller;

use app\common\model\Porder as PorderModel;
use Recharge\LiuLiangTong;
use Recharge\WTLT;
use think\Log;

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
    //凯文慢充
    public function kaiwenslow()
    {
        $state = intval(I('nFlag'));
        if ($state == 2) {
            //充值成功,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('kaiwenslow', I('szOrderId'), $_POST);
            $flag && PorderModel::rechargeSusApi(I('szOrderId'), "充值成功|接口回调|" . json_encode($_POST));
            echo "ok";
        } else if ($state == 3) {
            //充值失败,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('kaiwenslow', I('szOrderId'), $_POST);
            $flag && PorderModel::rechargeFailApi(I('szOrderId'), "充值失败|接口回调|" . json_encode($_POST));
            echo "ok";
        }
    }
    //移动分省慢充v2
    public function yidongprovincev2()
    {
        $state = intval(I('status'));
        if ($state == 3) {
            //充值成功,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('yidongprovincev2', I('order_id'), $_POST);
            $flag && PorderModel::rechargeSusApi(I('order_id'), "充值成功|接口回调|" . json_encode($_POST));
            echo "success";
        } else if ($state == 5) {
            //充值失败,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('yidongprovincev2', I('order_id'), $_POST);
            $flag && PorderModel::rechargeFailApi(I('order_id'), "充值失败|接口回调|" . json_encode($_POST));
            echo "success";
        }
    }
    //大卫联通慢充
    public function dawailiantongslow()
    {
        //        交易结果（0充值中 1已到账 2已退款 3已超时/已失败）
        $state = intval(I('status'));
        if ($state == 1) {
            //充值成功,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('dawailiantongslow', I('order_id'), $_POST);
            $flag && PorderModel::rechargeSusApi(I('order_id'), "充值成功|接口回调|" . json_encode($_POST));
            echo "success";
        } else if ($state == 3 || $state == 2) {
            //充值失败,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('dawailiantongslow', I('order_id'), $_POST);
            $flag && PorderModel::rechargeFailApi(I('order_id'), "充值失败|接口回调|" . json_encode($_POST));
            echo "success";
        }
    }
    //PP移动分省
    public function PPYiDongProvince()
    {
        //        交易结果（0充值中 1已到账 2已退款 3已超时/已失败）
      $jsonStr=  file_get_contents("php://input");
       $res=json_decode($jsonStr,true);
        $state = $res['return_code'];
        if ($state == 'SUCCESS') {
            //充值成功,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('PPYiDongProvince',$res['return_msg']['orderid'], $jsonStr);
            $flag && PorderModel::rechargeSusApi($res['return_msg'], "充值成功|接口回调|" . $jsonStr);
            echo '{"return_code":"OK"}';
        } else  {
            //充值失败,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('PPYiDongProvince', $res['return_msg']['orderid'], $_POST);
            $flag && PorderModel::rechargeFailApi($res['return_msg']['orderid'], "充值失败|接口回调|" . $jsonStr);
            echo '{"return_code":"OK"}';
        }
    }
    //赞赞联通
    public function zanzanliantong()
    {
        $state = intval(I('state'));
        if ($state == 2) {
            //充值成功,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('zanzanliantong', I('ordernum'), $_POST);
            $flag && PorderModel::rechargeSusApi(I('ordernum'), "充值成功|接口回调|" . json_encode($_POST));
            echo "ok";
        } else if ($state == 3) {
            //充值失败,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('zanzanliantong', I('ordernum'), $_POST);
            $flag && PorderModel::rechargeFailApi(I('ordernum'), "充值失败|接口回调|" . json_encode($_POST));
            echo "ok";
        }
    }
    //力骏
    public function junfeng()
    {
        Log::error("返回得数据".http_build_query($_POST));
        $state = intval(I('resultno'));
        if ($state == 1) {
            //充值成功,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('jinxiang2', I('orderid'), $_POST);
            $result = $flag && PorderModel::rechargeSusApi(I('orderid'), "充值成功|接口回调|" . json_encode($_POST));
            if ($result) {
                echo "OK";
            }else{
                echo "fail数据库或者日志写入出错";
            }

        } else if ($state == 9) {
            //充值失败,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('jinxiang2', I('orderid'), $_POST);
            $result =$flag && PorderModel::rechargeFailApi(I('orderid'), "充值失败|接口回调|" . json_encode($_POST));
            if ($result) {
                echo "OK";
            }else{
                echo "fail数据库或者日志写入出错";
            }
        }
    }
    //一尘联通慢充
    public function yichenltslow() {
        Log::error("yichenltslow".file_get_contents("php://input"));
        $state = intval(I('status'));
        if ($state == 1) {
            //充值成功,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('yichenltslow', I('partner_order_no'), $_POST);
            $result=($flag && PorderModel::rechargeSusApi(I('partner_order_no'), "充值成功|接口回调|" . json_encode($_POST)));
            if ($result) {
                echo "success";
            }else{
                echo "fail数据库或者日志写入出错".$flag;
            }
        }else {
            //充值失败,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('yichenltslow', I('partner_order_no'), $_POST);
            $result=($flag && PorderModel::rechargeFailApi(I('partner_order_no'), "充值失败|接口回调|" . json_encode($_POST)));
            if ($result) {
                echo "success";
            }else{
                echo "充值失败---fail数据库或者日志写入出错---".$flag;
            }
        }
    }
    //一尘联通慢充
    public function baoshijiewangting() {
        Log::error("yichenltslow".file_get_contents("php://input"));
        $state = intval(I('status'));
        if ($state == 1) {
            //充值成功,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('baoshijiewangting', I('partner_order_no'), $_POST);
            $result=($flag && PorderModel::rechargeSusApi(I('partner_order_no'), "充值成功|接口回调|" . json_encode($_POST)));
            if ($result) {
                echo "success";
            }else{
                echo "fail--《1》数据库或者日志写入出错\n<2> 数据库记录已经存在日志写入过";
            }
        }else {
            //充值失败,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('baoshijiewangting', I('partner_order_no'), $_POST);
            $result=($flag && PorderModel::rechargeFailApi(I('partner_order_no'), "充值失败|接口回调|" . json_encode($_POST)));
            if ($result) {
                echo "success";
            }else{
                echo "fail--《1》数据库或者日志写入出错\n<2> 数据库记录已经存在日志写入过";
            }
        }
    }
    //blink
    public function blink()
    {
        $state = intval(I('state'));
        if ($state == 1) {
            //充值成功,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('yuanren', I('out_trade_num'), $_POST);
            $result=($flag && PorderModel::rechargeSusApi(I('out_trade_num'), "充值成功|接口回调|" . json_encode($_POST)));
            if ($result) {
                echo "success";
            }else{
                echo "fail数据库或者日志写入出错".$flag;
            }
        } elseif ($state == 2) {
            //充值失败,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('yuanren', I('out_trade_num'), $_POST);
            $result=($flag && PorderModel::rechargeFailApi(I('out_trade_num'), "充值失败|接口回调|" . json_encode($_POST)));
            if ($result) {
                echo "success";
            }else{
                echo "fail数据库或者日志写入出错".$flag;
            }
        } else {
            echo "fail";
        }
    }
    //花生日记
    public function huashengriji()
    {
        Log::error(http_build_query($_REQUEST));
//        交易结果（0充值中 1已到账 2已退款 3已超时/已失败）
        $state = intval(I('status'));
        if ($state == 1) {
            //充值成功,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('zanzanliantong', I('ordernum'), $_POST);
            $flag && PorderModel::rechargeSusApi(I('ordernum'), "充值成功|接口回调|" . json_encode($_POST));
            echo "success";
        } else if ($state == 3 || $state == 2) {
            //充值失败,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('zanzanliantong', I('ordernum'), $_POST);
            $flag && PorderModel::rechargeFailApi(I('ordernum'), "充值失败|接口回调|" . json_encode($_POST));
            echo "success";
        }
    }
    //福禄
    public function fulu()
    {
        $res = json_decode($_POST);
        $state = $res['order_status'];
        if ($state == 'success') {
            //充值成功,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('fulu', $res['customer_order_no'], $_POST);
            $flag && PorderModel::rechargeSusApi($res['customer_order_no'], "充值成功|接口回调|" . json_encode($_POST));
            echo "success";
        } else if ($state == 'failed') {
            //充值失败,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('fulu', $res['customer_order_no'], $_POST);
            $flag && PorderModel::rechargeFailApi($res['customer_order_no'], "充值失败|接口回调|" . json_encode($_POST));
            echo "success";
        }
    }
    //淘京
    public function taojin()
    {
        Log::error("淘金回调1".http_build_query($_POST));
        Log::error("淘金回调1".http_build_query($_REQUEST));
        Log::error("淘金回调2".file_get_contents("php://input"));
        $state = intval(I('Status'));
        if ($state == 1) {
            //充值成功,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('taojin', I('OrderId'), $_POST);
            $flag && PorderModel::rechargeSusApi(I('OrderId'), "充值成功|接口回调|" . json_encode($_POST));
            echo "OK";
        } else if ($state == 2) {
            //充值失败,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('taojin', I('OrderId'), $_POST);
            $flag && PorderModel::rechargeFailApi(I('OrderId'), "充值失败|接口回调|" . json_encode($_POST));
            echo "OK";
        }
    }
    //潮流量
    public function chaoliuliang()
    {
        Log::error("chaoliuliang".http_build_query($_POST));
        Log::error("chaoliuliang".http_build_query($_REQUEST));
        Log::error("chaoliuliang".file_get_contents("php://input"));
        $state = intval(I('order_status'));
        if ($state == 1) {
            //充值成功,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('chaoliuliang', I('order_id'), $_POST);
            $flag && PorderModel::rechargeSusApi(I('order_id'), "充值成功|接口回调|" . json_encode($_POST));
            echo "200";
        } else if ($state == -1) {
            //充值失败,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('chaoliuliang', I('order_id'), $_POST);
            $flag && PorderModel::rechargeFailApi(I('order_id'), "充值失败|接口回调|" . json_encode($_POST));
            echo "200";
        }
    }
    //万能充
    public function wannengchong()
    {
        $state = intval(I('state'));
        if ($state == 9) {
            //充值成功,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('wannengchong', I('out_trade_id'), $_POST);
            $result=($flag && PorderModel::rechargeSusApi(I('out_trade_id'), "充值成功|接口回调|" . json_encode($_POST)));
            if ($result) {
                echo "success";
            }else{
                echo "fail数据库或者日志写入出错".$flag;
            }
        } else {
            //充值失败,根据自身业务逻辑进行后续处理
            $flag = $this->apinotify_log('wannengchong', I('out_trade_id'), $_POST);
            $result=($flag && PorderModel::rechargeFailApi(I('out_trade_id'), "充值失败|接口回调|" . json_encode($_POST)));
            if ($result) {
                echo "success";
            }else{
                echo "fail数据库或者日志写入出错".$flag;
            }
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
