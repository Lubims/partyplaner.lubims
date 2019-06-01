<?php

if(session_id() == ''){

    session_start();
}

$dsn = "mysql:host=localhost;dbname=alkdb";
$user = "root";
$password = "";
$zaehler = 0;

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
    foreach ($projekte as $row => $link) {
    if ($zaehler % 2 == 0) { ?>
    <li>
    <?php
    $zaehler++;
    }
    else { ?>
    <li class="timeline-inverted">
    <?php
    $zaehler++;
    }
    ?>
      <div class="timeline-badge"><i class="glyphicon glyphicon-check"></i></div>
      <div class="timeline-panel">
        <div class="timeline-heading">
          <h4 class="timeline-title"><?php echo $link['projektname']; ?></h4>
          <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i><?php echo $link['termin']; ?>, <?php echo $link['zeit']; ?>, <?php echo $link['ort']; ?></small></p>
        </div>
        <div class="timeline-body">
          <p><?php echo $link['beschreibung']; ?></p>
          <?php
          try {
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            //Testen ob es den nutzer schon gibt
            $ownerStmt = $dbh->prepare("SELECT besitzer FROM projektuser WHERE projektid = :projektid AND userid IN (SELECT userid FROM benutzer WHERE username = :username)");
            $ownerStmt->bindParam(":username", $_SESSION['user'], PDO::PARAM_STR, 12);
            $ownerStmt->bindParam(":projektid", $link['projektid'], PDO::PARAM_STR, 12);
            $ownerStmt->execute();

            $owner = $ownerStmt->fetch();
            // $owner["besitzer"] ist 1 oder 0

          } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            die();
          }
        if ($owner["besitzer"] == 1) { ?>
            <label class="btn btn-outline-success my-2 my-sm-0" role="button" onClick="redirectOrga(<?php echo $link['projektid']; ?>)">erweiterte Ansicht</label>
        <?php
        }
        ?>
        </div>
        <?php
    }
    }
    ?>
    </div>
    </li>
