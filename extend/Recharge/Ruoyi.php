<?php

namespace Recharge;

use app\common\model\Porder as PorderModel;
use think\Log;

/**
 * @author 暴龙慢充
 * wx:trsoft66
 */
class Ruoyi
{
    private $partner_id;//商户编号
    private $szKey = '';
    private $notify = '';
    private $apiurl = '';//话费充值接口

    public function __construct($option)
    {
        $this->partner_id = isset($option['param1']) ? $option['param1'] : '';
        $this->szKey = isset($option['param2']) ? $option['param2'] : '';
        $this->notify = isset($option['param3']) ? $option['param3'] : '';
        $this->apiurl = isset($option['param4']) ? $option['param4'] : '';
    }

    /**
     * 提交充值号码充值
     */
    public function recharge($out_trade_num, $mobile, $param, $isp = '')
    {

        $teltype = $this->get_teltype($isp);
        $data = [
            "customerId" => $this->partner_id,
            "orderNo" => $out_trade_num,
            "phoneNumber" => $mobile,
            "price" => $param['param1'].'00',
            "operator" => $teltype,
        ];
        $data['notifyUrl'] = $this->notify;
        $data['chargeType'] = 2;
        $data['expireTime'] = $param['param2'];
        ksort($data);
        $signstr = urldecode(http_build_query($data)).'&key='.$this->szKey;
        Log::error("嗯u哦一 ".$signstr);
        $sign = md5($signstr);
        $data['sign'] =strtoupper($sign);
        Log::error($data['sign']);
        return $this->http_post($this->apiurl, $data);
    }


    private function get_teltype($str)
    {
        switch ($str) {
            case '移动':
                return '1';
            case '联通':
                return '2';
            case '电信':
                return '3';
            default:
                return -1;
        }
    }
    public function notify()
    {
        $state = intval(I('status'));
        if ($state == 3) {
            //充值成功,根据自身业务逻辑进行后续处理
            PorderModel::rechargeSusApi('ruoyi',I('orderNo'), "充值成功|接口回调|" . json_encode($_POST));
            echo "success";
        } elseif ($state == 4  || $state == 5) {
            //充值失败,根据自身业务逻辑进行后续处理
            PorderModel::rechargeFailApi('ruoyi',I('orderNo'), "充值失败|接口回调|" . json_encode($_POST));
            echo "success";
        } else {
            echo "fail";
        }
    }
    /**
     * get请求
     * @param $methond
     * @param $param
     * @return bool|mixed
     */
    private function http_post($url, $param)
    {
        $oCurl = curl_init();
        if (is_string($param)) {
            $strPOST = $param;
        } else {
            $strPOST = http_build_query($param);
        }
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($oCurl, CURLOPT_POST, true);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS, $strPOST);
        curl_setopt($oCurl, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($oCurl, CURLOPT_TIMEOUT, 60);
        curl_setopt($oCurl, CURLOPT_HEADER, 0);
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        Log::error('若以提交得参数'.$strPOST);
        curl_close($oCurl);
        if (intval($aStatus["http_code"]) == 200) {
            $result = json_decode($sContent, true);
            Log::error('返回得参数'.$sContent);
            if ($result['return_code'] == 200) {
                return rjson(0, $result['return_code'].$result['msg'], $result);
            } else {
                return rjson(1, $result['return_code'].$result['msg'], $result);
            }
        } else {
            return rjson(1, '接口访问失败，http错误码' . $aStatus["http_code"]);
        }
    }
}