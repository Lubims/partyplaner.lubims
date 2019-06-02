<?php

if(session_id() == ''){

    session_start();
}

$dsn = "mysql:host=localhost;dbname=alkdb";
$user = "root";
$password = "";
?>
<h6><b>Gäste:</b></h6>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>Name</th>
      <th>Zugesagt</th>
      <th>Bringt mit</th>
      <th>Aktionen</th>
    </tr>
  </thead>
<?php
//gibt Projekte aus an denen der Nutzer beteiligt ist
try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    //Testen ob es den nutzer schon gibt
    $selectStmt = $dbh->prepare("SELECT * FROM projektuser WHERE projektid = :projektID");
    $selectStmt->bindParam(":projektID", $_GET['projektid'], PDO::PARAM_STR, 12);
    $selectStmt->execute();

    $projekte = $selectStmt->fetchAll();

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    die();
}

    if ($projekte) {
    // output data of each row
    foreach ($projekte as $row => $link) { ?>
    <tbody>
      <tr>
      <th>
      <?php
      //Testen ob es den nutzer schon gibt
      $Stmt = $dbh->prepare("SELECT username FROM benutzer WHERE userid = :userid");
      $Stmt->bindParam(":userid", $link['userid'], PDO::PARAM_STR, 12);
      $Stmt->execute();
      $userIDDB = $Stmt->fetch();
      echo $userIDDB['username'];
      ?>
      </th>
      <td>
      <?php
      if($link['zugesagt'] == 0){
        echo "noch keine Antwort";
      }
      if($link['zugesagt'] == 1){
        echo "Ist dabei!";
      }
      if($link['zugesagt'] == 2){
        echo "Kommt nicht";
      }
      ?>
      </td>
      <td>
      <?php
      $Stmt = $dbh->prepare("SELECT produktid,menge FROM produktliste WHERE userid = :userid AND projektid = :projektID");
      $Stmt->bindParam(":userid", $link['userid'], PDO::PARAM_STR, 12);
      $Stmt->bindParam(":projektID", $_GET['projektid'], PDO::PARAM_STR, 12);
      $Stmt->execute();
      $getraenk = $Stmt->fetchAll();

      if($getraenk){
        foreach($getraenk as $row => $getraenkLink){
          $Stmt = $dbh->prepare("SELECT name FROM produkte WHERE produktid = :produktid");
          $Stmt->bindParam(":produktid", $getraenkLink['produktid'], PDO::PARAM_STR, 12);
          $Stmt->execute();
          $getraenk = $Stmt->fetch();

          echo nl2br (($getraenkLink['menge']/100) . " liter " . $getraenk['name'] . "\n");
        }
      }else{
        echo "/";
      }

      $Stmt = $dbh->prepare("SELECT userid FROM benutzer WHERE username = :username");
      $Stmt->bindParam(":username", $_SESSION['user'], PDO::PARAM_STR, 12);
      $Stmt->execute();
      $userIDDB = $Stmt->fetch();
      $thisUserID = $userIDDB['userid'];

      $Stmt = $dbh->prepare("SELECT besitzer FROM projektuser WHERE userid = :thisUserID AND projektid = :projektID");
      $Stmt->bindParam(":thisUserID", $thisUserID, PDO::PARAM_STR, 12);
      $Stmt->bindParam(":projektID", $_GET['projektid'], PDO::PARAM_STR, 12);
      $Stmt->execute();
      $ownerDB = $Stmt->fetch();

      if ($link['userid'] == $thisUserID) { ?>
        <td style="padding-left: 10px"><label class="btn btn-outline-success my-2 my-sm-0" role="button" onClick="redirectOrga(<?php echo $link['projektid']; ?>)">Getränke leeren</label></td>
      <?php
      }
      else if($ownerDB['besitzer'] == 1) { ?>
        <td><label for="modal-switch" class="btn btn-outline-danger my-2 my-sm-0" role="button" data-toggle="modal" onclick="removeGast(<?php echo $link['projektid']; ?>, <?php echo $link['userid']; ?>)">Gast entfernen</label></td>
        <?php
      }
      ?>
      </td>
      </tr>
    </tbody>
    <?php
    }
    } else {
    echo '0 results';
    }
    ?>
    </table>
