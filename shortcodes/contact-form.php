<?php
function wovax_crm_contact_form($atts) {
	$page_title = get_the_title();
	ob_start();
	?>
	<form class="wovax-contact-form" action="" method="post">
		<div class="flex-container">
			<div class="flex-child full-flex wovax-crm-form-element">
				<label>First name
					<input type="text" name="first-name" class="first-name" required>
				</label>
			</div>
			<div class="flex-child full-flex wovax-crm-form-element">
				<label>Last name
					<input type="text" name="last-name" class="last-name" required>
				</label>
			</div>
		</div>
		<div class="flex-container">
			<div class="flex-child full-flex wovax-crm-form-element">
				<label>Email
					<input type="email" name="email" class="email" required>
				</label>
			</div>
			<div class="flex-child full-flex wovax-crm-form-element">
				<label>Phone
					<input type="tel" name="phone" class="phone" required>
				</label>
			</div>
		</div>
		<div class="flex-container">
			<div class="flex-child full-flex wovax-crm-form-element">
				<label>Preferred contact method
					<select name="preferred-contact-method" class="preferred-contact-method" required>
						<option value="call" selected>Call</option>
						<option value="text">Text</option>
						<option value="email">Email</option>
					</select>
				</label>
			</div>
			<div class="flex-child full-flex wovax-crm-form-element">
				<label>Best time of day
					<input type="text" name="best-time-of-day" class="best-time-of-day" required>
				</label>
			</div>
		</div>
		<div class="flex-container">
			<div class="flex-child full-flex wovax-crm-form-message">
				<label>Message
					<textarea name="message" class="message" required></textarea>
				</label>
			</div>
		</div>
		<div class="flex-container full-flex flex-align-self-end">
			<div class="flex-child wovax-crm-form-button">
				<input type="hidden" name="page" class="page" value="<?php echo $page_title; ?>" hidden>
				<input type="submit" name="submit" class="wovax-crm-form-submit">
			</div>
		</div>
	</form>
	<?php
	$results = ob_get_clean();
	return $results;
}
