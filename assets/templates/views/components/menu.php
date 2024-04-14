<?php

use assets\models\User;

ob_start(); ?>
	<div style="display: flex; padding: 1rem 0; justify-content: center">
		<div><a style="padding: 8px" href="/">Главная</a></div>
		<div><a style="padding: 8px" href="../../../../index.php">О нас</a></div>
		<div><a style="padding: 8px" href="../../../../index.php">Контакты</a></div>
		<?php if (User::checkAuth()) { ?>
			<div><a style="padding: 8px" href="../../../../index.php">Профиль</a></div>
			<div><a style="padding: 8px" href="../../../../index.php">Выйти</a></div>
		<?php } else { ?>
			<div><a style="padding: 8px" href="../../../../index.php">Регистрация</a></div>
			<div><a style="padding: 8px" href="../../../../index.php">Вход</a></div>
		<?php } ?>
	</div>
<?php
	\assets\templates\sections\Section::$menu = ob_get_contents();
	ob_end_clean();
