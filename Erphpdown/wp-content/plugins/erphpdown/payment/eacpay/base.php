
<?php
function P($arr=""){
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
}
class EacpayBase{
    private $options=array(
        'bizhong'=>'RMB',
        'recive_token'=>'',
        'receipt_confirmation'=>'3',
        'maxwaitpaytime'=>120,
        'eacpay_server'=>'https://api.eacpay.com:9000',
        'exhangeapi'=>'https://api.aex.zone/v3/depth.php',
        'ROOT'=>'',
    );
    private $bizhongarr = array(
        'RMB'=>'￥',
        'USD'=>'$',
        'EUR'=>'€',
    );
    
    private $bizhongtxtarr = array(
        'RMB'=>'人民币',
        'USD'=>'美元',
        'EUR'=>'欧元',
    );
    public $bizhong;
    public $bizhongTxt;
    function __construct($options=array()){
        $this->options = $options;
        $uid = $_G['uid'];
        
        $bizhong = $bizhongarr[$this->options['bizhong']];
        $bizhongTxt = $bizhongtxtarr[$this->options['bizhong']];
    }
    function test($vo){
    	$exp = ceil((time()-$vo['create_time'])/60);
    	$exp = $exp < 10 ? 10 : $exp;
    	$url = $this->options['eacpay_server']."/checktransaction/".$this->options['recive_token']."/".$vo['eac'].'/'.$vo['order_id'].'/'.($vo['block_height']+1).'/1000';
    	$ret = $this->get($url);
    	echo ($ret);
    }
    function check($vo=array()){
    	if($vo->status == 'complete'){
    		return array('code'=>1,'msg'=>'ok');
    	}
    	$exp = ceil((time()-strtotime($vo->ice_time))/60);
    	$exp = $exp < 10 ? 10 : $exp;
    	if($vo->type=='cash'){
    
    	}else{
    		$url = $this->options['eacpay_server']."/checktransaction/".$this->options['recive_token']."/".$vo->eac.'/'.$_SERVER['HTTP_HOST'].'_epd_'.$vo->ice_id.'/'.$vo->block_height.'/100';
    	}
    	//echo $url;
    	$ret = $this->get($url);
    	//P($ret);
    	$ret = json_decode($ret,true);
    	if($ret['Error']){
    		return array('code'=>4,'msg'=>$ret['Error'] == 'Payment not found' ? '等待用户支付' : $ret['Error']);
    	}
    	
    	$data =array(
    		'last_time' => time(),
    		'pay_time' => time(),
    		'status' 	=> 'payed',
    		'real_eac'	=>0
    	);
    	if ($ret['confirmations'] >= $this->options['receipt_confirmation']) {
    		//P(round($ret['vout'][0]['value'],strlen(explode('.',$vo['eac'])[1])));
    		//P($vo['eac']);
            global $wpdb;
    		foreach($ret['vout'] as $v){
    			if($v['scriptPubKey']['addresses'][0] == $this->options['recive_token']){
    				$data['real_eac'] = $v['value'];
    				if(round($v['value'],strlen(explode('.',$vo->eac)[1])) == $vo->eac){
    					$data['status']		=	'complete';
                        $wpdb->update($wpdb->prefix.'ice_money', $data, array("ice_id"=>$vo->ice_id));
                        $this->notify($vo->ice_num,$vo->ice_money);
                        $re = get_option('erphp_url_front_success');
                        if(isset($_COOKIE['erphpdown_return']) && $_COOKIE['erphpdown_return']){
                            $re = $_COOKIE['erphpdown_return'];
                        }
    		            return array('code'=>1,'msg'=>'ok',"url"=>$re);
    				}else{
                        $wpdb->update($wpdb->prefix.'ice_money', $data, array("ice_id"=>$vo->ice_id));
    		            return array('code'=>3,'msg'=>'交易数值不一致，请自行联系站长解决');
    				}
    				break;
    			}
    		}
    	}else{
    		return array('code'=>2,"msg"=>"正在确认订单",'confirmations'=>$ret['confirmations'],'receipt_confirmation'=>$this->options['receipt_confirmation']);
    	}
    }
    
    function notify($out_trade_no='',$total_fee=0){
        global $wpdb, $wppay_table_name;
    
    	if(strstr($out_trade_no,'wppay')){
    		$order=$wpdb->get_row("select * from $wppay_table_name where order_num='".$out_trade_no."'");
    		if($order){
    			if(!$order->order_status){
    				$total_fee = $order->post_price;
    				$wpdb->query("UPDATE $wppay_table_name SET order_status=1 WHERE order_num = '".$out_trade_no."'");
    
    				$postUserId=get_post($order->post_id)->post_author;
    				$ice_ali_money_author = get_option('ice_ali_money_author');
    				if($ice_ali_money_author){
    					addUserMoney($postUserId,$total_fee*get_option('ice_proportion_alipay')*$ice_ali_money_author/100);
    				}elseif($ice_ali_money_author == '0'){
    
    				}else{
    					addUserMoney($postUserId,$total_fee*get_option('ice_proportion_alipay'));
    				}
    
    				if($order->user_id){
    					$ppost = get_post($order->post_id);
    					erphpAddDownloadByUid($ppost->post_title,$order->post_id,$order->user_id,$total_fee*get_option('ice_proportion_alipay'),1,'',$ppost->post_author);
    				}
    			}
    		}
    	}else{
    		epd_set_order_success($out_trade_no,$total_fee,'eacpay');
    	}
    }
    function get_block_height(){
    	return $this->get($this->options['eacpay_server']."/getblockcount/Block_height");
    }
    function getExchange($priceType=''){
    	$priceType = $priceType ? $priceType : ($this->options['bizhong'] ? $this->options['bizhong']: 'CNY');
    	$ret = $this->post($this->options['exhangeapi'],array('mk_type'=>'usdt','coinname'=>'eac'));
    	$ret = json_decode($ret,true);
    	$unitPrice = 0;
    	$ret = $ret['data']['bids'];
    	
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
    	switch($priceType){
    		case 'CNY':
    			return $rate['CNY'];
    			break;
    		case 'EUR':
    			return $rate['EUR'];
    			break;
    		default:
    			return 1;
    			break;
    	}
    }
    function get($url) {
    	if (function_exists('curl_init')) {
    		$curl = curl_init(); 
    		curl_setopt($curl, CURLOPT_URL, $url); 
    		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    		curl_setopt($curl, CURLOPT_REFERER, $_SERVER['REQUEST_URI']); 
    		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
    		$result = curl_exec($curl); 
    		curl_close($curl);
    	} else {
    		$result = dfsockopen($url);
    	}
    	return $result;
    }
    function post($url,$data=array()) {
    	if (function_exists('curl_init')) {
    		$curl = curl_init(); 
    		curl_setopt($curl, CURLOPT_URL, $url); 
    		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    		curl_setopt($curl, CURLOPT_REFERER, $_SERVER['REQUEST_URI']); 
    		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
    		curl_setopt($curl, CURLOPT_POST, 1);
    		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    
    		$result = curl_exec($curl); 
    		curl_close($curl);
    	} else {
    		return 'need curl';
    	}
    	return $result;
    }
}