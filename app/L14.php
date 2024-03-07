<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 01</title>
</head>
<body>
    <form action="/index.php" method="post">
        <input type="text" name="vards" />
        <input type="uzvards" name="uzvards" />
        <input type="Submit">
    </form>
<?php

// $name = empty($_POST['vards']) ? $_POST['vards'] : '';
$name = $_POST['vards'] ?? '';

$number1 = 0;
$number2 = '0';
$number3 = "0";
$value = null;


// $name = $_POST['vards'] ?? '';
$surname = $_POST['uzvards'];
$surname2 = $_POST['uzvards2'];

$output = "Hello, $name $surname";

// if ($name == "Jānis") {
//     $output .= "!";
// } else if ($name == "Anna") {
//     $output .= ".";
// } else {
//     $output .= "?";
// }

switch ($name) {
    case "Jānis":
        $output .= "!";
        break;
    case "Anna":
        $output .= ".";
        break;
    default:
        $output .= "?";
        break;
}


if (empty($_POST['vards'])) {
    $output = "Norādi vārdu";
}

echo($output);

?>
</body>
</html>