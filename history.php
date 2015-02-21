<div class="container page-header">
<h1><span class="glyphicon glyphicon-book"></span> <?=get_text('HISTORY_TITLE')?></h1>
</div>
<?php
	$response = $mysqli -> query('SELECT id, name, author FROM ' . PASTE_MYSQL_TABLES_PREFIX . 'pastes' . (empty($_GET['history']) ? '' : ' WHERE author="' . $_GET['history'] . '"') . ' ORDER BY name');
	if(empty($response)) {
		echo '<div class="container well">' . PHP_EOL . '<b>' . get_text('HISTORY_EMPTY') . '</b>' . PHP_EOL . '</div>' . PHP_EOL;
	}
	else {
		while ($row = $response -> fetch_assoc()) {
			echo '<div class="container well">' . PHP_EOL . '<h2><a href="' . PASTE_PATH . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['name']) . '</a></h2>' . PHP_EOL . get_text('HISTORY_BY') . ' <strong><a href="' . PASTE_PATH . '?history=' . htmlspecialchars($row['author']) . '">' . htmlspecialchars($row['author']) . '</a></strong>.' . PHP_EOL . '</div>' . PHP_EOL;
		}
	}
?>