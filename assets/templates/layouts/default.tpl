<?php
//require 'menu.tpl';
?>
<!doctype html>
<html lang = "ru">
<head>
	<meta charset = "UTF-8">
	<meta name = "viewport"
		  content = "width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv = "X-UA-Compatible" content = "ie=edge">
	<title>Learn</title>
	<script src="https://yastatic.net/jquery/3.3.1/jquery.min.js"></script>
	<script src="../js/request.js"></script>
</head>
<body>
    <header><?php Core\Section::show('header') ?></header>
    <main><?php Core\Section::show('content'); ?></main>
</body>
</html>