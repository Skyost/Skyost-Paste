<?php
	include_once('config.php');
	if(isset($_GET['mode']) && $_GET['mode'] == 'script') {
		header('Content-Type: application/javascript');
		if(!PASTE_HAS_RECAPTCHA) {
			$_SESSION['captcha'] = true;
			die('function validateCaptcha(value){captchaValidated = true;}');
		}
		else {
?>
$(document).ready(function() {
	Recaptcha.create('<?=PASTE_RECAPTCHA_PUBLICKEY?>', 'recaptcha', {
		theme: 'clean',
		callback: Recaptcha.focus_response_field
	});
});

function validateCaptcha(value) {
	$.post('recaptcha.php', {
		challenge: Recaptcha.get_challenge(),
		response: Recaptcha.get_response()
	}).done(function(data) {
		if(data) {
			captchaValidated = true;
			$('#new-paste').submit();
		}
		else {
			Recaptcha.reload();
			$('#group-name').removeClass('has-error');
			$('#group-author').removeClass('has-error');
			getAndDisplay('FORM_ERROR_CAPTCHA');
		}
		finish();
	});
}
<?php
		}
	}
	else if(isset($_POST['challenge']) && isset($_POST['response'])) {
		$result = file_get_contents('http://www.google.com/recaptcha/api/verify', false, stream_context_create(array('http' => array(
			'header'  => 'Content-type: application/x-www-form-urlencoded',
			'method'  => 'POST',
			'content' => http_build_query(array('privatekey' => PASTE_RECAPTCHA_PRIVATEKEY, 'remoteip' => $_SERVER['REMOTE_ADDR'], 'challenge' => $_POST['challenge'], 'response' => $_POST['response']))
		))));
		if(strpos($result, 'true') !== false) {
			echo true;
			$_SESSION['captcha'] = true;
		}
		else {
			echo false;
		}
	}
?>