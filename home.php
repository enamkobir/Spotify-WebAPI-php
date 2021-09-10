<?php
session_start();
require_once "config.php";

$email=($_SESSION["email"]);


if($_SERVER["REQUEST_METHOD"] == "POST"){
   if(empty(trim($_POST["verification_code"]))){
    $username_err = "Please enter a verification code.";
   }else{
    $verification_code=$_POST["verification_code"];
    $sql = "SELECT COUNT(*) FROM user_verification 
     WHERE email = '$email'
    AND verification_code= $verification_code
    ORDER BY email DESC";
    // var_dump($link->query($sql));
    // die();
    if ($link->query($sql)) {
        header("location: search1.php");
    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
    }
   }
}    

?>

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
margin-left: 500px;
color: Green;
/* border: 1px dotted; */
width: 520px;
}
#display_results {
color: red;
/* background: #CCCCFF; */
}
.dropbtn {
  background-color: #B1B1B1;
  color: white;
  padding: 3px;
  font-size: 13px;
  border: none;
  cursor: pointer;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #FEFEFE;
  min-width: 160px;
  box-shadow: 0px 8px 8px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 8px 10px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #FEFEFE}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: #606060 ;
}
</style>
<script type="text/javascript "src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>

<script type='text/javascript'>
</script>
</head>

<body id="all">
<div id="main">
<?php
if(isset($_SESSION["username"])) {
?>
Welcome <?php  echo "<font color='blue'>". $_SESSION["username"]."</font>" ?>. Click here to 
<button><a style="text-decoration:none; color:red" href="logout.php" tite="Logout">Logout</a> </button>
<div class="dropdown">
  <button class="dropbtn">Email verification code</button>
  <div class="dropdown-content">
  <a href="action_page.php">Two step verification</a>
 
  </div>
</div>
<br><br>
<?php
if(isset($_GET['Message'])){
    echo $_GET['Message'];
}
?>
<br><br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
Verification Code: <input type="text" name="verification_code"><br>
<input type="submit">
</form>

</div>
</body>
</html> 
<?php
}else echo "<h1>Please login first .</h1>";
?>
<?php

?>