<?php
/**
 * Created by PhpStorm.
 * User: 12048
 * Date: 2017-11-14
 * Time: 14:41
 */

namespace app\admin\controller;

use think\Request;

/**
 * 呆呆
 *  wx:trsoft66
 **/
class User extends Admin
{
    //当前登录页用户资料
    public function infos()
    {
        if (Request::instance()->isPost()) {

            if (M('member')->where(['id' => I('id')])->update(['sex' => I('sex'), 'headimg' => I('headimg')])) {
              return $this->success("保存成功！");
            } else {
              return $this->error("保存失败！");
            }
        } else {
            $info = D('member')->find(UID);
            $this->assign('info', $info);
            return view();
        }
    }

    //更新密码
    public function uppwd()
    {
        if (D('member')->up_pwd(UID, I('ypwd'), I('npwd'))) {
          return $this->success("修改成功！");
        } else {
          return $this->error("修改失败，请重试！");
        }
    }

}