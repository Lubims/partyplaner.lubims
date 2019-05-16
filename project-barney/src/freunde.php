<?php include("../includes/config.php");?>
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
    <!--Freunde suchen-->
    <div class="mt-lg-1">
    <form class="form-inline mt-2 mt-md-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    </div>

    <form class="form-inline">
                  <div class="modal-body">
                    <table>
                      <tr>
                        <td style="padding: 10px">Benutzername:</td>
                        <td style="padding-left: 10px"><input class="form-control" placeholder="Benutzername" name="signup_username" required></td>
                      </tr>
                      <tr>
                        <td style="padding: 10px">Email-Adresse:</td>
                        <td style="padding-left: 10px"><input class="form-control" type="email" placeholder="Email-Adresse" name="signup_email" required></td>
                      </tr>
                      <tr>
                        <td style="padding: 10px">Passwort:</td>
                        <td style="padding-left: 10px"><input class="form-control" type="password" placeholder="Passwort" name="signup_pwd" required></td>
                      </tr>
                      <tr>
                        <td style="padding: 10px">Passwort wiederholen:</td>
                        <td style="padding-left: 10px"><input class="form-control" type="password" placeholder="Passwort wiederholen" oninput="check(this)" name="signup_pwd2" required></td>
                      </tr>
                    </table>
                  </div>
                  <div class="modal-footer">
                    <label for="modal-switch" class="btn btn-default" data-dismiss="modal">Schließen</label>
                    <button type="submit" name="signup_submit" class="btn btn-primary" style="margin-left: 261px">Registrieren</button>
                  </div>
                </form>

      <!-- Site footer -->
      <?php include("../includes/footer.php");?>

    </div> <!-- /container -->


    <!-- IE10-Anzeigefenster-Hack für Fehler auf Surface und Desktop-Windows-8 -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>

    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>