<?php
?>
<div class="wrap">
	<h2>Settings</h2>
	<div class="notice notice-success wovax-crm-save-success" hidden><p>Settings Saved!</p></div>
	<form class="wovax-crm-settings-form" enctype="multipart/form-data" action="" method="POST">
		<table class='form-table'>
			<tr>
				<th>
					<strong><label for="wovax_crm_api_key">Wovax CRM API Key</label></strong>
				</th>
				<td>
					<input type='text' name='wovax_crm_api_key' id='wovax_crm_api_key' value=<?php echo "'" . esc_html(get_option("wovax_crm_api_key")) . "'"; ?>>
				</td>
			</tr>
			<tr>
				<th>
					<strong><label for="wovax_crm_email">CRM Contact Form Email Address</label></strong>
				</th>
				<td>
					<input type='email' name='wovax_crm_email' id='wovax_crm_email' value=<?php echo "'" . esc_html(get_option("wovax_crm_email")) . "'"; ?>>
				</td>
			</tr>
		</table>
		<input type='submit' class='button button-primary wovax-crm-settings-submit' value='Save'>
	</form>
</div>
