<?php
	$response = $mysqli -> query('SELECT * FROM ' . PASTE_MYSQL_TABLES_PREFIX . 'pastes WHERE id="' . $_GET['p'] . '"');
	if(empty($response)) {
		die('<div class="alert alert-danger" role="alert">' . get_text('PASTE_NOPASTE') . '</div>' . PHP_EOL . '</body>' . PHP_EOL . '</html>');
	}
	$data = $response -> fetch_assoc();
	if($data == null || !array_key_exists('id', $data) || !array_key_exists('name', $data) || !array_key_exists('language', $data) || !array_key_exists('author', $data) || !array_key_exists('paste', $data)) {
		die('<div class="alert alert-danger" role="alert">' . get_text('PASTE_NOPASTE') . '</div>' . PHP_EOL . '</body>' . PHP_EOL . '</html>');
	}
	$current_language;
	foreach($languages as $language) {
		if($language[1] == $data['language']) {
			$current_language = $language[0];
		}
	}
	$link = PASTE_PATH . htmlspecialchars($data['id']);
?>
<div class="container page-header">
<h1 id="name"><span class="glyphicon glyphicon-file"></span> <?=htmlspecialchars($data['name'])?></h1>
</div>
<div class="container form-vertical well">
<?='<strong>' . get_text('PASTE_LANGUAGE') . '</strong> : ' . (isset($current_language) ? $current_language : get_text('PASTE_LANGUAGE_PLAINTEXT')) . PHP_EOL?>
<?='<br /><strong>' . get_text('PASTE_AUTHOR') . '</strong> : <a href="' . PASTE_PATH . '?history=' . htmlspecialchars($data['author']) . '">' . htmlspecialchars($data['author']) . '</a>' . PHP_EOL?>
<div id="editor" class="form-control" language="<?=htmlspecialchars($data['language'])?>"><?=htmlspecialchars($data['paste'])?></div>
<span id="raw-text">[<a id="raw-link" href="<?=$link . '?raw'?>"><?=get_text('PASTE_RAW')?></a>]</span>
<?='<strong>' . get_text('PASTE_LINK') . '</strong> : ' . $link . PHP_EOL?>
<br /><img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=<?=$link?>&bgcolor=F5F5F5" alt="QR Code">
</div>
<script src="scripts/ace/ace.js"></script>
<script src="scripts/paste.js"></script>