<?php

if(session_id() == ''){

    session_start();
}

$dsn = "mysql:host=localhost;dbname=alkdb";
$user = "root";
$password = "";

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
      $projektStmt = $dbh->prepare("SELECT projektname, termin, zeit FROM projekte WHERE projektid IN (SELECT projektid FROM projektuser WHERE userid = (SELECT userid FROM benutzer WHERE username = :username)) AND projektid IN (SELECT projektid FROM projektuser WHERE userid = :user2id) ORDER BY termin DESC LIMIT 1");
      $projektStmt->bindParam(":username", $_SESSION['user'], PDO::PARAM_STR, 12);
      $projektStmt->bindParam(":user2id", $link['username'], PDO::PARAM_STR, 12);
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
      echo "/";
    }?>
    </td>
    <td style="padding-left: 10px"><label for="modal-switch" class="btn btn-outline-success my-2 my-sm-0" role="button" data-toggle="modal" onclick="loadDynamicContentModal('projekte_aendern.html')">ändern</label></td>
    </tr>
    </tbody>
    <?php
    }
    }
    ?>
