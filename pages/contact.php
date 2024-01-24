<?php
//	require '../functions.php';
	ob_start(); ?>
		<div>Контакты</div>
<?php
	\Base\Layout::$content = ob_get_contents();
	ob_end_clean();
//	require '../layout/main.php';