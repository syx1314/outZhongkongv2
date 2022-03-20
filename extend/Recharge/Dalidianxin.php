<?php


namespace Recharge;


use app\common\model\Porder as PorderModel;
use think\Log;

/**

 **/
class Dalidianxin
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
            "splNo" => $this->userid,
            "body" => $mobile,
            "version" => 1.0,
            "signType" => 'MD5',
            "reqTime" => time().'000',
            "splOrderNo" => $out_trade_num,
            "ifCode" => 'dalang',
            "amount" => $param['param1'],
            "notifyUrl" => $this->notify,
            "expiredTime" => $param['param2'],// 过期时间 秒
        ];
        $data['sign'] = $this->sign($data);
        return $this->http_get($this->apiurl . 'index/recharge', $data);
    }
//blink
    public function notify()
    {
        Log::error('狸猫回掉'.json_encode($_POST));
        //	订单状态 0-订单生成,1-等待充值, 2-充值成功, 3-订单关闭
        $state = intval(I('state'));
        if ($state == 2) {
            //充值成功,根据自身业务逻辑进行后续处理
            PorderModel::rechargeSusApi('Limao',I('splOrderNo'), "充值成功|接口回调|" . json_encode($_POST));
            echo "success";
        } elseif ($state == 3) {
            //充值失败,根据自身业务逻辑进行后续处理
            PorderModel::rechargeFailApi('Limao',I('splOrderNo'), "充值失败|接口回调|" . json_encode($_POST));
            echo "success";
        }
    }



    //签名
    public function sign($data)
    {
        ksort($data);
        $sign_str = http_build_query($data) . '&key=' . $this->apikey;
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
        Log::error("limao提交".$strPOST);
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
