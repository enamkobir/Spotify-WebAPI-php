<?php
require_once "config.php";
session_start();
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "spotify";

// $conn = mysqli_connect($servername, $username, $password, $dbname);

$records = mysqli_query($link, "select * from rating_info");
$data = mysqli_fetch_all($records, MYSQLI_ASSOC);

function checklike($data,$id,$link){
    $record = mysqli_query($link, "SELECT music_id FROM rating_info WHERE music_album = '$id' and likes = '1'");
    $count = mysqli_fetch_all($record, MYSQLI_ASSOC);
    $like = count($count);   
    echo "Total like:" .$like.'';
    echo "&nbsp","&nbsp","&nbsp","&nbsp","&nbsp","&nbsp";
    
}

function checkdislike($data,$id,$link){
    $record = mysqli_query($link, "SELECT music_id FROM rating_info WHERE music_album = '$id' and dislikes = '1'");
    $count = mysqli_fetch_all($record, MYSQLI_ASSOC);
    $dislike = count($count);   
    echo "Total Dislike:" .$dislike.'<br/>';   
}

// function countRating($data, $id)
// {
// foreach ($data as $value) {
//       if ($value['music_id'] == $id) {
//         $a = array($value['music_album']);
//        var_dump($a);
//         } 
//       }
// }

function searchLikeRating($data, $music_id): int
{
//    var_dump($music_id);
    foreach ($data as $value) {
//        var_dump($value['music_id']);
        if ($value['music_id'] == $music_id) {
            return (int)$value['likes'];
        }
    }
    return 0;
}
function searchDislikeRating($data, $music_id): int
{
//    var_dump($music_id);
    foreach ($data as $value) {
//        var_dump($value['music_id']);
        if ($value['music_id'] == $music_id) {
            return (int)$value['dislikes'];
        }
    }
    return 0;
}

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<html>
<head>
    <title></title>
    <style type="text/css">
        #all{
            background:#D6DBDF;
        }
        #main {
            padding: 10px;
            margin: 100px 100px 100px 600px;
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

        .button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 5px 15px;
            text-align: center;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
        .button1 {background-color: #80BAF9;border-radius: 4px;} 
        .button2 {background-color: #008CBA;border-radius: 4px;} 
        .button3 {background-color: #FC7E7E;border-radius: 4px;} 
        .button4 {background-color: #FB3737;border-radius: 4px;} 

        .pagination a{
            color:black;
            float: left;
            padding:8px 16px;
            text-decoration:none;
            transition:background-color .3s;
        }
        .pagination a.active{
            background-color:#4CAF50;
            color:#fff;
        }
        .pagination{
            margin-top:30px;
        }
        .pagination a:hover:not(.active){
            background-color: #ddd;
        }

    </style>
</head>

<body id="all">
<div id="main">
    <div id="display_results">
    <button><a style="text-decoration:none; color:red" href="logout.php" tite="Logout">Logout</a> </button>
<br><br>
        <h1> Track List </h1>

        <?php
        
        ?>

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

        $tracks = $api->getAlbumTracks($id, 'ALBUM_ID');
        $chunks = array_chunk($tracks->items,3);
        $current_page = $chunks[($_GET['page'] ?? 1) - 1];
        
        
        $countlike = checklike($data, $id, $link);
        $countdislike = checkdislike($data, $id, $link);
        
       
        foreach ($current_page as $track) {
        //var_dump($track->external_urls->spotify);
            $a = $track->external_urls->spotify;
            echo "<a href='$a' target='_blank' style='text-decoration:none'>" . $track->name . "</a>";

            $result1 = searchLikeRating($data, $track->id);
            $result2 = searchDislikeRating($data, $track->id);

            ?>
                <?php
                    if ($result1) { 
                ?>
                <a style='text-decoration:none' href='save.php?id=<?php echo $track->id; ?>&l=1&like=0&album=<?php echo $id; ?>&page=<?php echo $_GET['page'] ?? 1; ?>'>
                    <button class="button button2">Liked</button><br>
                </a>

                <?php } elseif(!$result2) { ?>
                <a style='text-decoration:none' href='save.php?id=<?php echo $track->id; ?>&l=1&like=1&album=<?php echo $id; ?>&page=<?php echo $_GET['page'] ?? 1; ?>'>
                    <button class="button button1">Like</button>
                </a>
                <?php }
                ?>

                <?php               
                if ($result2) { ?>
                <a style='text-decoration:none' href='save.php?id=<?php echo $track->id; ?>&d=2&dislike=0&album=<?php echo $id; ?>&page=<?php echo $_GET['page'] ?? 1; ?>'>
                    <button class="button button4">Unliked</button>
                </a><br>

                <?php } elseif(!$result1) { ?>
                <a style='text-decoration:none' href='save.php?id=<?php echo $track->id; ?>&d=2&dislike=1&album=<?php echo $id; ?>&page=<?php echo $_GET['page'] ?? 1; ?>'>
                    <button class="button button3">Unlike</button>
                </a><br>
                <?php }
                
                ?>

            <?php
        }
        
        // $array = [$tracks->items];
        // $chunks = array_chunk($array,3);

        // echo'<pre>';
        // var_dump($chunks);
        // echo'</pre>';
        // die();
       
         echo "<div class='pagination'>";   
              $p=($_GET['page']??1) - 1;
              for($a=0; $a<count($chunks); $a++){
                
                if($p==$a){
                    echo '<a class="active">'.($a+1).'</a>';
                }else{
                echo '<a href="viewsongs.php?id='.$id.'&page='.($a+1).'">'.($a+1).'</a>';
                }
                ?>
                &nbsp;
                <?php
            }           
        echo"</div>";    
        ?>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js">

    </body>
    </html>
