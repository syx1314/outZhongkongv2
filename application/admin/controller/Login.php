<?php
/**
 * Created by PhpStorm.
 * User: 12048
 * Date: 2017-11-14
 * Time: 9:50
 */

namespace app\admin\controller;

use Util\Syslog;
use app\common\model\Member as MemberModel;

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
        $res = MemberModel::pwdLogin(I('nickname'), I('password'));
        if ($res['errno'] != 0) {
            return djson(1, $res['errmsg'], $res['data']);
        }
        $member = $res['data'];
        $auth = array(
            'id' => $member['id'],
            'nickname' => $member['nickname'],
            'last_login_time' => $member['last_login_time'],
            'headimg' => $member['headimg'],
        );
        session('user_auth', $auth);
        session('user_auth_sign', data_auth_sign($auth));
        Syslog::write("后台登录", $auth, $member['nickname']);
        return djson(0, "登录成功", $member);
    }

    /**
     * 呆呆
     *  wx:trsoft66
     * 退出登录
     */
    public function logout()
    {
        session('user_auth', null);
        session('user_auth_sign', null);
        session('Auth_List', null);
        $this->redirect('Login/login');
    }
}