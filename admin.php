<?php
/*
Author: Douglas Karr
Author URI: http://www.dknewmedia.com
Description: Visual Blaze NameTag
*/

$url_admin = get_option('siteurl') . '/wp-admin/admin.php?page=nametag/admin.php'; 
$url_data = get_option('siteurl') . '/wp-admin/plugins/nametag/data.php'; 
$url_plugin = dirname(__FILE__);

add_option('dknt_apikey', __('', 'dknt'));
add_option('dknt_tracking', __('', 'dknt'));

if ($_POST['stage']=='process') {
	$dknt_apikey = addslashes($_POST['dknt_apikey']);
	$dknt_tracking = addslashes($_POST['dknt_tracking']);
	update_option('dknt_apikey', trim($dknt_apikey));
	update_option('dknt_tracking', trim($dknt_tracking));
}

$dknt_apikey = stripslashes(get_option('dknt_apikey'));
$dknt_tracking = stripslashes(get_option('dknt_tracking'));

?>
<?php if ( !empty($_POST['submit'] ) ) : ?>
<div id="message" class="updated fade"><p><strong><?php _e('NameTag Options saved.') ?></strong></p></div>
<?php endif; ?>
<div class="wrap">
    <h2><a href="http://affiliates.my-vbtools.com/idevaffiliate.php?id=102_0_1_9" target="_blank"><img src="http://nametag.my-vbtools.com/images/loginLogo.png"></a> <?php _e("Configuration",'NameTag'); ?></h2>
    <div class="postbox-container" style="width: 600px;">
        <div class="metabox-holder">	
            <div class="meta-box-sortables">
                <form action="" method="post" id="nametag">
                    <div id="nametag_credentials" class="postbox">
						<h3 class="hndle"><span>NameTag Settings</span></h3>
						<div class="inside" style="padding:15px">
                        <?php 
							$error = 0;
							if (strlen(get_option('dknt_apikey'))<1) { $error = $error + 1; }
							if (strlen(get_option('dknt_tracking'))<1) { $error = $error + 2; }
							
							if ($error > 0) {
								echo "<p><center><a href=\"http://mkt.gs/gD0d2H\" target=\"_blank\"><img border=\"0\" src=\"http://affiliates.my-vbtools.com/banners/nametag_ad_300X2503.jpg\" width=\"300\" height=\"250\" alt=\"NameTag : Visitor Tracking Analytics\"></a></center></p>";
							}
							
							switch($error) {
								case 1:
									echo "<p><span style=\"color:red; font-weight:bold\">If you do not have a NameTag Account, sign up at <a href=\"http://mkt.gs/gy0qXX\" target=\"_blank\">vb Tools</a>. If you do, your NameTag API Key can be found in your <a href=\"http://nametag.my-vbtools.com/settings.php\" target=\"_blank\">NameTag settings</a>.</span></p>";
									break;
								case 2:
									echo "<p><span style=\"color:red; font-weight:bold\">If you do not have a NameTag Account, sign up at <a href=\"http://mkt.gs/gy0qXX\" target=\"_blank\">vb Tools</a>. If you do, your NameTag Tracking Embed script can be found in your <a href=\"http://nametag.my-vbtools.com/settings.php\" target=\"_blank\">NameTag settings</a>.</span></p>";
									break;
								case 3:
									echo "<p><span style=\"color:red; font-weight:bold\">If you do not have a NameTag Account, sign up at <a href=\"http://mkt.gs/gy0qXX\" target=\"_blank\">vb Tools</a>. Once you have an account, you can find your API Key and Tracking Embed script in your <a href=\"http://nametag.my-vbtools.com/settings.php\" target=\"_blank\">NameTag settings</a>.</span></p>";
									break;
							} ?>
							
                        	<p><label style="width:100px;text-align:right; float:left; display:block">API Key:</label>&nbsp;<input id="dknt_apikey" name="dknt_apikey" type="text" value="<?php echo stripslashes($dknt_apikey); ?>" /></p>
                        	<p><label style="width:100px;text-align:right; float:left; display:block">Tracking Embed:</label>&nbsp;<textarea cols="50" rows="4" id="dknt_tracking" name="dknt_tracking"><?php echo stripslashes($dknt_tracking); ?></textarea></p>
						</div>
					</div>
                    <div class="submit" style="text-align:right">
                    <input type="hidden" name="stage" id="stage" value="process" /> 
                    <input type="submit" class="button-primary" name="submit" value="<?php _e("Update NameTag Settings", 'dknt'); ?> &raquo;" />
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php include('vb_sidebar.php'); ?>