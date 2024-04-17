<?php

use assets\models\User;

if (!User::checkAuth()) redirect();

	ob_start(); ?>
		<div>
			Hello
		</div>
<?php
	\Section::$content = ob_get_contents();
	ob_end_clean();