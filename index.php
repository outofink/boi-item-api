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
    for ($i = 0; ; $i++) {
        echo json_encode($boi["items"][$i]["itemid"], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        echo 
        
        if ($boi["items"][$i]["itemid"] == $id) {
	    echo json_encode($boi["items"][$i], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
            break;
        }
        
        if ($i > 200) {
            echo "Error, item not found.";
            break;
        }
});
$app->run();