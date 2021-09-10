<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "spotify";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

require 'vendor/autoload.php';

$session = new SpotifyWebAPI\Session(
    '8bf4fb988fd245a0941c4b725426c959',
    '4fa60d0b1d534855ad8ea9206d79891e',
    'http://localhost:8080/laravel/spotify-web-api-php-main/'
);

$session->requestCredentialsToken();

$api = new SpotifyWebAPI\SpotifyWebAPI();
$api->setAccessToken($session->getAccessToken());


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $exists = check($id, $conn);

    if ($exists) {
        update($id, $conn);
    } else {
        create($id, $conn);
    }
}

function check($id, $conn): bool
{
    $record = mysqli_query($conn, "SELECT * FROM rating_info WHERE music_id = '$id'");

    if ($record) {
        $data = mysqli_fetch_array($record, MYSQLI_ASSOC);
        return (bool)$data;
    } else {
        return false;
    }
}

function create($id, $conn)
{
    $album_id = $_GET['album'];
    $page=$_GET['page'];
    if($like = $_GET['like']){
        $sql = "INSERT INTO rating_info (music_id,music_album,likes) VALUES ('$id', '$album_id', $like)";
        mysqli_query($conn, $sql);
       header('Location: viewsongs.php?id=' . $_GET['album'].'&page='.$_GET['page'] ?? 1 );
    }
    elseif($dislike = $_GET['dislike']){
        $sql = "INSERT INTO rating_info (music_id,music_album,dislikes) VALUES ('$id', '$album_id', $dislike)";
        mysqli_query($conn, $sql);
       header('Location: viewsongs.php?id=' . $_GET['album'].'&page='.$_GET['page'] ?? 1 );
    }  
}

function update($id, $conn)
{
    
        $sql = "UPDATE rating_info SET likes = " . $_GET['like'] . " WHERE music_id = '$id'";
        mysqli_query($conn, $sql);
        header('Location: viewsongs.php?id=' . $_GET['album'].'&page='.$_GET['page'] ?? 1 );
        
        $sql = "UPDATE rating_info SET dislikes = " . $_GET['dislike'] . " WHERE music_id = '$id'";
        mysqli_query($conn, $sql);
        header('Location: viewsongs.php?id=' . $_GET['album'].'&page='.$_GET['page'] ?? 1 );
    
        
}
