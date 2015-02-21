var editor;
var name;

$(document).ready(function() {
	name = $('#name').text().substring(1);
	document.title = name;
	editor = ace.edit('editor');
	editor.setTheme('ace/theme/chrome');
	editor.setReadOnly(true);
	editor.getSession().setMode('ace/mode/' + $('#editor').attr('language'));
});