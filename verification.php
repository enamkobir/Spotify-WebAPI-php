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

<form method="post" action="action_page.php">
  <label for="verification">Generate Code:<input type="text" id="vid" name="verification_code"><br></label><br>
  <input type="submit" name="submit" value="Send">
</form> 

</div>
</div>
</body>
</html> 
