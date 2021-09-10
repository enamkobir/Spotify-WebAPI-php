<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Example</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        h4.title{
            margin-bottom:50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row" style="padding-top:30px">
            <div class="col-md-6 offset-md-4">
                <input id="search" type="text" placeholder="Search.." name="search">
                <button id="send" type="submit"><i class="fa fa-search"></i></button> 
                <div id="text1"></div>
            </div>
        </div>
    </div>

</body>
<script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
        $(document).ready(function(){
            $("#send").click(function(){
               
                var varsearch = $("#search").val();
                
                $.ajax({
                    method:"POST",
                    url:"index.php",
                    data:{search:varsearch}
                }).done(function(data){
                    $("#text1").html(data);
                });

                
            });
        });
   
</script>
</html>