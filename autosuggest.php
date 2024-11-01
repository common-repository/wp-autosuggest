<?php
/*
Plugin Name: WP AutoSuggest
Plugin URI: http://www.ekhoury.com/wp-autosuggest/
Description: This plugin adds Auto suggest support to your WordPress searchbox!
Version: 0.24
Author: Elie El Khoury and Oskari Rauta
Author URI: http://www.ekhoury.com
*/

include 'autosuggest_functions.php';

$wpas_action = '';
$wpas_keys = '';
if(isset($_GET['wpas_action'])) {
	$wpas_action = $_GET['wpas_action'];
}
if (isset($_GET['wpas_keys'])) {
	$wpas_keys = $_GET['wpas_keys'];
}


if ($wpas_action == 'query') {

	require_once ('../../../wp-config.php');

	header('Content-Type: text/xml');
	echo '<results>';
	
	global $wpdb;
	
	$wpas_keys = str_replace(' ','%',$wpas_keys);
	$pageposts = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE (post_title LIKE '%$wpas_keys%') AND post_status = 'publish' ORDER BY post_date DESC");
	foreach ($pageposts as $post) {
		setup_postdata($post);
		echo "<rs id=\"";
		the_permalink();
		echo "\" info=\"" . autosuggest_excerpt(apply_filters('the_title', get_the_content())) . "\">";
		the_title();
		echo "</rs>";
	}
	echo '</results>';
	die();
}

define('AUTOSUGGEST_DIR', get_option('siteurl') . '/' . PLUGINDIR.'/'.dirname(plugin_basename(__FILE__)));


function add_autosuggest_css() {
	wp_register_style('autosuggestCSS', AUTOSUGGEST_DIR . '/css/wp_autosuggest.css', null, '1', 'screen');
	wp_enqueue_style('autosuggestCSS');
}

function add_autosuggest_js() {
	wp_register_script('autosuggestJS', AUTOSUGGEST_DIR . '/js/wp.autosuggest.js', null, '1');
	wp_enqueue_script('autosuggestJS');
}

function add_autosuggest_footer_code() {
?>
<script type="text/javascript">
var autosuggest_options = {
	script: "<?php echo AUTOSUGGEST_DIR; ?>/autosuggest.php?wpas_action=query&",
	varname: "wpas_keys",
	shownoresults:true,
	noresults:"<?php echo __('No results found.'); ?>",
	timeout:15000,
	callback:autosuggestSelected,
	maxresults: <?php echo get_wpas_option('wpas_maxresults','10'); ?>
};
var as = new AutoSuggest('<?php echo get_wpas_option('wpas_input_id','s'); ?>', autosuggest_options);
function autosuggestSelected(entry) {
    document.location = entry['id'];
}
</script>
<?php
}

function add_autosuggest_settings() {
?>
<div class="wrap">
	
	<?php

		$smsg = "";
		if (isset($_POST['submitoptions'])) {
			if (isset($_POST['wpas_input_id'])) {
				update_option('wpas_input_id',$_POST['wpas_input_id']);
			}
			if (isset($_POST['wpas_maxresults'])) {
				update_option('wpas_maxresults',$_POST['wpas_maxresults']);
			}
			?>

			<div id="message" class="updated fade"><p>WP AutoSuggest settings updated.</p></div>

	<?php } ?>
        
	<h2>WP AutoSuggest Settings</h2>

	<form action="" method="post">
	<table class="form-table">
		<tr valign="top">
		<th scope="row">Search Input ID</th>
		<td>
		<input type="text" value="<?php echo get_wpas_option('wpas_input_id','s'); ?>" id="wpas_input_id" name="wpas_input_id"/><br/>
		Default value is 's' which is used with the default WordPress theme. 
		</td>
		</tr>
		<tr valign="top">
		<th scope="row">Max Results</th>
		<td>
		<input type="text" value="<?php echo get_wpas_option('wpas_maxresults','10'); ?>" id="wpas_maxresults" name="wpas_maxresults"/><br/>
		Maximum number of suggested results (10 by default).
		</td>
		</tr>
	</table>
	<p class="submit"><input type="submit" name="submitoptions" value="Update Settings" /></p>
	</form>
	</div>
<?php
}

function add_autosuggest_menu_settings() {
	if (function_exists('add_options_page')) {
		 add_options_page(
		 	"WP AutoSuggest"
		 	, "WP AutoSuggest"
		 	, 7
		 	, basename(__FILE__)
		 	, 'add_autosuggest_settings');
	}
}

add_action('wp_print_scripts', 'add_autosuggest_js');
add_action('wp_print_styles', 'add_autosuggest_css');
add_action('wp_footer', 'add_autosuggest_footer_code');
add_action('admin_menu', 'add_autosuggest_menu_settings');


?>
