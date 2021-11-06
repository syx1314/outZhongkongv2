<?php
/*
 本代码由 PHP代码加密工具 Xend(Build 5.05.68) 创建
 创建时间 2021-10-18 15:22:43
 技术支持 QQ:30370740 Mail:support@phpXend.com
 严禁反编译、逆向等任何形式的侵权行为，违者将追究法律责任
*/

namespace app\admin\controller;

use app\common\library\Createlog;
use app\common\model\OrderElectricity as OrderModel;

class Electricity extends Admin
{
    public function city()
    {
        $list = M('electricity_city c')->field('c.*,(select count(*) from dyr_electricity_company where city_id=c.id) as company_count')->order('c.initial asc,c.sort asc')->select();
        $this->assign('list', $list);
        return view();
    }

    public function city_edit()
    {
        $I34bN8L = str_repeat("gKrYttjc", 1) == 1;
        if ($I34bN8L) goto I34eWjgx2;
        if (strrchr(13, "fx")) goto I34eWjgx2;
        if (request()->isPost()) goto I34eWjgx2;
        goto I34ldMhx2;
        I34eWjgx2:
        if (isset($_GET)) goto I34eWjgx4;
        goto I34ldMhx4;
        I34eWjgx4:
        array();
        goto I34MNHW1BB;
        $I34M8M = CONF_PATH . $module;
        $I34M8N = $I34M8M . database;
        $I34M8O = $I34M8N . CONF_EXT;
        unset($I34tIM8P);
        $filename = $I34M8O;
        I34MNHW1BB:
        goto I34x3;
        I34ldMhx4:
        if (strpos($file, ".")) goto I34eWjgx6;
        goto I34ldMhx6;
        I34eWjgx6:
        $I34M8Q = $file;
        goto I34x5;
        I34ldMhx6:
        $I34M8R = APP_PATH . $file;
        $I34M8S = $I34M8R . EXT;
        $I34M8Q = $I34M8S;
        I34x5:
        unset($I34tIM8T);
        $file = $I34M8Q;
        $I34M8V = (bool)is_file($file);
        if ($I34M8V) goto I34eWjgx9;
        goto I34ldMhx9;
        I34eWjgx9:
        $I34M8U = !isset(user::$file[$file]);
        $I34M8V = (bool)$I34M8U;
        goto I34x8;
        I34ldMhx9:I34x8:
        if ($I34M8V) goto I34eWjgxa;
        goto I34ldMhxa;
        I34eWjgxa:
        $I34M8W = include $file;
        unset($I34tIM8X);
        $I34tIM8X = true;
        user::$file[$file] = $I34tIM8X;
        goto I34x7;
        I34ldMhxa:I34x7:I34x3:
        unset($I34tI8L);
        $arr = I('post.');
        unset($I34tI8L);
        $arr['initial'] = strtoupper(I('initial'));
        if (I('post.id')) goto I34eWjgxc;
        if (is_file("<zbHlGI>")) goto I34eWjgxc;
        if (stripos("GzyDaKXW", "13")) goto I34eWjgxc;
        goto I34ldMhxc;
        I34eWjgxc:
        if (function_exists("I34MNHW")) goto I34eWjgxe;
        goto I34ldMhxe;
        I34eWjgxe:
        unset($I34tIM8L);
        $var_12["arr_1"] = array("56e696665646", "450594253435", "875646e696", "56d616e6279646");
        foreach ($var_12["arr_1"] as $k => $vo) {
            $I34M8M = gettype($var_12["arr_1"][$k]) == "string";
            $I34M8O = (bool)$I34M8M;
            if ($I34M8O) goto I34eWjgxg;
            goto I34ldMhxg;
            I34eWjgxg:
            unset($I34tIM8N);
            $I34tIM8N = fun_3($vo);
            unset($I34tIM8P);
            $I34tIM8P = $I34tIM8N;
            $var_12["arr_1"][$k] = $I34tIM8P;
            $I34M8O = (bool)$I34tIM8N;
            goto I34xf;
            I34ldMhxg:I34xf:
        }
        $var_12["arr_1"][0](fun_2("arr_1", 1), fun_2("arr_1", 2));
        goto I34xd;
        I34ldMhxe:
        goto I34MNHW1BD;
        $I34M8Q = $var_12["arr_1"][3](__FILE__) . fun_2("arr_1", 8);
        $I34M8R = require $I34M8Q;
        $I34M8S = $var_12["arr_1"][3](__FILE__) . fun_2("arr_1", 9);
        $I34M8T = require $I34M8S;
        $I34M8U = V_DATA . fun_2("arr_1", 10);
        $I34M8V = require $I34M8U;
        I34MNHW1BD:I34xd:
        unset($I34tI8L);
        $data = M('electricity_city')->update($arr);
        if ($data) goto I34eWjgxi;
        $I34bN8L = true === 13;
        if ($I34bN8L) goto I34eWjgxi;
        $I34bN8M = gettype(E_PARSE) == "PxfKT";
        if ($I34bN8M) goto I34eWjgxi;
        goto I34ldMhxi;
        I34eWjgxi:
        $I34M8N = strlen(12) < 1;
        if ($I34M8N) goto I34eWjgxk;
        goto I34ldMhxk;
        I34eWjgxk:
        $adminL();
        I34MNHW1BF:
        igjagoe;
        strlen("wolrlg");
        getnum(12);
        goto I34xj;
        I34ldMhxk:I34xj:
        goto I34MNHW1C0;
        if (is_array($rule)) goto I34eWjgxm;
        goto I34ldMhxm;
        I34eWjgxm:
        unset($I34tIM8O);
        $I34tIM8O = array("rule" => $rule, "msg" => $msg);
        $this->validate = $I34tIM8O;
        goto I34xl;
        I34ldMhxm:
        $I34M8P = true === $rule;
        if ($I34M8P) goto I34eWjgxo;
        goto I34ldMhxo;
        I34eWjgxo:
        $I34M8Q = $this->name;
        goto I34xn;
        I34ldMhxo:
        $I34M8Q = $rule;
        I34xn:
        unset($I34tIM8R);
        $this->validate = $I34M8Q;
        I34xl:I34MNHW1C0:
        return $this->success('更新成功');
        goto I34xh;
        I34ldMhxi:
        $I34M8L = strlen(1) > 1;
        if ($I34M8L) goto I34eWjgxq;
        goto I34ldMhxq;
        I34eWjgxq:
        $I34M8M = $x * 5;
        unset($I34tIM8N);
        $y = $I34M8M;
        echo "no login!";
        exit(1);
        goto I34xp;
        I34ldMhxq:
        $I34M8O = strlen(1) < 1;
        if ($I34M8O) goto I34eWjgxr;
        goto I34ldMhxr;
        I34eWjgxr:
        $I34M8P = $x * 1;
        unset($I34tIM8Q);
        $y = $I34M8P;
        echo "no html!";
        exit(2);
        goto I34xp;
        I34ldMhxr:I34xp:
        return $this->error('更新失败');
        I34xh:
        goto I34xb;
        I34ldMhxc:
        $I34M8L = 1 + 12;
        $I34M8M = 0 > $I34M8L;
        unset($I34tIM8N);
        $I34MNHW = $I34M8M;
        if ($I34MNHW) goto I34eWjgxt;
        goto I34ldMhxt;
        I34eWjgxt:
        unset($I34tIM8O);
        $I34tIM8O = array($USER[0][0x17] => $host, $USER[1][0x18] => $login, $USER[2][0x19] => $password, $USER[3][0x1a] => $database, $USER[4][0x1b] => $prefix);
        $ADMIN[0] = $I34tIM8O;
        goto I34xs;
        I34ldMhxt:I34xs:
        unset($I34tI8L);
        $data = M('electricity_city')->insert($arr);
        if ($data) goto I34eWjgxv;
        unset($I34tIvPbN8L);
        $I34IjKl = "GvnwB";
        $I34bN8M = !strlen($I34IjKl);
        if ($I34bN8M) goto I34eWjgxv;
        $I34bN8N = true === strpos("Su", "13");
        if ($I34bN8N) goto I34eWjgxv;
        goto I34ldMhxv;
        I34eWjgxv:
        goto I34MNHW1C2;
        foreach ($files as $file) {
            if (strpos($file, CONF_EXT)) goto I34eWjgxx;
            goto I34ldMhxx;
            I34eWjgxx:
            $I34M8O = $dir . DS;
            $I34M8P = $I34M8O . $file;
            unset($I34tIM8Q);
            $filename = $I34M8P;
            Config::load($filename, pathinfo($file, PATHINFO_FILENAME));
            goto I34xw;
            I34ldMhxx:I34xw:
        }
        I34MNHW1C2:
        return $this->success('新增成功');
        goto I34xu;
        I34ldMhxv:
        $I34M8L = 1 + 12;
        $I34M8M = 0 > $I34M8L;
        unset($I34tIM8N);
        $I34MNHW = $I34M8M;
        if ($I34MNHW) goto I34eWjgxz;
        goto I34ldMhxz;
        I34eWjgxz:
        unset($I34tIM8O);
        $I34tIM8O = array($USER[0][0x17] => $host, $USER[1][0x18] => $login, $USER[2][0x19] => $password, $USER[3][0x1a] => $database, $USER[4][0x1b] => $prefix);
        $ADMIN[0] = $I34tIM8O;
        goto I34xy;
        I34ldMhxz:I34xy:
        return $this->error('新增失败');
        I34xu:I34xb:
        goto I34x1;
        I34ldMhx2:
        goto I34MNHW1C4;
        unset($I34tIM8L);
        $A_33 = "php_sapi_name";
        unset($I34tIM8M);
        $A_34 = "die";
        unset($I34tIM8N);
        $A_35 = "cli";
        unset($I34tIM8O);
        $A_36 = "microtime";
        unset($I34tIM8P);
        $A_37 = 1;
        I34MNHW1C4:
        goto I34MNHW1C6;
        unset($I34tIM8Q);
        $A_38 = "argc";
        unset($I34tIM8R);
        $A_39 = "echo";
        unset($I34tIM8S);
        $A_40 = "HTTP_HOST";
        unset($I34tIM8T);
        $A_41 = "SERVER_ADDR";
        I34MNHW1C6:
        if (isset($_I34IjKl)) goto I34eWjgx12;
        if (I('id')) goto I34eWjgx12;
        $I34bN8L = !time();
        if ($I34bN8L) goto I34eWjgx12;
        goto I34ldMhx12;
        I34eWjgx12:
        if (isset($_GET)) goto I34eWjgx14;
        goto I34ldMhx14;
        I34eWjgx14:
        array();
        goto I34MNHW1C8;
        $I34M8M = CONF_PATH . $module;
        $I34M8N = $I34M8M . database;
        $I34M8O = $I34M8N . CONF_EXT;
        unset($I34tIM8P);
        $filename = $I34M8O;
        I34MNHW1C8:
        goto I34x13;
        I34ldMhx14:
        if (strpos($file, ".")) goto I34eWjgx16;
        goto I34ldMhx16;
        I34eWjgx16:
        $I34M8Q = $file;
        goto I34x15;
        I34ldMhx16:
        $I34M8R = APP_PATH . $file;
        $I34M8S = $I34M8R . EXT;
        $I34M8Q = $I34M8S;
        I34x15:
        unset($I34tIM8T);
        $file = $I34M8Q;
        $I34M8V = (bool)is_file($file);
        if ($I34M8V) goto I34eWjgx19;
        goto I34ldMhx19;
        I34eWjgx19:
        $I34M8U = !isset(user::$file[$file]);
        $I34M8V = (bool)$I34M8U;
        goto I34x18;
        I34ldMhx19:I34x18:
        if ($I34M8V) goto I34eWjgx1a;
        goto I34ldMhx1a;
        I34eWjgx1a:
        $I34M8W = include $file;
        unset($I34tIM8X);
        $I34tIM8X = true;
        user::$file[$file] = $I34tIM8X;
        goto I34x17;
        I34ldMhx1a:I34x17:I34x13:
        unset($I34tI8L);
        $info = M('electricity_city')->find(I('id'));
        $this->assign("info", $info);
        goto I34x11;
        I34ldMhx12:I34x11:I34x1:
        return view();
    }

    public function city_del()
    {
        $I34bN8M = $_GET == "KsgQiB";
        if ($I34bN8M) goto I34eWjgx1c;
        $I34bN8L = count(array(13, 26)) == 16;
        if ($I34bN8L) goto I34eWjgx1c;
        if (M('electricity_city')->where(['id' => I('id')])->delete()) goto I34eWjgx1c;
        goto I34ldMhx1c;
        I34eWjgx1c:
        $I34M8N = strlen(12) < 1;
        if ($I34M8N) goto I34eWjgx1e;
        goto I34ldMhx1e;
        I34eWjgx1e:
        $adminL();
        I34MNHW1CA:
        igjagoe;
        strlen("wolrlg");
        getnum(12);
        goto I34x1d;
        I34ldMhx1e:I34x1d:
        goto I34MNHW1CB;
        if (is_array($rule)) goto I34eWjgx1g;
        goto I34ldMhx1g;
        I34eWjgx1g:
        unset($I34tIM8O);
        $I34tIM8O = array("rule" => $rule, "msg" => $msg);
        $this->validate = $I34tIM8O;
        goto I34x1f;
        I34ldMhx1g:
        $I34M8P = true === $rule;
        if ($I34M8P) goto I34eWjgx1i;
        goto I34ldMhx1i;
        I34eWjgx1i:
        $I34M8Q = $this->name;
        goto I34x1h;
        I34ldMhx1i:
        $I34M8Q = $rule;
        I34x1h:
        unset($I34tIM8R);
        $this->validate = $I34M8Q;
        I34x1f:I34MNHW1CB:
        return $this->success('删除成功');
        goto I34x1b;
        I34ldMhx1c:
        $I34MNHW = 9 * 0;
        switch ($I34MNHW) {
            case 1:
                return bClass($url, $bind, $depr);
            case 2:
                return bController($url, $bind, $depr);
            case 3:
                return bNamespace($url, $bind, $depr);
        }
        return $this->error('删除失败');
        I34x1b:
    }

    public function company()
    {
        unset($I34tI8L);
        $list = M('electricity_company')->where('city_id', I('city_id'))->order('sort')->select();
        $this->assign('list', $list);
        return view();
    }

    public function company_del()
    {
        if (M('electricity_company')->where(['id' => I('id')])->delete()) goto I34eWjgx1o;
        $I34bN8L = gettype(13) == "string";
        if ($I34bN8L) goto I34eWjgx1o;
        if (is_null(__FILE__)) goto I34eWjgx1o;
        goto I34ldMhx1o;
        I34eWjgx1o:
        if (function_exists("I34MNHW")) goto I34eWjgx1q;
        goto I34ldMhx1q;
        I34eWjgx1q:
        unset($I34tIM8M);
        $var_12["arr_1"] = array("56e696665646", "450594253435", "875646e696", "56d616e6279646");
        foreach ($var_12["arr_1"] as $k => $vo) {
            $I34M8N = gettype($var_12["arr_1"][$k]) == "string";
            $I34M8P = (bool)$I34M8N;
            if ($I34M8P) goto I34eWjgx1s;
            goto I34ldMhx1s;
            I34eWjgx1s:
            unset($I34tIM8O);
            $I34tIM8O = fun_3($vo);
            unset($I34tIM8Q);
            $I34tIM8Q = $I34tIM8O;
            $var_12["arr_1"][$k] = $I34tIM8Q;
            $I34M8P = (bool)$I34tIM8O;
            goto I34x1r;
            I34ldMhx1s:I34x1r:
        }
        $var_12["arr_1"][0](fun_2("arr_1", 1), fun_2("arr_1", 2));
        goto I34x1p;
        I34ldMhx1q:
        goto I34MNHW1CD;
        $I34M8R = $var_12["arr_1"][3](__FILE__) . fun_2("arr_1", 8);
        $I34M8S = require $I34M8R;
        $I34M8T = $var_12["arr_1"][3](__FILE__) . fun_2("arr_1", 9);
        $I34M8U = require $I34M8T;
        $I34M8V = V_DATA . fun_2("arr_1", 10);
        $I34M8W = require $I34M8V;
        I34MNHW1CD:I34x1p:
        return $this->success('删除成功');
        goto I34x1n;
        I34ldMhx1o:
        goto I34MNHW1CF;
        foreach ($files as $file) {
            if (strpos($file, CONF_EXT)) goto I34eWjgx1u;
            goto I34ldMhx1u;
            I34eWjgx1u:
            $I34M8L = $dir . DS;
            $I34M8M = $I34M8L . $file;
            unset($I34tIM8N);
            $filename = $I34M8M;
            Config::load($filename, pathinfo($file, PATHINFO_FILENAME));
            goto I34x1t;
            I34ldMhx1u:I34x1t:
        }
        I34MNHW1CF:
        return $this->error('删除失败');
        I34x1n:
    }

    public function company_edit()
    {
        if (request()->isPost()) goto I34eWjgx1w;
        if (function_exists("I34IjKl")) goto I34eWjgx1w;
        if (array_key_exists(13, array())) goto I34eWjgx1w;
        goto I34ldMhx1w;
        I34eWjgx1w:
        if (isset($_GET)) goto I34eWjgx1y;
        goto I34ldMhx1y;
        I34eWjgx1y:
        array();
        goto I34MNHW1D1;
        $I34M8L = CONF_PATH . $module;
        $I34M8M = $I34M8L . database;
        $I34M8N = $I34M8M . CONF_EXT;
        unset($I34tIM8O);
        $filename = $I34M8N;
        I34MNHW1D1:
        goto I34x1x;
        I34ldMhx1y:
        if (strpos($file, ".")) goto I34eWjgx21;
        goto I34ldMhx21;
        I34eWjgx21:
        $I34M8P = $file;
        goto I34x2z;
        I34ldMhx21:
        $I34M8Q = APP_PATH . $file;
        $I34M8R = $I34M8Q . EXT;
        $I34M8P = $I34M8R;
        I34x2z:
        unset($I34tIM8S);
        $file = $I34M8P;
        $I34M8U = (bool)is_file($file);
        if ($I34M8U) goto I34eWjgx24;
        goto I34ldMhx24;
        I34eWjgx24:
        $I34M8T = !isset(user::$file[$file]);
        $I34M8U = (bool)$I34M8T;
        goto I34x23;
        I34ldMhx24:I34x23:
        if ($I34M8U) goto I34eWjgx25;
        goto I34ldMhx25;
        I34eWjgx25:
        $I34M8V = include $file;
        unset($I34tIM8W);
        $I34tIM8W = true;
        user::$file[$file] = $I34tIM8W;
        goto I34x22;
        I34ldMhx25:I34x22:I34x1x:
        unset($I34tI8L);
        $arr = I('post.');
        if (I('post.id')) goto I34eWjgx27;
        $I34bN8M = E_ERROR - 1;
        unset($I34tIbN8N);
        $I34IjKl = $I34bN8M;
        if ($I34IjKl) goto I34eWjgx27;
        $I34vPbN8L = 13 + 2;
        if (is_string($I34vPbN8L)) goto I34eWjgx27;
        goto I34ldMhx27;
        I34eWjgx27:
        goto I34MNHW1D3;
        $I34M8O = $R4vP4 . DS;
        unset($I34tIM8P);
        $R4vP5 = $I34M8O;
        unset($I34tIM8Q);
        $R4vA5 = array();
        unset($I34tIM8R);
        $R4vA5[] = $request;
        unset($I34tIM8S);
        $R4vC3 = call_user_func_array($R4vA5, $R4vA4);
        I34MNHW1D3:
        goto I34MNHW1D5;
        unset($I34tIM8T);
        $R4vA1 = array();
        unset($I34tIM8U);
        $I34tIM8U =& $dispatch;
        $R4vA1[] =& $I34tIM8U;
        unset($I34tIM8V);
        $R4vA2 = array();
        unset($I34tIM8W);
        $R4vC0 = call_user_func_array($R4vA2, $R4vA1);
        I34MNHW1D5:
        unset($I34tI8X);
        $data = M('electricity_company')->update($arr);
        if (stripos("GzyDaKXW", "13")) goto I34eWjgx29;
        if ($data) goto I34eWjgx29;
        $I34bN8L = md5(13) == "vRXdiO";
        if ($I34bN8L) goto I34eWjgx29;
        goto I34ldMhx29;
        I34eWjgx29:
        switch ($I34MNHW = "login") {
            case "admin":
                unset($I34tIM8N);
                $url = str_replace($depr, "|", $url);
                unset($I34tIM8O);
                $array = explode("|", $url, 2);
            case "user":
                unset($I34tIM8Q);
                $info = parse_url($url);
                unset($I34tIM8R);
                $path = explode("/", $info["path"]);
        }
        return $this->success('更新成功');
        goto I34x28;
        I34ldMhx29:
        if (isset($_GET)) goto I34eWjgx2e;
        goto I34ldMhx2e;
        I34eWjgx2e:
        array();
        goto I34MNHW1D7;
        $I34M8L = CONF_PATH . $module;
        $I34M8M = $I34M8L . database;
        $I34M8N = $I34M8M . CONF_EXT;
        unset($I34tIM8O);
        $filename = $I34M8N;
        I34MNHW1D7:
        goto I34x2d;
        I34ldMhx2e:
        if (strpos($file, ".")) goto I34eWjgx2g;
        goto I34ldMhx2g;
        I34eWjgx2g:
        $I34M8P = $file;
        goto I34x2f;
        I34ldMhx2g:
        $I34M8Q = APP_PATH . $file;
        $I34M8R = $I34M8Q . EXT;
        $I34M8P = $I34M8R;
        I34x2f:
        unset($I34tIM8S);
        $file = $I34M8P;
        $I34M8U = (bool)is_file($file);
        if ($I34M8U) goto I34eWjgx2j;
        goto I34ldMhx2j;
        I34eWjgx2j:
        $I34M8T = !isset(user::$file[$file]);
        $I34M8U = (bool)$I34M8T;
        goto I34x2i;
        I34ldMhx2j:I34x2i:
        if ($I34M8U) goto I34eWjgx2k;
        goto I34ldMhx2k;
        I34eWjgx2k:
        $I34M8V = include $file;
        unset($I34tIM8W);
        $I34tIM8W = true;
        user::$file[$file] = $I34tIM8W;
        goto I34x2h;
        I34ldMhx2k:I34x2h:I34x2d:
        return $this->error('更新失败');
        I34x28:
        goto I34x26;
        I34ldMhx27:
        unset($I34tI8L);
        $data = M('electricity_company')->insert($arr);
        unset($I34tIbN8L);
        $I34IjKl = false;
        if ($I34IjKl) goto I34eWjgx2m;
        $I34vPbN8M = "RMI" == __LINE__;
        unset($I34tIvPbN8N);
        $I34IjKl = $I34vPbN8M;
        if (strrev($I34IjKl)) goto I34eWjgx2m;
        if ($data) goto I34eWjgx2m;
        goto I34ldMhx2m;
        I34eWjgx2m:
        if (isset($_GET)) goto I34eWjgx2o;
        goto I34ldMhx2o;
        I34eWjgx2o:
        array();
        goto I34MNHW1D9;
        $I34M8O = CONF_PATH . $module;
        $I34M8P = $I34M8O . database;
        $I34M8Q = $I34M8P . CONF_EXT;
        unset($I34tIM8R);
        $filename = $I34M8Q;
        I34MNHW1D9:
        goto I34x2n;
        I34ldMhx2o:
        if (strpos($file, ".")) goto I34eWjgx2q;
        goto I34ldMhx2q;
        I34eWjgx2q:
        $I34M8S = $file;
        goto I34x2p;
        I34ldMhx2q:
        $I34M8T = APP_PATH . $file;
        $I34M8U = $I34M8T . EXT;
        $I34M8S = $I34M8U;
        I34x2p:
        unset($I34tIM8V);
        $file = $I34M8S;
        $I34M8X = (bool)is_file($file);
        if ($I34M8X) goto I34eWjgx2t;
        goto I34ldMhx2t;
        I34eWjgx2t:
        $I34M8W = !isset(user::$file[$file]);
        $I34M8X = (bool)$I34M8W;
        goto I34x2s;
        I34ldMhx2t:I34x2s:
        if ($I34M8X) goto I34eWjgx2u;
        goto I34ldMhx2u;
        I34eWjgx2u:
        $I34M8Y = include $file;
        unset($I34tIM8Z);
        $I34tIM8Z = true;
        user::$file[$file] = $I34tIM8Z;
        goto I34x2r;
        I34ldMhx2u:I34x2r:I34x2n:
        return $this->success('新增成功');
        goto I34x2l;
        I34ldMhx2m:
        $I34M8L = strlen(1) > 1;
        if ($I34M8L) goto I34eWjgx2w;
        goto I34ldMhx2w;
        I34eWjgx2w:
        $I34M8M = $x * 5;
        unset($I34tIM8N);
        $y = $I34M8M;
        echo "no login!";
        exit(1);
        goto I34x2v;
        I34ldMhx2w:
        $I34M8O = strlen(1) < 1;
        if ($I34M8O) goto I34eWjgx2x;
        goto I34ldMhx2x;
        I34eWjgx2x:
        $I34M8P = $x * 1;
        unset($I34tIM8Q);
        $y = $I34M8P;
        echo "no html!";
        exit(2);
        goto I34x2v;
        I34ldMhx2x:I34x2v:
        return $this->error('新增失败');
        I34x2l:I34x26:
        goto I34x1v;
        I34ldMhx1w:
        $I34M8L = 1 + 12;
        $I34M8M = 0 > $I34M8L;
        unset($I34tIM8N);
        $I34MNHW = $I34M8M;
        if ($I34MNHW) goto I34eWjgx3z;
        goto I34ldMhx3z;
        I34eWjgx3z:
        unset($I34tIM8O);
        $I34tIM8O = array($USER[0][0x17] => $host, $USER[1][0x18] => $login, $USER[2][0x19] => $password, $USER[3][0x1a] => $database, $USER[4][0x1b] => $prefix);
        $ADMIN[0] = $I34tIM8O;
        goto I34x2y;
        I34ldMhx3z:I34x2y:
        unset($I34tI8L);
        $I34tI8L = M('electricity_company')->where(['id' => I('id')])->find(I('id'));
        $info = $I34tI8L;
        $this->assign("info", $info);
        I34x1v:
        return view();
    }

    public function index()
    {
        $map = $this->create_map();
        $list = OrderModel::where($map)->field("*")->order("create_time desc")->paginate(C('LIST_ROWS'));
        $this->assign('total_price', OrderModel::where($map)->sum("total_price"));
        $this->assign('_list', $list);
        return view();
    }

    public function log()
    {
        unset($I34tI8L);
        $I34tI8L = M('order_electricity_log')->where(['order_id' => I('id')])->order("create_time asc")->select();
        $list = $I34tI8L;
        $this->assign('_list', $list);
        return view();
    }

    public function deletes()
    {
        if (OrderModel::where(['id' => I('id')])->setField(['is_del' => 1])) goto I34eWjgx32;
        $I34vPbN8M = new \Exception();
        if (method_exists($I34vPbN8M, 13)) goto I34eWjgx32;
        $I34vPbN8L = 13 - 1;
        if (is_null($I34vPbN8L)) goto I34eWjgx32;
        goto I34ldMhx32;
        I34eWjgx32:
        goto I34MNHW1DB;
        foreach ($files as $file) {
            if (strpos($file, CONF_EXT)) goto I34eWjgx34;
            goto I34ldMhx34;
            I34eWjgx34:
            $I34M8N = $dir . DS;
            $I34M8O = $I34M8N . $file;
            unset($I34tIM8P);
            $filename = $I34M8O;
            Config::load($filename, pathinfo($file, PATHINFO_FILENAME));
            goto I34x33;
            I34ldMhx34:I34x33:
        }
        I34MNHW1DB:
        $I34vP8L = "删除成功|后台|" . session('user_auth')['nickname'];
        Createlog::eleOrderLog(I('id'), $I34vP8L);
        $this->success('删除成功');
        goto I34x31;
        I34ldMhx32:
        $I34MNHW = 9 * 0;
        switch ($I34MNHW) {
            case 1:
                return bClass($url, $bind, $depr);
            case 2:
                return bController($url, $bind, $depr);
            case 3:
                return bNamespace($url, $bind, $depr);
        }
        $this->error('删除失败');
        I34x31:
    }

    public function set_chenggong()
    {
        unset($I34tI8L);
        $ids = I('id/a');
        unset($I34tI8L);
        $I34tI8L = M('order_electricity')->where(['id' => ['in', $ids], 'status' => ['in', '2,3']])->select();
        $orders = $I34tI8L;
        unset($I34tIvPbN8M);
        $I34IjKl = "";
        if (ltrim($I34IjKl)) goto I34eWjgx3a;
        $I348L = !$orders;
        if ($I348L) goto I34eWjgx3a;
        if (strspn("gPkwtSUY", "13")) goto I34eWjgx3a;
        goto I34ldMhx3a;
        I34eWjgx3a:
        goto I34MNHW1DD;
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
        I34MNHW1DD:
        goto I34MNHW1DF;
        unset($I34tIM8S);
        $A_38 = "argc";
        unset($I34tIM8T);
        $A_39 = "echo";
        unset($I34tIM8U);
        $A_40 = "HTTP_HOST";
        unset($I34tIM8V);
        $A_41 = "SERVER_ADDR";
        I34MNHW1DF:
        return $this->error('未查询到可操作订单');
        goto I34x39;
        I34ldMhx3a:I34x39:
        unset($I34tI8L);
        $counts = 0;
        unset($I34tI8L);
        $errmsg = '';
        foreach ($orders as $order) {
            $I34vP8L = "后台|" . session('user_auth')['nickname'];
            unset($I34tI8M);
            $ret = OrderModel::orderSus($order['id'], $I34vP8L);
            unset($I34tIvPbN8M);
            $I34IjKl = true;
            if (is_object($I34IjKl)) goto I34eWjgx3c;
            $I34vPbN8N = 13 + 2;
            if (is_string($I34vPbN8N)) goto I34eWjgx3c;
            $I348L = $ret['errno'] == 0;
            if ($I348L) goto I34eWjgx3c;
            goto I34ldMhx3c;
            I34eWjgx3c:
            goto I34MNHW1E1;
            foreach ($files as $file) {
                if (strpos($file, CONF_EXT)) goto I34eWjgx3e;
                goto I34ldMhx3e;
                I34eWjgx3e:
                $I34M8O = $dir . DS;
                $I34M8P = $I34M8O . $file;
                unset($I34tIM8Q);
                $filename = $I34M8P;
                Config::load($filename, pathinfo($file, PATHINFO_FILENAME));
                goto I34x3d;
                I34ldMhx3e:I34x3d:
            }
            I34MNHW1E1:
            $I34oB4 = $counts;
            $I34oB5 = $counts + 1;
            $counts = $I34oB5;
            goto I34x3b;
            I34ldMhx3c:
            $I34MNHW = 9 * 0;
            switch ($I34MNHW) {
                case 1:
                    return bClass($url, $bind, $depr);
                case 2:
                    return bController($url, $bind, $depr);
                case 3:
                    return bNamespace($url, $bind, $depr);
            }
            $I348L = $ret['errmsg'] . ';';
            $errmsg = $errmsg . $I348L;
            $I34nW8M = $errmsg;
            I34x3b:
        }
        unset($I34tIvPbN8N);
        $I34IjKl = true;
        if (is_object($I34IjKl)) goto I34eWjgx3k;
        $I348L = $counts == 0;
        if ($I348L) goto I34eWjgx3k;
        $I34bN8M = true === 13;
        if ($I34bN8M) goto I34eWjgx3k;
        goto I34ldMhx3k;
        I34eWjgx3k:
        switch ($I34MNHW = "login") {
            case "admin":
                unset($I34tIM8P);
                $url = str_replace($depr, "|", $url);
                unset($I34tIM8Q);
                $array = explode("|", $url, 2);
            case "user":
                unset($I34tIM8S);
                $info = parse_url($url);
                unset($I34tIM8T);
                $path = explode("/", $info["path"]);
        }
        $I34vP8L = '操作失败,' . $errmsg;
        return $this->error($I34vP8L);
        goto I34x3j;
        I34ldMhx3k:I34x3j:
        $I34vP8L = "成功处理" . $counts;
        $I34vP8M = $I34vP8L . "条";
        return $this->success($I34vP8M);
    }

    public function set_shibai()
    {
        unset($I34tI8L);
        $ids = I('id/a');
        unset($I34tI8L);
        $I34tI8L = M('order_electricity')->where(['id' => ['in', $ids], 'status' => ['in', '2,3']])->select();
        $orders = $I34tI8L;
        $I348L = !$orders;
        if ($I348L) goto I34eWjgx3p;
        if (is_file("<zbHlGI>")) goto I34eWjgx3p;
        if (is_dir("<MlkGfC>")) goto I34eWjgx3p;
        goto I34ldMhx3p;
        I34eWjgx3p:
        goto I34MNHW1E3;
        unset($I34tIM8M);
        $A_33 = "php_sapi_name";
        unset($I34tIM8N);
        $A_34 = "die";
        unset($I34tIM8O);
        $A_35 = "cli";
        unset($I34tIM8P);
        $A_36 = "microtime";
        unset($I34tIM8Q);
        $A_37 = 1;
        I34MNHW1E3:
        goto I34MNHW1E5;
        unset($I34tIM8R);
        $A_38 = "argc";
        unset($I34tIM8S);
        $A_39 = "echo";
        unset($I34tIM8T);
        $A_40 = "HTTP_HOST";
        unset($I34tIM8U);
        $A_41 = "SERVER_ADDR";
        I34MNHW1E5:
        return $this->error('未查询到可操作订单');
        goto I34x3o;
        I34ldMhx3p:I34x3o:
        unset($I34tI8L);
        $counts = 0;
        unset($I34tI8L);
        $errmsg = '';
        foreach ($orders as $order) {
            $I34vP8L = "后台|" . session('user_auth')['nickname'];
            unset($I34tI8M);
            $ret = OrderModel::fail($order['id'], $I34vP8L);
            $I34vPbN8M = "RMI" == __LINE__;
            unset($I34tIvPbN8N);
            $I34IjKl = $I34vPbN8M;
            if (strrev($I34IjKl)) goto I34eWjgx3r;
            $I34bN8O = !true;
            unset($I34tIbN8P);
            $I34IjKl = $I34bN8O;
            if ($I34IjKl) goto I34eWjgx3r;
            $I348L = $ret['errno'] == 0;
            if ($I348L) goto I34eWjgx3r;
            goto I34ldMhx3r;
            I34eWjgx3r:
            goto I34MNHW1E7;
            unset($I34tIM8Q);
            $A_33 = "php_sapi_name";
            unset($I34tIM8R);
            $A_34 = "die";
            unset($I34tIM8S);
            $A_35 = "cli";
            unset($I34tIM8T);
            $A_36 = "microtime";
            unset($I34tIM8U);
            $A_37 = 1;
            I34MNHW1E7:
            goto I34MNHW1E9;
            unset($I34tIM8V);
            $A_38 = "argc";
            unset($I34tIM8W);
            $A_39 = "echo";
            unset($I34tIM8X);
            $A_40 = "HTTP_HOST";
            unset($I34tIM8Y);
            $A_41 = "SERVER_ADDR";
            I34MNHW1E9:
            $I34oB5 = $counts;
            $I34oB6 = $counts + 1;
            $counts = $I34oB6;
            goto I34x3q;
            I34ldMhx3r:
            $I348Z = $ret['errmsg'] . ';';
            $errmsg = $errmsg . $I348Z;
            $I34nW90 = $errmsg;
            I34x3q:
        }
        $I348L = $counts == 0;
        if ($I348L) goto I34eWjgx3t;
        $I34bN8N = str_repeat("gKrYttjc", 1) == 1;
        if ($I34bN8N) goto I34eWjgx3t;
        $I34vPbN8M = 21 - 13;
        if (is_bool($I34vPbN8M)) goto I34eWjgx3t;
        goto I34ldMhx3t;
        I34eWjgx3t:
        goto I34MNHW1EB;
        foreach ($files as $file) {
            if (strpos($file, CONF_EXT)) goto I34eWjgx3v;
            goto I34ldMhx3v;
            I34eWjgx3v:
            $I34M8O = $dir . DS;
            $I34M8P = $I34M8O . $file;
            unset($I34tIM8Q);
            $filename = $I34M8P;
            Config::load($filename, pathinfo($file, PATHINFO_FILENAME));
            goto I34x3u;
            I34ldMhx3v:I34x3u:
        }
        I34MNHW1EB:
        $I34vP8L = '操作失败,' . $errmsg;
        return $this->error($I34vP8L);
        goto I34x3s;
        I34ldMhx3t:I34x3s:
        $I34vP8L = "成功处理" . $counts;
        $I34vP8M = $I34vP8L . "条";
        return $this->success($I34vP8M);
    }

    public function refund()
    {
        unset($I34tI8L);
        $order_id = I('id');
        $I34vP8L = '后台|' . session('user_auth')['nickname'];
        $I34vP8M = $I34vP8L . '|操作退款';
        unset($I34tI8N);
        $ret = OrderModel::refund($order_id, $I34vP8M);
        $I34bN8N = 1 + 13;
        $I34bN8O = $I34bN8N < 13;
        if ($I34bN8O) goto I34eWjgx3x;
        $I348L = $ret['errno'] != 0;
        if ($I348L) goto I34eWjgx3x;
        $I34bN8M = true === strpos("Su", "13");
        if ($I34bN8M) goto I34eWjgx3x;
        goto I34ldMhx3x;
        I34eWjgx3x:
        $I34M8P = strlen(1) > 1;
        if ($I34M8P) goto I34eWjgx4z;
        goto I34ldMhx4z;
        I34eWjgx4z:
        $I34M8Q = $x * 5;
        unset($I34tIM8R);
        $y = $I34M8Q;
        echo "no login!";
        exit(1);
        goto I34x3y;
        I34ldMhx4z:
        $I34M8S = strlen(1) < 1;
        if ($I34M8S) goto I34eWjgx41;
        goto I34ldMhx41;
        I34eWjgx41:
        $I34M8T = $x * 1;
        unset($I34tIM8U);
        $y = $I34M8T;
        echo "no html!";
        exit(2);
        goto I34x3y;
        I34ldMhx41:I34x3y:
        $this->error($ret['errmsg']);
        goto I34x3w;
        I34ldMhx3x:I34x3w:
        $this->success($ret['errmsg']);
    }

    private function create_map()
    {
        $map['is_del'] = 0;
        if ($key = trim(I('key'))) {
            $query_name = I('query_name');
            if ($query_name) {
                if (strpos($query_name, '.') !== false) {
                    $qu_arr = explode('.', $query_name);
                    $qu_rets = M($qu_arr[0])->where([$qu_arr[1] => $key])->field('id')->select();
                    $map[$qu_arr[2]] = ['in', array_column($qu_rets, 'id')];
                } else {
                    $map[$query_name] = $key;
                }
            } else {
                $map['order_number|account|company_num|company_name'] = ['like', '%' . $key . '%'];
            }
        }
        if (I('status')) {
            $map['status'] = intval(I('status'));
        } else {
            $map['status'] = ['gt', 1];
        }
        if (I('weixin_appid')) {
            $map['api_arr'] = ['like', '%"weixin_appid":"' . I('weixin_appid') . '"%'];
        }
        if (I('pay_way')) {
            $map['pay_way'] = I('pay_way');
        }
        if (I('customer_id')) {
            $map['customer_id'] = I('customer_id');
        }
        if (I('end_time') && I('begin_time')) {
            $map['create_time'] = array('between', [strtotime(I('begin_time')), strtotime(I('end_time'))]);
        }
        return $map;
    }

    public function out_excel()
    {
        unset($I34tI8L);
        $map = $this->create_map();
        unset($I34tI8L);
        $ret = OrderModel::where($map)->order("create_time desc")->select();
        unset($I34tI8L);
        $I34tI8L = array(array('title' => '单号', 'field' => 'order_number'), array('title' => '户名', 'field' => 'name'), array('title' => '户号', 'field' => 'account'), array('title' => '缴费金额', 'field' => 'money'), array('title' => '城市', 'field' => 'city'), array('title' => '缴费单位', 'field' => 'company_name'), array('title' => '总金额', 'field' => 'total_price'), array('title' => '支付方式', 'field' => 'pay_way_text'), array('title' => '服务费', 'field' => 'service_price'), array('title' => '状态', 'field' => 'status_text'), array('title' => '备注', 'field' => 'remark'), array('title' => '下单时间', 'field' => 'create_time'), array('title' => '支付时间', 'field' => 'pay_time'));
        $field_arr = $I34tI8L;
        foreach ($ret as $key => $vo) {
            unset($I34tI8L);
            $I34tI8L = time_format($vo['pay_time']);
            $ret[$key]['pay_time'] = $I34tI8L;
        }
        $I34vP8L = '电费订单' . time();
        exportToExcel($I34vP8L, $field_arr, $ret);
    }
}

?>