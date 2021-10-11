<?php

namespace Recharge;
/**
 * 呆呆  wx：trsoft66
 * 流量通炫捷慢充
 */
class LiuLiangtongXueJieSlow
{
    private $szAgentId;//商户编号
    private $szKey;
    private $notify;
    private $apiurl;//话费充值接口

    public function __construct($option)
    {
        $this->szAgentId = isset($option['param1']) ? $option['param1'] : '';
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
            "szAgentId" => $this->szAgentId,
            "szOrderId" => $out_trade_num,
            "szPhoneNum" => $mobile,
            "nMoney" => $param['param1'],
            "nSortType" => $teltype,
            "nProductClass" => 1,
            "nProductType" => '1',
            'szTimeStamp' => $szTimeStamp
        ];
        $signstr = urldecode(http_build_query($data) . "&szKey=" . $this->szKey);
        $sign = md5($signstr);
        $data['szVerifyString'] = $sign;
        $data['szNotifyUrl'] = $this->notify;
        return $this->http_post($this->apiurl, $data);
    }

    private function get_teltype($str)
    {
        switch ($str) {
            case '移动':
                return 1;
            case '联通':
                return 2;
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
        if (intval($aStatus["http_code"]) == 200) {
            $result = json_decode($sContent, true);
            if ($result['nRtn'] == 0) {
                return rjson(0, $result['szRtnCode'], $result);
            } else {
                return rjson(1, $result['szRtnCode'], $result);
            }
        } else {
            return rjson(1, '接口访问失败，http错误码' . $aStatus["http_code"]);
        }
    }
}