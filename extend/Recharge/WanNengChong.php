<?php

namespace Recharge;
use think\Log;

/**
 * 作者：dd
 * wx：trsoft66
 * 万能充
 **/
class WanNengChong
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
    public function recharge($out_trade_num, $mobile, $param, $isp = '',$province)
    {

        $teltype = $this->get_teltype($isp);
        $data = [
            "app_id" => $this->partner_id,
            "out_trade_id" => $out_trade_num,
            "phone_num" => $mobile,
            "amount" => $param['param1'],
            "payment_code" => $teltype,
            "province" => $this->getProvinceCode($province),
        ];
        $data['notify_url'] = $this->notify;
        ksort($data);
        $signstr = urldecode(http_build_query($data)).'&app_secret='.$this->szKey;
        $sign = strtoupper(md5($signstr));
        $data['md5_sign'] = $sign;

        return $this->http_post($this->apiurl, $data);
    }


    private function get_teltype($str)
    {
        switch ($str) {
            case '移动':
                return 100;
            case '联通':
                return 200;
            case '电信':
                return 300;
            default:
                return -1;
        }
    }

    private function  getProvinceCode($province) {
        $data = [
            '北京'=>'11',
            '天津'=>'12',
            '河北'=>'13',
            '山西'=>'14',
            '内蒙古自治区'=>'15',
            '辽宁'=>'21',
            '吉林'=>'22',
            '黑龙江'=>'23',
            '上海'=>'31',
            '江苏'=>'32',
            '浙江'=>'33',
            '安徽'=>'34',
            '福建'=>'35',
            '江西'=>'36',
            '山东'=>'37',
            '河南'=>'41',
            '湖北'=>'42',
            '湖南'=>'43',
            '广东'=>'44',
            '广西自治区'=>'45',
            '海南'=>'46',
            '重庆'=>'50',
            '四川'=>'51',
            '贵州'=>'52',
            '云南'=>'53',
            '西藏自治区'=>'54',
            '陕西'=>'61',
            '甘肃'=>'62',
            '青海'=>'63',
            '宁夏自治区'=>'64',
            '新疆自治区'=>'65',
        ];
        $provinceCode='';
        foreach($data as $key => $value){
            Log::error('遍历---'.$key.'-----'.$value);
            if (strpos($key,$province)!=false || strpos($province,$key)!=false) {
                $provinceCode = $value;
                break;
            }
        }
        return $provinceCode;
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
        Log::error('提交得参数'.$strPOST);
        curl_close($oCurl);
        if (intval($aStatus["http_code"]) == 0) {
            return rjson(0, "http状态码0 无法确认是否提交成功请查看渠道", 'http状态码0 无法确认是否提交成功请查看渠道');
        } else {
            if (intval($aStatus["http_code"]) == 200) {
                $result = json_decode($sContent, true);
                if ($result['state'] == 'ok') {
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