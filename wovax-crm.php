<?php
/*
Plugin Name: Wovax CRM
Plugin URI: https://wovax.com/crm/
Description: Wovax CRM for WordPress allows you to collect website visitor information and send it to the Wovax CRM dashboard at https://crm.wovax.com/ an active subscription to Wovax CRM is required.
Version: 0.0.2
Author: Wovax, LLC.
Author URI: https://wovax.com/
License: GPLv2 or later
*/

if (!defined('ABSPATH')) exit;

//includes
require_once plugin_dir_path(__FILE__) . "/shortcodes/contact-form.php";
require_once plugin_dir_path(__FILE__) . "ajax-functions.php";

//Admin menu setup
add_action('admin_menu', 'wovax_crm_menu');

function wovax_crm_menu() {
	$wovax_icon_svg = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB3aWR0aD0iMjRweCIgaGVpZ2h0PSIyNHB4IiB2aWV3Qm94PSIwIDAgMjQgMjQiIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+CiAgICA8IS0tIEdlbmVyYXRvcjogU2tldGNoIDU4ICg4NDY2MykgLSBodHRwczovL3NrZXRjaC5jb20gLS0+CiAgICA8dGl0bGU+QXJ0Ym9hcmQ8L3RpdGxlPgogICAgPGRlc2M+Q3JlYXRlZCB3aXRoIFNrZXRjaC48L2Rlc2M+CiAgICA8ZyBpZD0iQXJ0Ym9hcmQiIHN0cm9rZT0ibm9uZSIgc3Ryb2tlLXdpZHRoPSIxIiBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGZvbnQtZmFtaWx5PSJIZWx2ZXRpY2FOZXVlLUJvbGQsIEhlbHZldGljYSBOZXVlIiBmb250LXNpemU9IjI5IiBmb250LXdlaWdodD0iYm9sZCIgbGV0dGVyLXNwYWNpbmc9Ii0wLjAyOTQ4NzIiPgogICAgICAgIDx0ZXh0IGlkPSJ3IiBmaWxsPSIjMDAwMDAwIj4KICAgICAgICAgICAgPHRzcGFuIHg9IjAuMjExNzQzNiIgeT0iMTkuNSI+dzwvdHNwYW4+CiAgICAgICAgPC90ZXh0PgogICAgPC9nPgo8L3N2Zz4=';
		// $page_title, $menu_title, $capability, $menu_slug, $function = '', $icon_url = '', $position = null
		add_menu_page('Wovax CRM', 'Wovax CRM', 'manage_options', 'wovax_crm_settings', '', $wovax_icon_svg, '25.00000000000001');
		// $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function = ''
		$settings_hook = add_submenu_page('wovax_crm_settings', 'Wovax CRM Settings', 'Settings', 'manage_options', 'wovax_crm_settings', 'wovax_crm_settings');
  }

function wovax_crm_settings() {
	require plugin_dir_path(__FILE__) . "/admin/pages/settings.php";
}

function wovax_crm_connections() {
	require plugin_dir_path(__FILE__) . "/admin/pages/connections.php";
}

add_action( 'wp_enqueue_scripts', 'wovax_crm_scripts' );
add_action('wp_enqueue_scripts', 'wovax_crm_styles');
add_action( 'admin_enqueue_scripts', 'wovax_crm_admin_scripts');

function wovax_crm_scripts() {
  wp_enqueue_script( 'wovax-crm-js', plugin_dir_url(__FILE__).'/assets/js/wovax-crm.min.js', array('jquery'), null, true );
  $variables = array(
	  'ajaxurl' => admin_url( 'admin-ajax.php' ),
	  'ajaxnonce' => wp_create_nonce('wovax_crm_security')
  );
  wp_localize_script('wovax-crm-js', "wovaxcrm", $variables);
}

function wovax_crm_styles() {
	wp_enqueue_style('wovax_crm_min_stylesheet', plugins_url('assets/css/wovax-crm.min.css', __FILE__));
}


function wovax_crm_admin_scripts() {
	if(isset($_GET['page']) && $_GET['page'] == 'wovax_crm_settings') {
		wp_enqueue_script( 'admin', plugin_dir_url(__FILE__).'/assets/js/admin.min.js', array('jquery'), null, true );
	}
}

add_shortcode('wovax-crm-contact-form', 'wovax_crm_contact_form');

register_activation_hook(__FILE__, 'wovax_crm_activation');
function wovax_crm_activation() {
  add_option('wovax_crm_api_key','');
  add_option('wovax_crm_email');
}
