<?php


namespace Recharge;

use think\Log;

/**
 * 作者：呆呆
 * wx:trssoft66
 **/
class YiDongProvince
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
            "id" => $this->szAgentId,
            "out_trade_no" => $out_trade_num,
            "phonenumber" => $mobile,
            "amount" => $param['param1'],
            "operator" => $teltype,
            "rechargetype" => '1', //充值类型  0 快充  1 慢充
            "timestamp" => time(),
        ];
        $data['notifyurl'] = $this->notify;
        $data['nonce_str'] = time();
        ksort($data);
//        $signstr = 'amount='.$data['amount'].'&id='.$data['id'].'&notifyurl='.$data['notifyurl'].'&operator='.$data['operator'].'&out_trade_no='.$data['out_trade_no'].'&phonenumber='.$data['phonenumber'].'&rechargetype='.$data['rechargetype'].'&timestamp='.$data['timestamp']."&key=".$this->szKey;
        $signstr = urldecode(http_build_query($data))."&key=".$this->szKey;
        Log::error("签名串：".$signstr);
        $sign = strtoupper(md5($signstr));
        $data['sign'] = $sign;

        return $this->http_post($this->apiurl, $data);
    }

    private function get_teltype($str)
    {
        switch ($str) {
            case '移动':
                return 'CMCC';
            case '联通':
                return 'CUCC';
            case '电信':
                return 'CTCC';
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
            if ($result['code'] == 0) {
                return rjson(0, $result['code'].$result['msg'], $result);
            } else {
                return rjson(1, $result['code'].$result['msg'], $result);
            }
        } else {
            return rjson(1, '接口访问失败，http错误码' . $aStatus["http_code"]);
        }
    }
}