<?php
if(!function_exists('P')){
    function P($arr=''){
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }
}
/**
 * Class WC_Eacpay_Payment_Gateway file.
 *
 * @package WooCommerce\Gateways
 */
class WC_Eacpay_Payment_Gateway extends WC_Payment_Gateway
{

    public function __construct()
    {
        $this->id = 'eacpay';
        $this->icon = plugin_dir_url(__FILE__) . '../assets/images/logo.png';
        $this->has_fields = true;
        $this->enabled = $this->get_option('enabled');
        $this->method_title = __('eacpay', 'eacpay');
        $this->method_description = __('Eacpay支付是基于区块链代币,价格会存在波动,您收到的EAC兑换法币可能会有变化, 介意请勿使用', 'Eacpay');

        // Load the settings.
        $this->init_form_fields();
        $this->init_settings();

        $this->title = $this->get_option('title');
        $this->description = $this->get_option('description');// . ' <a href="http://eacpay.com" target="_blank">什麼是Eacpay支付?</a>';
        $this->instructions = $this->get_option('instructions');

        // 送單的備註
        $this->hide_text_box = $this->get_option('hide_text_box');
        add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));

        // --- 分割線 ---
        // 結帳完回傳
        add_action('woocommerce_api_eacpay_checkout', array($this, 'get_eacpay_checkout'));
    }

    /**
     * 后台设置参数列表
     */
    public function init_form_fields()
    {
        $this->form_fields = array(
            'enabled' => array(
                'title' => __('Enable/Disable', 'woocommerce'),
                'type' => 'checkbox',
                'label' => __('啟用', 'woocommerce'),
                'default' => 'no'
            ),
            'title' => array(
                'title' => __('Title', 'woocommerce'),
                'type' => 'text',
                'description' => __('使用者結帳所顯示的支付名稱', 'woocommerce'),
                'default' => __('Eacpay支付', 'eacpay')
            ),
            'description' => array(
                'title' => __('Description', 'woocommerce'),
                'type' => 'textarea',
                'css' => 'width: 400px;',
                'description' => __('透過培根支付付款。', 'eacpay'),
                'default' => __("透過Eacpay付款，備註請在下方留言", 'eacpay')
            ),
            'hide_text_box' => array(
                'title' => __('隱藏付款備註', 'woocommerce'),
                'type' => 'checkbox',
                'label' => __('隱藏', 'woocommerce'),
                'default' => 'no',
                'description' => __('如果您根本不需要顯示客戶的文本框，請啟用此選項。', 'eacpay'),
            ),
            'eacpay_recive_token' => array(
                'title' => __('收款地址', 'eacpay'),
                'type' => 'text',
                'description' => __('你收款的地址，請注意您的大小寫', 'eacpay'),
                'default' => 'eZcwRzRDPiPvM6WUGQXMRLa5MAHkrwWP9t',
            ),
            /*
            'eacpay_fixed_value' => array(
                'title' => __('代幣價值', 'eacpay'),
                'type' => 'text',
                'description' => __('等值該平台預設支付幣別的價格做換算，如：30 ETC 可換成 1 個接收代幣（注意：循環小數最小到八位，<a href="https://www.eacpay.com" title="另開視窗查看 - Eacpay" target="_blank">價值參考</a>，）', 'eacpay'),
                'default' => '30',
            ),
            'eacpay_proportion_value' => array(
                'title' => __('代幣支付折扣', 'eacpay'),
                'type' => 'select',
                'description' => __('使用代幣支付結帳金額折扣優惠，(總金額×折扣%)÷代幣價值', 'eacpay'),
                'default' => '95',
                'options' => array(
                    '10' => '10%',
                    '20' => '20%',
                    '30' => '30%',
                    '40' => '40%',
                    '50' => '50%',
                    '60' => '60%',
                    '65' => '65%',
                    '70' => '70%',
                    '75' => '75%',
                    '80' => '80%',
                    '85' => '85%',
                    '90' => '90%',
                    '95' => '95%',
                    '100' => '無折扣',
                )
            ),
            */
            'eacpay_cancel_url' => array(
                'title' => __('取消連結', 'eacpay'),
                'type' => 'text',
                'description' => __('取消結帳轉跳位址', 'eacpay'),
                'default' => 'http://' . $_SERVER['HTTP_HOST'] . '/cart'
            ),
            'eacpay_redirect_url' => array(
                'title' => __('結帳連結', 'eacpay'),
                'type' => 'text',
                'description' => __('結帳完成後轉跳網址', 'eacpay'),
                'default' => 'http://' . $_SERVER['HTTP_HOST'] . '/checkout/order-received'
            ),
            'eacpay_receipt_confirmation' => array(
                'title' => __('确认数量', 'eacpay'),
                'type' => 'text',
                'description' => __('必填，数值越大，确认充值的时间越长，但安全性越高，最低3个，建议不超过是10个', 'eacpay'),
                'default' => '3'
            ),
            'eacpay_maxwaitpaytime' => array(
                'title' => __('支付超时', 'eacpay'),
                'type' => 'text',
                'description' => __('必填，默认120分钟', 'eacpay'),
                'default' => '120'
            ),
            'eacpay_server' => array(
                'title' => __('Earthcoin区块链浏览器', 'eacpay'),
                'type' => 'text',
                'description' => __('必填，用于充值是到EAC区块链上查询支付情况，可以自行搭建或者查询公共浏览器<br />
                https://blocks.deveac.com:4040，https://api.eacpay.com:9000', 'eacpay'),
                'default' => 'https://api.eacpay.com:9000'
            ),
            'eacpay_exhangeapi' => array(
                'title' => __('EAC定价基准交易所', 'eacpay'),
                'type' => 'text',
                'description' => __('必填，目前默认http://www.aex.com(安银)', 'eacpay'),
                'default' => 'https://api.aex.zone/v3/depth.php'
            )
        );
    }

    public function get_eacpay_checkout()
    {
        if (isset($_GET['order_token']) && isset($_GET['order_id'])) {
            wp_safe_redirect(wc_get_checkout_url());
            exit;
        }
    }
    /**
     * Process the payment and return the result.确认下单
     *
     * @param    int $order_id Order ID.
     * @return array
     */
    public function process_payment($order_id)
    {
        global $woocommerce;
        // Reduce stock levels 降低庫存
        wc_reduce_stock_levels($order_id);
        if (isset($_POST[$this->id . '-admin-note']) && trim($_POST[$this->id . '-admin-note']) != '') {
            $order->add_order_note(esc_html($_POST[$this->id . '-admin-note']), 1);
        }

        $order = wc_get_order($order_id);
        $arr = array(
            'oid'=>$order->id,
            'order_id'=>$_SERVER['HTTP_HOST'].'_recharge_'.$order->id,
            'amount' => $order->total,
            'eac' => $order->total / $this->getExchange($order->currency),
            'real_eac' => 0,
            'to_address'  => $this->get_option('eacpay_recive_token'),
            'block_height' =>$this->get_block_height(),
            'create_time'=>time(),
            'pay_time' => 0,
            'last_time' => time(),
            'status' =>'wait',
            'type' => 'recharge',
        );
        global $wpdb;
        $eacorder = $wpdb->get_row("select * from {$wpdb->prefix}eacpay_order where `oid`='".$order->id."'");
        if(!$eacorder){
            $wpdb->insert( $wpdb->prefix.'eacpay_order', $arr);
            $order_id = $wpdb->insert_id;
        }else{
            $wpdb->update( $wpdb->prefix.'eacpay_order', $arr,array(
                'id'=>$eacorder->id
            ));
            $order_id = $eacorder->id;
        }

        // 100% 完全支付 Remove cart 清空購物車
        if ($this->get_option('eacpay_proportion_value') === 100) {
            $woocommerce->cart->empty_cart();
        }

        // Return thankyou redirect 轉跳到支付頁面
        return array(
            'result' => 'success',
            'redirect' => ($_SERVER['REQUEST_SCHEME']).'://'.$_SERVER['HTTP_HOST'].'/wp-content/plugins/eacpay/includes/eacpay.php?order_id='.$order_id,
        );
    }

    // 用戶备注输入框
    public function payment_fields()
    {
        if ($this->hide_text_box !== 'yes') {
            ?>
            <fieldset>
                <p class="form-row form-row-wide">
                    <label for="<?php echo $this->id; ?>-admin-note"><?php echo ($this->description); ?></label>
                    <textarea id="<?php echo $this->id; ?>-admin-note" class="input-text" type="text" name="<?php echo $this->id; ?>-admin-note"></textarea>
                </p>
                <div class="clear"></div>
            </fieldset>
            <?php
        }
    }
    
    function check($vo){
        global $wpdb;
        if($vo->status == 'complete'){
            return array('code'=>1,'msg'=>'ok');
        }
        $exp = ceil((time()-$vo->create_time)/60);
        $exp = $exp < 10 ? 10 : $exp;
        $url = $this->get_option('eacpay_server')."/checktransaction/".$vo->to_address."/".$vo->eac.'/'.$vo->order_id.'/'.$vo->block_height.'/'.$exp;

        //echo $url;
        $ret = $this->get($url);
        //P($ret);
        $ret = json_decode($ret,true);
        if($ret['Error']){
            return array(
                'code'=>4,
                'msg'=>$ret['Error'] == 'Payment not found' ? '等待用户支付' : $ret['Error'],
                'url'=>$url
            );
        }
        $data =array(
            'last_time' => time(),
            'pay_time' => time(),
            'status' 	=> 'payed',
            'real_eac'	=>0
        );
        $receiptConfirmation = $this->get_option('eacpay_receipt_confirmation');
        if ($ret['confirmations'] >= $receiptConfirmation) {
            $data['from_address'] = $ret['vout'][0]['scriptPubKey']['addresses'][0];
            $data['real_eac'] = $ret['vout'][1]['value'];
            if($data['from_address'] == $vo->to_address){
                $data['from_address'] = $ret['vout'][1]['scriptPubKey']['addresses'][0];
                $data['real_eac'] = $ret['vout'][0]['value'];
            }
            $wcOrder = wc_get_order($vo->oid);
            if(round($data['real_eac'],strlen(explode('.',$vo->eac)[1])) == $vo->eac){
                $data['status']		=	'complete';
                $wpdb->update($wpdb->prefix.'eacpay_order', $data, array("id"=>$vo->id));
                $wcOrder->update_status('completed');
                return array(
                    'code'=>1,
                    'msg'=>'ok',
                    'url'=>$this->get_option('eacpay_redirect_url')
                );
            }else{
                $wpdb->update($wpdb->prefix.'eacpay_order', $data, array("id"=>$vo->id));
                $wcOrder->update_status('hold','交易数值不一致，请自行联系站长解决');
                return array('code'=>3,'msg'=>'交易数值不一致，请自行联系站长解决');
            }
        }else{
            return array(
                'code'=>2,
                'msg'=>'正在确认订单，请稍等...',
                'confirmations'=>$ret['confirmations'],
                'receiptConfirmation'=>$receiptConfirmation
            );
        }
    }
    function makePayQrcode($orderid){
        global $wpdb;
        require_once  __DIR__.'/qrcode.class.php';
        $order = $wpdb->get_row("select * from {$wpdb->prefix}eacpay_order where `id`=".$orderid);
        QRcode::png("earthcoin:{$order->to_address}?amount=".$order->eac."&message=".$order->order_id, false, QR_ECLEVEL_Q,4,4);

    }
    function makeRefundQrcode($orderid){
        global $wpdb;
        require_once  __DIR__.'/qrcode.class.php';
        $order = $wpdb->get_row("select * from {$wpdb->prefix}eacpay_order where `id`=".$orderid);
        QRcode::png("earthcoin:{$order->from_address}?amount=".$order->real_eac."&message=".$_SERVER['HTTP_HOST'].'_refund_'.$order->oid, false, QR_ECLEVEL_Q,4,4);

    }
    function get_block_height(){
        return $this->get($this->get_option('eacpay_server')."/getblockcount/Block_height");
    }
    function getExchange($priceType = ''){
        $priceType = $priceType ? $priceType : get_option('woocommerce_currency');
        $ret = $this->post($this->get_option('eacpay_exhangeapi'),array('mk_type'=>'usdt','coinname'=>'eac'));
        $ret = json_decode($ret,true);
        $unitPrice = 0;
        $ret = $ret['data']['bids'];
        //P(json_encode($ret));
        
        foreach( $ret as $k=>$v){
            $unitPrice +=$v[0];
            if($k==4){
                break;
            }
        }
        $unitPrice = round($unitPrice/5,6);
        $hl = $this->huiulv($priceType);
        $unitPrice=$unitPrice * $hl;
        return round($unitPrice,6);
    }
    function huiulv($priceType='CNY'){
        if($priceType =='USD'){return 1;}
        $hlret = $this->get('https://api.exchangerate-api.com/v4/latest/USD');
        $hlret=json_decode($hlret,true);
        $rate = $hlret['rates'];
        if(key_exists($priceType,$rate)){
            return $rate[$priceType];
        }else{
            return 1;
        }
    }
    function get($url) {
        if (function_exists('curl_init')) {
            $curl = curl_init(); 
            curl_setopt($curl, CURLOPT_URL, $url); 
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
            //curl_setopt($curl, CURLOPT_REFERER, $_G['siteurl']); 
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
            $result = curl_exec($curl); 
            curl_close($curl);
        } else {
            $result = file_get_contents($url);
        }
        return $result;
    }
    function post($url,$data=array()) {
        if (function_exists('curl_init')) {
            $curl = curl_init(); 
            curl_setopt($curl, CURLOPT_URL, $url); 
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    
            $result = curl_exec($curl); 
            curl_close($curl);
        } else {
            die('need curl');
        }
        return $result;
    }
}
