<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Редактировать запись</title>
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
                    <span class="navbar-text">Редактирование</span>
                </li>
            </ul>
            <span class="navbar-text">
                <?php echo $_SESSION['user']->getUserName(); ?>
            </span>
            <span class="navbar-text">
                <a class="nav-link" href="signout">Выйти</a>
            </span>
        </div>
    </nav>
</header>
<main>
    <div class="container w-50">
        <div class="text-center mt-5">
            <form method="post" action="update?id=<? echo $data->getId(); ?>">
                <div class="form-group">
                    <input class="form-control"  type="text" name="name" placeholder="Название" value="<? echo $data->getName(); ?>">
                </div>
                <div class="form-group">
                    <input class="form-control"  type="text" name="description" placeholder="Описание" value="<? echo $data->getDescription(); ?>">
                </div>
                <div class="form-group">
                    <input class="form-control"  type="text" name="moneyAmount" placeholder="Сумма" value="<? echo $data->getMoneyAmount(); ?>">
                    <small class="form-text text-muted">Если эта операция убыточна - поставьте знак '-' перед суммой.</small>
                </div>
                <div class="form-group text-left">
                    <label for="time">Время операции:</label>
                    <input class="form-control w-25"  type="time" name="time" step="1" value="<? echo $data->getDate()->format('H:i:s'); ?>">
                </div>
                <div class="form-group text-left">
                    <label for="date">Дата операции:</label>
                    <input class="form-control w-25"  type="date" name="date" value="<? echo $data->getDate()->format('Y-m-d'); ?>">
                </div>
                <button type="submit" class="btn btn-dark">Редактировать</button>
            </form>
            <a class="btn btn-sm btn-dark text-light mt-5" href="index">На главную</a>
        </div>
    </div>
</main>
</body>
</html>