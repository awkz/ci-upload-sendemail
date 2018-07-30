<!DOCTYPE html>
<html>
<head>
	<title>Email Form</title>
</head>
<body>
	<?php
		if (isset($message_display)) {
		echo $message_display;
	}
	?>
	<?= form_open_multipart('email/send_email_with_file'); ?>
		<div class="form-group">
			<label>To</label>
			<input type="email" name="to">
		</div>
		<div class="form-group">
			<label>Subject</label>
			<input type="text" name="subject">
		</div>
		<div class="form-group">
			<label>Message</label>
			<textarea name="message"></textarea>
		</div>
		<div class="form-group">
			<label>File attach</label>
			<input type="file" name="file"/>
		</div>
		<button type="submit">Kirim</button>
	<?= form_close(); ?>
</body>
</html>