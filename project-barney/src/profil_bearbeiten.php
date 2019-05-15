<?php include("../includes/config.php");
$user = getUserData();
$USER_NAME = $user['Username'];
$USER_EMAIL = $user['Email'];

?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Die 3 Meta-Tags oben *müssen* zuerst im head stehen; jeglicher sonstiger head-Inhalt muss *nach* diesen Tags kommen -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo($PAGE_TITLE)?></title>

    <!-- Bootstrap-CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Besondere Stile für diese Vorlage -->
    <link href="src/css/justified-nav.css" rel="stylesheet">

    <!-- Unterstützung für Media Queries und HTML5-Elemente in IE8 über HTML5 shim und Respond.js -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container-fluid">

    <nav class="navbar navbar-light bg-light">
      <a class="navbar-brand">Logo</a>
        <form class="form-inline">
          <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle btn-outline-success my-2 my-sm-0 mr-sm-2" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Hallo, <?php echo $_SESSION['user'];?>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="profil_bearbeiten.php">Profil</a>
              <a class="dropdown-item" href="freunde.php">Freunde</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="dashboard/profil.php">Zum Dashboard</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="logout.php">Ausloggen</a>
            </div>
          </div>
        </form>
    </nav>
<<<<<<< HEAD
    <!--Profil bearbeiten-->

    <div class="modal-body text-center">
      <table class="table">
        <tr>
          <td style="padding: 10px"><input type="text" readonly class="form-control-plaintext" value="Benutzername:"></td>
          <td style="padding-left: 10px"><input type="text" readonly class="form-control-plaintext" id="staticUser" value="Name"></td>
          <td style="padding-left: 10px"><label for="modal-switch" class="btn btn-outline-success my-2 my-sm-0" role="button" data-toggle="modal" data-target="#benutzerändern">ändern</label></td>
        </tr>
        <tr>
          <td style="padding: 10px"><input type="text" readonly class="form-control-plaintext" value="Email:"></td>
          <td style="padding-left: 10px"><input type="text" readonly class="form-control-plaintext" id="staticUser" value="Name"></td>
          <td style="padding-left: 10px"><label for="modal-switch" class="btn btn-outline-success my-2 my-sm-0" role="button" data-toggle="modal" data-target="#mailändern">ändern</label></td>
        </tr>
      </table>
      <td style="padding-left: 10px"><label for="modal-switch" class="btn btn-outline-success my-2 my-sm-0" role="button" data-toggle="modal" data-target="#passwortändern">Passwort ändern</label></td>
    </div>

=======
<!--HIER!-->
    <span class="label label-primary"><?php echo $USER_EMAIL;?></span>


      <!-- Site footer -->
      <?php include("../includes/footer.php");?>

    </div> <!-- /container -->


    <!-- IE10-Anzeigefenster-Hack für Fehler auf Surface und Desktop-Windows-8 -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>

    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
