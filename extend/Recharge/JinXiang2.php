<?php


namespace Recharge;

use think\Log;

/**
 * 作者：呆呆
 * wx:trssoft66
 **/
class JinXiang2
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
        $szTimeStamp = date("YmdHis", time());
        $data = [
            "userid" => $this->szAgentId,
            "productid" => '',
            "price" => $param['param1'],
            "num" => 1,
            "mobile" => $mobile,
            "spordertime" => $szTimeStamp,
            "sporderid" => $out_trade_num,
        ];
        $signstr = urldecode(http_build_query($data))."&key=".$this->szKey;
        $data['paytype'] = $teltype;
        Log::error("签名串：".$signstr);
        $data['back_url'] = $this->notify;
        $sign = md5($signstr);
        $data['sign'] = $sign;

        return $this->http_post($this->apiurl, $data);
    }

    private function get_teltype($str)
    {
        switch ($str) {
            case '移动':
                return 'yd';
            case '联通':
                return 'lt';
            case '电信':
                return 'dx';
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
        Log::error("提交得数据".$strPOST.json_encode($param));
        curl_close($oCurl);
        if (intval($aStatus["http_code"]) == 0) {
            return rjson(0, "http状态码0 无法确认是否提交成功请查看渠道", 'http状态码0 无法确认是否提交成功请查看渠道');
        }else{
            if (intval($aStatus["http_code"]) == 200) {
                Log::error("返回数据".$sContent);
                $sContent = $this->strToUtf8($sContent);
                $sContent=str_replace('<?xml version="1.0" encoding="gb2312"?>','',$sContent);
                $sContent='<XML>'.$sContent.'</XML>';
                $result = json_decode( json_encode(simplexml_load_string($sContent)), true);
                Log::error("返回数据".http_build_query($result));
                $result =$result['order'];
                if ($result['resultno'] == 0 || $result['resultno'] == 2) {
                    return rjson(0, $result['resultno'], urldecode(http_build_query($result)));
                } else {
                    return rjson(1, $result['resultno'], urldecode(http_build_query($result)));
                }
            } else {
                return rjson(1, '接口访问失败，http错误码' . $aStatus["http_code"]);
            }
        }

    }
    function strToUtf8($str){
        $encode = mb_detect_encoding($str, array("ASCII",'UTF-8',"GB2312","GBK",'BIG5'));
        if($encode == 'UTF-8'){
            return $str;
        }else{
            return mb_convert_encoding($str, 'UTF-8', $encode);
        }
    }
}