<?php
	ob_start(); ?>
	<div style="display: flex; padding: 1rem 0; justify-content: center">
		<div><a style="padding: 8px" href="/">Главная</a></div>
		<div><a style="padding: 8px" href="/about">О нас</a></div>
		<div><a style="padding: 8px" href="/contact">Контакты</a></div>
		<?php if (User::checkAuth()) { ?>
			<div><a style="padding: 8px" href="/user">Профиль</a></div>
			<div><a style="padding: 8px" href="/do_logout">Выйти</a></div>
		<?php } else { ?>
			<div><a style="padding: 8px" href="/registration">Регистрация</a></div>
			<div><a style="padding: 8px" href="/login">Вход</a></div>
		<?php } ?>
	</div>
<?php
	\Base\Layout::$menu = ob_get_contents();
	ob_end_clean();
