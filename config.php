<?php
	/*
		Meta options.
	*/
	
	DEFINE('PASTE_META_DESC', 'Skyost\'s Paste');
	DEFINE('PASTE_META_KEYWORDS', 'skyost, paste');
	DEFINE('PASTE_META_AUTHOR', 'Skyost');
	
	/*
		MySQL options.
	*/
	
	DEFINE('PASTE_MYSQL_HOST', 'localhost');
	DEFINE('PASTE_MYSQL_USERNAME', 'root');
	DEFINE('PASTE_MYSQL_PASSWORD', 'password');
	DEFINE('PASTE_MYSQL_DATABASE', 'database');
	DEFINE('PASTE_MYSQL_TABLES_PREFIX', 'paste_');
	
	/*
		First row : the language's name.
		Second row : the language's file (the path must be valid : "/scripts/ace/mode-language.js").
	*/
	
	$languages = array_map(null,
	array('C / C++', 'C#', 'CSS', 'Groovy', 'HAML', 'HTML', 'INI', 'Java', 'JavaScript', 'JSON', 'Lua', 'MySQL', 'Pascal', 'Perl', 'PHP', 'Python', 'Ruby', 'XML', 'YAML'),
	array('csharp', 'c_cpp', 'css', 'groovy', 'haml', 'html', 'ini', 'java', 'javascript', 'json', 'lua', 'mysql', 'pascal', 'perl', 'php', 'python', 'ruby', 'xml', 'yaml')
	);
	/* DEFINE('PASTE_ADSENSE_AD_CLIENT', 'ca-pub-9142230790374858');
	DEFINE ('PASTE_ADSENSE_AD_SLOT', '7537968122'); */ // Remove the "/*" and the "*/" before the line to enable this option.
	/* DEFINE('PASTE_RECAPTCHA_PUBLICKEY', '6LfYE_kSAAAAAPGe7cBd6uVsCpyQLofDhZ9kuKCv');
	DEFINE('PASTE_RECAPTCHA_PRIVATEKEY', '6LfYE_kSAAAAAPdtg030P6-IXKr-pjp6eePtnfic'); */ // Same here for reCAPTCHA.
	DEFINE('PASTE_PATH', 'http://paste.skyost.eu/'); // Your paste's url.
	
	/*
		Do not touch anything after this line !
	*/
	
	DEFINE('PASTE_VERSION', '0.7.3');
	DEFINE('PASTE_HAS_RECAPTCHA', defined('PASTE_RECAPTCHA_PUBLICKEY') && defined('PASTE_RECAPTCHA_PRIVATEKEY'));
	
	session_start();
	$mysqli = new mysqli(PASTE_MYSQL_HOST, PASTE_MYSQL_USERNAME, PASTE_MYSQL_PASSWORD, PASTE_MYSQL_DATABASE);
	if($mysqli -> connect_errno) {
		die('MySQL Error !');
	}
	$mysqli -> query('CREATE TABLE IF NOT EXISTS ' . PASTE_MYSQL_TABLES_PREFIX . 'pastes (id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, language VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, paste LONGTEXT NOT NULL, PRIMARY KEY(id))');
?>