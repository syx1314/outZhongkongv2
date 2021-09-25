<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:101:"E:\phpCode\zhongkong\outZhongkongv2\outZhongkongv2\public/../application/agent/view/porder/index.html";i:1631155195;s:92:"E:\phpCode\zhongkong\outZhongkongv2\outZhongkongv2\application\agent\view\public\header.html";i:1631981505;}*/ ?>
<!-- 廖强 dayuanren@qq.com     -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo C('WEB_SITE_TITLE'); ?></title>
    <link rel="shortcut icon" href="/\/favicon.ico">
    <link href="/public/agent/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/public/agent/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/public/agent/css/animate.css" rel="stylesheet">
    <link href="/public/agent/css/style.css?v8" rel="stylesheet">
    <link href="/public/agent/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="/public/agent/css/layx.min.css" rel="stylesheet"/>
    <link href="/public/agent/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/public/agent/css/animate.css" rel="stylesheet">
    <script src="/public/agent/js/jquery.min.js?v=2.1.4"></script>
    <script src="/public/agent/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/public/agent/js/plugins/layer/layer.min.js"></script>
    <script src="/public/agent/js/content.js"></script>
    <script src="/public/agent/js/plugins/toastr/toastr.min.js"></script>
    <script src="/public/agent/js/dayuanren.js?v12"></script>
    <script src="/public/agent/js/layx.js" type="text/javascript"></script>
    <script src="/public/agent/js/plugins/iCheck/icheck.min.js"></script>
    <script src="/public/agent/js/clipboard.min.js"></script>
    <script src="/public/agent/js/vue.min.js?v=3.3.6"></script>
    <script src="/public/agent/js/util.js?V=1"></script>
    <script src="/public/agent/js/laydate/laydate.js" type="text/javascript"></script>
    <script src="/public/agent/js/ajaxfileupload.js?v1" type="text/javascript"></script>
</head>

<style>
    .table-bordered > tbody > tr:hover {
        background-color: #f5f5f5
    }
</style>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeIn">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>订单列表</h5>
                </div>
                <div class="ibox-content">
                    <div class="row input-groups">

                        <div class="col-md-12 m-b-xs form-inline text-left">
                            <div class="form-group">
                                <span class="control-label">开始：</span>
                                <input type="text" name="begin_time" id="begin_time" value="<?php echo I('begin_time'); ?>"
                                       class="input-sm input-s-sm serach_selects" style="border: 1px solid #e5e6e7;"
                                       placeholder="下单开始日期" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <span class="control-label">&nbsp;结束：</span>
                                <input type="text" name="end_time" id="end_time" value="<?php echo I('end_time'); ?>"
                                       style="border: 1px solid #e5e6e7;"
                                       class="input-sm input-s-sm serach_selects" placeholder="下单结束日期"
                                       autocomplete="off">
                            </div>
                            <div class="form-group">
                                <a class="btn btn-sm btn-white kuaijie_time"
                                   data-strat="<?php echo date('Y-m-d 00:00:00', time());?>"
                                   data-end="<?php echo date('Y-m-d 23:59:59', time());?>">今日</a>
                                <a class="btn btn-sm btn-white kuaijie_time"
                                   data-strat="<?php echo date('Y-m-01 00:00:00', time());?>"
                                   data-end="<?php echo date('Y-m-d 23:59:59', time());?>">本月</a>
                                <a class="btn btn-sm btn-white kuaijie_time"
                                   data-strat="<?php echo date('Y-01-01 00:00:00', time());?>"
                                   data-end="<?php echo date('Y-m-d 23:59:59', time());?>">本年</a>
                            </div>
                            <div class="form-group">
                                <?php $type=C('PRODUCT_TYPE'); ?>
                                <label class="control-label">类型:</label>
                                <select class="input-sm form-control input-s-sm inline serach_selects" name="type"
                                        style="width: auto;">
                                    <option value="0">请选择</option>
                                    <?php if(is_array($type) || $type instanceof \think\Collection || $type instanceof \think\Paginator): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <option value="<?php echo $key; ?>"
                                    <?php if(I('type')==$key){ echo "selected='selected'"; } ?>><?php echo $vo; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <?php $client=C('CLIENT_TYPE'); ?>
                                <label class="control-label">渠道:</label>
                                <select class="input-sm form-control input-s-sm inline serach_selects"
                                        name="client"
                                        style="width: auto;">
                                    <option value="0">请选择</option>
                                    <?php if(is_array($client) || $client instanceof \think\Collection || $client instanceof \think\Paginator): $i = 0; $__LIST__ = $client;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <option value="<?php echo $key; ?>"
                                    <?php if(I('client')==$key){ echo "selected='selected'"; } ?>><?php echo $vo; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <?php $isps=C('ISP_TEXT');?>
                                <label class="control-label">运营商:</label>
                                <select class="input-sm form-control input-s-sm inline serach_selects" name="isp"
                                        style="width: auto;">
                                    <option value="0">请选择</option>
                                    <?php if(is_array($isps) || $isps instanceof \think\Collection || $isps instanceof \think\Paginator): $i = 0; $__LIST__ = $isps;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <option value="<?php echo $key; ?>"
                                    <?php if(I('isp')==$key){ echo "selected='selected'"; } ?>><?php echo $vo; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <?php $statusarr=C('ORDER_STUTAS');?>
                                <label class="control-label">状态:</label>
                                <select class="input-sm form-control input-s-sm inline serach_selects" name="status"
                                        style="width: auto;">
                                    <option value="0">请选择</option>
                                    <?php if(is_array($statusarr) || $statusarr instanceof \think\Collection || $statusarr instanceof \think\Paginator): $i = 0; $__LIST__ = $statusarr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <option value="<?php echo $key; ?>"
                                    <?php if(I('status')==$key){ echo "selected='selected'"; } ?>><?php echo $vo; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">回调状态:</label>
                                <select class="input-sm form-control input-s-sm inline serach_selects"
                                        name="is_notification"
                                        style="width: auto;">
                                    <option value="0">请选择</option>
                                    <option value="1"
                                    <?php if(I('is_notification')==1){ echo "selected='selected'"; } ?>>未回调</option>
                                    <option value="2"
                                    <?php if(I('is_notification')==2){ echo "selected='selected'"; } ?>
                                    >回调成功</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">查询条件:</label>
                                <select class="input-sm form-control input-s-sm inline" name="query_name"
                                        style="width: auto;">
                                    <option value="">模糊</option>
                                    <option value="order_number"
                                    <?php if(I('query_name')=='order_number'){ echo "selected='selected'"; } ?>
                                    >订单号</option>
                                    <option value="out_trade_num"
                                    <?php if(I('query_name')=='out_trade_num'){ echo "selected='selected'"; } ?>>商户单号</option>
                                    <option value="mobile"
                                    <?php if(I('query_name')=='mobile'){ echo "selected='selected'"; } ?>>手机号</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="hidden" value="<?php echo I('excel_id'); ?>" name="excel_id"/>
                                    <input type="hidden" value="<?php echo I('status2'); ?>" name="status2"/>
                                    <input type="text" name="key" placeholder="请输入套餐/单号/手机号" value="<?php echo I('key'); ?>"
                                           class="input-sm form-control">
                                    <span class="input-group-btn"><button type="button" id="search"
                                                                          class="btn btn-sm btn-primary"
                                                                          url="<?php echo U('index'); ?>"> 搜索</button></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="button" id="excel"
                                        class="btn btn-sm btn-primary"
                                        url="<?php echo U('out_excel'); ?>"> 导出
                                </button>
                            </div>
                        </div>
                        <div class="col-md-12 form-inline text-left">
                            <div class="form-group">
                                <a class="btn btn-sm btn-white open-reload"><i
                                        class="glyphicon glyphicon-repeat"></i></a>
                                <span>&nbsp;总金额：￥<?php echo $total_price; ?></span>
                            </div>

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>系统单号</th>
                                <th>商户单号</th>
                                <th>类型</th>
                                <th>套餐</th>
                                <th>充值号码</th>
                                <th>归属地</th>
                                <th>下单渠道</th>
                                <th>运营商</th>
                                <th>状态</th>
                                <th>订单金额</th>
                                <th>下单时间</th>
                                <th>完成时间</th>
                                <th>回调</th>
                                <th>凭证</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(is_array($_list) || $_list instanceof \think\Collection || $_list instanceof \think\Paginator): $i = 0; $__LIST__ = $_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <tr>
                                <td><?php echo $vo['order_number']; ?></td>
                                <td><?php echo $vo['out_trade_num']; ?></td>
                                <td><?php echo C('PRODUCT_TYPE')[$vo['type']]; ?></td>
                                <td><?php echo $vo['product_name']; ?></td>
                                <td><?php echo $vo['mobile']; ?></td>
                                <td><?php echo $vo['guishu']; ?></td>
                                <td><?php echo C('CLIENT_TYPE')[$vo['client']]; ?></td>
                                <td><?php echo $vo['isp']; ?></td>
                                <td>
                                    <?php switch($vo['status']): case "1": ?>
                                    <span class="label label-default">
                                    <?php echo C('ORDER_STUTAS')[$vo['status']]; ?>
                                    </span>
                                    <?php break; case "2": ?>
                                    <span class="label label-success">
                                    <?php echo C('ORDER_STUTAS')[$vo['status']]; ?>
                                    </span>
                                    <?php break; case "3": ?>
                                    <span class="label label-warning">
                                    <?php echo C('ORDER_STUTAS')[$vo['status']]; ?>
                                    </span>
                                    <?php break; case "4": ?>
                                    <span class="label label-primary">
                                    <?php echo C('ORDER_STUTAS')[$vo['status']]; ?>
                                    </span>
                                    <?php break; case "5": ?>
                                    <span class="label label-danger">
                                    <?php echo C('ORDER_STUTAS')[$vo['status']]; ?>
                                    </span>
                                    <?php break; case "6": ?>
                                    <span class="label label-default">
                                    <?php echo C('ORDER_STUTAS')[$vo['status']]; ?>
                                    </span>
                                    <?php break; default: ?>
                                    <span class="label label-default">
                                    <?php echo C('ORDER_STUTAS')[$vo['status']]; ?>
                                    </span>
                                    <?php endswitch; ?>
                                </td>
                                <td><?php echo $vo['total_price']; ?></td>
                                <td><?php echo time_format($vo['pay_time']); ?></td>
                                <td><?php echo time_format($vo['finish_time']); ?></td>
                                <td><?php if($vo['client'] == '4'): ?>
                                    状态：<?php echo !empty($vo['is_notification'])?'回调成功':'未回调'; ?>/<?php echo $vo['notification_num']; ?><br/>
                                    时间：<?php echo time_format($vo['notification_time']); ?><br/>
                                    <span class="tiptext text-success" data-text='<?php echo $vo['notify_url']; ?>'>回调地址</span><br/>
                                    <a class="text-danger ajax-get confirm" href="<?php echo U('notification?id='.$vo['id']); ?>"
                                       title="手动回调">手动回调</a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($vo['status'] == '4'): ?>
                                    <a class="text-warning open-window no-refresh"
                                       href="<?php echo C('WEB_URL'); ?>yrapi.php/open/voucher/id/<?php echo $vo['id']; ?>.html"
                                       title="凭证">凭证</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="page">
                        <?php echo $_list->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/public/agent/js/laydate/laydate.js"></script>
<script>
    //执行一个laydate实例
    laydate.render({
        elem: '#begin_time',
        type: 'datetime',
        done: function (value, date, endDate) {
            $('#begin_time').val(value);
        }
    });
    laydate.render({
        elem: '#end_time',
        type: 'datetime',
        done: function (value, date, endDate) {
            $('#end_time').val(value);
        }
    });
    $(".tiptext").click(function () {
        var text = $(this).data('text');
        layer.alert(text, {
            skin: 'layui-layer-molv' //样式类名
            , closeBtn: 0
        }, function () {
            layer.closeAll();
        });
    });
    $(".kuaijie_time").click(function () {
        var strat = $(this).data('strat');
        var end = $(this).data('end');
        $("#begin_time").val(strat);
        $("#end_time").val(end);
        $("#search").trigger('click');
    });

</script>
<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green'
        });
    });

</script>
</body>
</html>
