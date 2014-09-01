<?php
require 'vendor/autoload.php';

$app = new \Slim\Slim();
function encode($data) {return json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);}
function pprint($json) {echo "<pre>";echo encode($json);echo "</pre>";}

$boi_json = file_get_contents("boi.json");
$boi = json_decode($boi_json, true);

$items = $boi["items"];
$trinkets = $boi["trinkets"];
$cards = $boi["cards"];

// $item_names = array_merge(array(), $items);
// foreach ($items_names as &$item) {
//     $item = $item["title"];
// }
// unset($item);

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
$app->get('/boi/trinkets/all/compressed', function () {
    global $trinkets;
    echo encode($trinkets);
});
$app->get('/boi/trinkets/all', function () {
    global $trinkets;
    pprint($trinkets);
});
$app->get('/boi/cards/all/compressed', function () {
    global $cards;
    echo encode($cards);
});
$app->get('/boi/cards/all', function () {
    global $cards;
    pprint($cards);
});
$app->get('/boi/items', function () use ($app) {
    $app->redirect('/boi/items/all');
});
$app->get('/boi/trinkets', function () use ($app) {
    $app->redirect('/boi/trinkets/all');
});
$app->get('/boi/cards', function () use ($app) {
    $app->redirect('/boi/cards/all');
});
$app->get('/boi/all', function () use ($app) {
    $app->redirect('/boi/all/all');
});

$app->get('/boi/items/:id', function ($id){
    global $items;
    global $item_names;
    $newid = intval($id)-1;
    if ($newid >= 0 and $newid < 198) {
        $itembyid = $items[$newid];
        pprint($itembyid);
    }
    else {
        global $items;
        $item_names = $items;
        foreach ((array) $items_names as &$item) {
            $item = $item["title"];
            echo $item;
        }
        unset($item);
    }
});
$app->run();