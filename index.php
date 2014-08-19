<?php
require 'vendor/autoload.php';

$app = new \Slim\Slim();

$boi_json = file_get_contents("boi.json");
$boi = json_decode($boi_json, true);
$items = $boi["items"];

$app->get('/', function () {
    echo "Welcome to the Out of Ink Software API!";
});
$app->get('/boi', function () {
    echo "Welcome to The Binding of Isaac item API!";
});
$app->get('/boi/all/all/compressed', function () {
    global $boi;
    echo json_encode($boi, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
});
$app->get('/boi/all/all', function () {
    global $boi;
    echo "<pre>";
    echo json_encode($boi, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    echo "</pre>";
});
$app->get('/boi/items/all/compressed', function () {
    global $items;
    echo json_encode($items, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
});
$app->get('/boi/items/all', function () {
    global $items;
    echo "<pre>";
    echo json_encode($items, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    echo "</pre>";
});
$app->get('/boi/items', function () use ($app) {
    $app->redirect('/boi/items/all');
});
$app->get('/boi/items/:id', function ($id) {
    global $items;
    $newid = intval($id)-1;
    if ($newid >= 0 and $newid < 198) {
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