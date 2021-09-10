<html>
<head>
<title></title>
<style type="text/css" >
 #all{
background:#D6DBDF;
}
#main {
padding: 10px;
margin: 100px;
margin-left: 600px;
color: Green;
/* border: 1px dotted; */
width: 520px;
}

#display_results {
    color: #34495E;
    /* background: #CCCCFF; */
}
h1 {
    padding-left: 50px;
}
</style>
</head>

<body id=all>
<div id="main">
<div id="display_results">
<button><a style="text-decoration:none; color:red" href="logout.php" tite="Logout">Logout</a></button>
<br><br>
 <h1> Album List </h1>
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


$id = $_GET['id'];

$albums = $api->getArtistAlbums($id,'ARTIST_ID');

foreach ($albums->items as $album) {
    
   
    echo "<a href='viewsongs.php?id=".$album->id."'>".$album->name."</a><br>";
}

?>

</div>
</div>
</body>
</html> 
