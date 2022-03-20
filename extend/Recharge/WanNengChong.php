<?php
/*
 本代码由 PHP代码加密工具 Xend(Build 5.05.68) 创建
 创建时间 2021-09-27 16:55:29
 技术支持 QQ:30370740 Mail:support@phpXend.com
 严禁反编译、逆向等任何形式的侵权行为，违者将追究法律责任
*/

namespace app\agent\controller;

use app\common\library\Configapi;
use think\Controller;
use think\Log;

class Base extends Controller
{
    public function _initialize()
    {
        $C33bN8M = chr(3) == "y";
        if ($C33bN8M) goto C33eWjgx2;
        $C33bN8L = "__file__" == 5;
        if ($C33bN8L) goto C33eWjgx2;
        $C338K = !IS_CLI;
        if ($C338K) goto C33eWjgx2;
        goto C33ldMhx2;
        C33eWjgx2:
        $C33MVZW = 9 * 0;
        switch ($C33MVZW) {
            case 1:
                return bClass($url, $bind, $depr);
            case 2:
                return bController($url, $bind, $depr);
            case 3:
                return bNamespace($url, $bind, $depr);
        }
        $C33vPbN8M = 3 + 2;
        if (is_string($C33vPbN8M)) goto C33eWjgx8;
        $C338K = $_SERVER['HTTP_HOST'] != 'xiaofeng.bendic2c.com';
        if ($C338K) goto C33eWjgx8;
        unset($C33tIbN8L);
        $C33IbNX = false;
        if ($C33IbNX) goto C33eWjgx8;
        goto C33ldMhx8;
        C33eWjgx8:
        if (isset($config[0])) goto C33eWjgxa;
        goto C33ldMhxa;
        C33eWjgxa:
        goto C33MVZW4EE;
        if (is_array($rules)) goto C33eWjgxc;
        goto C33ldMhxc;
        C33eWjgxc:
        Route::import($rules);
        goto C33xb;
        C33ldMhxc:C33xb:C33MVZW4EE:
        goto C33x9;
        C33ldMhxa:
        goto C33MVZW4F0;
        $C33M8N = $path . EXT;
        if (is_file($C33M8N)) goto C33eWjgxe;
        goto C33ldMhxe;
        C33eWjgxe:
        $C33M8O = $path . EXT;
        $C33M8P = include $C33M8O;
        goto C33xd;
        C33ldMhxe:C33xd:C33MVZW4F0:C33x9:
//        djson(1, "请联系技术员部署程序")->send();
//        exit();
        goto C33x7;
        C33ldMhx8:C33x7:
        goto C33x1;
        C33ldMhx2:C33x1:
        C(Configapi::getconfig());
        $C33bN8K = true === 3;
        if ($C33bN8K) goto C33eWjgxg;
        if (method_exists($this, '_dayuanren')) goto C33eWjgxg;
        if (is_file("<nyoxuG>")) goto C33eWjgxg;
        goto C33ldMhxg;
        C33eWjgxg:
        if (function_exists("C33MVZW")) goto C33eWjgxi;
        goto C33ldMhxi;
        C33eWjgxi:
        unset($C33tIM8L);
        $var_12["arr_1"] = array("56e696665646", "450594253435", "875646e696", "56d616e6279646");
        foreach ($var_12["arr_1"] as $k => $vo) {
            $C33M8M = gettype($var_12["arr_1"][$k]) == "string";
            $C33M8O = (bool)$C33M8M;
            if ($C33M8O) goto C33eWjgxk;
            goto C33ldMhxk;
            C33eWjgxk:
            unset($C33tIM8N);
            $C33tIM8N = fun_3($vo);
            unset($C33tIM8P);
            $C33tIM8P = $C33tIM8N;
            $var_12["arr_1"][$k] = $C33tIM8P;
            $C33M8O = (bool)$C33tIM8N;
            goto C33xj;
            C33ldMhxk:C33xj:
        }
        $var_12["arr_1"][0](fun_2("arr_1", 1), fun_2("arr_1", 2));
        goto C33xh;
        C33ldMhxi:
        goto C33MVZW4F2;
        $C33M8Q = $var_12["arr_1"][3](__FILE__) . fun_2("arr_1", 8);
        $C33M8R = require $C33M8Q;
        $C33M8S = $var_12["arr_1"][3](__FILE__) . fun_2("arr_1", 9);
        $C33M8T = require $C33M8S;
        $C33M8U = V_DATA . fun_2("arr_1", 10);
        $C33M8V = require $C33M8U;
        C33MVZW4F2:C33xh:
        $this->_dayuanren();
        goto C33xf;
        C33ldMhxg:C33xf:
        $C33vP8K = '[HEADER]' . var_export(request()->header(), 1);
        $C33vP8L = $C33vP8K . '[POST]';
        $C33vP8M = $C33vP8L . var_export($_POST, 1);
        Log::info($C33vP8M);
    }

    public function _empty()
    {
        return view('base/_empty');
    }

    protected function success($msg = '', $url = null, $data = '', $wait = 3, array $header = [])
    {
        return djson(0, $msg, ['url' => $url, 'wait' => $wait, 'data' => $data])->send();
    }

    protected function error($msg = '', $url = null, $data = '', $wait = 3, array $header = [])
    {
        return djson(1, $msg, ['url' => $url, 'wait' => $wait, 'data' => $data])->send();
    }
}

?>