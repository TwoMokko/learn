<?php
//	require '../functions.php';
	ob_start(); ?>
		<div>О нас</div>
<?php
	\assets\templates\sections\Section::$content = ob_get_contents();
	ob_end_clean();
//	require '../layouts/main.php';