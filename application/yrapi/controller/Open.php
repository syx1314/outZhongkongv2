<?php

namespace app\yrapi\controller;


class Open extends \app\common\controller\Base
{
    function _commonbase()
    {

    }

    //凭证
    public function voucher()
    {
        $porder = M('porder')->where(['id' => I('id'), 'type' => ['in', [1, 2], 'status' => 4]])->find();
        if (!$porder || $porder['status'] != 4 || !in_array($porder['type'], [1, 2])) {
            echo "未获得凭证";
            exit();
        }
        $map['status'] = 1;
        $map['isp'] = ispstrtoint($porder['isp']);
        $voucher = M('voucher_config')->where($map)->find();
        if (!$voucher) {
            echo "订单没有凭证";
            exit();
        }
        $txtdata = [];
        if ($voucher['is_no']) {
            $txtdata[] = [
                'type' => 'txt',
                'left' => $voucher['no_left'],
                'top' => $voucher['no_top'],
                'size' => $voucher['no_size'],
                'color' => $voucher['no_color'],
                'text' => $porder['order_number']
            ];
        }
        if ($voucher['is_mobile']) {
            $txtdata[] = [
                'type' => 'txt',
                'left' => $voucher['mobile_left'],
                'top' => $voucher['mobile_top'],
                'size' => $voucher['mobile_size'],
                'color' => $voucher['mobile_color'],
                'text' => $porder['mobile']
            ];
        }
        if ($voucher['is_date']) {
            $txtdata[] = [
                'type' => 'txt',
                'left' => $voucher['date_left'],
                'top' => $voucher['date_top'],
                'size' => $voucher['date_size'],
                'color' => $voucher['date_color'],
                'text' => time_format($porder['finish_time'])
            ];
        }
        if ($voucher['is_price']) {
            $price = 0;
            if ($porder['total_price'] <= 10) {
                $price =10;
            }else if ($porder['total_price'] <= 30) {
                $price =30;
            }else if ($porder['total_price'] <= 50) {
                $price =50;
            } else if ($porder['total_price'] <= 100) {
                $price =100;
            }else if ($porder['total_price'] <= 200) {
                $price =200;
            }else if ($porder['total_price'] <= 500) {
                $price =500;
            }else {
                $price =$porder['total_price'];
            }

            $txtdata[] = [
                'type' => 'txt',
                'left' => $voucher['price_left'],
                'top' => $voucher['price_top'],
                'size' => $voucher['price_size'],
                'color' => $voucher['price_color'],
                'text' => $price
            ];
        }
        if ($voucher['is_product']) {
            $txtdata[] = [
                'type' => 'txt',
                'left' => $voucher['product_left'],
                'top' => $voucher['product_top'],
                'size' => $voucher['product_size'],
                'color' => $voucher['product_color'],
                'text' => $porder['product_name']
            ];
        }
        $this->assign('txtdata', json_encode($txtdata));
        $this->assign('bgpath', $voucher['path']);
        return view();
    }


}
