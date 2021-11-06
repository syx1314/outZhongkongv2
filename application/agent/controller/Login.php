<?php
/**
 * Created by PhpStorm.
 * User: 12048
 * Date: 2017-11-14
 * Time: 9:50
 */

namespace app\agent\controller;

use app\common\model\Customer as CustomerModel;

/**
 * 呆呆
 *  wx:trsoft66
 **/
class Login extends Base
{
    //登录
    public function login()
    {
        return view();
    }

    public function logindo()
    {
        if (strtolower(session('piccode')) != strtolower(I('verifycode'))) {
            return djson(1, "验证码错误！");
        }
        $res = CustomerModel::pwdLogin(I('username'), I('password'));
        if ($res['errno'] != 0) {
            return djson(1, $res['errmsg'], $res['data']);
        }
        $customer = $res['data'];
        $auth = array(
            'id' => $customer['id'],
            'username' => $customer['username'],
            'headimg' => $customer['headimg'],
            'mobile' => $customer['mobile']
        );
        session('user_auth_agent', $auth);
        return djson(0, "登录成功", $customer);
    }

    /**
     * 呆呆
     *  wx:trsoft66
     * 退出登录
     */
    public function logout()
    {
        session('user_auth_agent', null);
        $this->redirect('Login/login');
    }
}