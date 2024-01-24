<?php
	ob_start(); ?>
		<div>
			<form action = "/do_login" method = "post">
				<input type = "text" name = "login" placeholder = "введите имя"/>
				<input type = "password" name = "pass" placeholder = "введите пароль"/>
				<input type = "submit" value = "Войти"/>
				<a href = "#" onclick = "Base.Request.sendForm(this.closest('form'), () => { window.location.href = '/' }); return false;">Отправить запрос</a>
			</form>
		</div>
<?php
	\Base\Layout::$content = ob_get_contents();
	ob_end_clean();