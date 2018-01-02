<?php

require 'vendor/autoload.php';
$config = require __DIR__.'/app/config.php';

$app = new App\Application($config, __DIR__.'/');
$app->boot();

$app->get('/', function () use ($app) {
    $galleries = App\Models\Gallery::all();
    echo $app->view('galleries', compact('galleries'));
});
$app->get('/sort/{type}', function($type) use ($app){
    $galleries = \App\Models\Gallery::all();
    switch ($type){
        case"date":
            $galleries = $galleries->sortByDesc(function($gallery){ return $gallery->id; });
            break;
        case"count":
            $galleries = $galleries->sortBy(function($gallery){ return count($gallery->images); });
            break;
        case"countDesc":
            $galleries = $galleries->sortByDesc(function($gallery){ return count($gallery->images); });
            break;
        case"abc":
            $galleries = $galleries->sortBy('title', SORT_NATURAL);
            break;
        case"abcDesc":
            $galleries = $galleries->sortByDesc('title', SORT_NATURAL);
            break;
    }
    echo $app->view('galleries', compact('galleries', 'type'));
});
$app->get('/gallery/{id}', function ($id) use ($app){
    $gallery = App\Models\Gallery::find($id);
    if(isset($gallery) && !empty($gallery)) {
        echo $app->view('gallery', compact('gallery'));
    }else{
        echo "<h1>No gallery found</h1>";
    }
});
$app->start();
