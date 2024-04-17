<?php
	ob_start(); ?>
		<div>
			<form action = "../../../../index.php" method = "post">
				<input type = "text" name = "login" placeholder = "введите имя" value = "qwerty1"/>
				<input type = "password" name = "pass" placeholder = "введите пароль" value = "pass1"/>
				<label><input type = "checkbox" name = "remember" value = "1"/>запомнить</label>
				<input type = "submit" value = "Войти" onclick = "Base.Request.sendForm(this.closest('form'), () => { window.location.href = '/profile' }); return false;"/>
			</form>
		</div>
<?php
	\Section::$content = ob_get_contents();
	ob_end_clean();