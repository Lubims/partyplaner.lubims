<?php include("includes/config.php");?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <script>
        // Function to check Whether both passwords
        // is same or not.
        function checkSignup(form) {
            password1 = form.signup_pwd.value;
            password2 = form.signup_pwd2.value;
            pwd2_feld = document.getElementById("confirm_password");
            newUser = true;
            var isUserNew;

            // If Not same return False.
            if (password1 != password2) {
                alert ("Passwörter stimmen nicht überein.");
                return false;
            }

            // If same return True.
            else {
              jQuery.ajax({
                  async: false,
                  type: 'POST',
                  url: 'src/registrierung.php',
                  data: {signup_username: form.signup_username.value, signup_email: form.signup_email.value, signup_pwd: form.signup_pwd.value},

                  success:function(isUserNew) {
                      if(isUserNew.localeCompare("true") == 0) {
                        alert ("User registriert, bitte anmelden.")
                        return true;
                      } else if(isUserNew.localeCompare("false") == 0) {
                        alert ("User existiert bereits");
                        return false;
                      } else {
                        alert ("Ein Fehler ist aufgetreten");
                        return false;
                      }
                  }
              });
            }
        }
        function checkLogin(form) {
            var isLoginCorrect = false;

            jQuery.ajax({
                async: false,
                type: 'POST',
                url: 'src/login.php',
                data: {login_username: form.login_username.value, login_pwd: form.login_pwd.value},

                success:function(loginCorrect) {
                    if(loginCorrect.localeCompare("false") == 0) {
                      alert ("Anmeldedaten falsch. Erneut versuchen.");
                      return false;
                    } else {
                      return true;
                    }
                }
            });
        }
        function loadDynamicContentNavbar() {
          var navbar = <?php
          if (isset($_SESSION['user'])){
            echo json_encode("navbar_log.php");
          } else {
            echo json_encode("navbar.html");
          }
          ?>;

          console.log(navbar);
          $('#dynamic-navbar').load('src/navbar/' + navbar);
        }
        function losGehts() {
          var signup = <?php
          if (isset($_SESSION['user'])){
            echo json_encode("signed_up");
          } else {
            echo json_encode("signup");
          }
          ?>;

          if(signup == "signup") {
            document.getElementById("modal-switch").checked = true;
          } else {
            window.location.href = "src/dashboard/neue_projekte.php";
          }
        }
    </script>
    <!-- IE10-Anzeigefenster-Hack für Fehler auf Surface und Desktop-Windows-8 -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    <script
			  src="https://code.jquery.com/jquery-3.4.1.js"
			  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
			  crossorigin="anonymous"></script>
    <script src="src/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Die 3 Meta-Tags oben *müssen* zuerst im head stehen; jeglicher sonstiger head-Inhalt muss *nach* diesen Tags kommen -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo($PAGE_TITLE)?></title>

    <!-- Bootstrap-CSS -->
    <link href="src/css/bootstrap.min.css" rel="stylesheet">

    <!-- Besondere Stile für diese Vorlage -->
    <link href="src/css/justified-nav.css" rel="stylesheet">

    <!-- Footer CSS -->
    <link href="src/css/sticky-footer.css" rel="stylesheet">

    <!-- Unterstützung für Media Queries und HTML5-Elemente in IE8 über HTML5 shim und Respond.js -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body onload="loadDynamicContentNavbar();">

    <div class="container-fluid">

      <!-- NavBar -->
      <div id="dynamic-navbar"></div>

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
                    <button type="submit" name="signup_submit" class="btn btn-primary">Registrieren</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!--Slideshow-->

        <div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel" data-interval="5000">
          <!--Indicators-->
          <ol class="carousel-indicators">
            <li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-2" data-slide-to="1"></li>
            <li data-target="#carousel-example-2" data-slide-to="2"></li>
          </ol>
          <!--/.Indicators-->
          <!--Slides-->
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <div class="view">
                <img class="d-block w-100" src="pictures/biermeter.jpg" height="550px" alt="First slide">
                <div class="mask rgba-black-light"></div>
              </div>
              <div class="carousel-caption">
                <h1>Alkohol Rechner</h1>
                <p class="lead">Beschreibung zum Rechner</p>
                <p><a class="btn btn-lg btn-success" href="javascript:losGehts()" role="button">Los Gehts!</a></p>
              </div>
            </div>
            <div class="carousel-item">
              <!--Mask color-->
              <div class="view">
                <img class="d-block w-100 mx-auto" src="pictures/wand.jpg" height="550px" alt="Second slide">
                <div class="mask rgba-black-strong"></div>
              </div>
              <div class="carousel-caption">
                <h3 class="h3-responsive">Strong mask</h3>
                <p>Secondary text</p>
              </div>
            </div>
            <div class="carousel-item">
              <!--Mask color-->
              <div class="view">
                <img class="d-block w-100 mx-auto" src="pictures/flaschen.jpg" height="550px" alt="Third slide">
                <div class="mask rgba-black-slight"></div>
              </div>
              <div class="carousel-caption">
                <h3 class="h3-responsive">Slight mask</h3>
                <p>Third text</p>
              </div>
            </div>
          </div>
          <!--/.Slides-->

          <!--Controls-->
          <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
          <!--/.Controls-->
        </div>
        <!--/.Slideshow-->

      <!-- Beispiel-Zeile von Spalten -->
      <div class="row">
        <div class="col-lg-4">
          <h2>Safari-Fehlerwarnung!</h2>
          <p class="text-danger">Safari (Stand v8.0) hat einen Fehler, bei dem die Veränderung der Breite deines Browsers zu Problemen in der Anzeige der gleichmäßig ausgerichteten Navigation führt, was durch ein erneutes Laden der Seite behoben werden kann.</p>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-primary" href="#" role="button">Details anzeigen &raquo;</a></p>
        </div>
        <div class="col-lg-4">
          <h2>Überschrift</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-primary" href="#" role="button">Details anzeigen &raquo;</a></p>
       </div>
        <div class="col-lg-4">
          <h2>Überschrift</h2>
          <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p>
          <p><a class="btn btn-primary" href="#" role="button">Details anzeigen &raquo;</a></p>
        </div>
      </div>

      <!-- Site footer -->
      <?php include("includes/footer.php");?>

    </div> <!-- /container -->
  </body>
</html>
