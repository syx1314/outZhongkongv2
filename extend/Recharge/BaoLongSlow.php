<?php

namespace Recharge;

/**
 * @author 暴龙慢充
 * wx:trsoft66
 */
class BaoLongSlow
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
        $szTimeStamp = date("Y-m-d H:i:s", time());
        $data = [
            "uid" => $this->partner_id,
            "order_id" => $out_trade_num,
            "product_id" =>  $param['param2'],//平台分配的产品编码 必填
            "cellphone" => $mobile,
            "amount" => $param['param1'],
            "operator" => $teltype,
            "time" => $szTimeStamp,
        ];
        $data['notify_url'] = $this->notify;
        $signstr = urldecode(http_build_query($data).'&secret='.$this->szKey);

        $sign = sha1($signstr);
        $data['sign'] = strtolower($sign);

        return $this->http_post($this->apiurl, $data);
    }


    private function get_teltype($str)
    {
        switch ($str) {
            case '移动':
                return 'CM';
            case '联通':
                return 'CU';
            case '电信':
                return 'CT';
            default:
                return -1;
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
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        curl_close($oCurl);
        if (intval($aStatus["http_code"]) == 200) {
            $result = json_decode($sContent, true);
            if ($result['code'] == 200) {
                return rjson(0, $result['code'].$result['msg'], $result);
            } else {
                return rjson(1, $result['code'].$result['msg'], $result);
            }
        } else {
            return rjson(1, '接口访问失败，http错误码' . $aStatus["http_code"]);
        }
    }
}