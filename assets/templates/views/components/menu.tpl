<div style="display: flex; padding: 1rem 0; justify-content: center">
    <div><a style="padding: 8px" href="/">Главная</a></div>
    <div><a style="padding: 8px" href="/about">О нас</a></div>
    <div><a style="padding: 8px" href="/contacts">Контакты</a></div>
    <?php if (/*User::checkAuth()*/0) { ?>
        <div><a style="padding: 8px" href="/user/profile">Профиль</a></div>
        <div><a style="padding: 8px" href="/user/logout">Выйти</a></div>
    <?php } else { ?>
        <div><a style="padding: 8px" href="/user/registration">Регистрация</a></div>
        <div><a style="padding: 8px" href="/user/login">Вход</a></div>
    <?php } ?>
</div>