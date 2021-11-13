<?php 
if(isset($_GET['redirect_url'])){
    $_COOKIE['erphpdown_return'] = urldecode($_GET['redirect_url']);
    setcookie('erphpdown_return',urldecode($_GET['redirect_url']),0,'/');
}else{
    $_COOKIE['erphpdown_return'] = '';
    setcookie('erphpdown_return','',0,'/');
}
require_once('../../../../wp-load.php');
require_once('eacpay/base.php');
header("Content-Type: text/html;charset=utf-8");
date_default_timezone_set('Asia/Shanghai');

if(!is_user_logged_in()){
    $erphp_url_front_login = wp_login_url();
    if(get_option('erphp_url_front_login')){
        $erphp_url_front_login = get_option('erphp_url_front_login');
    }
    wp_die("请先<a href='".$erphp_url_front_login."'>登录</a>！",'提示');
}

$eacpay_allow_cash=get_option('erphpdown_eacpay_allow_cash');
$eacpay_recive_token=get_option('erphpdown_eacpay_recive_token');
$eacpay_bizhong=get_option('erphpdown_eacpay_bizhong');
$eacpay_server=get_option('erphpdown_eacpay_server');
$eacpay_exhangeapi=get_option('erphpdown_eacpay_exhangeapi');
$eacpay_receiptConfirmation=get_option('erphpdown_eacpay_receiptConfirmation');
$eacpay_maxwaitpaytime=get_option('erphpdown_eacpay_maxwaitpaytime');
$eacpay_notice=get_option('erphpdown_eacpay_notice');
if($_REQUEST['action'] == 'check'){
    $base = new EacpayBase(array(
        'bizhong'=>$eacpay_bizhong,
        'recive_token'=>$eacpay_recive_token,
        'receipt_confirmation'=>$eacpay_receiptConfirmation,
        'eacpay_server'=>$eacpay_server,
        'exhangeapi'=>$eacpay_exhangeapi,
        'maxwaitpaytime'=>$eacpay_maxwaitpaytime,
        'ROOT'=>constant("erphpdown"),
    ));
    $orderid   = trim($_REQUEST['order_id']);
    $order=$wpdb->get_row("select * from ".$wpdb->icemoney." where ice_id='".$orderid."'");
    echo json_encode($base->check($order));
    exit;
}elseif($_REQUEST['action'] == 'qrcode'){
    require_once '../includes/qrcode.class.php';
    $orderid = $_REQUEST['orderid'];
    $order=$wpdb->get_row("select * from ".$wpdb->icemoney." where ice_id='".$orderid."'");
    $str = "earthcoin:{$order->to_address}?amount=".$order->eac."&message=".$_SERVER['HTTP_HOST'].'_epd_'.$orderid;
    ob_clean();
    QRcode::png($str);
    exit;
}elseif($_REQUEST['action'] == 'cashqrcode'){
    require_once '../includes/qrcode.class.php';
    $orderid = $_REQUEST['orderid'];
    $info=$wpdb->get_row("select * from ".$wpdb->iceget." where ice_id='".$orderid."'");
    $str = "earthcoin:{$info->ice_alipay}?amount=".$info->eac."&message=".$_SERVER['HTTP_HOST'].'_epd_withdrawl_'.$info->ice_id;

    ob_clean();
    QRcode::png($str);
    exit;

}else{
    $post_id   = isset($_GET['ice_post']) && is_numeric($_GET['ice_post']) ?$_GET['ice_post'] :0;
    $user_type   = isset($_GET['ice_type']) && is_numeric($_GET['ice_type']) ?$_GET['ice_type'] :'';
    $index   = isset($_GET['index']) && is_numeric($_GET['index']) ?$_GET['index'] :'';
    //ice_post=16
    //&type=2
    //redirect_url=http%3A%2F%2Fepd.eacpay.com%2F%25e6%25b5%258b%25e8%25af%2595%25e5%2595%2586%25e5%2593%25812%2F
    
    $index_vip = '';
    if($post_id){
        if($index){
            $urls = get_post_meta($post_id, 'down_urls', true);
            if($urls){
                $cnt = count($urls['index']);
                if($cnt){
                    for($i=0; $i<$cnt;$i++){
                        if($urls['index'][$i] == $index){
                            $index_name = $urls['name'][$i];
                            $price = $urls['price'][$i];
                            $index_vip = $urls['vip'][$i];
                            break;
                        }
                    }
                }
            }
        }else{
            $price=get_post_meta($post_id, 'down_price', true);
        }
        $start_down2 = get_post_meta($post_id, 'start_down2',TRUE);
        if(!$start_down2){
            $price = $price / get_option("ice_proportion_alipay");
        }
        $memberDown=get_post_meta($post_id, 'member_down',TRUE);
        if($index_vip){
            $memberDown = $index_vip;
        }
        $userType=getUsreMemberType();
        if($memberDown==4 || $memberDown==8 || $memberDown==9 || (($memberDown == 10 || $memberDown == 11 || $memberDown == 12) && !$userType)){
            wp_die('您无权购买此资源！','友情提示');
        }
    
        if($userType && ($memberDown==2 || $memberDown==13)){
            $price=sprintf("%.2f",$price*0.5);
        }elseif($userType && ($memberDown==5 || $memberDown==14)){
            $price=sprintf("%.2f",$price*0.8);
        }elseif($userType>=9 && $memberDown==11){
            $price=sprintf("%.2f",$price*0.5);
        }elseif($userType>=9 && $memberDown==12){
            $price=sprintf("%.2f",$price*0.8);
        }
    }elseif($user_type){
        $ciphp_life_price    = get_option('ciphp_life_price');
        $ciphp_year_price    = get_option('ciphp_year_price');
        $ciphp_quarter_price = get_option('ciphp_quarter_price');
        $ciphp_month_price  = get_option('ciphp_month_price');
        $ciphp_day_price  = get_option('ciphp_day_price');
        if($user_type == 6){
            $price = $ciphp_day_price/get_option('ice_proportion_alipay');
        }elseif($user_type == 7){
            $price = $ciphp_month_price/get_option('ice_proportion_alipay');
        }elseif($user_type == 8){
            $price = $ciphp_quarter_price/get_option('ice_proportion_alipay');
        }elseif($user_type == 9){
            $price = $ciphp_year_price/get_option('ice_proportion_alipay');
        }elseif($user_type == 10){
            $price = $ciphp_life_price/get_option('ice_proportion_alipay');
        }
    }else{
        $price   = isset($_GET['ice_money']) && is_numeric($_GET['ice_money']) ?$_GET['ice_money'] :0;
        $price = esc_sql($price);   
        $erphpdown_min_price    = get_option('erphpdown_min_price');
        if($erphpdown_min_price > 0){
            if($price < $erphpdown_min_price){
                wp_die('您最低需充值'.$erphpdown_min_price.'元','提示');
            }
        }
    }
    
    $trade_order_id = date("ymdhis").mt_rand(100,999).mt_rand(100,999).mt_rand(100,999);
    $subject = get_bloginfo('name').'订单['.get_the_author_meta( 'user_login', wp_get_current_user()->ID ).']';
    $erphp_order_title = get_option('erphp_order_title');
    if($erphp_order_title){
        $subject = $erphp_order_title;
    }
    
    if($price > 0){
        $base = new EacpayBase(array(
            'bizhong'=>$eacpay_bizhong,
            'recive_token'=>$eacpay_recive_token,
            'receipt_confirmation'=>$eacpay_receiptConfirmation,
            'eacpay_server'=>$eacpay_server,
            'exhangeapi'=>$eacpay_exhangeapi,
            'maxwaitpaytime'=>$eacpay_maxwaitpaytime,
        ));
        $user_Info   = wp_get_current_user();
        $block_height=$base->get_block_height();
        $exchangedata=$base->getExchange('CNY');
        $eac=$price / $exchangedata;
        $sql="INSERT INTO $wpdb->icemoney (ice_money,ice_num,ice_user_id,ice_user_type,ice_post_id,ice_post_index,ice_time,ice_success,ice_note,ice_success_time,ice_alipay,from_address,to_address,eac,real_eac,block_height,last_time,status,type)
        VALUES ('$price','$trade_order_id','".$user_Info->ID."','".$user_type."','".$post_id."','".$index."','".date("Y-m-d H:i:s")."',0,'0','".date("Y-m-d H:i:s")."','eacpay','','{$eacpay_recive_token}',{$eac},0,'{$block_height}','".time()."','wait','recharge')";
        $a=$wpdb->query($sql);
        if(!$a){
            wp_die('系统发生错误，请稍后重试!');
        }else{
    		$money_info=$wpdb->get_row("select * from ".$wpdb->icemoney." where ice_num='".$trade_order_id."'");
    	}
    }else{
        wp_die('请输入您要充值的金额');
    }
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
    <body<?php if(!isset($_GET['iframe'])){echo ' class="erphpdown-page-pay"';}?>>
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
                            <td><strong id="priceCount"><?php echo $money_info->ice_money;?></strong> 元</td>
                        </tr>
                        <tr>
                            <td width="180">官方网站:</td>
                            <td><strong><a href="http://www.eacpay.com" target="_blank">www.eacpay.com</a></strong></td>
                        </tr>
                        <tr>
                            <td width="180">EAC即时价:</td>
                            <td><strong id="exchangeData"><?php echo $exchangedata.' 元'?></strong></td>
                        </tr>
                        <tr>
                            <td width="180">约合EAC:</td>
                            <td><strong id="eac"><?php echo $money_info->eac;?></strong></td>
                        </tr>
                        <tr>
                            <td width="180">支付剩余时间:</td>
                            <td><strong id="time"><?php echo $eacpay_maxwaitpaytime;?></strong></td>
                        </tr>
                        <tr>
                            <td width="180">扫码支付:</td>
                            <td id="qrcode">
                                <img src="<?php echo constant("erphpdown").'payment/eacpay.php?action=qrcode&orderid='.$money_info->ice_id;?>" />
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
                <img src="<?php echo ERPHPDOWN_URL;?>/static/images/eacpay-app.jpg" width="160" height="190"/>
            </div>
        </div>
        <script>
            jQuery(function() {
                var timeId = null;
    
                function check() {
                    jQuery.getJSON('<?php echo ERPHPDOWN_URL;?>/payment/eacpay.php?action=check&order_id=<?php echo $money_info->ice_id;?>', function(d) {
                        if (d.code == "1") {
                            clearInterval(timeId);
                            jQuery('#eacpayresult .loading .bar').css('width','100%');
                            $('#eacpayresult .resultmsg').html("付款成功");
                            setTimeout(function() {
                                location.href = d.url;
                            }, 2000);
                        }else if (d.code == "2") {
                            jQuery('#eacpayresult .loading .bar').css('width',(parseInt(d.confirmations)/parseInt(d.receipt_confirmation))*100+'%');
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
                
                var maxwaitpaytime = <?php echo $eacpay_maxwaitpaytime;?>*60, s = 0;  
                var Timer = document.getElementById("time");
                wppayCountdown();
                erphpTimer = setInterval(function(){ wppayCountdown() },1000);
                function s2time(s){
                    var ret="";
                    if(s>3600){
                        ret+= parseInt(s / 3600)+"时";
                        ret+= parseInt((s % 3600) /60)+"分";
                        ret+= parseInt(s % 60)+"秒";
                    }else{
                        ret+= parseInt(s / 60)+"分";
                        ret+= parseInt(s % 60)+"秒";
                    }
                    return ret;
                }
                function wppayCountdown (){
                    Timer.innerHTML = "支付倒计时：<span>"+s2time(maxwaitpaytime)+"</span>";
                    if( maxwaitpaytime<=0 ){
                        clearInterval(timeId);
                        clearInterval(erphpTimer);
                        jQuery("#qrcode").html('<div class="expired">支付超时,请刷新页面重新发起支付!</div>');
                    }else{
                        maxwaitpaytime--;
                    }
                }
            })
        </script>
    </body>
    </html>
    <?php
}