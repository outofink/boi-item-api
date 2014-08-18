<?php
require 'vendor/autoload.php';

$app = new \Slim\Slim();

$boi_json = file_get_contents("boi.json");

$boi = json_decode($boi_json);
$boi_json_v2 = json_encode($boi, JSON_PRETTY_PRINT, JSON_UNESCAPED_SLASHES);

$app->get('/hello/:name', function ($name) {
    echo "Hello, $name!";
});

$app->get('/', function () {
    echo "Hello!";
});
$app->get('/boi/allitems/compressed', function () {
    global $boi_json;
    echo $boi_json;
});
$app->get('/boi/allitems', function () {
    global $boi_json_v2;
    echo "<pre>";
    echo $boi_json_v2;
    echo "</pre>";
});

$app->run();