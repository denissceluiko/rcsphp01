<?php
    // session_start();

    $person = [];

    if (isset($_COOKIE['person'])) {
        $person = json_decode($_COOKIE['person'], true);
    }

    if (!empty($_POST['name'])) {
        $person['name'] = $_POST['name'];
    }

    if (!empty($_POST['surname'])) {
        $person['surname'] = $_POST['surname'];
    }

    setcookie('person', json_encode($person));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 02</title>
</head>
<body>
<?php

function hello(string $subject = 'noone', string $suffix = ''): string
{
    return 'hello '.$subject.$suffix;
}

function formatName(array $source): string
{
    if (!isset($source['name'])) {
        $source['name'] = 'unnamed';
    }

    $source['surname'] ??= 'unsurnamed';

    return "{$source['name'][0]}. {$source['surname']}";
}

$filepatharray = explode('/', __FILE__);
$submitPath = array_pop($filepatharray);

?>
    <div>Hello, <?= $person['name'] ?> <?= $person['surname'] ?></div>
    <form action="/<?= $submitPath ?>" method="post">
        <input type="text" name="name" />
        <input type="text" name="surname" />
        <input type="Submit">
    </form>
</body>
</html>