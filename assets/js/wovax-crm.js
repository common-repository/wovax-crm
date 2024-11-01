jQuery(document).ready(function($) {

	$(document).on('click', '.wovax-crm-form-submit', function(event) {
		event.preventDefault();
		form = $(this).closest('form.wovax-contact-form');
		formValidate = form.get(0);
		if(formValidate.reportValidity()) {
			$('.wovax-crm-form-submit').prop('disabled', true);
			formdata = form.serializeArray();

			data = {
				data: formdata,
				nonce: wovaxcrm.ajaxnonce,
				action: 'wovax_crm_contact_submit'
			};

			$.post(wovaxcrm.ajaxurl, data, function(response) {
				if(response.length > 0) {
					$('.wovax-crm-form-submit').prop('disabled', false);
					console.log(response);
					window.alert('Form submitted');
					form.trigger('reset');
				}
			});
		} else {
			formValidate.submit();
		}

	});
});
