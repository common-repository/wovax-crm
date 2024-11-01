jQuery(document).ready(function($) {
	$(document).on('click', '.wovax-crm-settings-form .wovax-crm-settings-submit', function(event) {
		event.preventDefault();
		$('.wovax-crm-settings-submit').prop('disabled', true);
		api_key = $('#wovax_crm_api_key').val();
		email = $('#wovax_crm_email').val();
		data = {
			data: {
				wovax_crm_api_key: api_key,
				wovax_crm_email: email
			},
			action: 'wovax_crm_settings_save'
		};

		$.post(ajaxurl, data, function(response) {
			if(response.length > 0) {
				$('.wovax-crm-settings-submit').prop('disabled', false);
				console.log(response);
				$('.wovax-crm-save-success').show('');
				$('.wovax-crm-save-success').delay(2000).hide('slow');
			}
		});
	});
});
