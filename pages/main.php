<?php
//	require 'functions.php';
	ob_start(); ?>
		<div>Главная</div>
<?php
	\Base\Layout::$content = ob_get_contents();
	ob_end_clean();
//	require 'layout/main.php';
