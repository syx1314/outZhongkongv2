<?php


namespace Recharge;


use think\Log;

/**
 * 淘京快充
 * 呆呆
 *  wx:trsoft66
 **/
class TaoJinKui
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
            "UserId" => $this->userid,
            "ChargeAccount" => $mobile,
            "ProductType" => 1,
            "IspType" => $this->get_teltype($isp),
            "UserOrderId" => $out_trade_num,
            "Parvalue" => $param['param1'],
            "CallbackUrl" => $this->notify,
        ];
        $signStr='UserId'.$data['UserId'].'UserOrderId'.$data['UserOrderId'].'ChargeAccount'.$data['ChargeAccount'].'Parvalue'.$data['Parvalue']
            .'ProductType'.$data['ProductType'].'CallbackUrl'.$data['CallbackUrl'].$this->apikey;
        $data['sign'] = md5($signStr);
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
                if ($result['code'] == '0000') {
                    return rjson(0, $result['code'], $result['message']);
                } else {
                    return rjson(1, $result['code'] . $result['message'], $result['message']);
                }
            } else {
                return rjson(1, '接口访问失败，http错误码' . $aStatus["http_code"]);
            }
        }
    }
}