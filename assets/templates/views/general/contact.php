<?php
//	require '../functions.php';
	ob_start(); ?>
		<div>Контакты</div>
<?php
	\Section::$content = ob_get_contents();
	ob_end_clean();
//	require '../layouts/default.tpl';