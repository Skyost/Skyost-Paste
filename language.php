<?php
	if(isset($_POST['id']) && !empty($_POST['id'])) {
		echo get_text($_POST['id']);
	}
	
	function get_text($id){
		static $lang = array(
			'NAME' => 'Skyost\'s Paste',
			'HEADER_HOME' => 'Home',
			'HEADER_HISTORY' => 'History',
			'FOOTER' => 'Version %v - By <a href="http://www.skyost.eu">Skyost</a>',
			'FORM_TITLE' => 'Create a new paste',
			'FORM_NAME' => 'Name of the paste',
			'FORM_NAME_PLACEHOLDER' => 'Name',
			'FORM_LANGUAGE' => 'Language',
			'FORM_LANGUAGE_PLAINTEXT' => 'Plain Text',
			'FORM_AUTHOR' => 'Author of the paste',
			'FORM_AUTHOR_PLACEHOLDER' => 'Author',
			'FORM_PASTE' => 'Paste',
			'FORM_SUBMIT' => 'Submit',
			'FORM_ERROR' => 'Error',
			'FORM_ERROR_CAPTCHA' => 'Wrong captcha !',
			'FORM_ERROR_NOPASTE' => 'You must enter something in your paste !',
			'FORM_ERROR_SPAMS' => 'Due to spams, the author\'s name must not be equal to the paste\'s name.',
			'FORM_UNTITLED' => 'Untitled',
			'FORM_ANONYMOUS' => 'Anonymous',
			'PASTE_NOPASTE' => 'Nothing exists for the selected id.',
			'PASTE_LANGUAGE' => 'Language',
			'PASTE_LANGUAGE_PLAINTEXT' => 'None',
			'PASTE_AUTHOR' => 'Author',
			'PASTE_RAW' => 'RAW',
			'PASTE_LINK' => 'Link',
			'HISTORY_TITLE' => 'History',
			'HISTORY_EMPTY' => 'Nothing here !',
			'HISTORY_BY' => 'By'
		);
		return array_key_exists($id, $lang) ? $lang[$id] : 'This ID does not exists !';
	}
?>