<?php
require_once '../main/config.php';
require_once '../main/db.php';
require_once '../main/Controller.php';
require_once '../main/Model.php';
require_once 'php/tendersController.php';

$object = new tendersController();
$config = $config['db'];
if (empty($_POST)) {
    $data = $object->getData($config);
} else {
    $method = strval($_POST['action']);
    $data = $_POST['data'];
    $object->$method($config, $data);
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Тендеры</title>
    <link rel="stylesheet" href="../assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="../assets/img/favicon.png" type="image/x-icon">
</head>
<body>

<div class="container">
    <button class="add-tender btn btn-default">Добавить Тендер</button>
    <form action="#" class="hidden add-tender-form">
        <input type="text" name="name" placeholder="Название тендера" class="form-control">
        <input type="hidden" name="date" value="<?=date('Y-m-d')?>">
        <input type="hidden" name="year" value="<?=date('Y')?>">
        <br>
        <textarea name="code" placeholder="Код" class="form-control"></textarea>
        <hr>
        <button type="button" class="cancel btn btn-default">Отмена</button>
        <button type="submit" class=" btn btn-default">Добавить тендер</button>
    </form>
    <hr>
    <table class="table">
        <thead>
        <tr>
            <th>№</th>
            <th>Название</th>
            <th>Дата создания</th>
            <th>Код</th>
            <th>Год</th>
            <th>Изменить</th>
        </tr>
        </thead>
        <tbody>
        <?= $data ?>
        </tbody>
    </table>
</div>


</body>
<script src="../assets/jquery/jquery.min.js"></script>
<script src="../assets/js/main.js"></script>
<script src="js/script.js"></script>
</html>
