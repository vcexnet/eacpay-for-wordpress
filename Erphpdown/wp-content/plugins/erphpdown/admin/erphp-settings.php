<?php
/**
 * setting
 www.mobantu.com
 E-mail:82708210@qq.com
 */
if ( !defined('ABSPATH') ) {exit;}

if(isset($_POST['Submit'])) {
	update_option('ice_ali_money_limit', trim($_POST['ice_ali_money_limit']));
	update_option('ice_ali_money_site', trim($_POST['ice_ali_money_site']));
	update_option('ice_ali_money_author', trim($_POST['ice_ali_money_author']));
	update_option('ice_ali_money_ref', trim($_POST['ice_ali_money_ref']));
	update_option('ice_ali_money_ref2', trim($_POST['ice_ali_money_ref2']));
	update_option('ice_ali_money_checkin', trim($_POST['ice_ali_money_checkin']));
	update_option('ice_ali_money_new', trim($_POST['ice_ali_money_new']));
	update_option('ice_ali_money_reg', trim($_POST['ice_ali_money_reg']));
	update_option('erphp_mycred', trim($_POST['erphp_mycred']));
	update_option('erphp_to_mycred', trim($_POST['erphp_to_mycred']));
	update_option('ice_tips', str_replace('\"', '"', trim($_POST['ice_tips'])));
	update_option('ice_tips_see', str_replace('\"', '"', trim($_POST['ice_tips_see'])));
	update_option('ice_tips_free', str_replace('\"', '"', trim($_POST['ice_tips_free'])));
	update_option('erphpdown_downkey', trim($_POST['erphpdown_downkey']));
	update_option('erphp_ajaxbuy', trim($_POST['erphp_ajaxbuy']));
	update_option('erphp_popdown', trim($_POST['erphp_popdown']));
	update_option('erphp_justbuy', trim($_POST['erphp_justbuy']));
	update_option('erphp_free_wait', trim($_POST['erphp_free_wait']));
	update_option('erphp_remind', trim($_POST['erphp_remind']));
	update_option('erphp_remind_recharge', trim($_POST['erphp_remind_recharge']));
	update_option('ice_name_alipay', trim($_POST['ice_name_alipay']));
	update_option('ice_proportion_alipay', trim($_POST['ice_proportion_alipay']));
	update_option('erphpdown_min_price', trim($_POST['erphpdown_min_price']));
	update_option('epd_game_price', $_POST['epd_game_price']);
	update_option('erphp_wppay_cookie', trim($_POST['erphp_wppay_cookie']));
	update_option('erphp_wppay_ip', trim($_POST['erphp_wppay_ip']));
	update_option('erphp_wppay_payment', trim($_POST['erphp_wppay_payment']));
	update_option('erphp_addon_card', trim($_POST['erphp_addon_card']));
	update_option('erphp_addon_activation', trim($_POST['erphp_addon_activation']));
	update_option('erphpdown_direct_type', trim($_POST['erphpdown_direct_type']));

	echo'<div class="updated settings-error"><p>更新成功！</p></div>';
}

$ice_ali_money_limit    = get_option('ice_ali_money_limit');
$ice_ali_money_site    = get_option('ice_ali_money_site');
$ice_ali_money_author   = get_option('ice_ali_money_author');
$ice_ali_money_ref    = get_option('ice_ali_money_ref');
$ice_ali_money_ref2    = get_option('ice_ali_money_ref2');
$ice_ali_money_checkin = get_option('ice_ali_money_checkin');
$ice_ali_money_new    = get_option('ice_ali_money_new');
$ice_ali_money_reg    = get_option('ice_ali_money_reg');
$erphp_mycred    = get_option('erphp_mycred');
$erphp_to_mycred    = get_option('erphp_to_mycred');
$ice_tips    = get_option('ice_tips');
$ice_tips_see    = get_option('ice_tips_see');
$ice_tips_free    = get_option('ice_tips_free');
$erphpdown_downkey    = get_option('erphpdown_downkey')?get_option('erphpdown_downkey'):wp_generate_password(7, false);
$erphp_ajaxbuy    = get_option('erphp_ajaxbuy');
$erphp_popdown    = get_option('erphp_popdown');
$erphp_justbuy = get_option('erphp_justbuy');
$erphp_free_wait = get_option('erphp_free_wait');
$erphp_remind = get_option('erphp_remind');
$erphp_remind_recharge = get_option('erphp_remind_recharge');
$ice_name_alipay    = get_option('ice_name_alipay');
$ice_proportion_alipay    = get_option('ice_proportion_alipay');
$erphpdown_min_price    = get_option('erphpdown_min_price');
$epd_game_price  = get_option('epd_game_price');
$erphp_wppay_cookie    = get_option('erphp_wppay_cookie');
$erphp_wppay_ip    = get_option('erphp_wppay_ip');
$erphp_wppay_payment    = get_option('erphp_wppay_payment');
$erphp_addon_card    = get_option('erphp_addon_card');
$erphp_addon_activation = get_option('erphp_addon_activation');
$erphpdown_direct_type = get_option('erphpdown_direct_type');

$erphpdown_payname = get_option('ice_name_alipay')?get_option('ice_name_alipay'):'模板币';
?>
 <style>.form-table th{font-weight: 400}</style>
 <div class="wrap">
 	<h1>基础设置</h1>
 	<form method="post" action="<?php echo admin_url('admin.php?page='.plugin_basename(__FILE__)); ?>">
 		<h3>基础设置</h3>
 		<table class="form-table">
 			<tr>
 				<th valign="top">货币昵称 *</th>
 				<td>
 					<input type="text" id="ice_name_alipay" name="ice_name_alipay" value="<?php echo $ice_name_alipay;?>" class="regular-text"/> （例如：模板币）
 				</td>
 			</tr>
 			<tr>
 				<th valign="top">推广消费提成（百分点）*</th>
 				<td>
 					<input type="number" step="0.01" id="ice_ali_money_ref" name="ice_ali_money_ref" value="<?php echo $ice_ali_money_ref; ?>" required="required" class="regular-text"/>% 
                    <p>A推广B，B消费后A的提成</p>
 				</td>
 			</tr>
            <tr>
                <th valign="top">三级推广消费提成（百分点）</th>
                <td>
                    <input type="number" step="0.01" id="ice_ali_money_ref2" name="ice_ali_money_ref2" value="<?php echo $ice_ali_money_ref2; ?>" class="regular-text"/>% 
                    <p>A推广B，B推广C，C消费后A的提成</p>
                </td>
            </tr>
 			<tr>
 				<th valign="top">作者分成（百分点）</th>
 				<td>
 					<input type="number" step="0.01" id="ice_ali_money_author" name="ice_ali_money_author" value="<?php echo $ice_ali_money_author; ?>"  class="regular-text"/>%
                    <p>例如输入80，表示作者A发布的收费资源用户B购买后，A将得到其资源价格的80%，不填则默认100%</p>
 				</td>
 			</tr>
 			<tr>
 				<th valign="top">每日签到奖励</th>
 				<td>
 					<input type="number" step="0.01" id="ice_ali_money_checkin" name="ice_ali_money_checkin" value="<?php echo $ice_ali_money_checkin; ?>"  class="regular-text"/> <?php echo $erphpdown_payname;?> （请输入一个整数）
 				</td>
 			</tr>
 			<tr>
 				<th valign="top">新注册赠送</th>
 				<td>
 					<input type="number" step="0.01" id="ice_ali_money_new" name="ice_ali_money_new" value="<?php echo $ice_ali_money_new; ?>" class="regular-text"/> <?php echo $erphpdown_payname;?> （请输入一个整数，赠送新用户）
 				</td>
 			</tr>
 			<tr>
 				<th valign="top">推广注册奖励</th>
 				<td>
 					<input type="number" step="0.01" id="ice_ali_money_reg" name="ice_ali_money_reg" value="<?php echo $ice_ali_money_reg; ?>" class="regular-text"/> <?php echo $erphpdown_payname;?> （请输入一个整数，奖励推广人）
 				</td>
 			</tr>
 			<tr>
 				<th valign="top">提现规则 *</th>
 				<td>
 					<input type="number" step="0.01" id="ice_ali_money_limit" name="ice_ali_money_limit" value="<?php echo $ice_ali_money_limit; ?>" required="required" class="regular-text"/> <?php echo $erphpdown_payname;?>以上方可提现 （请输入一个整数）
 				</td>
 			</tr>
 			<tr>
 				<th valign="top">提现手续费（百分点）*</th>
 				<td>
 					<input type="number" step="0.01" id="ice_ali_money_site" name="ice_ali_money_site" value="<?php echo $ice_ali_money_site; ?>" required="required" class="regular-text"/>% （请输入一个整数）
 				</td>
 			</tr>
 			<tr>
 				<th valign="top">购买下载说明</th>
 				<td>
 					<textarea id="ice_tips" name="ice_tips" placeholder="客服QQ：82708210" rows="5" cols="70"><?php echo $ice_tips; ?></textarea>
 				</td>
 			</tr>
 			<tr>
 				<th valign="top">购买查看说明</th>
 				<td>
 					<textarea id="ice_tips_see" name="ice_tips_see" placeholder="客服QQ：82708210" rows="5" cols="70"><?php echo $ice_tips_see; ?></textarea>
 					<p>用于显示在短代码[erphpdown]处</p>
 				</td>
 			</tr>
 			<tr>
 				<th valign="top">免费下载说明</th>
 				<td>
 					<textarea id="ice_tips_free" name="ice_tips_free" placeholder="客服QQ：82708210" rows="5" cols="70"><?php echo $ice_tips_free; ?></textarea>
 				</td>
 			</tr>
 			<tr>
 				<th valign="top">Ajax无跳转购买</th>
 				<td>
 					<input type="checkbox" id="erphp_ajaxbuy" name="erphp_ajaxbuy" value="yes" <?php if($erphp_ajaxbuy == 'yes') echo 'checked'; ?> /> 
 				</td>
 			</tr>
 			<tr>
 				<th valign="top">直接支付购买</th>
 				<td>
 					<input type="checkbox" id="erphp_justbuy" name="erphp_justbuy" value="yes" <?php if($erphp_justbuy == 'yes') echo 'checked'; ?> /> （用户单独购买资源时可直接支付，跳过充值）
 				</td>
 			</tr>
 			<tr>
 				<th valign="top">充值提醒</th>
 				<td>
 					<input type="checkbox" id="erphp_remind_recharge" name="erphp_remind_recharge" value="yes" <?php if($erphp_remind_recharge == 'yes') echo 'checked'; ?> /> （有用户充值时邮件提醒管理员，收件箱为【设置-常规】里的管理邮件地址，请务必提前配置好SMTP发件，否则会导致卡顿。）
 				</td>
 			</tr>
 			<tr>
 				<th valign="top">购买提醒</th>
 				<td>
 					<input type="checkbox" id="erphp_remind" name="erphp_remind" value="yes" <?php if($erphp_remind == 'yes') echo 'checked'; ?> /> （有用户购买时邮件提醒管理员，收件箱为【设置-常规】里的管理邮件地址，请务必提前配置好SMTP发件，否则会导致卡顿。开启提醒可能会导致用户购买卡顿，请知晓！）
 				</td>
 			</tr>
 		</table>
 		<h3>充值设置</h3>
 		<table class="form-table">
 			<tr>
 				<th valign="top">充值比例 *</th>
 				<td>
 					<input type="number" id="ice_proportion_alipay" name="ice_proportion_alipay" value="<?php echo $ice_proportion_alipay;?>" required="required" class="regular-text"/> （请输入一个整数，例如：10，代表1元=10 <?php echo $erphpdown_payname;?>）
 				</td>
 			</tr>
 			<tr>
 				<th valign="top">最小充值金额</th>
 				<td>
 					<input type="text" id="erphpdown_min_price" name="erphpdown_min_price" value="<?php echo $erphpdown_min_price;?>" class="regular-text"/> 元（这里是充值的最小金额，不设置则不限制）
 				</td>
 			</tr>
 			<tr>
				<th valign="top">充值奖励</th>
				<td>
					<?php if($epd_game_price){ $cnt = count($epd_game_price['buy']); if($cnt){?>
					<div class="prices">
						<?php for($i=0; $i<$cnt;$i++){?>
						<p>充值 <input type="number" name="epd_game_price[buy][]" value="<?php echo $epd_game_price['buy'][$i]?>" class="regular-text" style="width:150px;" step="0.01"/> 元 实际得到 <input type="number" name="epd_game_price[get][]" value="<?php echo $epd_game_price['get'][$i]?>" class="regular-text" style="width:150px;" step="0.01"/> 元 <a href="javascript:;" class="del-price">删除</a></p>
						<?php }?>
					</div>
					<?php }}else{?>
					<div class="prices"></div>
					<?php }?>
					<button class="button add-more-price" type="button">+添加规则</button>
					<p>（示例：充值比例是1:10，那么可以设置充值1元（10<?php echo get_option('ice_name_alipay');?>），实际得到1.2元（12<?php echo get_option('ice_name_alipay');?>），相当于赠送了2<?php echo get_option('ice_name_alipay');?>）</p>
				</td>
			</tr>
 		</table>
 		<h3>下载设置</h3>
 		<table class="form-table">
 			<tr>
 				<th valign="top">免费下载等待时间</th>
 				<td>
 					<input type="number" step="1" id="erphp_free_wait" name="erphp_free_wait" value="<?php echo $erphp_free_wait; ?>"  class="regular-text"/>秒
 					<p>普通用户下载免费资源前等待多少秒，VIP无需等待，留空则无需等待</p>
 				</td>
 			</tr>
 			<tr>
 				<th valign="top">下载标识码 *</th>
 				<td>
 					<input type="text" id="erphpdown_downkey" name="erphpdown_downkey" value="<?php echo $erphpdown_downkey;?>" class="regular-text" required="required"/> 
          <p>务必设置一个随机字符串，长度为8位左右即可，不要告知他人</p>
 				</td>
 			</tr>
 			<tr>
 				<th valign="top">后缀文件直接下载</th>
 				<td>
 					<input type="text" id="erphpdown_direct_type" name="erphpdown_direct_type" value="<?php echo $erphpdown_direct_type;?>" class="regular-text"/> 
          <p>下载地址里哪些后缀文件需要直接下载而不是访问，例如pdf,doc,txt,jpg等，不需要填压缩包的后缀，多个后缀名用英文半角逗号<code>,</code>隔开<br>特别说明：如果文件较大，网站加载文件很费带宽，可能会导致网站卡顿<br>建议下载地址都使用压缩包或者网盘链接，不要直接放后缀文件地址</p>
 				</td>
 			</tr>
 			<tr>
 				<th valign="top">弹窗下载</th>
 				<td>
 					<input type="checkbox" id="erphp_popdown" name="erphp_popdown" value="yes" <?php if($erphp_popdown == 'yes') echo 'checked'; ?> /> 
 				</td>
 			</tr>
 		</table>
 		<h3>免登录下载设置</h3>
 		<table class="form-table">
 			<tr>
 				<th valign="top">支付接口</th>
 				<td>
 					<select name="erphp_wppay_payment">
 						<option value ="f2fpay" <?php if($erphp_wppay_payment == 'f2fpay') echo 'selected="selected"';?>>支付宝当面付</option>
 						<option value ="weixin" <?php if($erphp_wppay_payment == 'weixin') echo 'selected="selected"';?>>官方微信扫码支付</option>
 						<option value ="f2fpay_weixin" <?php if($erphp_wppay_payment == 'f2fpay_weixin') echo 'selected="selected"';?>>支付宝当面付/官方微信扫码支付</option>
 						<option value ="paypy" <?php if($erphp_wppay_payment == 'paypy') echo 'selected="selected"';?>>Paypy个人免签</option>
 						<option value ="f2fpay_paypy" <?php if($erphp_wppay_payment == 'f2fpay_paypy') echo 'selected="selected"';?>>支付宝当面付/Paypy微信个人免签</option>
 						<option value ="payjs" <?php if($erphp_wppay_payment == 'payjs') echo 'selected="selected"';?>>Payjs</option>
 						<option value ="hupiv3" <?php if($erphp_wppay_payment == 'hupiv3') echo 'selected="selected"';?>>虎皮椒V3</option>
 						<option value ="f2fpay_hupiv3" <?php if($erphp_wppay_payment == 'f2fpay_hupiv3') echo 'selected="selected"';?>>支付宝当面付/虎皮椒V3微信支付</option>
 						<option value ="vpay" <?php if($erphp_wppay_payment == 'vpay') echo 'selected="selected"';?>>V免签</option>
 						<option value ="eacpay" <?php if($erphp_wppay_payment == 'eacpay') echo 'selected="selected"';?>>Eacpay</option>
 					</select>
 				</td>
 			</tr>
 			<tr>
				<th valign="top">Cookie过期天数 *</th>
				<td>
					<input type="number" id="erphp_wppay_cookie" name="erphp_wppay_cookie" value="<?php echo $erphp_wppay_cookie ; ?>" class="regular-text" required="required"/>
				</td>
			</tr>
 			<tr>
 				<th valign="top">加通过IP判断</th>
 				<td>
 					<input type="checkbox" id="erphp_wppay_ip" name="erphp_wppay_ip" value="yes" <?php if($erphp_wppay_ip == 'yes') echo 'checked'; ?> />（勾选后就算cookie过期，只要IP不变，一样会判断成已支付）
 				</td>
 			</tr>
 		</table>
 		<h3>免费扩展功能</h3>
 		<table class="form-table">
 			<tr>
 				<th valign="top">充值卡</th>
 				<td>
 					<input type="checkbox" id="erphp_addon_card" name="erphp_addon_card" value="yes" <?php if($erphp_addon_card == 'yes') echo 'checked'; ?> />（请不要同时安装充值卡扩展插件，以免冲突）
 				</td>
 			</tr>
 			<tr>
 				<th valign="top">Mycred兑换</th>
 				<td>
 					<input type="checkbox" id="erphp_mycred" name="erphp_mycred" value="yes" <?php if($erphp_mycred == 'yes') echo 'checked'; ?> />（需安装<a href="https://wordpress.org/plugins/mycred/" target="_blank">mycred插件</a>） 兑换比例：
 					<input type="number" step="0.01" id="erphp_to_mycred" name="erphp_to_mycred" value="<?php echo $erphp_to_mycred; ?>" style="width:100px" />（输入100则为 100积分 = 1<?php echo $erphpdown_payname;?>）
 				</td>
 			</tr>
 			<tr>
 				<th valign="top">激活码发放</th>
 				<td>
 					<input type="checkbox" id="erphp_addon_activation" name="erphp_addon_activation" value="yes" <?php if($erphp_addon_activation == 'yes') echo 'checked'; ?> />（请不要同时安装激活码发放扩展插件，以免冲突）
 				</td>
 			</tr>
 		</table>
 		<p class="submit">
 			<input type="submit" name="Submit" value="保存设置" class="button-primary"/>
 			<div >技术支持：mobantu.com <a href="http://www.mobantu.com/6658.html" target="_blank">使用教程>></a></div>
 		</p>      
 	</form>
 	<script>
  jQuery(".add-more-price").click(function(){
    jQuery(".prices").append('<p>充值 <input type="number" name="epd_game_price[buy][]" value="" class="regular-text" style="width:150px;" step="0.01"/> 元 实际得到 <input type="number" name="epd_game_price[get][]" value="" class="regular-text" style="width:150px;" step="0.01"/> 元 <a href="javascript:;" class="del-price">删除</a></p>');
    jQuery(".del-price").click(function(){
      jQuery(this).parent().remove();
    });
    return false;
  });

  
  jQuery(".del-price").click(function(){
    jQuery(this).parent().remove();
  });
</script>
 </div>
