<?php

namespace app\queue\job;

use app\common\controller\Base;
use app\common\model\Porder;
use think\Log;
use think\queue\Job;

/**
 * 呆呆
 *  wx:trsoft66
 **/
class Work extends Base
{

    //超出错误错次数后回调  --tries  n
    public function failed($data)
    {
        Log::error('队列Work失败' . var_export($data, true));
    }

    // 默认执行的方法
    //示例：queue('app\queue\job\Work@fire', $data);
    public function fire(Job $job, $data)
    {
        //当任务执行过程中抛出了异常，任务会重新下发，可以通过下面的次数判断来决定任务是否继续执行
        if ($job->attempts() > 2) {
            Log::error('Work超过2次了，将停止' . json_encode($data));
            $job->delete();
            return;
        }
        Log::error("消息已经执行了" . $job->attempts() . '次');
        Log::error('Work执行了' . json_encode($data));
        // 可以重新发布这个任务
        $job->release(3); //$delay为延迟时间
    }

    //提交接口充值
    public function porderSubApi(Job $job, $porder_id)
    {
        Porder::subApi($porder_id);
        $job->delete();
    }

    //退款
    public function porderRefund(Job $job, $data)
    {
        Porder::refund($data['id'], $data['remark'], $data['operator']);
        $job->delete();
    }


    //后台导入订单
    public function adminPushExcel(Job $job, $data)
    {
        for ($i = 0; $i < count($data); $i++) {
            Porder::adminExcelOrder($data[$i]['id']);
        }
        $job->delete();
    }


    //代理批量提交订单
    public function agentPushExcel(Job $job, $data)
    {
        for ($i = 0; $i < count($data); $i++) {
            Porder::agentExcelOrder($data[$i]['id']);
        }
        $job->delete();
    }

    //代理api下单支付
    public function agentApiPayPorder(Job $job, $data)
    {
        Porder::agentApiPayPorder($data['porder_id'], $data['customer_id'], $data['notify_url']);
        $job->delete();
    }

    //指定执行方法
    //queue('app\queue\job\Work@callFunc', ['class' => '\app\common\library\Notification', 'func' => 'test', 'param' => 'xxx']);
    public function callFunc(Job $job, $data)
    {
        $job->delete();
        $classname = $data['class'];
        $fun = $data['func'];
        $param = $data['param'];
        call_user_func(array($classname, $fun), $param);
    }
}