<?php

namespace Recharge;
/**
 * 作者：dd
 * wx：trsoft66
 * WT联通
 **/
class YiChenLTSlow
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
        $szTimeStamp = time();
        $data = [
            "partner_id" => $this->partner_id,
            "partner_order_no" => $out_trade_num,
            "phone" => $mobile,
            "amount" => $param['param1'],
            "type" => $teltype,
        ];
        $data['notify_url'] = $this->notify;
        $signstr = urldecode($data['partner_id'] . $data['partner_order_no'] . $data['phone'] . $data['amount'] . $data['type'] . $data['notify_url'] . $this->szKey);
        $sign = md5($signstr);
        $data['sign'] = $sign;

        return $this->http_post($this->apiurl, $data);
    }


    private function get_teltype($str)
    {
        switch ($str) {
            case '移动':
                return 2;
            case '联通':
                return 1;
            case '电信':
                return 3;
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
        if (intval($aStatus["http_code"]) == 0) {
            return rjson(0, "http状态码0 无法确认是否提交成功请查看渠道", 'http状态码0 无法确认是否提交成功请查看渠道');
        } else {
            if (intval($aStatus["http_code"]) == 200) {
                $result = json_decode($sContent, true);
                if ($result['code'] == 1) {
                    return rjson(0, $result['msg'], $result);
                } else {
                    return rjson(1, $result['msg'], $result);
                }
            } else {
                return rjson(1, '接口访问失败，http错误码' . $aStatus["http_code"]);
            }
        }
    }
}