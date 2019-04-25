<?php
  header("Location: start.html");
?>

<!DOCTYPE html>
<html>
  <head></head>
  <body>

    <?php
      use PHPMailer\PHPMailer\PHPMailer;
      use PHPMailer\PHPMailer\Exception;

      require dirname(__DIR__).'/lib/PHPMailer/src/Exception.php';
      require dirname(__DIR__).'/lib/PHPMailer/src/PHPMailer.php';
      require dirname(__DIR__).'/lib/PHPMailer/src/SMTP.php';

      //Variablen
      $signup_username = $_POST["signup_username"];
      $code = mt_rand(100000, 999999);
      $signup_email = $_POST["signup_email"];

      //Erstellen der Email
      $message = "<html>";
      $message .= "<body style=\"font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#666666;\">";
      $message .= "Der Code für die Registrierung lautet:<br>";
      $message .= "<br><font size=\"2\" color=\"black\" style=\"font-weight: bold\">".$code."</font><br>";
      $message .= "<br><a href=\"http://localhost/php-2019/project-barney/webcontent/index.html\">Zur Homepage</a>";
      $message .= "</body>";
      $message .= "</html>";


      $mail = new PHPMailer(true);
      //Send mail using gmail
      //if($send_using_gmail){
        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->IsHTML(true); //html-format einstellen
        $mail->CharSet = 'UTF-8'; //charset einstellen
        $mail->SMTPAuth = true; // enable SMTP authentication
        $mail->SMTPSecure = "ssl"; // sets the prefix to the servier
        $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
        $mail->Port = 465; // set the SMTP port for the GMAIL server
        $mail->Username = "noreply.brny@gmail.com"; // GMAIL username
        $mail->Password = "php-2019"; // GMAIL password
      //s}

      //Typical mail data
      $mail->AddAddress($signup_email);
      $mail->SetFrom("noreply@barney.com");
      $mail->Subject = "Registrierung für User ".$signup_username;
      $mail->Body = $message;
      try{
        $mail->Send();
        echo "Success";
      } catch(Exception $e){
        //Something went bad
        echo "Fail :(";
      }
      die();
    ?>

  </body>
<html>
