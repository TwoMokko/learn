<?php
//	require '../functions.php';
	ob_start(); ?>
		<div>
			<form action = "../../../../index.php" method = "post">
				<input type = "text" name = "login" placeholder = "введите имя"/>
				<input type = "password" name = "pass" placeholder = "введите пароль"/>
				<input type = "password" name = "repass" placeholder = "повторите пароль"/>
				<label><input type = "checkbox" name = "remember" value = "1"/>запомнить</label>
				<input type = "submit" value = "Зарегистрироваться" onclick = "Base.Request.sendForm(this.closest('form'), () => { window.location.href = '/profile' }); return false;"/>
			</form>
		</div>
<?php
	\Section::$content = ob_get_contents();
	ob_end_clean();
//	require '../layouts/default.tpl';