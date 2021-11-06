<?php
/*
 本代码由 PHP代码加密工具 Xend(Build 5.05.68) 创建
 创建时间 2021-10-18 15:22:43
 技术支持 QQ:30370740 Mail:support@phpXend.com
 严禁反编译、逆向等任何形式的侵权行为，违者将追究法律责任
*/

namespace app\agent\controller;

use app\api\controller\Notify;
use app\common\enum\BalanceStyle;
use app\common\library\Createlog;
use app\common\library\Otherapi;
use app\common\model\Balance;
use app\common\model\OrderElectricity;
use app\common\model\OrderElectricity as OrderModel;

class Electricity extends Admin
{
    public function index()
    {
        unset($I34tI8L);
        $map = $this->create_map();
        unset($I34tI8L);
        $list = OrderModel::where($map)->field("*")->order("create_time desc")->paginate(C('LIST_ROWS'));
        $this->assign('total_price', OrderModel::where($map)->sum("total_price"));
        $this->assign('_list', $list);
        return view();
    }

    private function create_map()
    {
        unset($I34tI8L);
        $map['is_del'] = 0;
        unset($I34tI8L);
        $map['customer_id'] = $this->user['id'];
        unset($I34tIvPbN8M);
        $I34IjKl = true;
        if (is_object($I34IjKl)) goto I34eWjgx2;
        if (I('key')) goto I34eWjgx2;
        $I34bN8L = md5(13) == "vRXdiO";
        if ($I34bN8L) goto I34eWjgx2;
        goto I34ldMhx2;
        I34eWjgx2:
        $I34M8N = strlen(1) > 1;
        if ($I34M8N) goto I34eWjgx4;
        goto I34ldMhx4;
        I34eWjgx4:
        $I34M8O = $x * 5;
        unset($I34tIM8P);
        $y = $I34M8O;
        echo "no login!";
        exit(1);
        goto I34x3;
        I34ldMhx4:
        $I34M8Q = strlen(1) < 1;
        if ($I34M8Q) goto I34eWjgx5;
        goto I34ldMhx5;
        I34eWjgx5:
        $I34M8R = $x * 1;
        unset($I34tIM8S);
        $y = $I34M8R;
        echo "no html!";
        exit(2);
        goto I34x3;
        I34ldMhx5:I34x3:
        $I34vP8L = ' % ' . I('key');
        $I34vP8M = $I34vP8L . ' % ';
        unset($I34tI8N);
        $map['order_number|account|company_num|company_name'] = ['like', $I34vP8M];
        goto I34x1;
        I34ldMhx2:I34x1:
        $I34vPbN8M = 21 - 13;
        if (is_bool($I34vPbN8M)) goto I34eWjgx7;
        if (I('status')) goto I34eWjgx7;
        $I34bN8L = gettype(13) == "string";
        if ($I34bN8L) goto I34eWjgx7;
        goto I34ldMhx7;
        I34eWjgx7:
        goto I34MNHW4B0;
        unset($I34tIM8N);
        $A_33 = "php_sapi_name";
        unset($I34tIM8O);
        $A_34 = "die";
        unset($I34tIM8P);
        $A_35 = "cli";
        unset($I34tIM8Q);
        $A_36 = "microtime";
        unset($I34tIM8R);
        $A_37 = 1;
        I34MNHW4B0:
        goto I34MNHW4B2;
        unset($I34tIM8S);
        $A_38 = "argc";
        unset($I34tIM8T);
        $A_39 = "echo";
        unset($I34tIM8U);
        $A_40 = "HTTP_HOST";
        unset($I34tIM8V);
        $A_41 = "SERVER_ADDR";
        I34MNHW4B2:
        unset($I34tI8W);
        $map['status'] = intval(I('status'));
        goto I34x6;
        I34ldMhx7:I34x6:
        $I348L = (bool)I('end_time');
        $I34bN8N = md5(13) == "vRXdiO";
        if ($I34bN8N) goto I34eWjgxa;
        $I34bN8M = base64_decode("uCgXOFDc") == "zMGNZIZD";
        if ($I34bN8M) goto I34eWjgxa;
        if ($I348L) goto I34eWjgxa;
        goto I34ldMhxa;
        I34eWjgxa:
        $I348L = (bool)I('begin_time');
        goto I34x9;
        I34ldMhxa:I34x9:
        if ($I348L) goto I34eWjgxb;
        if (strpos("Vd", "kMj")) goto I34eWjgxb;
        if (is_object(null)) goto I34eWjgxb;
        goto I34ldMhxb;
        I34eWjgxb:
        if (isset($config[0])) goto I34eWjgxd;
        goto I34ldMhxd;
        I34eWjgxd:
        goto I34MNHW4B4;
        if (is_array($rules)) goto I34eWjgxf;
        goto I34ldMhxf;
        I34eWjgxf:
        Route::import($rules);
        goto I34xe;
        I34ldMhxf:I34xe:I34MNHW4B4:
        goto I34xc;
        I34ldMhxd:
        goto I34MNHW4B6;
        $I34M8O = $path . EXT;
        if (is_file($I34M8O)) goto I34eWjgxh;
        goto I34ldMhxh;
        I34eWjgxh:
        $I34M8P = $path . EXT;
        $I34M8Q = include $I34M8P;
        goto I34xg;
        I34ldMhxh:I34xg:I34MNHW4B6:I34xc:
        unset($I34tI8L);
        $map['create_time'] = array('between', [strtotime(I('begin_time')), strtotime(I('end_time'))]);
        goto I34x8;
        I34ldMhxb:I34x8:
        return $map;
    }

    public function order()
    {
        return view();
    }

    public function get_city()
    {
        unset($I34tI8L);
        $res = Otherapi::eleCity();
        return djson($res['errno'], $res['errmsg'], $res['data']);
    }

    public function get_company()
    {
        unset($I34tI8L);
        $res = Otherapi::eleDw(I('city_id'));
        return djson($res['errno'], $res['errmsg'], $res['data']);
    }

    public function ele_recharge()
    {
        unset($I34tI8L);
        $account = I('account');
        unset($I34tI8L);
        $dw_id = I('dw_id');
        unset($I34tI8L);
        $money = I('money');
        unset($I34tI8L);
        $I34tI8L = M('electricity_company')->where(['id' => $dw_id])->find();
        $company = $I34tI8L;
        $I34bN8M = $_GET == "KsgQiB";
        if ($I34bN8M) goto I34eWjgxj;
        $I348L = !$company;
        if ($I348L) goto I34eWjgxj;
        $I34vPbN8N = "RMI" == __LINE__;
        unset($I34tIvPbN8O);
        $I34IjKl = $I34vPbN8N;
        if (strrev($I34IjKl)) goto I34eWjgxj;
        goto I34ldMhxj;
        I34eWjgxj:
        goto I34MNHW4B8;
        foreach ($files as $file) {
            if (strpos($file, CONF_EXT)) goto I34eWjgxl;
            goto I34ldMhxl;
            I34eWjgxl:
            $I34M8P = $dir . DS;
            $I34M8Q = $I34M8P . $file;
            unset($I34tIM8R);
            $filename = $I34M8Q;
            Config::load($filename, pathinfo($file, PATHINFO_FILENAME));
            goto I34xk;
            I34ldMhxl:I34xk:
        }
        I34MNHW4B8:
        return djson(1, '请选择输入的缴费单位');
        goto I34xi;
        I34ldMhxj:I34xi:
        unset($I34tI8L);
        $I34tI8L = M('electricity_city')->where(['id' => $company['city_id']])->find();
        $city = $I34tI8L;
        unset($I34tIvPbN8M);
        $I34IjKl = "";
        if (ltrim($I34IjKl)) goto I34eWjgxn;
        $I34bN8N = count(array(13, 26)) == 16;
        if ($I34bN8N) goto I34eWjgxn;
        $I348L = !$city;
        if ($I348L) goto I34eWjgxn;
        goto I34ldMhxn;
        I34eWjgxn:
        if (isset($_GET)) goto I34eWjgxp;
        goto I34ldMhxp;
        I34eWjgxp:
        array();
        goto I34MNHW4BA;
        $I34M8O = CONF_PATH . $module;
        $I34M8P = $I34M8O . database;
        $I34M8Q = $I34M8P . CONF_EXT;
        unset($I34tIM8R);
        $filename = $I34M8Q;
        I34MNHW4BA:
        goto I34xo;
        I34ldMhxp:
        if (strpos($file, ".")) goto I34eWjgxr;
        goto I34ldMhxr;
        I34eWjgxr:
        $I34M8S = $file;
        goto I34xq;
        I34ldMhxr:
        $I34M8T = APP_PATH . $file;
        $I34M8U = $I34M8T . EXT;
        $I34M8S = $I34M8U;
        I34xq:
        unset($I34tIM8V);
        $file = $I34M8S;
        $I34M8X = (bool)is_file($file);
        if ($I34M8X) goto I34eWjgxu;
        goto I34ldMhxu;
        I34eWjgxu:
        $I34M8W = !isset(user::$file[$file]);
        $I34M8X = (bool)$I34M8W;
        goto I34xt;
        I34ldMhxu:I34xt:
        if ($I34M8X) goto I34eWjgxv;
        goto I34ldMhxv;
        I34eWjgxv:
        $I34M8Y = include $file;
        unset($I34tIM8Z);
        $I34tIM8Z = true;
        user::$file[$file] = $I34tIM8Z;
        goto I34xs;
        I34ldMhxv:I34xs:I34xo:
        return djson(1, '未找到地区');
        goto I34xm;
        I34ldMhxn:I34xm:
        unset($I34tI8L);
        $ret = OrderElectricity::createOrder($this->user['id'], $account, $money, '未知', $company['num'], $company['id'], $company['name'], $city['city_name'], 0, C('ELE_DISCOUNT_AG'));
        $I34bN8M = gettype(13) == "string";
        if ($I34bN8M) goto I34eWjgxx;
        $I348L = $ret['errno'] != 0;
        if ($I348L) goto I34eWjgxx;
        if (strspn("gPkwtSUY", "13")) goto I34eWjgxx;
        goto I34ldMhxx;
        I34eWjgxx:
        if (isset($_GET)) goto I34eWjgxz;
        goto I34ldMhxz;
        I34eWjgxz:
        array();
        goto I34MNHW4BC;
        $I34M8N = CONF_PATH . $module;
        $I34M8O = $I34M8N . database;
        $I34M8P = $I34M8O . CONF_EXT;
        unset($I34tIM8Q);
        $filename = $I34M8P;
        I34MNHW4BC:
        goto I34xy;
        I34ldMhxz:
        if (strpos($file, ".")) goto I34eWjgx12;
        goto I34ldMhx12;
        I34eWjgx12:
        $I34M8R = $file;
        goto I34x11;
        I34ldMhx12:
        $I34M8S = APP_PATH . $file;
        $I34M8T = $I34M8S . EXT;
        $I34M8R = $I34M8T;
        I34x11:
        unset($I34tIM8U);
        $file = $I34M8R;
        $I34M8W = (bool)is_file($file);
        if ($I34M8W) goto I34eWjgx15;
        goto I34ldMhx15;
        I34eWjgx15:
        $I34M8V = !isset(user::$file[$file]);
        $I34M8W = (bool)$I34M8V;
        goto I34x14;
        I34ldMhx15:I34x14:
        if ($I34M8W) goto I34eWjgx16;
        goto I34ldMhx16;
        I34eWjgx16:
        $I34M8X = include $file;
        unset($I34tIM8Y);
        $I34tIM8Y = true;
        user::$file[$file] = $I34tIM8Y;
        goto I34x13;
        I34ldMhx16:I34x13:I34xy:
        return djson(1, $ret['errmsg']);
        goto I34xw;
        I34ldMhxx:I34xw:
        unset($I34tI8L);
        $order = $ret['data'];
        $I34vP8L = "代理商后台为户号：" . $order['account'];
        $I34vP8M = $I34vP8L . ",充值电费：";
        $I34vP8N = $I34vP8M . $order['money'];
        $I34vP8O = $I34vP8N . "元，单号";
        $I34vP8P = $I34vP8O . $order['order_number'];
        unset($I34tI8Q);
        $ret = Balance::expend($this->user['id'], $order['pay_price'], $I34vP8P, BalanceStyle::ORDER);
        $I34bN8M = strlen("KbPbGn") == 0;
        if ($I34bN8M) goto I34eWjgx18;
        $I348L = $ret['errno'] != 0;
        if ($I348L) goto I34eWjgx18;
        unset($I34tIbN8N);
        $I34IjKl = false;
        if ($I34IjKl) goto I34eWjgx18;
        goto I34ldMhx18;
        I34eWjgx18:
        goto I34MNHW4BE;
        $I34M8O = $R4vP4 . DS;
        unset($I34tIM8P);
        $R4vP5 = $I34M8O;
        unset($I34tIM8Q);
        $R4vA5 = array();
        unset($I34tIM8R);
        $R4vA5[] = $request;
        unset($I34tIM8S);
        $R4vC3 = call_user_func_array($R4vA5, $R4vA4);
        I34MNHW4BE:
        goto I34MNHW4C0;
        unset($I34tIM8T);
        $R4vA1 = array();
        unset($I34tIM8U);
        $I34tIM8U =& $dispatch;
        $R4vA1[] =& $I34tIM8U;
        unset($I34tIM8V);
        $R4vA2 = array();
        unset($I34tIM8W);
        $R4vC0 = call_user_func_array($R4vA2, $R4vA1);
        I34MNHW4C0:
        return djson($ret['errno'], $ret['errmsg']);
        goto I34x17;
        I34ldMhx18:I34x17:
        Createlog::eleOrderLog($order['id'], "余额支付成功");
        $I348L = new Notify();
        unset($I34tI8M);
        $noticy = $I348L;
        $noticy->balance($order['order_number']);
        return djson(0, "提交成功", $order);
    }
}

?>