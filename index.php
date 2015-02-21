<?php
	include_once('config.php');
	include_once('language.php');
	if((isset($_GET['p']) && !empty($_GET['p'])) && isset($_GET['raw'])) {
		header("Content-Type: text/plain");
		$content = $mysqli -> query('SELECT paste FROM ' . PASTE_MYSQL_TABLES_PREFIX . 'pastes WHERE id="' . $_GET['p'] . '"') -> fetch_assoc();
		echo $content['paste'];
		die();
	}
	if((isset($_POST['name']) && isset($_POST['language']) && isset($_POST['author']) && isset($_POST['paste'])) && ((!empty($_POST['name']) && !empty($_POST['author'])) || ($_POST['name'] != $_POST['author'])) && (isset($_SESSION['captcha']) && $_SESSION['captcha'])) {
		if(empty($_POST['name']) || trim($_POST['name']) == '') {
			$_POST['name'] = get_text('FORM_UNTITLED');
		}
		else {
			$_POST['name'] = htmlspecialchars($_POST['name']);
		}
		if(empty($_POST['author']) || trim($_POST['author']) == '') {
			$_POST['author'] = get_text('FORM_ANONYMOUS');
		}
		else {
			$_POST['author'] = htmlspecialchars($_POST['author']);
		}
		$id = uniqid(str_replace(' ', '-', strtolower($_POST['author'])) . '-');
		$mysqli -> query('INSERT INTO ' . PASTE_MYSQL_TABLES_PREFIX . 'pastes(id, name, language, author, paste) VALUES("' . $id . '", "' . str_replace('"', '\"', $_POST['name']) . '", "' . $_POST['language'] . '", "' . str_replace('"', '\"', $_POST['author']) . '", "' . str_replace('"', '\"', $_POST['paste']) . '")');
		unset($_SESSION['captcha']);
		header('Location: ' . PASTE_PATH . htmlspecialchars($id));
		die();
	}
?>
<!DOCTYPE html>
<!--Compressed page-->
<html>
<head>
<title><?=get_text('NAME')?></title>
<meta name="description" content="<?=PASTE_META_DESC?>">
<meta name="keywords" content="<?=PASTE_META_KEYWORDS?>">
<meta name="author" content="<?=PASTE_META_AUTHOR?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<link rel="stylesheet" href="css/main.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.js"></script>
<link href="favicon.ico" type="image/x-icon" rel="icon">
<!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/><![endif]-->
</head>
<body>
<div class="navbar navbar-default navbar-static-top" role="navigation">
<div class="container">
<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand"><span class="glyphicon glyphicon-edit"></span> <?=get_text('NAME')?></a>
</div>
<div class="navbar-collapse collapse">
<ul class="nav navbar-nav">
<li><a href="<?=PASTE_PATH?>"><?=get_text('HEADER_HOME')?></a></li>
<li><a href="<?=PASTE_PATH?>?history"><?=get_text('HEADER_HISTORY')?></a></li>
</ul>  
</div>
</div>
</div>
<?php
	if(isset($_GET['history'])) {
		include('history.php');
	}
	else {
		include((isset($_GET['p']) && !empty($_GET['p'])) ? 'paste.php' : 'form.php');
		echo PHP_EOL;
	}
	if(defined('PASTE_ADSENSE_AD_CLIENT') && defined('PASTE_ADSENSE_AD_SLOT')) {
		include('adsense.php');
	}
?>
<footer class="container navbar-fixed-bottom well well-sm center footer">
<?=str_replace('%v', PASTE_VERSION, get_text('FOOTER'));?>
</footer>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>