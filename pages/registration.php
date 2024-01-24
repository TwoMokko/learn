<?php
//	require '../functions.php';
	ob_start(); ?>
		<div>
			<form action = "/do_registration" method = "post">
				<input type = "text" name = "login" placeholder = "введите имя"/>
				<input type = "password" name = "pass" placeholder = "введите пароль"/>
				<input type = "password" name = "repass" placeholder = "повторите пароль"/>
				<input type = "submit" value = "Зарегистрироваться"/>
			</form>
		</div>
<?php
	\Base\Layout::$content = ob_get_contents();
	ob_end_clean();
//	require '../layout/main.php';