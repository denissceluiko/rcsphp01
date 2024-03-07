<?php

include "App.php";

$app = new App();
$app->handleRequest();

if ($app->showEditForm()) {
    $editPerson = $app->getPerson($_GET['id']);
}

include "layout.php";