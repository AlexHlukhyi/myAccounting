<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Регистрация</title>
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
                    <span class="navbar-text">Регистрация</span>
                </li>
            </ul>
            <span class="navbar-text">
                <a class="nav-link" href="/login">Авторизоваться</a>
            </span>
        </div>
    </nav>
</header>
<main>
    <div class="container w-25">
        <div class="text-center mt-5">
            <form method="post" action="/signup">
                <div class="form-group">
                    <input class="form-control" type="text" name="username" placeholder="Логин" required>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="email" placeholder="Эл. Почта" required>
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" name="password" placeholder="Пароль" required>
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" name="repeat-password" placeholder="Повторите пароль" required>
                </div>
                <button type="submit" class="btn btn-dark">Зарегистрироваться</button>
            </form>
        </div>
    </div>
</main>
</body>
</html>