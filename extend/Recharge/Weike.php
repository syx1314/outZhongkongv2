<?php


namespace Recharge;


use app\common\model\Porder as PorderModel;
use think\Log;

/**

 **/
class Weike
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

        $common_data = [
            "app_key" => $this->userid,
            "timestamp" => time(),
            "client" => '152.136.107.158',
            "v" => '1.0',
            "format" => 'json',
        ];

        $data = [
            "store_id" => '586',
            "mobile" => $mobile,
            "order_no" => $out_trade_num,
            "money" => $param['param1'],
            "notify_url" => $this->notify,
            "source" => 1,
            "recharge_type" => $param['param2'],// 充值类型 0 慢充 1 快充
        ];
        $common_data['sign'] = $this->sign(array_merge($common_data,$data));
        return $this->http_get($this->apiurl.'?'.http_build_query($common_data), $data);
    }
//blink
    public function notify()
    {
        $jsonStr=file_get_contents('php://input');
        Log::error('Weike回掉'.$jsonStr);
        //	订单状态 状态 订单状态 0 待支付 1 已付 充值中 2充值成功 3充值失败 需要退款 4退款成功
        // 5已超时 6待充值 7 已匹配 8 已存单 9 已取消 10返销 11部分到账
        //
        //仅在2，3，10情况下进行通知，其他不用处理
        $arr = json_decode($jsonStr,true);
        $state = $arr['status'];
        if ($state == 2) {
            //充值成功,根据自身业务逻辑进行后续处理
            PorderModel::rechargeSusApi('Weike',$arr['order_no'], "充值成功|接口回调|" . $jsonStr);
            echo "success";
        } elseif ($state == 3 || $state == 4) {
            //充值失败,根据自身业务逻辑进行后续处理
            PorderModel::rechargeFailApi('Weike',$arr['order_no'], "充值失败|接口回调|" . $jsonStr);
            echo "success";
        }
    }



    //签名
    public function sign($data)
    {
        ksort($data);
        $sign_str = $this->apikey.str_replace('=','',urldecode(http_build_query($data))). $this->apikey;
        $sign_str = str_replace("&",'',$sign_str);
        Log::error("签名串".$sign_str);
        return strtoupper(md5(urldecode($sign_str)));
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
            $strPOST = http_build_query($param);
        }
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($oCurl, CURLOPT_POST, true);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS, $strPOST);
        curl_setopt($oCurl, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($oCurl, CURLOPT_TIMEOUT, 30);
        curl_setopt($oCurl, CURLOPT_HEADER, 0);
        Log::error("Weikeurl".$url);
        Log::error("Weike提交".$strPOST);
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        curl_close($oCurl);
        if (intval($aStatus["http_code"]) == 200) {
            $result = json_decode($sContent, true);
            if ($result['code'] == 0) {
                return rjson(0, $result['msg'], $result['msg']);
            } else {
                return rjson(1, $result['msg'], $result['msg']);
            }
        } else {
            return rjson(1, '接口访问失败，http错误码' . $aStatus["http_code"]);
        }
    }
}
