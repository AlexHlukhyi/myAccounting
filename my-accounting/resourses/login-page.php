<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Авторизация</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Моя бухгалтерия</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <span class="navbar-text">Авторизация</span>
                </li>
            </ul>
            <span class="navbar-text">
                <a class="nav-link" href="/auth/register">Зарегистрироваться</a>
            </span>
        </div>
    </nav>
</header>
<main>
    <div class="container w-25">
        <div class="text-center mt-5">
            <form method="post" action="/auth/signin">
                <div class="form-group">
                    <input class="form-control" type="text" name="login" placeholder="Эл. Почта или Логин" required>
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" name="password" placeholder="Пароль" required>
                </div>
                <button type="submit" class="btn btn-dark">Войти</button>
            </form
        </div>
    </div>
</main>
</body>
</html>