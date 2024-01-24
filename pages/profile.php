<?php
    if (!User::checkAuth()) redirect();

	ob_start(); ?>
		<div>
			Hello
		</div>
<?php
	\Base\Layout::$content = ob_get_contents();
	ob_end_clean();