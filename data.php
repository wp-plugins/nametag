<?php 
/*
Author: Douglas Karr
Author URI: http://www.dknewmedia.com
Description: Visual Blaze NameTag Data
*/

$site_url = get_settings('siteurl');
$dknt_pluginurl = $site_url."/wp-admin/options-general.php?page=nametag/nametag.php";

?>
<div class="wrap">
    <h2><a href="http://affiliates.my-vbtools.com/idevaffiliate.php?id=102_0_1_9" target="_blank"><img src="http://nametag.my-vbtools.com/images/loginLogo.png"></a> <?php _e("Data",'NameTag'); ?></h2>
    <div class="postbox-container" style="width:500px;">
        <div class="metabox-holder">	
            <div class="meta-box-sortables">
                <div id="nametag_credentials" class="postbox">
                    <h3 class="hndle"><span>NameTag Latest 25 Companies</span></h3>
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
									echo "<p><span style=\"color:red; font-weight:bold\">You must fill in the NameTag API Key in the <a href=\"".$dknt_pluginurl."\">NameTag Options</a>.</span></p>";
									break;
								case 2:
									echo "<p><span style=\"color:red; font-weight:bold\">You must fill in the NameTag Tracking Embed script in the <a href=\"".$dknt_pluginurl."\">NameTag Options</a>.</span></p>";
									break;
								case 3:
									echo "<p><span style=\"color:red; font-weight:bold\">You must fill in the NameTag API Key and Tracking Embed script in the <a href=\"".$dknt_pluginurl."\">NameTag Options</a>.</span></p>";
									break;
							
							} 
							
							if ($error == 0) { ?>
                	<div id="pagedata" style="width:565px;min-height:500px"><img src="<?php echo $site_url; ?>/wp-content/plugins/nametag/images/load.gif" style="margin: 50px 0 0 200px;"></div>
                    <script id="page" language="javascript" type="text/javascript">
                    $.post(ajaxurl, { action: "dknt_getpage" }, function(response) {
							$("#pagedata").html(response).fadeIn();
							$("#nametag p").hide(); 
							$("#nametag a.show").click(function() { $(this).next("#nametag p").slideToggle('normal'); return false; });
					}, "text");					
                    </script>
                	<?php } ?>
                </div>
                </div>
            </div>
        </div>
    </div>
<?php include('vb_sidebar.php'); ?>