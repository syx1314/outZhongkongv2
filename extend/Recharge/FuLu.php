<?php


namespace Recharge;


use think\Log;

/**
 * 福禄
 * 呆呆
 *  wx:trsoft66
 **/
class FuLu
{
    private $userid;
    private $AppSecret;
    private $notify;
    private $apiurl;//充值接口

    public function __construct($option)
    {
        $this->userid = isset($option['param1']) ? $option['param1'] : '';
        $this->AppSecret = isset($option['param2']) ? $option['param2'] : '';
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
        $szTimeStamp = date("Y-m-d H:i:s", time());
        $data = [
            "product_id" => $param['param1'],
            "customer_order_no" => $out_trade_num,
            "charge_account" => $mobile,
            "buy_num" => 1,
            "shop_type" => "其他",
        ];
        // 公共参数
        $pubData = [
            "app_key" => $this->userid,
            "method" => "fulu.order.direct.add",
            "timestamp" => $szTimeStamp,
            "version" => "2.0",
            "format" => "json",
            "charset" => "utf-8",
            "sign_type" => "md5",
            "app_auth_token" => "",
            "biz_content" => json_encode($data),
        ];
        $pubData['sign'] = $this->getSign($pubData);
        Log::error($pubData);
        return $this->http_get($this->apiurl, $pubData);
    }
    /**
     * php签名方法
     */
    public function getSign($Parameters)
    {
        //签名步骤一：把字典json序列化
        $json = json_encode( $Parameters, 320 );
        //签名步骤二：转化为数组
        $jsonArr = $this->mb_str_split( $json );
        //签名步骤三：排序
        sort( $jsonArr );
        //签名步骤四：转化为字符串
        $string = implode( '', $jsonArr );
        //签名步骤五：在string后加入secret
        $string = $string . $this->AppSecret;
        //签名步骤六：MD5加密
        $result_ = strtolower( md5( $string ) );
        return $result_;
    }
    /**
     * 可将字符串中中文拆分成字符数组
     */
    function mb_str_split($str){
        return preg_split('/(?<!^)(?!$)/u', $str );
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
        curl_setopt($oCurl, CURLOPT_HTTPHEADER, ["Content-Type:application/json"]);
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        curl_close($oCurl);
        if (intval($aStatus["http_code"]) == 200) {
            $result = json_decode($sContent, true);
            Log::error(http_build_query($result));
            if ($result['code'] == 0) {
                return rjson(0, $result['code'], http_build_query($result));
            } else {
                return rjson(1, $result['code'].$result['message'], $result['message']);
            }
        } else {
            return rjson(1, '接口访问失败，http错误码' . $aStatus["http_code"]);
        }
    }
}