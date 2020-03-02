<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Моя Бухгалтерия</title>
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
                <span class="navbar-text">Главная</span>
            </li>
        </ul>
        <span class="navbar-text">
                <?php echo $_SESSION['user']->getUserName(); ?>
            </span>
        <span class="navbar-text">
                <a class="nav-link" href="/auth/signout">Выйти</a>
            </span>
    </div>
</nav>
</header>
<main>
    <div class="container w-75">
        <div class="text-center">
            <table class="table">
                <tr>
                    <th>Название</th>
                    <th>Описание</th>
                    <th>Сумма</th>
                    <th>Дата и время</th>
                    <th>Действия</th>
                </tr>
            <?php
                foreach($data as $transaction) {
                    ?>
                        <tr style="background-color: <?php echo ($transaction->getMoneyAmount()>0)?'palegreen':'lightcoral'; ?>;">
                            <td><? echo $transaction->getName(); ?></td>
                            <td><? echo $transaction->getDescription(); ?></td>
                            <td><? echo $transaction->getMoneyAmount(); ?></td>
                            <td><? echo $transaction->getDate()->format('H:i:s d.m.Y'); ?></td>
                            <td>
                                <a class="btn btn-dark" href="/transaction/edit?id=<? echo $transaction->getId(); ?>">Редактировать</a>
                                <a class="btn btn-danger" href="/transaction/destroy?id=<? echo $transaction->getId(); ?>">Удалить</a>
                            </td>
                        </tr>
                    <?php
                }
            ?>
            </table>
            <a class="btn btn-dark mt-5 text-center" href="/transaction/create">Добавить новую операцию</a>
        </div>
    </div>
</main>
</body>
</html>