var editor;
var captchaValidated = false;

$(document).ready(function() {
	editor = ace.edit('editor');
	editor.setTheme('ace/theme/chrome');
	changeLanguage();
});

$('#language').change(function() {
	changeLanguage();
});

$('#new-paste').submit(function(event) {
	validateForm();
	if(captchaValidated) {
		$('#paste').val(editor.getValue());
	}
	else {
		event.preventDefault();
	}
});

function validateForm() {
	$('#button-submit').attr('disabled', true);
	$('#button-glyphicon').attr('class', 'glyphicon glyphicon-refresh glyphicon-refresh-animate');
	var value = editor.getValue();
	if(value.length == 0) {
		$('#group-paste').addClass('has-error');
		getAndDisplay('FORM_ERROR_NOPASTE');
		finish();
		return;
	}
	var name = $('#paste-name').val();
	var author = $('#paste-author').val();
	if((name.length == 0 && author.length == 0) || (name == author)) {
		$('#group-paste').removeClass('has-error');
		$('#group-name').addClass('has-error');
		$('#group-author').addClass('has-error');
		getAndDisplay('FORM_ERROR_SPAMS');
		finish();
		return;
	}
	if(!captchaValidated) {
		validateCaptcha(value);
	}
}

function changeLanguage() {
	editor.getSession().setMode('ace/mode/' + $('#language').val());
}

function getAndDisplay(message_id) {
	$.post('language.php', {
		id: message_id
	}).done(function(data) {
		displayMessage(data);
	});
}

function displayMessage(message) {
	$('#modal-text').text(message);
	$('#modal').modal();
}

function finish() {
	$('#button-submit').attr('disabled', false);
	$('#button-glyphicon').attr('class', 'glyphicon glyphicon-ok');
}