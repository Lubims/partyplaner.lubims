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
    $selectStmt = $dbh->prepare("SELECT * FROM projekte WHERE projektid IN (SELECT projektid FROM projektuser WHERE userid = (SELECT userid FROM benutzer WHERE username = :username))AND termin >= CURDATE() ORDER BY termin ASC");
    $selectStmt->bindParam(":username", $_SESSION['user'], PDO::PARAM_STR, 12);
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
      <?php echo $link['projektid']; ?>
      </th>
      <td>
      <?php echo $link['projektname']; ?>
      </td>
    </tbody>
    <?php
    }
    } else {
    echo '0 results';
    }
    ?>
    </table>
