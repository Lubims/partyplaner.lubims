<?php session_start();

if(session_id() == ''){
    session_start();
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../lib/PHPMailer/src/Exception.php';
require '../../lib/PHPMailer/src/PHPMailer.php';
require '../../lib/PHPMailer/src/SMTP.php';
/* Connect to a MySQL database using driver invocation */
//Variablen
$code = mt_rand(100000, 999999);
$new_email = htmlspecialchars($_POST["new_email"]);
$dsn = "mysql:host=localhost; dbname=alkdb";
$user = "root";
$password = "";

try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    //Testen ob es den nutzer schon gibt
    $Stmt1 = $dbh->prepare("SELECT Email FROM benutzer WHERE email = ?");
    $Stmt1->execute([$new_email]);
    $userExists = $Stmt1->fetch();

    if ($userExists) {
      echo 'false_exists';
    } else {
      $Stmt2 = $dbh->prepare("SELECT email FROM benutzer WHERE username = ?");
      $Stmt2->execute([$_SESSION['user']]);
      $user = $Stmt2->fetch();
      if($user['email'] === $new_email) {
        echo 'false_same';
      } else {
        //Erstellen der Email
        $message = "<html>";
        $message .= "<body style=\"font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#666666;\">";
        $message .= "Der Code für das Update der Email lautet:<br>";
        $message .= "<br><font size=\"2\" color=\"black\" style=\"font-weight: bold\">".$code."</font><br>";
        $message .= "<br><a href=\"lubar.servebeer.com/php-2019/project-barney/src/dashboard/profil.php\">Zur Homepage</a>";
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
        $mail->AddAddress($new_email);
        $mail->SetFrom("noreply@barney.com");
        $mail->Subject = "Neue Email für User ".$_SESSION['user'];
        $mail->Body = $message;
        try{
          $mail->Send();
        } catch(Exception $e){
          die();
        }
        //Insert in die db
        $UpdateStmt = $dbh->prepare("UPDATE benutzer SET new_email = ?, newemail_code = ? WHERE Username = ?");
        $UpdateStmt->execute([$_POST['new_email'], $code, $_SESSION['user']]);
        $_SESSION['newemail_code'] = $code;
        $_SESSION['new_email'] = $new_email;
        echo 'true';
      }
  }
} catch (PDOException $e) {
    header("Location: ../error.html");
}

die();
?>
