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
<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "config.php";
require './vendor/autoload.php';
session_start();

$mail = new PHPMailer(true);

$recipient=($_SESSION["email"]);


// if (isset($_POST['submit'])) {

//     $phpmailer = new PHPMailer();
//     $phpmailer->isSMTP();
//     $phpmailer->Host = 'smtp.mailtrap.io';
//     $phpmailer->SMTPAuth = true;
//     $phpmailer->Port = 2525;
//     $phpmailer->Username = '36957db64416d6';
//     $phpmailer->Password = '445f9af3c4f0a3';


    // $code = rand(100000,999999);
    // $to = $_SESSION["email"]; 
    // $subject = "Verification";
    // $message = $code;
    // $from = "248dddbdad-d4a3c4@inbox.mailtrap.io";
    // $headers = "From:" . $from;

    // echo $to;
    // die;

    // var_dump($to);
    // var_dump($subject);
    // var_dump($message);
    // var_dump($from);
    // var_dump($headers);
    // die();

    // TransportFactory::setConfig('mailtrap', [
    //     'host' => 'smtp.mailtrap.io',
    //     'port' => 2525,
    //     'username' => '36957db64416d6',
    //     'password' => '445f9af3c4f0a3',
    //     'className' => 'Smtp'
    //   ]);

    // var_dump(mail($to, $subject, $message, $headers));
    // die;

      
    // if (mail($to, $subject, $message, $headers)) {
    //     echo "Mail Sent.";
    // }
    // else {
    //     echo "failed";
    // }




//     $to = "somebody@example.com, somebodyelse@example.com";
// $subject = "HTML email";

// $message = "
// <html>
// <head>
// <title>HTML email</title>
// </head>
// <body>
// <p>This email contains HTML Tags!</p>
// <table>
// <tr>
// <th>Firstname</th>
// <th>Lastname</th>
// </tr>
// <tr>
// <td>John</td>
// <td>Doe</td>
// </tr>
// </table>
// </body>
// </html>
// ";

// Always set content-type when sending HTML email
// $headers = "MIME-Version: 1.0" . "\r\n";
// $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
// $headers .= 'From: <webmaster@example.com>' . "\r\n";
// $headers .= 'Cc: myboss@example.com' . "\r\n";

// 

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.mailtrap.io';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = '36957db64416d6';                     //SMTP username
    $mail->Password   = '445f9af3c4f0a3';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 2525;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress($recipient, 'enam kobir');     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $code = rand(100000,999999);
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = $code;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    if($mail){
        $sql = "INSERT INTO user_verification (email,verification_code)
        VALUES ('$recipient', '$code')";
    }

    if ($link->query($sql) === TRUE) {
        $Message = urlencode("Message has been sent");
        header("Location:home.php?Message=".$Message);
      } else {
        echo "Error: " . $sql . "<br>" . $link->error;
      }


   
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>