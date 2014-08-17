<?php
require 'vendor/autoload.php';
$app = new \Slim\Slim();

$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});
$app->get('/', function ($name) {
    echo "Hello!";
});

$app->run();