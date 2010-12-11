<?php 
/*
Author: Douglas Karr
Author URI: http://www.dknewmedia.com
Description: Visual Blaze NameTag Sidebar
*/

?>
<div class="postbox-container" style="width:35%; margin-left: 10px">
        <div class="metabox-holder">	
            <div class="meta-box-sortables">
                <div id="a" class="postbox">
					<h3 class="hndle"><span style="background: url(<?php echo $site_url; ?>/wp-content/plugins/nametag/images/w.png) no-repeat; padding: 0 0 10px 25px;">Visual Blaze Blog</span></h3>
					<div class="inside" style="padding: 10px;">
						<div id="blog1" style="min-height:80px"><img src="<?php echo $site_url; ?>/wp-content/plugins/nametag/images/load.gif" style="margin: 20px 0 0 120px;"></div>
						<script id="page" language="javascript" type="text/javascript">
                        $.post(ajaxurl, { action: "dknt_getblog" }, function(response) {
                                $("#blog1").html(response).fadeIn();
                        }, "text");
                        </script>
                        <p style="height:16px"><a href="http://www.getvisualblaze.com/blog/?feed=rss2" target="_blank" style="background: url(<?php echo $site_url; ?>/wp-content/plugins/nametag/images/feed.png) no-repeat; padding: 0 0 10px 25px;">Subscribe to the Visual Blaze Blog</a></p>
                	</div>
				</div>
                <div id="b" class="postbox">
					<h3 class="hndle"><span style="background: url(<?php echo $site_url; ?>/wp-content/plugins/nametag/images/twitter.gif) no-repeat; padding: 0 0 10px 25px;">Visual Blaze on Twitter</span></h3>
					<div class="inside" style="padding: 10px;">
						<div id="twitter1" style="min-height:80px"><img src="<?php echo $site_url; ?>/wp-content/plugins/nametag/images/load.gif" style="margin: 20px 0 0 120px;"></div>
						<script id="page" language="javascript" type="text/javascript">
                        $.post(ajaxurl, { action: "dknt_gettwitter" }, function(response) {
                                $("#twitter1").html(response).fadeIn();
                        }, "text");
                        </script>
                   	</div>
				</div>
				<div id="c" class="postbox">
					<h3 class="hndle"><span style="background: url(<?php echo $site_url; ?>/wp-content/plugins/nametag/images/w.png) no-repeat; padding: 0 0 10px 25px;">Marketing Technology Blog</span></h3>
					<div class="inside" style="padding: 10px;">
						<div id="blog2" style="min-height:80px"><img src="<?php echo $site_url; ?>/wp-content/plugins/nametag/images/load.gif" style="margin: 20px 0 0 120px;"></div>
						<script id="page" language="javascript" type="text/javascript">
                        $.post(ajaxurl, { action: "dknt_getblog2" }, function(response) {
                                $("#blog2").html(response).fadeIn();
                        }, "text");
                        </script>
                        <p style="height:16px"><a href="http://www.marketingtechblog.com/feed/" target="_blank" style="background: url(<?php echo $site_url; ?>/wp-content/plugins/nametag/images/feed.png) no-repeat; padding: 0 0 10px 25px;">Subscribe to the Marketing Technology Blog</a></p>
                	</div>
				</div>
                <div id="author" style="text-align: center; font-size: 10px">Developed by <a href="http://www.dknewmedia.com">DK New Media, LLC</a></div>
            </div>
        </div>
    </div>
</div>