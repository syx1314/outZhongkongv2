<?php


namespace Recharge;


use think\Log;

/**
 * 赞赞联通
 * 呆呆
 *  wx:trsoft66
 **/
class ZanZanLianTong
{
    private $userid;
    private $apikey;
    private $notify;
    private $apiurl;//充值接口

    public function __construct($option)
    {
        $this->userid = isset($option['param1']) ? $option['param1'] : '';
        $this->apikey = isset($option['param2']) ? $option['param2'] : '';
        $this->notify = isset($option['param3']) ? $option['param3'] : '';
        $this->apiurl = isset($option['param4']) ? $option['param4'] : '';
    }

    /**
     * 提交充值号码充值
     * @param $out_trade_num
     * @param $mobile
     * @param $param
     * @param string $isp
     * @param $product_id
     * @return \think\response\Json
     */
    public function recharge($out_trade_num, $mobile, $param)
    {
        $szTimeStamp = date("YmdHis", time());
        $data = [
            "userid" => $this->userid,
            "mobile" => $mobile,
            "flowtype" => "fee_slow",
            "echo" => "57845676",
            "orderid" => $out_trade_num,
            "timestamp" => $szTimeStamp,
            "version" => "1.0",
            "packcode" => $param['param1'],
            "callback_url" => $this->notify,
        ];
        $signStr=$data['userid'].$data['orderid'].$this->apikey.$data['echo'].$data['timestamp'];
        $data['chargeSign'] = md5($signStr);
        return $this->http_get($this->apiurl, $data);
    }



    /**
     * get请求
     */
    private function http_get($url, $param)
    {
        $oCurl = curl_init();
        if (is_string($param)) {
            $strPOST = $param;
        } else {
            $strPOST = json_encode($param);
        }
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($oCurl, CURLOPT_POST, true);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS, $strPOST);
        curl_setopt($oCurl, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($oCurl, CURLOPT_TIMEOUT, 30);
        curl_setopt($oCurl, CURLOPT_HEADER, 0);
        curl_setopt($oCurl, CURLOPT_HTTPHEADER, ["ContentType:application/json"]);
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        curl_close($oCurl);
        if (intval($aStatus["http_code"]) == 200) {
            $result = json_decode($sContent, true);
            Log::error(http_build_query($result));
            if ($result['code'] == '0000') {
                return rjson(0, $result['code'], $result['desc']);
            } else {
                return rjson(1, $result['code'], $result['desc']);
            }
        } else {
            return rjson(1, '接口访问失败，http错误码' . $aStatus["http_code"]);
        }
    }
}