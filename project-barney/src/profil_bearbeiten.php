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

    <!-- Modal -->
    <div class="pure-css-bootstrap-modal">
      <style>
        .pure-css-bootstrap-modal {
          position: absolute; /* Don't take any space. */
        }
        .pure-css-bootstrap-modal label.close {
          /* Reset */
          padding: 0;
          margin: 0;
        }

        #modal-switch {
          display: none;
        }
        /* MODAL */
        .modal {
          display: block;
        }
        #modal-switch:not(:checked) ~ .modal {
          /*
          In Bootstrap Model is hidden by `display: none`.
          Unfortunately I couldn't get this option to work with css transitions
          (they are disabled when `display: none` is present).
          We need other way to hide the modal, e.g. with `max-width`.
          */
          max-width: 0;
        }
        #modal-switch:checked ~ .fade,
        #modal-switch:checked ~ .modal .fade
        {
          opacity: 1;
        }
        /* BACKDROP */
        .modal-backdrop {
          margin: 0;
        }
        #modal-switch:not(:checked) ~ .modal .modal-backdrop
        {
          display: none;
        }
        #modal-switch:checked ~ .modal .modal-backdrop
        {
          filter: alpha(opacity=50);
          opacity: 0.5;
        }
        /* DIALOG */
        #modal-switch ~ .modal .modal-dialog {
          transition: transform .3s ease-out;
          transform: translate(0, -50%);
        }
        #modal-switch:checked ~ .modal .modal-dialog {
          transform: translate(0, 10%);
          z-index: 1050;
        }
      </style>


      <input type="checkbox" id="modal-switch"/>

      <!-- Modal für Benutzername ändern -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <label class="modal-backdrop fade" for="modal-switch"></label>

        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Registrierung</h4>
              <label for="modal-switch" class="close" data-dismiss="modal" aria-label="Close" style="display: flex; align-items: center;">
                <span aria-hidden="true">&times;</span>
              </label>
            </div>
            <form class="form-inline" method="post" action="src/dashboard/profil.php" onSubmit="return checkSignup(this)">
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
          </div>
        </div>
      </div>

      <!-- Modal für Email ändern -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <label class="modal-backdrop fade" for="modal-switch"></label>

        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Registrierung</h4>
              <label for="modal-switch" class="close" data-dismiss="modal" aria-label="Close" style="display: flex; align-items: center;">
                <span aria-hidden="true">&times;</span>
              </label>
            </div>
            <form class="form-inline" method="post" action="src/dashboard/profil.php" onSubmit="return checkSignup(this)">
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
          </div>
        </div>
      </div>

      <!-- Modal für Passwort ändern -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <label class="modal-backdrop fade" for="modal-switch"></label>

        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Registrierung</h4>
              <label for="modal-switch" class="close" data-dismiss="modal" aria-label="Close" style="display: flex; align-items: center;">
                <span aria-hidden="true">&times;</span>
              </label>
            </div>
            <form class="form-inline" method="post" action="src/dashboard/profil.php" onSubmit="return checkSignup(this)">
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
          </div>
        </div>
      </div>

      <!-- Modal für Account löschen -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <label class="modal-backdrop fade" for="modal-switch"></label>

        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Registrierung</h4>
              <label for="modal-switch" class="close" data-dismiss="modal" aria-label="Close" style="display: flex; align-items: center;">
                <span aria-hidden="true">&times;</span>
              </label>
            </div>
            <form class="form-inline" method="post" action="src/dashboard/profil.php" onSubmit="return checkSignup(this)">
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
          </div>
        </div>
      </div>

    </div>

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
    <!--Profil bearbeiten-->

    <div class="modal-body text-center">
      <table class="table">
        <tr>
          <td style="padding: 10px"><input type="text" readonly class="form-control-plaintext" value="Benutzername:"></td>
          <td style="padding-left: 10px"><input type="text" readonly class="form-control-plaintext" id="staticUser" value=<?php echo $USER_NAME;?>></td>
          <td style="padding-left: 10px"><label for="modal-switch" class="btn btn-outline-success my-2 my-sm-0" role="button" data-toggle="modal" data-target="#benutzerändern">ändern</label></td>
        </tr>
        <tr>
          <td style="padding: 10px"><input type="text" readonly class="form-control-plaintext" value="Email:"></td>
          <td style="padding-left: 10px"><input type="text" readonly class="form-control-plaintext" id="staticUser" value=<?php echo $USER_EMAIL;?>></td>
          <td style="padding-left: 10px"><label for="modal-switch" class="btn btn-outline-success my-2 my-sm-0" role="button" data-toggle="modal" data-target="#mailändern">ändern</label></td>
        </tr>
      </table>
      <td style="padding-left: 10px"><label for="modal-switch" class="btn btn-outline-success my-2 my-sm-0" role="button" data-toggle="modal" data-target="#passwortändern">Passwort ändern</label>
      <label for="modal-switch" class="btn btn-outline-danger my-2 my-sm-0" role="button" data-toggle="modal" data-target="#accountlöschen">Account löschen</label></td>
    </div>



      <!-- Site footer -->
      <?php include("../includes/footer.php");?>

    </div> <!-- /container -->


    <!-- IE10-Anzeigefenster-Hack für Fehler auf Surface und Desktop-Windows-8 -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>

    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
