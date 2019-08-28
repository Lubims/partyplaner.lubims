<?php

if(session_id() == ''){

    session_start();
}

$dsn = "mysql:host=localhost;dbname=kd58916_alkdb";
$user = "kd58916_root";
$password = "At452B7L9s";

//gibt Projekte aus an denen der Nutzer beteiligt ist
try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    //Testen ob es den nutzer schon gibt
    $selectStmt = $dbh->prepare("SELECT userid,username FROM benutzer WHERE userid IN (SELECT user2id FROM freunde WHERE user1id = (SELECT userid FROM benutzer WHERE username = :username))");
    $selectStmt->bindParam(":username", $_SESSION['user'], PDO::PARAM_STR, 12);
    $selectStmt->execute();

    $freunde = $selectStmt->fetchAll();

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    die();
}

    if ($freunde) {
    // output data of each row
    foreach ($freunde as $row => $link) {
      $projektStmt = $dbh->prepare("SELECT projektname, termin, zeit FROM projekte WHERE projektid IN (SELECT projektid FROM projektuser WHERE userid = (SELECT userid FROM benutzer WHERE username = :username)) AND projektid IN (SELECT projektid FROM projektuser WHERE userid = :user2id)AND termin >= CURDATE() ORDER BY termin ASC LIMIT 1");
      $projektStmt->bindParam(":username", $_SESSION['user'], PDO::PARAM_STR, 12);
      $projektStmt->bindParam(":user2id", $link['userid'], PDO::PARAM_STR, 12);
      $projektStmt->execute();
      $projekte = $projektStmt->fetch();
      ?>
    <tbody>
    <tr>
    <th>
    <?php echo $link['username']; ?>
    </th>
    <td>
    <?php if($projekte){
      echo $projekte['projektname'] . " am " . $projekte['termin'] . " um " . $projekte['zeit'];
    }else{
      echo $projektStmt->fetch();
    }?>
    </tbody>
    <?php
    }
    }
    ?>
