<?php
/**
 www.mobantu.com
 E-mail:82708210@qq.com
 */
 if ( !defined('ABSPATH') ) {exit;}

 if(isset($_POST['Submit'])) {
    update_option('erphpdown_recharge_order', trim($_POST['erphpdown_recharge_order']));
    update_option('erphpdown_alipay_type', trim($_POST['erphpdown_alipay_type']));
    update_option('ice_ali_partner', trim($_POST['ice_ali_partner']));
    update_option('ice_ali_security_code', trim($_POST['ice_ali_security_code']));
    update_option('ice_ali_seller_email', trim($_POST['ice_ali_seller_email']));
    update_option('ice_ali_app', trim($_POST['ice_ali_app']));
    update_option('ice_ali_app_id', trim($_POST['ice_ali_app_id']));
    update_option('ice_ali_private_key', trim($_POST['ice_ali_private_key']));
    update_option('ice_ali_public_key', trim($_POST['ice_ali_public_key']));
    update_option('ice_payapl_api_uid', trim($_POST['ice_payapl_api_uid']));
    update_option('ice_payapl_api_pwd', trim($_POST['ice_payapl_api_pwd']));
    update_option('ice_payapl_api_md5', trim($_POST['ice_payapl_api_md5']));
    update_option('ice_payapl_api_rmb', trim($_POST['ice_payapl_api_rmb']));   
    update_option('erphpdown_xhpay_appid31', trim($_POST['erphpdown_xhpay_appid31']));
    update_option('erphpdown_xhpay_appsecret31', trim($_POST['erphpdown_xhpay_appsecret31']));
    update_option('erphpdown_xhpay_api31', trim($_POST['erphpdown_xhpay_api31']));
    update_option('erphpdown_xhpay_appid32', trim($_POST['erphpdown_xhpay_appid32']));
    update_option('erphpdown_xhpay_appsecret32', trim($_POST['erphpdown_xhpay_appsecret32']));
    update_option('erphpdown_xhpay_api32', trim($_POST['erphpdown_xhpay_api32']));
    update_option('ice_weixin_mchid', trim($_POST['ice_weixin_mchid']));
    update_option('ice_weixin_appid', trim($_POST['ice_weixin_appid']));
    update_option('ice_weixin_key', trim($_POST['ice_weixin_key']));
    update_option('ice_weixin_secret', trim($_POST['ice_weixin_secret']));
    update_option('ice_weixin_app', trim($_POST['ice_weixin_app']));
    update_option('erphpdown_paypy_key', trim($_POST['erphpdown_paypy_key']));
    update_option('erphpdown_paypy_api', trim($_POST['erphpdown_paypy_api']));
    update_option('erphpdown_paypy_alipay', trim($_POST['erphpdown_paypy_alipay']));
    update_option('erphpdown_paypy_wxpay', trim($_POST['erphpdown_paypy_wxpay']));
    update_option('erphpdown_paypy_curl', trim($_POST['erphpdown_paypy_curl']));
    update_option('erphpdown_payjs_appid', trim($_POST['erphpdown_payjs_appid']));
    update_option('erphpdown_payjs_appsecret', trim($_POST['erphpdown_payjs_appsecret']));
    update_option('erphpdown_payjs_alipay', trim($_POST['erphpdown_payjs_alipay']));
    update_option('erphpdown_payjs_wxpay', trim($_POST['erphpdown_payjs_wxpay']));
    update_option('erphpdown_codepay_appid', trim($_POST['erphpdown_codepay_appid']));
    update_option('erphpdown_codepay_appsecret', trim($_POST['erphpdown_codepay_appsecret']));
    update_option('erphpdown_codepay_alipay', trim($_POST['erphpdown_codepay_alipay']));
    update_option('erphpdown_codepay_qqpay', trim($_POST['erphpdown_codepay_qqpay']));
    update_option('erphpdown_codepay_wxpay', trim($_POST['erphpdown_codepay_wxpay']));
    update_option('erphpdown_codepay_api', trim($_POST['erphpdown_codepay_api']));
    update_option('erphpdown_f2fpay_id', trim($_POST['erphpdown_f2fpay_id']));
    update_option('erphpdown_f2fpay_public_key', trim($_POST['erphpdown_f2fpay_public_key']));
    update_option('erphpdown_f2fpay_private_key', trim($_POST['erphpdown_f2fpay_private_key']));
    update_option('erphpdown_f2fpay_alipay', trim($_POST['erphpdown_f2fpay_alipay']));
    update_option('erphpdown_epay_id', trim($_POST['erphpdown_epay_id']));
    update_option('erphpdown_epay_key', trim($_POST['erphpdown_epay_key']));
    update_option('erphpdown_epay_url', trim($_POST['erphpdown_epay_url']));
    update_option('erphpdown_epay_alipay', trim($_POST['erphpdown_epay_alipay']));
    update_option('erphpdown_epay_wxpay', trim($_POST['erphpdown_epay_wxpay']));
    update_option('erphpdown_vpay_key', trim($_POST['erphpdown_vpay_key']));
    update_option('erphpdown_vpay_api', trim($_POST['erphpdown_vpay_api']));
    update_option('erphpdown_vpay_alipay', trim($_POST['erphpdown_vpay_alipay']));
    update_option('erphpdown_vpay_wxpay', trim($_POST['erphpdown_vpay_wxpay']));
    update_option('erphpdown_vpay_curl', trim($_POST['erphpdown_vpay_curl']));

    update_option('erphpdown_eacpay_allow_cash', trim($_POST['eacpay_allow_cash']));
    update_option('erphpdown_eacpay_recive_token', trim($_POST['eacpay_recive_token']));
    update_option('erphpdown_eacpay_bizhong', trim($_POST['eacpay_bizhong']));
    update_option('erphpdown_eacpay_server', trim($_POST['eacpay_server']));
    update_option('erphpdown_eacpay_exhangeapi', trim($_POST['eacpay_exhangeapi']));
    update_option('erphpdown_eacpay_receiptConfirmation', trim($_POST['eacpay_receiptConfirmation']));
    update_option('erphpdown_eacpay_maxwaitpaytime', trim($_POST['eacpay_maxwaitpaytime']));
    update_option('erphpdown_eacpay_notice', trim($_POST['eacpay_notice']));
    update_option('erphpdown_eacpay_alipay', trim($_POST['erphpdown_eacpay_alipay']));
    update_option('erphpdown_eacpay_wxpay', trim($_POST['erphpdown_eacpay_wxpay']));
    echo'<div class="updated settings-error"><p>更新成功！</p></div>';

 }
 $erphpdown_recharge_order = get_option('erphpdown_recharge_order');
 $erphpdown_alipay_type = get_option('erphpdown_alipay_type');
 $ice_ali_partner       = get_option('ice_ali_partner');
 $ice_ali_security_code = get_option('ice_ali_security_code');
 $ice_ali_seller_email  = get_option('ice_ali_seller_email');
 $ice_ali_app   = get_option('ice_ali_app');
 $ice_ali_app_id   = get_option('ice_ali_app_id');
 $ice_ali_private_key   = get_option('ice_ali_private_key');
 $ice_ali_public_key   = get_option('ice_ali_public_key');
 $ice_payapl_api_uid    = get_option('ice_payapl_api_uid');
 $ice_payapl_api_pwd    = get_option('ice_payapl_api_pwd');
 $ice_payapl_api_md5    = get_option('ice_payapl_api_md5');
 $ice_payapl_api_rmb    = get_option('ice_payapl_api_rmb');
 $erphpdown_xhpay_appid31    = get_option('erphpdown_xhpay_appid31');
 $erphpdown_xhpay_appsecret31    = get_option('erphpdown_xhpay_appsecret31');
 $erphpdown_xhpay_api31    = get_option('erphpdown_xhpay_api31');
 $erphpdown_xhpay_appid32    = get_option('erphpdown_xhpay_appid32');
 $erphpdown_xhpay_appsecret32    = get_option('erphpdown_xhpay_appsecret32');
 $erphpdown_xhpay_api32    = get_option('erphpdown_xhpay_api32');
 $ice_weixin_mchid  = get_option('ice_weixin_mchid');
 $ice_weixin_appid  = get_option('ice_weixin_appid');
 $ice_weixin_key  = get_option('ice_weixin_key');
 $ice_weixin_secret  = get_option('ice_weixin_secret');
 $ice_weixin_app  = get_option('ice_weixin_app');
 $erphpdown_paypy_key    = get_option('erphpdown_paypy_key');
 $erphpdown_paypy_api    = get_option('erphpdown_paypy_api');
 $erphpdown_paypy_alipay = get_option('erphpdown_paypy_alipay');
 $erphpdown_paypy_wxpay = get_option('erphpdown_paypy_wxpay');
 $erphpdown_paypy_curl = get_option('erphpdown_paypy_curl');
 $erphpdown_payjs_appid    = get_option('erphpdown_payjs_appid');
 $erphpdown_payjs_appsecret    = get_option('erphpdown_payjs_appsecret');
 $erphpdown_payjs_alipay    = get_option('erphpdown_payjs_alipay');
 $erphpdown_payjs_wxpay    = get_option('erphpdown_payjs_wxpay');
 $erphpdown_codepay_appid    = get_option('erphpdown_codepay_appid');
 $erphpdown_codepay_appsecret    = get_option('erphpdown_codepay_appsecret');
 $erphpdown_codepay_alipay = get_option('erphpdown_codepay_alipay');
 $erphpdown_codepay_qqpay = get_option('erphpdown_codepay_qqpay');
 $erphpdown_codepay_wxpay = get_option('erphpdown_codepay_wxpay');
 $erphpdown_codepay_api = get_option('erphpdown_codepay_api');
 $erphpdown_f2fpay_id       = get_option('erphpdown_f2fpay_id');
 $erphpdown_f2fpay_public_key       = get_option('erphpdown_f2fpay_public_key');
 $erphpdown_f2fpay_private_key       = get_option('erphpdown_f2fpay_private_key');
 $erphpdown_f2fpay_alipay = get_option('erphpdown_f2fpay_alipay');
 $erphpdown_epay_id  = get_option('erphpdown_epay_id');
 $erphpdown_epay_key  = get_option('erphpdown_epay_key');
 $erphpdown_epay_url  = get_option('erphpdown_epay_url');
 $erphpdown_epay_alipay = get_option('erphpdown_epay_alipay');
 $erphpdown_epay_wxpay = get_option('erphpdown_epay_wxpay');
 $erphpdown_vpay_key  = get_option('erphpdown_vpay_key');
 $erphpdown_vpay_api  = get_option('erphpdown_vpay_api');
 $erphpdown_vpay_alipay = get_option('erphpdown_vpay_alipay');
 $erphpdown_vpay_wxpay = get_option('erphpdown_vpay_wxpay');
 $erphpdown_vpay_curl = get_option('erphpdown_vpay_curl');

$eacpay_allow_cash=get_option('erphpdown_eacpay_allow_cash');
$eacpay_recive_token=get_option('erphpdown_eacpay_recive_token');
$eacpay_bizhong=get_option('erphpdown_eacpay_bizhong');
$eacpay_server=get_option('erphpdown_eacpay_server');
$eacpay_exhangeapi=get_option('erphpdown_eacpay_exhangeapi');
$eacpay_receiptConfirmation=get_option('erphpdown_eacpay_receiptConfirmation');
$eacpay_maxwaitpaytime=get_option('erphpdown_eacpay_maxwaitpaytime');
$eacpay_notice=get_option('erphpdown_eacpay_notice');
$erphpdown_eacpay_alipay=get_option('erphpdown_eacpay_alipay');
$erphpdown_eacpay_wxpay=get_option('erphpdown_eacpay_wxpay');
 ?>
 <style>.form-table th{font-weight: 400}</style>
 <div class="wrap">
    <h1>支付设置</h1>
    <form method="post" action="<?php echo admin_url('admin.php?page='.plugin_basename(__FILE__)); ?>">
        <h3>充值支付接口顺序</h3>
        支付宝 <code>alipay</code>、支付宝当面付 <code>f2fpay</code>、微信支付 <code>wxpay</code>、PayPal <code>paypal</code>、Paypy微信 <code>paypy-wx</code>、Paypy支付宝 <code>paypy-ali</code>、Payjs微信 <code>payjs-wx</code>、Payjs支付宝 <code>payjs-ali</code>、虎皮椒微信 <code>xhpay-wx</code>、虎皮椒支付宝 <code>xhpay-ali</code>、码支付微信 <code>codepay-wx</code>、码支付支付宝 <code>codepay-ali</code>、码支付QQ钱包 <code>codepay-qq</code>、易支付微信 <code>epay-wx</code>、易支付支付宝 <code>epay-ali</code>、V免签微信 <code>vpay-wx</code>、V免签支付宝 <code>vpay-ali</code>
        <table class="form-table">
            <tr>
                <td style="padding-left: 0">
                    <input type="text" id="erphpdown_recharge_order" name="erphpdown_recharge_order" value="<?php echo $erphpdown_recharge_order ; ?>" class="regular-text"/>
                    <p>留空则默认，如需设置请填写可用接口的<code>代号</code>，多个用英文逗号隔开，例如：alipay,wxpay</p>
                </td>
            </tr>
        </table>
        <h3>1、支付宝（官方接口-企业）</h3>
        PC电脑网站支付申请地址： https://mrchportalweb.alipay.com/user/home.htm#/ 页面下面开通电脑网站支付。
        <table class="form-table">
            <tr>
                <th valign="top">接口类型</th>
                <td>
                    <select name="erphpdown_alipay_type">
                        <option value="create_direct_pay_by_user" <?php if($erphpdown_alipay_type == 'create_direct_pay_by_user') echo 'selected="selected"';?>>即时到账</option>
                        <option disabled value ="create_partner_trade_by_buyer" <?php if($erphpdown_alipay_type == 'create_partner_trade_by_buyer') echo 'selected="selected"';?>>担保交易（官方已下架）</option>
                        <option disabled value ="trade_create_by_buyer" <?php if($erphpdown_alipay_type == 'trade_create_by_buyer') echo 'selected="selected"';?>>双接口（官方已下架）</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th valign="top">合作者身份(Partner ID)</th>
                <td>
                    <input type="text" id="ice_ali_partner" name="ice_ali_partner" value="<?php echo $ice_ali_partner ; ?>" class="regular-text"/>
                    <p>查看地址：https://openhome.alipay.com/platform/keyManage.htm?keyType=partner</p>
                </td>
            </tr>
            <tr>
                <th valign="top">安全校验码(Key)</th>
                <td>
                    <input type="text" id="ice_ali_security_code" name="ice_ali_security_code" value="<?php echo $ice_ali_security_code; ?>" class="regular-text"/>
                    <p>密钥管理 - mapi网关产品密钥，MD5密钥</p>
                </td>
            </tr>
            <tr>
                <th valign="top">支付宝收款账号</th>
                <td>
                    <input type="text" id="ice_ali_seller_email" name="ice_ali_seller_email" value="<?php echo $ice_ali_seller_email; ?>" class="regular-text"/>
                </td>
            </tr>
            <tr>
                <th valign="top">启用唤醒APP支付</th>
                <td>
                    <input type="checkbox" id="ice_ali_app" name="ice_ali_app" value="yes" <?php if($ice_ali_app == 'yes') echo 'checked'; ?> /> 
                    <p>唤醒APP支付接口现在已免费集成，但模板兔不提供免费的调试接口辅助。<br>开放平台申请接口：https://openhome.alipay.com/platform/developerIndex.htm<br>网页&移动应用，能力名称为 手机网站支付</p>
                </td>
            </tr>
            <tr>
                <th valign="top">APP支付APPID</th>
                <td>
                <input type="text" id="ice_ali_app_id" name="ice_ali_app_id" value="<?php echo $ice_ali_app_id; ?>" class="regular-text"/>
                </td>
            </tr>
            <tr>
                <th valign="top">APP支付商户应用私钥</th>
                <td>
                <textarea id="ice_ali_private_key" name="ice_ali_private_key" class="regular-text" style="height: 200px;"><?php echo $ice_ali_private_key; ?></textarea>
                </td>
            </tr>
            <tr>
                <th valign="top">APP支付支付宝公钥</th>
                <td>
                <textarea id="ice_ali_public_key" name="ice_ali_public_key" class="regular-text" style="height: 200px;"><?php echo $ice_ali_public_key; ?></textarea>
                </td>
            </tr>
        </table>
        <br />
        <h3>2、支付宝当面付（官方接口-个人）</h3>
        <table class="form-table">
                <tr>
                <th valign="top">应用APPID</th>
                <td>
                    <input type="text" id="erphpdown_f2fpay_id" name="erphpdown_f2fpay_id" value="<?php echo $erphpdown_f2fpay_id ; ?>" class="regular-text"/>
                </td>
            </tr>
            <tr>
                <th valign="top">商户应用私钥</th>
                <td>
                    <textarea id="erphpdown_f2fpay_private_key" name="erphpdown_f2fpay_private_key" class="regular-text" style="height: 200px;"><?php echo $erphpdown_f2fpay_private_key; ?></textarea>
                </td>
            </tr>
            <tr>
                <th valign="top">支付宝公钥</th>
                <td>
                    <textarea id="erphpdown_f2fpay_public_key" name="erphpdown_f2fpay_public_key" class="regular-text" style="height: 200px;"><?php echo $erphpdown_f2fpay_public_key; ?></textarea>
                </td>
            </tr>
            <tr>
                <th valign="top">隐藏</th>
                <td>
                    <input type="checkbox" id="erphpdown_f2fpay_alipay" name="erphpdown_f2fpay_alipay" value="yes" <?php if($erphpdown_f2fpay_alipay == 'yes') echo 'checked'; ?> /> 
                </td>
            </tr>
        </table>
        <br />
        <h3>3、微信支付（官方接口-企业）</h3>
        微信支付-->开发配置，设置支付授权目录：<?php echo home_url();?>/wp-content/plugins/erphpdown/payment/
        <table class="form-table">
            <tr>
                <th valign="top">商户号(MCHID)</th>
                <td>
                    <input type="text" id="ice_weixin_mchid" name="ice_weixin_mchid" value="<?php echo $ice_weixin_mchid ; ?>" class="regular-text"/>
                </td>
            </tr>
            <tr>
                <th valign="top">APPID</th>
                <td>
                    <input type="text" id="ice_weixin_appid" name="ice_weixin_appid" value="<?php echo $ice_weixin_appid; ?>" class="regular-text"/>
                </td>
            </tr>
            <tr>
                <th valign="top">商户支付密钥(KEY)</th>
                <td>
                    <input type="text" id="ice_weixin_key" name="ice_weixin_key" value="<?php echo $ice_weixin_key; ?>" class="regular-text"/><br>
                    设置地址：<a href="https://pay.weixin.qq.com/index.php/account/api_cert" target="_blank">https://pay.weixin.qq.com/index.php/account/api_cert </a>，建议为32位字符串<br>设置教程：<a href="https://www.mobantu.com/7919.html" target="_blank">https://www.mobantu.com/7919.html</a>
                </td>
            </tr>
            <tr>
                <th valign="top">公众帐号Secret</th>
                <td>
                    <input type="text" id="ice_weixin_secret" name="ice_weixin_secret" value="<?php echo $ice_weixin_secret; ?>" class="regular-text"/>
                </td>
            </tr>
            <tr>
                <th valign="top">启用唤醒APP支付</th>
                <td>
                    <input type="checkbox" id="ice_weixin_app" name="ice_weixin_app" value="yes" <?php if($ice_weixin_app == 'yes') echo 'checked'; ?> /> 
                    <p>唤醒APP支付接口现在已免费集成，但模板兔不提供免费的调试接口辅助。<br>1、微信公众平台-->公众号设置-->功能设置，设置业务域名、JS接口安全域名、网页授权域名<br>2、商户平台-->产品中心-->开发配置，设置支付授权目录、H5支付域名</p>
                </td>
            </tr>
        </table>

        <br />
        <h3>4、PayPal（官方接口-企业）</h3>
        <table class="form-table">
            <tr>
                <th valign="top">API帐号</th>
                <td>
                    <input type="text" id="ice_payapl_api_uid" name="ice_payapl_api_uid" value="<?php echo $ice_payapl_api_uid ; ?>" class="regular-text"/>
                </td>
            </tr>
            <tr>
                <th valign="top">API密码</th>
                <td>
                    <input type="text" id="ice_payapl_api_pwd" name="ice_payapl_api_pwd" value="<?php echo $ice_payapl_api_pwd; ?>" class="regular-text"/>
                </td>
            </tr>
            <tr>
                <th valign="top">API签名</th>
                <td>
                    <input type="text" id="ice_payapl_api_md5" name="ice_payapl_api_md5" value="<?php echo $ice_payapl_api_md5; ?>" class="regular-text"/>
                </td>
            </tr>
            <tr>
                <th valign="top">汇率</th>
                <td>
                    <input type="number" step="0.01" id="ice_payapl_api_rmb" name="ice_payapl_api_rmb" value="<?php echo $ice_payapl_api_rmb; ?>" class="regular-text"/>
                    <p>填5表示1美元=5元</p>
                </td>
            </tr>
        </table>

        <br />
        <h3>5、Paypy（微信/支付宝-个人免签）</h3>
        <div>详情：<a href="http://www.mobantu.com/8080.html" target="_blank" rel="nofollow">http://www.mobantu.com/8080.html</a></div>
        <table class="form-table">
            <tr>
                <th valign="top">Api地址</th>
                <td>
                    <input type="text" id="erphpdown_paypy_api" name="erphpdown_paypy_api" value="<?php echo $erphpdown_paypy_api; ?>" class="regular-text"/>
                </td>
            </tr>
            <tr>
                <th valign="top">签名密钥</th>
                <td>
                    <input type="text" id="erphpdown_paypy_key" name="erphpdown_paypy_key" value="<?php echo $erphpdown_paypy_key ; ?>" class="regular-text"/>
                </td>
            </tr>
            <tr>
                <th valign="top">隐藏支付宝</th>
                <td>
                    <input type="checkbox" id="erphpdown_paypy_alipay" name="erphpdown_paypy_alipay" value="yes" <?php if($erphpdown_paypy_alipay == 'yes') echo 'checked'; ?> /> 
                </td>
            </tr>
            <tr>
                <th valign="top">隐藏微信</th>
                <td>
                    <input type="checkbox" id="erphpdown_paypy_wxpay" name="erphpdown_paypy_wxpay" value="yes" <?php if($erphpdown_paypy_wxpay == 'yes') echo 'checked'; ?> /> 
                </td>
            </tr>
            <tr>
                <th valign="top">兼容切换</th>
                <td>
                    <input type="checkbox" id="erphpdown_paypy_curl" name="erphpdown_paypy_curl" value="yes" <?php if($erphpdown_paypy_curl == 'yes') echo 'checked'; ?> /> 
                    <p>如果都配置好了但无法出码，可勾选此项试试</p>
                </td>
            </tr>
        </table>
        <br />
        <h3>6、虎皮椒（微信/支付宝-个人）</h3>
        <div>关于此接口的安全稳定性，请使用者自行把握，我们只提供集成服务，接口申请地址：<a href="https://admin.xunhupay.com/sign-up/451.html" target="_blank" rel="nofollow">点击查看</a></div>
        <table class="form-table">
            <tr>
                <th valign="top">微信appid</th>
                <td>
                    <input type="text" id="erphpdown_xhpay_appid31" name="erphpdown_xhpay_appid31" value="<?php echo $erphpdown_xhpay_appid31 ; ?>" class="regular-text"/>
                </td>
            </tr>
            <tr>
                <th valign="top">微信appsecret</th>
                <td>
                    <input type="text" id="erphpdown_xhpay_appsecret31" name="erphpdown_xhpay_appsecret31" value="<?php echo $erphpdown_xhpay_appsecret31; ?>" class="regular-text"/>
                </td>
            </tr>
            <tr>
                <th valign="top">微信网关</th>
                <td>
                    <input type="text" id="erphpdown_xhpay_api31" name="erphpdown_xhpay_api31" value="<?php echo $erphpdown_xhpay_api31; ?>" class="regular-text"/>
                    <p>留空则默认网关，无特别升级提示，请留空即可</p>
                </td>
            </tr>
            <tr>
                <th valign="top">支付宝appid</th>
                <td>
                    <input type="text" id="erphpdown_xhpay_appid32" name="erphpdown_xhpay_appid32" value="<?php echo $erphpdown_xhpay_appid32 ; ?>" class="regular-text"/>
                </td>
            </tr>
            <tr>
                <th valign="top">支付宝appsecret</th>
                <td>
                    <input type="text" id="erphpdown_xhpay_appsecret32" name="erphpdown_xhpay_appsecret32" value="<?php echo $erphpdown_xhpay_appsecret32; ?>" class="regular-text"/>
                </td>
            </tr>
            <tr>
                <th valign="top">支付宝网关</th>
                <td>
                    <input type="text" id="erphpdown_xhpay_api32" name="erphpdown_xhpay_api32" value="<?php echo $erphpdown_xhpay_api32; ?>" class="regular-text"/>
                    <p>留空则默认网关，无特别升级提示，请留空即可</p>
                </td>
            </tr>
        </table>
        <br />
        <h3>7、Payjs（微信/支付宝-个人）</h3>
        <div>关于此接口的安全稳定性，请使用者自行把握，我们只提供集成服务，接口申请地址：<a href="http://payjs.cn/?utm_source=erphpdown" target="_blank" rel="nofollow">点击查看</a></div>
        <table class="form-table">
            <tr>
                <th valign="top">商户号</th>
                <td>
                    <input type="text" id="erphpdown_payjs_appid" name="erphpdown_payjs_appid" value="<?php echo $erphpdown_payjs_appid ; ?>" class="regular-text"/>
                </td>
            </tr>
            <tr>
                <th valign="top">通讯密钥</th>
                <td>
                    <input type="text" id="erphpdown_payjs_appsecret" name="erphpdown_payjs_appsecret" value="<?php echo $erphpdown_payjs_appsecret; ?>" class="regular-text"/>
                </td>
            </tr>
            <tr>
                <th valign="top">隐藏支付宝</th>
                <td>
                    <input type="checkbox" id="erphpdown_payjs_alipay" name="erphpdown_payjs_alipay" value="yes" <?php if($erphpdown_payjs_alipay == 'yes') echo 'checked'; ?> /> 
                </td>
            </tr>
            <tr>
                <th valign="top">隐藏微信</th>
                <td>
                    <input type="checkbox" id="erphpdown_payjs_wxpay" name="erphpdown_payjs_wxpay" value="yes" <?php if($erphpdown_payjs_wxpay == 'yes') echo 'checked'; ?> /> 
                </td>
            </tr>
        </table>
        <br />
        <h3>8、码支付（支付宝/微信/QQ钱包-个人免签）</h3>
        <div>关于此接口的安全稳定性，请使用者自行把握，我们只提供集成服务，接口申请地址：<a href="https://api.xiuxiu888.com/i/520753" target="_blank" rel="nofollow">点击查看</a></div>
        <table class="form-table">
            <tr>
                <th valign="top">码支付ID</th>
                <td>
                    <input type="text" id="erphpdown_codepay_appid" name="erphpdown_codepay_appid" value="<?php echo $erphpdown_codepay_appid ; ?>" class="regular-text"/>
                </td>
            </tr>
            <tr>
                <th valign="top">通讯密钥</th>
                <td>
                    <input type="text" id="erphpdown_codepay_appsecret" name="erphpdown_codepay_appsecret" value="<?php echo $erphpdown_codepay_appsecret; ?>" class="regular-text"/>
                </td>
            </tr>
            <tr>
                <th valign="top">网关</th>
                <td>
                    <input type="text" id="erphpdown_codepay_api" name="erphpdown_codepay_api" value="<?php echo $erphpdown_codepay_api; ?>" class="regular-text"/>
                    <p>留空则默认网关，无特别升级提示，请留空即可，结尾不要带/。例如：https://api.xiuxiu888.com</p>
                </td>
            </tr>
            <tr>
                <th valign="top">隐藏支付宝</th>
                <td>
                    <input type="checkbox" id="erphpdown_codepay_alipay" name="erphpdown_codepay_alipay" value="yes" <?php if($erphpdown_codepay_alipay == 'yes') echo 'checked'; ?> /> 
                </td>
            </tr>
            <tr>
                <th valign="top">隐藏微信</th>
                <td>
                    <input type="checkbox" id="erphpdown_codepay_wxpay" name="erphpdown_codepay_wxpay" value="yes" <?php if($erphpdown_codepay_wxpay == 'yes') echo 'checked'; ?> /> 
                </td>
            </tr>
            <tr>
                <th valign="top">隐藏QQ钱包</th>
                <td>
                    <input type="checkbox" id="erphpdown_codepay_qqpay" name="erphpdown_codepay_qqpay" value="yes" <?php if($erphpdown_codepay_qqpay == 'yes') echo 'checked'; ?> /> 
                </td>
            </tr>
        </table>
        <br />
        <h3>9、易支付（四方支付）</h3>
        <div>详情：https://www.mobantu.com/8722.html</div>
        <table class="form-table">
            <tr>
                <th valign="top">商户ID</th>
                <td>
                <input type="text" id="erphpdown_epay_id" name="erphpdown_epay_id" value="<?php echo $erphpdown_epay_id ; ?>" class="regular-text"/>
                </td>
            </tr>
            <tr>
                <th valign="top">商户密钥key</th>
                <td>
                <input type="text" id="erphpdown_epay_key" name="erphpdown_epay_key" value="<?php echo $erphpdown_epay_key; ?>" class="regular-text"/>
                </td>
            </tr>
            <tr>
                <th valign="top">API地址</th>
                <td>
                <input type="text" id="erphpdown_epay_url" name="erphpdown_epay_url" value="<?php echo $erphpdown_epay_url; ?>" class="regular-text"/>
                <p>注意：地址最后需要带上斜杠/，例如http://epay.erphpdown.com/</p>
                </td>
            </tr>
            <tr>
                <th valign="top">隐藏支付宝</th>
                <td>
                    <input type="checkbox" id="erphpdown_epay_alipay" name="erphpdown_epay_alipay" value="yes" <?php if($erphpdown_epay_alipay == 'yes') echo 'checked'; ?> /> 
                </td>
            </tr>
            <tr>
                <th valign="top">隐藏微信</th>
                <td>
                    <input type="checkbox" id="erphpdown_epay_wxpay" name="erphpdown_epay_wxpay" value="yes" <?php if($erphpdown_epay_wxpay == 'yes') echo 'checked'; ?> /> 
                </td>
            </tr>
        </table>
        <br />
        <h3>10、V免签（微信/支付宝-个人免签）</h3>
        <div>详情：https://github.com/szvone/vmqphp</div>
        <table class="form-table">
            <tr>
                <th valign="top">通信密钥key</th>
                <td>
                <input type="text" id="erphpdown_vpay_key" name="erphpdown_vpay_key" value="<?php echo $erphpdown_vpay_key; ?>" class="regular-text"/>
                </td>
            </tr>
            <tr>
                <th valign="top">API地址</th>
                <td>
                <input type="text" id="erphpdown_vpay_api" name="erphpdown_vpay_api" value="<?php echo $erphpdown_vpay_api; ?>" class="regular-text"/>
                <p>vpay域名+/createOrder结尾，例如http://vpay.erphpdown.com/createOrder</p>
                </td>
            </tr>
            <tr>
                <th valign="top">隐藏支付宝</th>
                <td>
                    <input type="checkbox" id="erphpdown_vpay_alipay" name="erphpdown_vpay_alipay" value="yes" <?php if($erphpdown_vpay_alipay == 'yes') echo 'checked'; ?> /> 
                </td>
            </tr>
            <tr>
                <th valign="top">隐藏微信</th>
                <td>
                    <input type="checkbox" id="erphpdown_vpay_wxpay" name="erphpdown_vpay_wxpay" value="yes" <?php if($erphpdown_vpay_wxpay == 'yes') echo 'checked'; ?> /> 
                </td>
            </tr>
            <tr>
                <th valign="top">兼容切换</th>
                <td>
                    <input type="checkbox" id="erphpdown_vpay_curl" name="erphpdown_vpay_curl" value="yes" <?php if($erphpdown_vpay_curl == 'yes') echo 'checked'; ?> /> 
                    <p>如果都配置好了但无法出码，可勾选此项试试</p>
                </td>
            </tr>
        </table>

        <br />
        <h3>11、Eacpay区块链支付</h3>
        <div>详情：https://www.eacpay.com</div>
        <table class="form-table">
            <tr>
                <th valign="top">用户提现</th>
                <td>
                    <input type="checkbox" id="eacpay_allow_cash" name="eacpay_allow_cash" value="yes" <?php if($eacpay_allow_cash == 'yes') echo 'checked'; ?> /> 
                </td>
            </tr>
            <tr>
                <th valign="top">收款地址</th>
                <td>
                    <input type="text" id="eacpay_recive_token" name="eacpay_recive_token" value="<?php echo $eacpay_recive_token; ?>" class="regular-text"/>
                    <p>必填，请下载EAC钱包，生成一个地址，可以随时更换收款地址，严禁多个网站公用一个地址</p>
                </td>
            </tr>
            <tr>
                <th valign="top">定价基准币种</th>
                <td>
                    <select name="eacpay_bizhong">
                        <option value="CNY" <?php if($eacpay_bizhong == 'CNY') echo 'selected="selected"';?>>人民币</option>
                        <option value ="USD" <?php if($eacpay_bizhong == 'USD') echo 'selected="selected"';?>>美元</option>
                        <option value ="EUR" <?php if($eacpay_bizhong == 'EUR') echo 'selected="selected"';?>>欧元</option>
                    </select>
                    <p>必选，系统自动将对应的金额数量换成成同等价值的eac个数</p>
                </td>
            </tr>
            <tr>
                <th valign="top">Earthcoin区块链浏览器</th>
                <td>
                    <input type="text" id="eacpay_server" name="eacpay_server" value="<?php echo $eacpay_server; ?>" class="regular-text" /> 
                    <p>必填，用于充值是到EAC区块链上查询支付情况，可以自行搭建或者查询公共浏览器<br> https://blocks.deveac.com:4040，https://api.eacpay.com:9000</p>
                </td>
            </tr>
            <tr>
                <th valign="top">EAC定价基准交易所</th>
                <td>
                <input type="text" id="eacpay_exhangeapi" name="eacpay_exhangeapi" value="<?php echo $eacpay_exhangeapi; ?>" class="regular-text"/>
                <p> 必填，目前默认http://www.aex.com(安银)</p>
                </td>
            </tr>
            <tr>
                <th valign="top">确认数量</th>
                <td>
                    <input type="number" step="0.01" id="eacpay_receiptConfirmation" name="eacpay_receiptConfirmation" value="<?php echo $eacpay_receiptConfirmation; ?>" class="regular-text"/>
                    <p>必填，数值越大，确认充值的时间越长，但安全性越高，最低3个，建议不超过是10个</p>
                </td>
            </tr>
            <tr>
                <th valign="top">支付超时</th>
                <td>
                    <input type="number" step="0.01" id="eacpay_maxwaitpaytime" name="eacpay_maxwaitpaytime" value="<?php echo $eacpay_maxwaitpaytime; ?>" class="regular-text"/>
                    <p> 单位:分钟</p>
                </td>
            </tr>
            <tr>
                <th valign="top">提示信息</th>
                <td>
                    <textarea id="eacpay_notice" name="eacpay_notice" class="regular-text"><?php echo $eacpay_notice; ?></textarea>
                </td>
            </tr>
            <tr>
                <th valign="top">隐藏支付宝</th>
                <td>
                    <input type="checkbox" id="erphpdown_eacpay_alipay" name="erphpdown_eacpay_alipay" value="yes" <?php if($erphpdown_eacpay_alipay == 'yes') echo 'checked'; ?> /> 
                </td>
            </tr>
            <tr>
                <th valign="top">隐藏微信</th>
                <td>
                    <input type="checkbox" id="erphpdown_eacpay_wxpay" name="erphpdown_eacpay_wxpay" value="yes" <?php if($erphpdown_eacpay_wxpay == 'yes') echo 'checked'; ?> /> 
                </td>
            </tr>
        </table>
        <p class="submit">
            <input type="submit" name="Submit" value="保存设置" class="button-primary"/>
            <div >技术支持：mobantu.com <a href="http://www.mobantu.com/6658.html" target="_blank">使用教程>></a></div>
        </p>      
    </form>
</div>