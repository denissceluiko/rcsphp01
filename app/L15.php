<?php
    session_start();
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

$food = [
    'fruits' => [
        'apple',
        'pear',
        'banana',
    ],
    'vegetables' => ['potato', 'carrot', 'cabbage'],
    'berries' => ['strawberry', 'blackcurrant', 'watermelon'],
];

if (!empty($_POST['name']) && $_POST['name'] != $_SESSION['name']) {
    $_SESSION['name'] = $_POST['name'];
}

if (!empty($_POST['surname']) && $_POST['surname'] != $_SESSION['surname']) {
    $_SESSION['surname'] = $_POST['surname'];
}

// $_SESSION['fullname'] = "{$person['name'][0]}. {$person['surname']}";

$list = [
    0 => 'apple',
    1 => 'pear',
    2 => 'banana',
];

$value = 'uhfiwhef;iauhweihfa;auwhefiuhesr;iuherifuhe;iuqiuwh';
$values = explode(';', $value);
$imploded = implode('$', $list);

for ($i=1; $i<20; $i+=2) {
    echo($i.' ');
}

echo('<br>');

$j=0;
while ($j<20) {
    echo($j.' ');
    $j++;
}

$j=40;

do {
    echo($j.' ');
    $j++;
} while ($j<20);

foreach ($food as $type => $elements) {
    echo("<br />");
    echo("$type: ");

    foreach($elements as $item) {
        echo("$item, ");
    }

}


?>
    <form action="/L15.php" method="post">
        <input type="text" name="name" />
        <input type="text" name="surname" />
        <input type="Submit">
    </form>
    <table>
        <thead>
            <th>Key</th>
            <th>Value</th>
        </thead>
        <tbody>
            <?php foreach ($food as $type => $elements) { ?>
            <tr>
                <td><?= $type ?></td>
                <td><?= implode(', ', $elements) ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?= $value ?><br />
    <pre><?= print_r($_SESSION) ?></pre><br />
    <?= $imploded ?><br />
    <?= hello(formatName($_SESSION), '!'); ?><br />
</body>
</html>