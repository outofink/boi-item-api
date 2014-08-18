<?php
require 'vendor/autoload.php';

$app = new \Slim\Slim();

$app->get('/hello/:name', function ($name) {
    echo "Hello, $name!";
});

$app->get('/', function () {
    echo "Hello!";
});
$app->get('/boi/allitems', function () {
    $boi_json = file_get_contents("boi.json");
    echo $boi_json;
});
$app->run();