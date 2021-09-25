<?php
/**
 * Created by PhpStorm.
 * User: 12048
 * Date: 2018-01-16
 * Time: 16:20
 */

namespace app\agent\controller;

/**
 * 呆呆
 *  wx:trsoft66
 **/
class Verify extends Base
{

    //控制器中 生成验证码
    public function verify()
    {
        //使用memcheck 设置session
        $captcha = new \Util\Captcha(82, 34, 4);
        echo $captcha->showImg();
        session('piccode', $captcha->getCaptcha());
        exit;
    }

    /**
     * 呆呆
     *  wx:trsoft66
     * @param $code
     * @return bool
     * 检查验证码石否正确
     */
    public function check($code)
    {
        if (session('piccode') == $code) {
            return true;
        } else {
            return false;
        }
    }
}