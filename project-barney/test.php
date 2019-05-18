<?php session_start();
/* Connect to a MySQL database using driver invocation */


if(session_id() == ''){

    session_start();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require dirname(__DIR__).'/project-barney/lib/PHPMailer/src/Exception.php';
require dirname(__DIR__).'/project-barney//lib/PHPMailer/src/PHPMailer.php';
require dirname(__DIR__).'/project-barney//lib/PHPMailer/src/SMTP.php';

/* Connect to a MySQL database using driver invocation */

//Variablen
$code = mt_rand(100000, 999999);
$signup_username = "robin2810";
$signup_email = "robinbehrendt@web.de";
$signup_pwd = "123";
$dsn = "mysql:host=h2836116.stratoserver.net; dbname=alkdb";
$user = "root";
$password = "php-2019";


try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    //Testen ob es den nutzer schon gibt
    $Stmt = $dbh->prepare("SELECT Username, Email FROM Benutzer WHERE Username = :username OR Email = :email LIMIT 1");
    $Stmt->bindParam(":username", $signup_username, PDO::PARAM_STR, 12);
    $Stmt->bindParam(":email", $signup_email, PDO::PARAM_STR, 12);
    $Stmt->execute();

      $user = $Stmt->fetch();

      if ($user) {
        if ($user['Username'] === $signup_username) {
          echo "<script type='text/javascript'>alert('Dieser Username existiert bereits!');</script>";
          header('Location: ../index.php');
          exit;
        }
      } else {
      //Erstellen der Email
      $message = "<html>";
      $message .= "<body style=\"font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#666666;\">";
      $message .= "Der Code für die Registrierung lautet:<br>";
      $message .= "<br><font size=\"2\" color=\"black\" style=\"font-weight: bold\">".$code."</font><br>";
      $message .= "<br><a href=\"http://localhost/php-2019/project-barney/src/profil.php\">Zur Homepage</a>";
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
      } catch(Exception $e){
        die();
      }


      //Insert in die db
      $InsertStmt = $dbh->prepare("INSERT INTO benutzer (Username, Email, Passwort, Code) VALUES(?, ?, ?, ?)");
      $InsertStmt->execute([$signup_username, $signup_email, password_hash($signup_pwd, PASSWORD_BCRYPT), $code]);
      echo "true";
    }
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    die();
}

die();


?>
