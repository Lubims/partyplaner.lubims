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
$code = mt_rand(100000, 999999);
//$signup_email = htmlspecialchars($_POST["signup_email"]);
//$signup_pwd = htmlspecialchars($_POST["signup_pwd"]);
//$signup_username = htmlspecialchars($_POST["signup_username"]);
$signup_email = "admin@lubims.de";
$signup_pwd = "test";
$signup_username = "admin";
$dsn = "mysql:host=localhost:3306;dbname=kd58916_alkdb";
$user = "kd58916_root";
$password = "At452B7L9s";

try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    //Testen ob es den nutzer schon gibt
    $Stmt = $dbh->prepare("SELECT Username, Email FROM benutzer WHERE Username = :username OR Email = :email LIMIT 1");
    $Stmt->bindParam(":username", $signup_username, PDO::PARAM_STR, 12);
    $Stmt->bindParam(":email", $signup_email, PDO::PARAM_STR, 12);
    $Stmt->execute();

    echo "test1";

      $user = $Stmt->fetch();

      if ($user) {
        if ($user['Username'] === $signup_username) {
          echo 'false_user_exists';
        } else if ($user['Email'] === $signup_email) {
          echo 'false_email_exists';
        }
      } else {
      //Erstellen der Email
      $message = "<html>";
      $message .= "<body style=\"font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#666666;\">";
      $message .= "Der Code für die Registrierung lautet:<br>";
      $message .= "<br><font size=\"2\" color=\"black\" style=\"font-weight: bold\">".$code."</font><br>";
      $message .= "<br><a href=\"partyplaner.lubims.de/src/dashboard/profil.php\">Zur Homepage</a>";
      $message .= "</body>";
      $message .= "</html>";

      $mail = new PHPMailer(true);
      //Send mail using gmail
        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->IsHTML(true); //html-format einstellen
        $mail->CharSet = 'UTF-8'; //charset einstellen
        $mail->SMTPAuth = true; // enable SMTP authentication
        $mail->SMTPSecure = "ssl"; // sets the prefix to the servier
        $mail->Host = "mail.lubims.de"; // sets lubims.de as the SMTP server
        $mail->Port = 465; // set the SMTP port for the Mail server
        $mail->Username = "noreply@lubims.de"; // Mail username
        $mail->Password = "LubimsNoreply"; // Mail password
        //s}
        //Typical mail data
        $mail->AddAddress($new_email);
        $mail->SetFrom("noreply@lubims.de");
      $mail->Subject = "Registrierung für User ".$signup_username;
      $mail->Body = $message;
      try{
        $mail->Send();
      } catch(Exception $e){
        echo $e->getMessage();
        die();
      }

      //Insert in die db
      $InsertStmt = $dbh->prepare("INSERT INTO benutzer (Username, Email, Passwort, Code) VALUES(?, ?, ?, ?)");
      $InsertStmt->execute([$signup_username, $signup_email, password_hash($signup_pwd, PASSWORD_BCRYPT), $code]);
      $_SESSION['code'] = $code;
      $_SESSION['user'] = $signup_username;
      echo 'true';
    }
} catch (PDOException $e) {
<<<<<<< HEAD
    echo $e->getMessage();
=======
    echo "test";
>>>>>>> parent of 003ce9f... test
    die();
}

die();


?>
