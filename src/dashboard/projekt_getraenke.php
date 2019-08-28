<?php

if(session_id() == ''){

    session_start();
}

$dsn = "mysql:host=localhost;dbname=alkdb";
$user = "root";
$password = "";
?>
<h6><b>Getränke:</b></h6>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>Name</th>
      <th>Menge</th>
    </tr>
  </thead>
<?php
//gibt Projekte aus an denen der Nutzer beteiligt ist
try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    //Testen ob es den nutzer schon gibt
    $selectStmt = $dbh->prepare("SELECT DISTINCT  produktid FROM produktliste WHERE projektid = :projektID");
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
      $Stmt = $dbh->prepare("SELECT name FROM produkte WHERE produktid = :produktID");
      $Stmt->bindParam(":produktID", $link['produktid'], PDO::PARAM_STR, 12);
      $Stmt->execute();
      $produktDB = $Stmt->fetch();
      echo $produktDB['name'];
      ?>
      </th>
      <td>
      <?php
      $Stmt = $dbh->prepare("SELECT SUM(menge) FROM produktliste WHERE produktid = :produktID AND projektid = :projektID");
      $Stmt->bindParam(":produktID", $link['produktid'], PDO::PARAM_STR, 12);
      $Stmt->bindParam(":projektID", $_GET['projektid'], PDO::PARAM_STR, 12);
      $Stmt->execute();
      $mengeDB = $Stmt->fetch();
      echo ($mengeDB['SUM(menge)'] / 100) . " liter";
      ?>
      </td>
    </tbody>
    <?php
    }
    } else {
    echo '0 results';
    }
    ?>
    </table>
