<div class="container page-header">
<h1><span class="glyphicon glyphicon-pencil"></span> <?=get_text('FORM_TITLE')?></h1>
</div>
<div class="container form-vertical well">
<form id="new-paste" action="index.php" method="post">
<div class="form-group" id="group-name">
<label><?=get_text('FORM_NAME')?></label>
<input type="text" class="form-control" name="name" id="paste-name" placeholder="<?=get_text('FORM_NAME_PLACEHOLDER')?>">
</div>
<div class="form-group">
<label><?=get_text('FORM_LANGUAGE')?></label>
<br /><select id="language" class="select form-control" name="language">
<option value="plain_text"><?=get_text('FORM_LANGUAGE_PLAINTEXT')?></option>
<option disabled>───────────────────</option>
<?php
	foreach($languages as $language) {
		echo '<option value="' . $language[1] . '">' . $language[0] . '</option>' . PHP_EOL;
	}
?>
</select>
</div>
<div class="form-group" id="group-author">
<label><?=get_text('FORM_AUTHOR')?></label>
<input type="text" class="form-control" name="author" id="paste-author" placeholder="<?=get_text('FORM_AUTHOR_PLACEHOLDER')?>">
</div>
<div class="form-group" id="group-paste">
<label><?=get_text('FORM_PASTE')?></label>
<textarea id="paste" class="form-control hidden" name="paste"></textarea>
<div id="editor" class="form-control"></div>
</div>
<?php
	if(PASTE_HAS_RECAPTCHA) {
		echo '<div id="recaptcha"></div>' . PHP_EOL;
	}
?>
<button id="button-submit" type="submit" class="btn btn-default"><span id="button-glyphicon" class="glyphicon glyphicon-ok"></span> <?=get_text('FORM_SUBMIT')?></button>
</form>
</div>
<div id="modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="false">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title"><?=get_text('FORM_ERROR')?></h4>
</div>
<div class="modal-body">
<span id="modal-text"></span>
</div>
</div>
</div>
</div>
<script src="scripts/ace/ace.js"></script>
<script src="scripts/form.js"></script>
<?php
	if(PASTE_HAS_RECAPTCHA) {
		echo '<script type="text/javascript" src="http://www.google.com/recaptcha/api/js/recaptcha_ajax.js"></script>' . PHP_EOL;
	}
	echo '<script type="text/javascript" src="recaptcha.php?mode=script"></script>';
?>