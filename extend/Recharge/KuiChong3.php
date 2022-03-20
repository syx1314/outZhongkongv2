<?php


namespace Recharge;


use think\Log;

/**
 * 淘京快充
 * 呆呆
 *  wx:trsoft66
 **/
class KuiChong3
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
    public function recharge($out_trade_num, $mobile, $param, $isp = '')
    {
        $data = [
            "MchId" => $this->userid,
            "Pid" => $param['param1'],
            "Account" => $mobile,
            "TimeStamp" => time(),
            "ExternalOrderNo" => $out_trade_num,
            "NotifyUrl" => $this->notify,
        ];
        $signStr=$data['Pid'].$data['Account'].$data['ExternalOrderNo'].$data['MchId']
            .$data['TimeStamp'].$this->apikey;
        $data['Sign'] = md5($signStr);
        return $this->http_post($this->apiurl, $data);
    }


    /**
     * post请求
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
        curl_setopt($oCurl, CURLOPT_TIMEOUT, 30);
        curl_setopt($oCurl, CURLOPT_HEADER, 0);
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        Log::error('提交得参数'.$strPOST);
        curl_close($oCurl);
        if (intval($aStatus["http_code"]) == 0) {
            return rjson(0, "http状态码0 无法确认是否提交成功请查看渠道", 'http状态码0 无法确认是否提交成功请查看渠道');
        }else {
            if (intval($aStatus["http_code"]) == 200) {
                $result = json_decode($sContent, true);
                Log::error(http_build_query($result));
                if ($result['status'] == '10001') {
                    return rjson(0, $result['status'], $result['message']);
                } else {
                    return rjson(1, $result['status'] . $result['message'], $result['message']);
                }
            } else {
                return rjson(1, '接口访问失败，http错误码' . $aStatus["http_code"]);
            }
        }
    }
}