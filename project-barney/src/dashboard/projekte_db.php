<?php

if(session_id() == ''){

    session_start();
}

$dsn = "mysql:host=localhost;dbname=alkdb";
$user = "root";
$password = "";

try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    //Testen ob es den nutzer schon gibt
    $selectStmt = $dbh->prepare("SELECT * FROM projekte WHERE projektid IN (SELECT projektid FROM projektuser WHERE userid = (SELECT userid FROM benutzer WHERE username = :username))");
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
    <?php echo $link['beschreibung']; ?>
    </td>
    </tr>
    </tbody>
    <?php
    }
    } else {
    echo '0 results';
    }
    ?>
