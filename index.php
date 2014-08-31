<?php
require 'vendor/autoload.php';

$app = new \Slim\Slim();
function pencode($data) {return json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);}
function encode($data) {return json_encode($data, JSON_UNESCAPED_SLASHES);}
function pprinter($data) {echo "<pre>";echo pencode($boi);echo "</pre>";}
function printer($data) {echo "<pre>";echo encode($boi);echo "</pre>";}

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
    printer($boi);
});
$app->get('/boi/all/all', function () {
    pprinter($boi);
});
$app->get('/boi/items/all/compressed', function () {
    global $items;
    printer($items);
});
$app->get('/boi/items/all', function () {
    global $items;
    pprinter($items);
});
$app->get('/boi/items', function () use ($app) {
    $app->redirect('/boi/items/all');
});
$app->get('/boi/all', function () use ($app) {
    $app->redirect('/boi/all/all');
});
$app->get('/boi/items/:id', function ($id) {
    global $items;
    $newid = intval($id)-1;
    if ($newid >= 0 and $newid < 198) {
        pprinter($items[$newid]);
    }
    else {
        echo "Invalid id.";
    }
});
$app->run();