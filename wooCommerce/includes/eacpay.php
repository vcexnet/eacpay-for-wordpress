<?php
require __DIR__ . '/../../../../wp-blog-header.php';
http_response_code(200);
$w = new WC_Eacpay_Payment_Gateway();
if($_GET['action'] == 'check'){
    $order = $wpdb->get_row("select * from {$wpdb->prefix}eacpay_order where `id`=".intval($_GET['order_id']));
    echo json_encode($w->check($order));
}elseif($_GET['action'] == 'test'){
    
    /*add_filter( 'cron_schedules', 'eacpay_add_cron_interval' );
    function eacpay_add_cron_interval( $schedules ) {
        $schedules['5seconds'] = array(
            'interval' => 5,
            'display'  => esc_html__( 'Every Five Seconds' ),
        );
        return $schedules;
    }

    function eacpay_order_crontab( $rules ) {
        $w = new WC_Eacpay_Payment_Gateway();
        global $wpdb;
        $table_name = $wpdb->prefix . "eacpay_order";
        $settings =get_option('woocommerce_eacpay_settings');
        $maxtime = time()-$settings['eacpay_maxwaitpaytime']*60;

        $wpdb->update($table_name,array(
            `status`=>'cancel'
        ),array(
            'status'=>'wait',
            'type'=>'recharge',
            'create_time'=>$maxtime
        ));
        $sql = "select * from {$table_name} where `status`='wait'";
        $list = $wpdb->get_results($sql);
        foreach($list as $k=>$v){
            $w->check($v);
        }
    }
    add_action( 'eacpay_order_crontab', 'eacpay_order_crontab' );
    if ( ! wp_next_scheduled( 'eacpay_order_crontab' ) ) {
        wp_schedule_event( time(), '5seconds', 'eacpay_order_crontab' );
    }*/
    //P(_get_cron_array() );

}elseif($_GET['action'] == 'qrcode'){
    ob_clean();
    $w->makePayQrcode(trim($_GET['eacorderid']));
}elseif($_GET['action'] == 'rejectqrcode'){
    ob_clean();
    $w->makeRefundQrcode(trim($_GET['eacorderid']));
}else{
    $order = $wpdb->get_row("select * from {$wpdb->prefix}eacpay_order where `id`=".intval($_GET['order_id']));
    $exchangedata = $w->getExchange($wcorder->currency);
    $wcorder = wc_get_order($order->oid);
?>
<html>
<head>
    <title>eacpay区块链支付 - 付款页面</title>
    <meta charset="utf-8" />
    <script src="https://unpkg.com/layui@2.6.8/dist/layui.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/layui@2.6.8/dist/css/layui.css">
    <script>
        var $= layui.jquery;
        var jQuery = $;
    </script>
    <style>
        #eacpay{width: 800px;margin: 0 auto;position: relative;padding: 10px;}
        .flex_row {display: flex;flex-direction: row;margin: 10px 0;}
        .flex_row>b {width: 80px;}
        .flex_col {display: flex;flex-direction: column;}
        .flex_1 {flex: 1;}
        .eacpay_remark{margin: 10px 0;}
    </style>
</head>
<body>
    <div id="eacpay" class="flex_row">
        <div class="flex_1" style="margin-right: 20px;">
            <table class="layui-table">
                <thead>
                    <tr>
                        <td colspan="6">eacpay区块链支付 - 付款页面</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="180">订单价格:</td>
                        <td><strong id="priceCount"><?php echo $order->amount;?></strong> <?php echo $wcorder->currency;?></td>
                    </tr>
                    <tr>
                        <td width="180">官方网站:</td>
                        <td><strong><a href="http://www.eacpay.com" target="_blank">www.eacpay.com</a></strong></td>
                    </tr>
                    <tr>
                        <td width="180">EAC即时价:</td>
                        <td><strong id="exchangeData"><?php echo $exchangedata.' '.$wcorder->currency;?></strong></td>
                    </tr>
                    <tr>
                        <td width="180">约合EAC:</td>
                        <td><strong id="eac"><?php echo $order->eac;?></strong></td>
                    </tr>
                    <tr>
                        <td width="180">扫码支付:</td>
                        <td>
                            <img src="eacpay.php?action=qrcode&eacorderid=<?php echo $order->id;?>" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div id="eacpayresult">
                                <div class="resultmsg" style="text-align: center;font-size: 16px;margin-bottom: 15px;">正在确认订单，请稍等...</div>
                                <div class="loading" style="width: 100%;height: 8px;background: #999999;border-radius: 2px;">
                                    <div class="bar" style="width: 0%;background: #ff5f00;height: 100%;transition: all 0.2s;border-radius: 2px;"></div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="eacpay_remark" style="background: #fff;">
            <p>人民币现金 1元 = 61.8085个eac</p>
            <p>EACPAY手机端区块链钱包下载:</p>
            <p>1、google play</p>
            <p>2、<a href="http://www.eacpay.com" target="_blank">eacpay.com官网下载</a></p>
            <p>3、手机浏览器扫一扫，下载EACPAY</p>
            <img src="../assets/images/app.jpg" width="160" height="190"/>
        </div>
    </div>
    <script>
        $(function() {
            var timeId = null;

            function check() {
                jQuery.getJSON('eacpay.php?action=check&order_id=<?php echo $order->id;?>', function(d) {
                    if (d.code == "1") {
                        clearInterval(timeId);
                        jQuery('#eacpayresult .loading .bar').css('width','100%');
                        $('#eacpayresult .resultmsg').html("付款成功");
                        setTimeout(function() {
                            location.href = d.url;
                        }, 2000);
                    }else if (d.code == "2") {
                        jQuery('#eacpayresult .loading .bar').css('width',(parseInt(d.confirmations)/parseInt(d.receiptConfirmation))*100+'%');
                        jQuery('#eacpayresult .resultmsg').html(d.msg);
                    }else if (d.code == "3") {
                        jQuery('#eacpayresult .loading .bar').css('width','100%');
                        jQuery('#eacpayresult .resultmsg').html(d.msg);
                    }else if (d.code == "4") {
                        jQuery('#eacpayresult .loading .bar').css('width','0%');
                        jQuery('#eacpayresult .resultmsg').html(d.msg);
                    } else {
                        clearInterval(timeId);
                        jQuery('#eacpayresult .loading .bar').css('width','100%');
                        jQuery('#eacpayresult .resultmsg').html(d.msg);
                    }
                });
            }
            timeId = setInterval(check, 3000);
        })
    </script>
</body>
</html>
<?php
}
?>