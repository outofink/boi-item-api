<?php
require 'vendor/autoload.php';

$app = new \Slim\Slim();
$boi_json = file_get_contents("boi.json");
$app->get('/hello/:name', function ($name) {
    echo "Hello, $name!";
});

$app->get('/', function () {
    echo "Hello!";
});
$app->get('/boi/allitems/compressed', function () {
    echo $boi_json;
});
$app->get('/boi/allitems', function () {
    echo nl2br($boi_json);
});
$app->run();