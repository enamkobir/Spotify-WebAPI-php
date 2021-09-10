{/* <a href='save.php?id="<?php echo $track->id;?>"&dislike="<?php echo $dislike=2;?>"'></a>

$countrating = mysqli_query($conn, "select count(*) from rating_info where likes=1");
if($countrating){ 
     $row = mysqli_fetch_assoc($countrating);
     $count = $row["count(*)"];
     var_dump($count);
   
}


$album_id = $_GET['album'];
    $like = $_GET['like'];

    $sql = "INSERT INTO rating_info (music_id,music_album,likes) VALUES ('$id', '$album_id', $like)";
      mysqli_query($conn, $sql);
     header('Location: viewsongs.php?id=' . $_GET['album']); */}

     // .'&page='.$_GET['page'] ?? 1  