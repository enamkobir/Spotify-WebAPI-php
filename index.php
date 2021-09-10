<?php
require 'vendor/autoload.php';


$session = new SpotifyWebAPI\Session(
    '8bf4fb988fd245a0941c4b725426c959',
    '4fa60d0b1d534855ad8ea9206d79891e',
    'http://localhost:8080/laravel/spotify-web-api-php-main/'
);

$session->requestCredentialsToken();


$api = new SpotifyWebAPI\SpotifyWebAPI();
$api->setAccessToken($session->getAccessToken());

$name = $_POST['search'];

$results = $api->search( $name, 'artist');


foreach ($results->artists->items as $artist) {
   // var_dump($artist);
   echo "<a href='view.php?id=".$artist->id."'>".$artist->name."</a><br>";
}








