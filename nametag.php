<?php
/*
Plugin Name: NameTag
Plugin URI: http://marketingtechblog.com/projects/nametag/
Description: A plugin for integrating <a href="http://affiliates.my-vbtools.com/idevaffiliate.php?id=102" target="_blank">NameTag</a> with your WordPress blog.
Version: 1.0.4
Author: Douglas Karr
Author URI: http://www.dknewmedia.com/
*/

load_plugin_textdomain('dknt', $path = 'wp-content/plugins/nametag');

define('NAMETAG_COMPATIBLE', version_compare(phpversion(), '5', '>='));
if (!NAMETAG_COMPATIBLE) {
	trigger_error('NameTag requires PHP 5 or greater.', E_USER_ERROR);
}

function dknt_addnametag() {
	if (function_exists('add_menu_page')) {
		$page = add_submenu_page('index.php', __('NameTag'), __('NameTag'), '0', 'nametag', 'dknt_addnametag_page');
		add_action('admin_print_scripts-'.$page, 'dknt_javascript');
	}
	if (function_exists('add_options_page')) {
		$settings = add_options_page('NameTag', 'NameTag', 'administrator', __FILE__, 'dknt_addnametagadmin_page');
		add_action('admin_print_scripts-'.$settings, 'dknt_javascript');
    }
}

function dknt_addnametagadmin_page() {
    include(dirname(__FILE__).'/admin.php');
}

function dknt_addnametag_page() {
    include(dirname(__FILE__).'/data.php');
}

function dknt_code() {
	$dknt_tracking = get_option('dknt_tracking');
	$dknt_tracking = stripslashes($dknt_tracking);
	echo stripslashes($dknt_tracking)."\n";
}

function dkntRequest($apikey, $url) {
	// create a new cURL resource
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "api_key=".$apikey);
	$output = curl_exec($ch);
	return $output;
}

function dknt_admin_init() {
	wp_register_script('dknt_jqry', path_join(WP_PLUGIN_URL, basename( dirname( __FILE__ ) ). '/js/jquery.js'));
}
	
function dknt_javascript() {
	$canvasie = path_join(WP_PLUGIN_URL, basename( dirname( __FILE__ ) )."/js/excanvas.min.js");
	wp_enqueue_script( 'dknt_jqry' );

	echo "<style type='text/css'>\n";
	echo "</style>";
}

function dknt_getpage() {
	$dknt_apikey = stripslashes(get_option('dknt_apikey'));
	$dknt_apiurl = "http://nametag.my-vbtools.com/api/select/latest:25:company/all/json";
	
	$response = dkntRequest($dknt_apikey, $dknt_apiurl);
	$obj = json_decode($response, true);
	
	$array = $obj['history'];

	echo "<ol id=\"nametag\">";
	foreach ($array as $key => $value) {
		echo "<li><a href=\"#\" class=\"show\">".$value['company']."</a>";
		echo "<p>";
		echo "<strong>Visited:</strong> ".$value['time']."<br />";
		echo "<strong>Address:</strong> ".$value['company_address']."<br />";
		echo "<strong>Referred From:</strong> <a href=\"".$value['referrer']."\" title=\"".$value['referrer']."\" target=\"_blank\">Link</a><br />";
		if($value['keywords']) {
			echo "<strong>Keywords:</strong> <span style=\"background:yellow\">";
			echo $value['keywords'];
			echo "</span><br />";
		}
		echo "<strong>Pages Visited:</strong> ";
		$i = 1;
		$array2 = $value['pages'];
		foreach ($array2 as $key2 => $value2) {
			echo "<a href=\"".$value2."\" title=\"".$value2."\" target=\"_blank\">".$i."</a> ";
			$i = $i + 1;
		}
		echo "</p></li>";
	}
	echo "</ol>";
	
  	die;
}

function dknt_gettwitter() {
	$rss = fetch_feed('http://twitter.com/statuses/user_timeline/17474151.rss');
	$maxitems = $rss->get_item_quantity(3); 
	$rss_items = $rss->get_items(0, $maxitems); 
	echo "<ul style='list-style:square; margin-left: 20px'>";
	foreach ( $rss_items as $item ) :
		$title = $item->get_title();
		if (substr($title,0,5)!="links") {
			echo "<li>Visual Blaze: ";
			echo substr($title,13,150);
			echo " <a href='".$item->get_permalink()."' title='".$title."' target='_blank'>read&nbsp;&raquo;</a>";
			echo "</li>";
	} endforeach;
	echo "</ul>";
	die;
}

function dknt_getblog() {
	$rss = fetch_feed('http://www.getvisualblaze.com/blog/?feed=rss2');
	$maxitems = $rss->get_item_quantity(4); 
	$rss_items = $rss->get_items(0, $maxitems); 
	echo "<ul style='list-style:square; margin-left: 20px'>";
	foreach ( $rss_items as $item ) :
		$title = $item->get_title();
		if (substr($title,0,5)!="links") {
		echo "<li>";
		echo $title;
		echo " <a href='".$item->get_permalink()."' title='".$title."' target='_blank'>read&nbsp;&raquo;</a>";
		echo "</li>";
	 } endforeach;
	echo "</ul>";
	die;
}

function dknt_getblog2() {
	$rss = fetch_feed('http://www.marketingtechblog.com/feed/');
	$maxitems = $rss->get_item_quantity(4); 
	$rss_items = $rss->get_items(0, $maxitems); 
	echo "<ul style='list-style:square; margin-left: 20px'>";
	foreach ( $rss_items as $item ) :
		$title = $item->get_title();
		if (substr($title,0,5)!="links") {
		echo "<li>";
		echo $title;
		echo " <a href='".$item->get_permalink()."' title='".$title."' target='_blank'>read&nbsp;&raquo;</a>";
		echo "</li>";
	 } endforeach;
	echo "</ul>";
	die;
}

add_action('admin_init', 'dknt_admin_init');
add_action('admin_menu', 'dknt_addnametag');
add_action('wp_footer','dknt_code',90);
add_action('wp_ajax_dknt_getpage', 'dknt_getpage' );
add_action('wp_ajax_dknt_gettwitter', 'dknt_gettwitter' );
add_action('wp_ajax_dknt_getblog', 'dknt_getblog' );
add_action('wp_ajax_dknt_getblog2', 'dknt_getblog2' );
add_action('admin_header', 'dknt_javascript');
?>