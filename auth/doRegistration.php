<?php ob_start(); ?>
	<div>
		<div style = "display: flex">
			<div><strong>Ваше имя:</strong></div>
			<div><?= $_POST['login']; ?></div>
		</div>
		<div style = "display: flex">
			<div><strong>Ваш пароль:</strong></div>
			<div><?= $_POST['pass']; ?></div>
		</div>
		<div style = "display: flex">
			<div><strong>Ваш повторный пароль:</strong></div>
			<div><?= $_POST['repass']; ?></div>
		</div>
	</div>
<?php
$content = ob_get_contents();
ob_end_clean();
require '../layout/main.php';