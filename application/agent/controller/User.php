<?php
/**
 * Created by PhpStorm.
 * User: 12048
 * Date: 2017-11-14
 * Time: 14:41
 */

namespace app\agent\controller;

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
            M('customer')->where(['id' => $this->user['id']])->setField([
                'headimg' => I('headimg'),
                'ip_white_list' => I('ip_white_list')
            ]);
            return $this->success("保存成功！");
        } else {
            $info = M('customer')->find($this->user['id']);
            $this->assign('info', $info);
            return view();
        }
    }

    //更新密码
    public function uppwd()
    {
        if (I('npwd') == I('ypwd')) {
            return $this->error("新密码不能与原密码相同");
        }
        if (!M('customer')->where(['id' => $this->user['id'], 'password' => dyr_encrypt(I('ypwd'))])->find()) {
            return $this->error("密码错误");
        }
        M('customer')->where(['id' => $this->user['id']])->setField(['password' => dyr_encrypt(I('npwd'))]);
        session('user_auth_agent', null);
        return $this->success("修改成功！");
    }

    public function balance()
    {
        $map['customer_id'] = $this->user['id'];
        if (I('style')) {
            $map['style'] = I('style');
        }
        if (I('key')) {
            $map['remark'] = array('like', '%' . I('key') . '%');
        }
        if (I('end_time') && I('begin_time')) {
            $map['create_time'] = array('between', [strtotime(I('begin_time')), strtotime(I('end_time'))]);
        }
        $list = M('balance_log')->where($map)->order("create_time desc")->paginate(30);
        $this->assign('_list', $list);
        return view();
    }

}