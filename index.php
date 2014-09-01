<?php
require 'vendor/autoload.php';

$app = new \Slim\Slim();
function encode($data) {return json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);}
function pprint($json) {echo "<pre>";echo encode($json);echo "</pre>";}

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
    echo encode($boi);
});
$app->get('/boi/all/all', function () {
    global $boi;
    pprint($boi);
});
$app->get('/boi/items/all/compressed', function () {
    global $items;
    echo encode($items);
});
$app->get('/boi/items/all', function () {
    global $items;
    pprint($items);
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
        $itembyid = encode($items[$newid]);
        pprint($itembyid);
    }
    else {
        echo "Invalid id.";
    }
});
$app->run();