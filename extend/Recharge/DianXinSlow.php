<?php


namespace Recharge;

use think\Log;/**
 * 作者：dd
 * wx：trsoft66
 * 电信慢充
 **/
class DianXinSlow
{
    private $user_id;//商户编号
    private $szKey;
    private $notify;
    private $apiurl;//话费充值接口

    public function __construct($option)
    {
        $this->user_id = isset($option['param1']) ? $option['param1'] : '';
        $this->szKey = isset($option['param2']) ? $option['param2'] : '';
        $this->notify = isset($option['param3']) ? $option['param3'] : '';
        $this->apiurl = isset($option['param4']) ? $option['param4'] : '';
    }

    /**
     * 提交充值号码充值
     */
    public function recharge($out_trade_num, $mobile, $param, $isp = '')
    {
        $data = [
            "rechargerId" => $this->user_id,
            "rechargeOrder" => $out_trade_num,
            "address" => '',
            "account" => $mobile,
            "amount" => $param['param1'],
            'expireTime' => $param['param2'] ,//毫秒
            'timeStamp' => time()*1000 //毫秒
        ];
        $data['notifyUrl'] = $this->notify;
        $signstr =$data['account'].$data['amount'] .$data['rechargerId'] .$data['timeStamp']  . $this->szKey;
        $sign = md5($signstr);
        $data['sign'] = $sign;
        Log::error('提交的数据'.json_encode($data));
        return $this->http_post($this->apiurl, $data);
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
        if (stripos($url, "https://") !== FALSE) {
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($oCurl, CURLOPT_SSLVERSION, 1);
        }
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
        curl_setopt($oCurl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        curl_close($oCurl);
        if (intval($aStatus["http_code"]) == 200) {
            $result = json_decode($sContent, true);
            if ($result['code'] == 0) {
                return rjson(0, '提交订单:'.$result['code'], $result);
            } else {
                return rjson(1, $result['code'].$result['msg'], $result);
            }
        } else {
            return rjson(1, '接口访问失败，http错误码' . $aStatus["http_code"]);
        }
    }
}