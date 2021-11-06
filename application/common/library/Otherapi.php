<?php
/**
 * Created by PhpStorm.
 * User: 12048
 * Date: 2018-03-23
 * Time: 21:42
 */

namespace app\common\library;


use app\common\model\Customer;
use Recharge\Yuanren;
use Recharge\Yxyou;
use Util\Http;

class Otherapi
{

    //查询qq昵称
    public static function getQqNick($qq)
    {
        if (intval(C('SYS_TYPE')) == 1) {
            $api = 'http://r.qzone.qq.com/fcg-bin/cgi_get_portrait.fcg';
            $url = $api . '?' . http_build_query(['uins' => $qq]);
            $ret = Http::get($url);
            $ret = mb_convert_encoding((string)$ret, 'UTF-8', 'GB2312');
            $ret = str_replace("\n", '', $ret);
            preg_match('/^.*\((.*)\)\;{0,1}$/', $ret, $match);
            $infoStr = $match[1];
            $infoArr = json_decode($infoStr, true);
            if (isset($infoArr['error'])) {
                $errInfo = $infoArr['error'];
                $errmsg = isset($errInfo['msg']) ? $errInfo['msg'] : json_encode($errInfo);
                return rjson(1, $errmsg);
            }
            foreach ($infoArr as $userId => $info) {
                $data = [
                    'qq' => $userId,
                    'head_img' => isset($info[0]) ? $info[0] : '',
                    'nickname' => isset($info[6]) ? $info[6] : '',
                ];
                return rjson(0, 'ok', $data);
            }
            return rjson(1, '未查询到qq信息');
        } else {
            $config = M('reapi')->where(['id' => 4])->find();
            $api = new Yuanren(["userid" => $config['param1'], "apikey" => $config['param2'], "notify" => $config['param3'], 'apiurl' => $config['param4']]);
            $res = $api->qqnick($qq);
            return $res;
        }
    }


    //查询用户手机余额
    public static function mobileBalance($mobile, $customer_id)
    {
        $res = Customer::canQueryBalanceClock();
        if ($res['errno'] != 0) {
            return rjson(1, $res['errmsg']);
        }
        $res = Customer::canQueryBalance($customer_id);
        if ($res['errno'] != 0) {
            return rjson(1, $res['errmsg']);
        }

        if (intval(C('SYS_TYPE')) == 1) {
            $config = M('reapi')->where(['id' => 7])->find();
            $yx = new Yxyou($config);
            $res = $yx->cus_info($mobile);
            if ($res['errno'] != 0) {
                return rjson(1, $res['errmsg']);
            }
            $result = explode("|", $res['data']);
            return rjson(0, '查询成功', ['name' => $result[1], 'balance' => $result[2]]);
        } else {
            $config = M('reapi')->where(['id' => 4])->find();
            $api = new Yuanren(["userid" => $config['param1'], "apikey" => $config['param2'], "notify" => $config['param3'], 'apiurl' => $config['param4']]);
            $res = $api->mobile_balance($mobile);
            return $res;
        }
    }

    //电费余额查询
    public static function eleBalance($dw_id, $account)
    {
        $res = Customer::canQueryBalanceClock();
        if ($res['errno'] != 0) {
            return rjson(1, $res['errmsg']);
        }
        if (intval(C('SYS_TYPE')) == 1) {
            $company = M('electricity_company')->where(['id' => $dw_id])->find();
            if (!$company) {
                return rjson(1, '请选择输入的缴费单位');
            }
            $city = M('electricity_city')->where(['id' => $company['city_id']])->find();
            if (!$city) {
                return rjson(1, '未找到地区');
            }
            if ($company['ke_cha'] == 0) {
                return rjson(0, '该地区不能查询余额', ['account' => $account, 'company_id' => $company['id'], 'company_name' => $company['name'], 'company_num' => $company['num'], 'name' => '未知', 'balance' => '未知', 'more' => '', 'city' => $city['city_name']]);
            }
            $config = M('reapi')->where(['id' => 7])->find();
            $yx = new Yxyou($config);
            $res = $yx->cus_info($account, 6, $company['num']);
            if ($res['errno'] != 0) {
                return rjson(1, $res['errmsg']);
            }
            $result = explode("|", $res['data']);
            return rjson(0, '查询成功', ['account' => $account, 'company_id' => $company['id'], 'company_name' => $company['name'], 'company_num' => $company['num'], 'name' => $result[1], 'balance' => $result[2], 'more' => $result[3], 'city' => $city['city_name']]);
        } else {
            $config = M('reapi')->where(['id' => 4])->find();
            $api = new Yuanren(["userid" => $config['param1'], "apikey" => $config['param2'], "notify" => $config['param3'], 'apiurl' => $config['param4']]);
            $res = $api->ele_balance($dw_id, $account);
            return $res;
        }
    }

    //电费地区
    public static function eleCity()
    {
        if (intval(C('SYS_TYPE')) == 1) {
            $initials = M('electricity_city')->group('initial asc')->field('initial')->select();
            $arr = [];
            foreach ($initials as $ini) {
                $list = M('electricity_city')->where(['initial' => $ini['initial']])->order('sort asc')->select();
                $arr[] = ['letter' => $ini['initial'], 'list' => $list];
            }
            return rjson(0, 'ok', $arr);
        } else {
            $config = M('reapi')->where(['id' => 4])->find();
            $api = new Yuanren($config);
            $res = $api->ele_city();
            return rjson($res['errno'], $res['errmsg'], $res['data']);
        }
    }

    //电费地区
    public static function eleDw($city_id)
    {
        if (intval(C('SYS_TYPE')) == 1) {
            $map = [];
            $city_id && $map['city_id'] = $city_id;
            $company = M('electricity_company')->where($map)->order('sort asc')->select();
            if (!$company) {
                return rjson(1, '没有可缴费单位');
            }
            return rjson(0, 'ok', $company);
        } else {
            $config = M('reapi')->where(['id' => 4])->find();
            $api = new Yuanren($config);
            $res = $api->ele_dw(I('city_id'));
            return rjson($res['errno'], $res['errmsg'], $res['data']);
        }
    }
}