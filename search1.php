<?php
session_start();
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
$(document).ready(function(){
$("#search_results").slideUp();
$("#button_find").click(function(event){
event.preventDefault();
search_ajax_way();
});
$("#search").keyup(function(event){
event.preventDefault();
search_ajax_way();
});

});

function search_ajax_way(){
$("#search_results").show();
var search_this=$("#search").val();
if(search_this != "") {
    $.post("index.php", {search : search_this}, function(data){
    $("#display_results").html(data);
})
}else{
    $("#display_results").html("No search found...");  
}
}
</script>
</head>

<body id="all">
<div id="main">
<?php
if(isset($_SESSION["username"])) {
?>
Welcome <?php  echo "<font color='blue'>". $_SESSION["username"]."</font>" ?>. Click here to 
<button><a style="text-decoration:none; color:red" href="logout.php" tite="Logout">Logout</a> </button>

<br><br>
<form id="searchform" method="post">
<label>Enter</label>
<input type="text" name="search_query" id="search" placeholder="Artist name....." size="50"/>
<input type="submit" value="Search" id="button_find"/>
</form>
<div id="display_results"></div>
</div>
</body>
</html> 
<?php
}else echo "<h1>Please login first .</h1>";
?>