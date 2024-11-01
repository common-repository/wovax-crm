<?php

add_action('wp_ajax_wovax_crm_contact_submit','wovax_crm_contact_submit');
add_action('wp_ajax_nopriv_wovax_crm_contact_submit', 'wovax_crm_contact_submit');
function wovax_crm_contact_submit() {
	check_ajax_referer('wovax_crm_security', 'nonce');
	$data = $_POST['data'];
	$formdata = array();
	foreach($data as $value) {
		$name = sanitize_text_field($value['name']);
		if($name === 'email') {
			$input = sanitize_email($value['value']);
		} else if ($name === 'message') {
			$input = sanitize_textarea_field($value['value']);
		} else {
			$input = sanitize_text_field($value['value']);
		}
		$formdata[$name] = $input;
		unset($name);
		unset($input);
	}
	$email_subject = 'Wovax CRM contact form submission from: '.$formdata['first-name']. ' ' . $formdata['last-name'];
	$user_email = get_option('wovax_crm_email');
	$message = print_r($formdata, true);
	wp_mail($user_email,$email_subject,$message);
	echo 'Message sent';
	wp_die();
}

add_action('wp_ajax_wovax_crm_settings_save','wovax_crm_settings_save');
function wovax_crm_settings_save() {
	$data = $_POST['data'];
	$api_key = sanitize_text_field($data['wovax_crm_api_key']);
	$email = sanitize_email($data['wovax_crm_email']);
	update_option('wovax_crm_api_key', $api_key);
	update_option('wovax_crm_email', $email);
	echo 'Options Updated';
	wp_die();
}
