<?php
/**
 * 呆呆
 *  wx:trsoft66
 * 公司：
 **/
/**
 * Created by PhpStorm.
 * User: 12048
 * Date: 2017-11-13
 * Time: 10:47
 */
return [
// 视图输出字符串内容替换
    'view_replace_str' => [
        '__IMG__' => ROOT . 'public' . DS . 'agent' . DS . 'img',
        '__CSS__' => ROOT . 'public' . DS . 'agent' . DS . 'css',
        '__JS__' => ROOT . 'public' . DS . 'agent' . DS . 'js',
        '__PG__' => ROOT . 'public' . DS . 'agent' . DS . 'plugins',
        '__ADMIN__' => ROOT . 'public' . DS . 'agent',
    ],
    //默认控制器
    'default_controller' => 'Admin',
    // 默认操作名
    'default_action' => 'index',

    /* 文件上传相关配置 */
    'DOWNLOAD_UPLOAD' => [
        'mimes' => '', //允许上传的文件MiMe类型
        'maxSize' => 100 * 1024 * 1024, //上传的文件大小限制 (0-不做限制)
        'exts' => 'jpg,gif,png,jpeg,zip,rar,tar,gz,7z,doc,docx,txt,xml,xls,xlsx,mp3,wma,wav,amr,pem,apk,ipa', //允许上传的文件后缀
        'autoSub' => true, //自动子目录保存文件
        'subName' => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
        'rootPath' => ROOT . 'public' . DS . 'uploads' . DS, //保存根路径
        'movePath' => ROOT_PATH . 'public' . DS . 'uploads' . DS,
        'savePath' => '', //保存路径
        'saveName' => array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
        'saveExt' => '', //文件保存后缀，空则使用原后缀
        'replace' => false, //存在同名是否覆盖
        'hash' => true, //是否生成hash编码
        'callback' => false, //检测文件是否存在回调函数，如果存在返回文件信息数组
    ], //下载模型上传配置（文件上传类配置）
];