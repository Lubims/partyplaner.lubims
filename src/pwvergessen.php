<?php
/* Connect to a MySQL database using driver invocation */


if(session_id() == ''){

    session_start();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require dirname(__DIR__).'/lib/PHPMailer/src/Exception.php';
require dirname(__DIR__).'/lib/PHPMailer/src/PHPMailer.php';
require dirname(__DIR__).'/lib/PHPMailer/src/SMTP.php';

/* Connect to a MySQL database using driver invocation */

//Variablen

//temporäres Passwort generieren
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$charactersLength = strlen($characters);
$tempPwd = '';
for ($i = 0; $i < 10; $i++) {
    $tempPwd .= $characters[rand(0, $charactersLength - 1)];
}

$input_email = htmlspecialchars($_POST["input_email"]);
$dsn = "mysql:host=localhost;dbname=kd58916_alkdb";
$user = "kd58916_root";
$password = "At452B7L9s";


try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    //Testen ob es den nutzer schon gibt
    $Stmt = $dbh->prepare("SELECT Username, Email FROM benutzer WHERE Email = :email LIMIT 1");
    $Stmt->bindParam(":email", $input_email, PDO::PARAM_STR, 12);
    $Stmt->execute();

      $user = $Stmt->fetch();

      if ($user) {
        //Erstellen der Email
        $message = "<html>";
        $message .= "<body style=\"font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#666666;\">";
        $message .= "Das neue temporäre Passwort lautet:<br>";
        $message .= "<br><font size=\"2\" color=\"black\" style=\"font-weight: bold\">".$tempPwd."</font><br>";
        $message .= "<br><a href=\"lubar.servebeer.com/php-2019/project-barney/src/dashboard/profil_bearbeiten.php\">Passwort ändern über Profil bearbeiten</a>";
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
        $mail->AddAddress($input_email);
        $mail->SetFrom("noreply@barney.com");
        $mail->Subject = "Neues Passwort für User ".$user["Username"];
        $mail->Body = $message;
        try{
          $mail->Send();
        } catch(Exception $e){
          die();
        }


        //Insert in die db
        $InsertStmt = $dbh->prepare("UPDATE benutzer SET passwort = ?");
        $InsertStmt->execute([password_hash($tempPwd, PASSWORD_BCRYPT)]);
        echo 'true';
      } else {
        echo 'false_exists';
    }
} catch (PDOException $e) {
    header("../error.html");
    die();
}

die();


?>