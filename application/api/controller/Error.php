<?php
/**
 * Created by PhpStorm.
 * User: 12048
 * Date: 2017-11-13
 * Time: 11:25
 */

namespace app\api\controller;

/**
 * 呆呆
 *  wx:trsoft66
 **/
class Error extends Base
{
    /**
     * 呆呆
     *  wx:trsoft66
     * 找不到控制器
     */
    public function index()
    {
        return djson(1, '出错了！');
    }

}