<?php

if(session_id() == ''){

    session_start();
}

$dsn = "mysql:host=localhost;dbname=alkdb";
$user = "root";
$password = "";
?>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Termin</th>
      <th>Uhrzeit</th>
      <th>Ort</th>
      <th>Beschreibung</th>
      <th>Änderungen</th>
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
      <td>
      <?php echo $link['termin']; ?>
      </td>
      <td>
      <?php echo $link['zeit']; ?>
      </td>
      <td>
      <?php echo $link['ort']; ?>
      </td>
      <td>
      <?php echo $link['beschreibung']; ?>
      </td>
      <td style="padding-left: 10px"><label class="btn btn-outline-success my-2 my-sm-0" role="button" onClick="redirectOrga(<?php echo $link['projektid']; ?>)">ändern</label></td>
      </tr>
    </tbody>
    <?php
    }
    } else {
    echo '0 results';
    }
    ?>
    </table>
    <br><br>
    <h6><b>Alte Projekte:</b></h6>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Termin</th>
          <th>Uhrzeit</th>
          <th>Ort</th>
          <th>Beschreibung</th>
          <th>Änderungen</th>
        </tr>
      </thead>
      <?php
      try {
          $dbh = new PDO($dsn, $user, $password);
          $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
          //Testen ob es den nutzer schon gibt
          $selectStmt = $dbh->prepare("SELECT * FROM projekte WHERE projektid IN (SELECT projektid FROM projektuser WHERE userid = (SELECT userid FROM benutzer WHERE username = :username))AND termin < CURDATE() ORDER BY termin DESC");
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
            <td>
            <?php echo $link['termin']; ?>
            </td>
            <td>
            <?php echo $link['zeit']; ?>
            </td>
            <td>
            <?php echo $link['ort']; ?>
            </td>
            <td>
            <?php echo $link['beschreibung']; ?>
            </td>
            <td style="padding-left: 10px"><label for="modal-switch" class="btn btn-outline-success my-2 my-sm-0" role="button" data-toggle="modal" onClick="getProjektdaten(<?php echo $link['projektid']; ?>)">ändern</label></td>
            </tr>
            </tbody>
            <?php
            }
          }
          ?>
        </table>
