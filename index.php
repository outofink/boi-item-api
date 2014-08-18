<?php
require 'vendor/autoload.php';

$app = new \Slim\Slim();

$boi_json = file_get_contents("boi.json");

$boi = json_decode($boi_json, true);
$boi_json_v2 = json_encode($boi, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

$app->get('/', function () {
    echo "Welcome to The Binding of Isaac item API!";
});
$app->get('/boi/items/all/compressed', function () {
    global $boi_json_v2;
    echo $boi_json_v2;
});
$app->get('/boi/items/all', function () {
    global $boi_json_v2;
    echo "<pre>";
    echo $boi_json_v2;
    echo "</pre>";
});
$app->get('/boi/items', function () use ($app) {
    $app->redirect('/boi/items/all');
});
$app->get('/boi/items/:id', function ($id) {
    global $boi;
    $newid = intval($id);
    if ($newid > 0 or $newid > 196) {
        $items = $boi["items"];
        $itembyid = json_encode($items[$newid], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        echo "<pre>";
        echo $itembyid;
        echo "</pre>";
    }
    else {
        echo "Invalid id.";
    }
});
$app->run();