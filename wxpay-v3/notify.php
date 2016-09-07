<?php

include_once("../../../includes/config.inc.php");

require_once "lib/WxPay.Api.php";
require_once 'lib/WxPay.Notify.php';
// require_once 'log.php';

// 初始化日志
// $logHandler = new CLogFileHandler("../../data/logs/" . date('Y-m-d') . '.log');
// $log = Log::Init($logHandler, 15);
// file_put_contents('../../data/logs/log', '');

class PayNotifyCallBack extends WxPayNotify {

    //查询订单
    public function Queryorder($transaction_id) {
        $input = new WxPayOrderQuery();
        $input->SetTransaction_id($transaction_id);
        $result = WxPayApi::orderQuery($input);//file_put_contents('../../../data/pay.txt', json_encode($result));
        if (array_key_exists("return_code", $result) && array_key_exists("result_code", $result) && $result["return_code"] == "SUCCESS" && $result["result_code"] == "SUCCESS") {
            /* ***********回调成功的处理开始*********** */

            $oid      = str_replace($result['mch_id'], '', $result['out_trade_no']);//订单号
            $oidArr   = explode('_', $oid);
            $Sign     = new Model_Subtable('applist_qx_sign');
            $pay_time = date('Y-m-d H:i');

            if($oidArr[1] == 1){//个人报名
                $Sign->query("update applist_qx_sign set is_pay = 1,pay_time = '{$pay_time}' where id=".$oidArr[0]);
            }else{//团体报名
                $Sign->query("update applist_qx_group set status = 2 where id=".$oidArr[0]);
                $Sign->query("update applist_qx_sign set is_pay = 1,pay_time = '{$pay_time}' where pid=".$oidArr[0]);
            }

            /* ***********回调成功的处理结束*********** */
            return true;
        }
        //失败记录日志
        // Log::DEBUG("query:" . json_encode($result));
        return false;
    }

    //重写回调处理函数
    public function NotifyProcess($data, &$msg) {
        // Log::DEBUG("call back:" . json_encode($data));
        $notfiyOutput = array();

        if (!array_key_exists("transaction_id", $data)) {
            $msg = "输入参数不正确";
            return false;
        }
        //查询订单，判断订单真实性
        if (!$this->Queryorder($data["transaction_id"])) {
            $msg = "订单查询失败";
            return false;
        }
        return true;
    }

}

//Log::DEBUG("begin notify");
$notify = new PayNotifyCallBack();
$notify->Handle(false);
