<?php include("../../includes/config.php");

//Prüft ob der Nutzer den bestätigungscode bestätigt hat
if(isset($_POST['checkCode'])) {
  if($_SESSION['code'] == $_POST['checkCode']) {
    $dsn = "mysql:host=localhost;dbname=kd58916_alkdb";
    $user = "kd58916_root";
    $password = "At452B7L9s";

    try {
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        //Insert in die db
        $Stmt = $dbh->prepare("UPDATE benutzer SET Code = -1 WHERE Username = ?");
        $Stmt->execute([$_SESSION['user']]);

        $_SESSION['code'] = -1;
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        die();
    }
  }
}
?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <script>
        // Function to check Whether both passwords
        // is same or not.
        function checkInputCode(form) {
          userCode = form.sessionCode.value;
          inputCode = form.checkCode.value;
          if(userCode == inputCode) {
              return true;
          } else {
              alert ("Registrierungs-Code inkorrekt");
              return false;
          }
        }
        function keepModalOpen() {
          var code = <?php echo $_SESSION['code'] ?>;
          if(code < 0) {
            document.getElementById("modal-switch").checked = true;
          }
        }
        function redirectOrga(id) {
          window.location.replace("projekt_ansicht_orga.php?projektid=" + id);
        }

        function zusagen(projektid,userid) {
          var returnVal;
          jQuery.ajax({
              async: false,
              type: 'POST',
              url: 'profil_zusage.php',
              data: {projektid: projektid, userid: userid},
              success:function(zusagen) {
                console.log(zusagen);
                if(zusagen.localeCompare("true") == 0) {
                  returnVal = true;
                  location.reload();
                } else {
                  alert ("Ein Fehler ist aufgetreten");
                  returnVal = false;
                }
              }
          });
          return returnVal;
        }

        function absage(projektid,userid) {
          var returnVal;
          jQuery.ajax({
              async: false,
              type: 'POST',
              url: 'profil_absage.php',
              data: {projektid: projektid, userid: userid},
              success:function(absage) {
                console.log(absage);
                if(absage.localeCompare("true") == 0) {
                  returnVal = true;
                  location.reload();
                } else {
                  alert ("Ein Fehler ist aufgetreten");
                  returnVal = false;
                }
              }
          });
          return returnVal;
        }
    </script>
    <script
        src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Die 3 Meta-Tags oben *müssen* zuerst im head stehen; jeglicher sonstiger head-Inhalt muss *nach* diesen Tags kommen -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo($PAGE_TITLE)?></title>

    <!-- Bootstrap-CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!--<link href="css/bootstrap-grid.min.css" rel="stylesheet">
    <link href="css/bootstrap-reboot.min.css" rel="stylesheet">-->

    <!-- Besondere Stile für diese Vorlage -->
    <link href="../css/justified-nav.css" rel="stylesheet">

    <!-- Footer CSS -->
    <link href="../css/sticky-footer.css" rel="stylesheet">

    <!-- Unterstützung für Media Queries und HTML5-Elemente in IE8 über HTML5 shim und Respond.js -->

      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

  </head>

  <body>
  <!--Überprüfung Mail-Code-->

    <div class="container-fluid">

      <!-- Modal -->
      <div class="pure-css-bootstrap-modal">
        <style>
          .pure-css-bootstrap-modal {
            position: absolute; /* Don't take any space. */
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
          input::-webkit-outer-spin-button,
          input::-webkit-inner-spin-button {
              /* display: none; <- Crashes Chrome on hover */
              -webkit-appearance: none;
              margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
          }

          input[type=number] {
              -moz-appearance:textfield; /* Firefox */
          }

        </style>


        <input type="checkbox" name="modal-switch" id="modal-switch" onchange="keepModalOpen()" <?php if ($_SESSION['code'] > -1) echo "checked='checked'"; ?>>


        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <label class="modal-backdrop fade" for="modal-switch"></label>

          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Registrierung abschließen</h4>
              </div>
              <form class="form-inline" method="post" action="profil.php" onSubmit="return checkInputCode(this)">
                <input type="hidden" name="sessionCode" value="<?php echo htmlspecialchars($_SESSION['code']); ?>"/>
                <div class="modal-body">
                  <table>
                    <tr>
                      <td style="padding: 10px">Registrierungscode aus Email:</td>
                      <td style="padding-left: 10px"><input class="form-control" type="number" placeholder="Code" name="checkCode" required></td>
                    </tr>
                  </table>
                </div>
                <div class="modal-footer">
                  <button type="submit" name="signup_submit" class="btn btn-primary mr-auto">Abschicken</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <nav class="navbar navbar-light bg-light">
            <a href="/php-2019/project-barney"><img src="/php-2019/project-barney/pictures/logo.jpg" width="100" height="40" title="Logo"></a>
          <form class="form-inline">
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle btn-outline-success my-2 my-sm-0 mr-sm-2" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Hallo, <?php echo $_SESSION['user'];?>
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="../profil_bearbeiten.php">Profil</a>
                <a class="dropdown-item" href="../freunde.php">Freunde</a>
                <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="../../index.php">Zur Startseite</a>
                <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="../logout.php">Ausloggen</a>
                </div>
              </div>
            </form>
            <!--Sidebar mit Inhalt-->
            </nav>
              <div class="container-fluid">
                <div class="row">
                  <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                    <div class="sidebar-sticky">
                      <ul class="nav flex-column">
                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                          <span>Navigation</span>
                        </h6>
                        <li class="nav-item">
                          <a class="nav-link active" href="profil.php">
                            Übersicht
                            <span class="sr-only">(current)</span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link active" href="projekte.php">
                            Projekte
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link active" href="neue_projekte.php">
                            Neues Projekt
                          </a>
                        </li>
                      </ul>
                    </div>
                    </nav>

                    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                      <!--Ansicht-->
                      <div class="container">
                        <style>
                          .timeline {
  list-style: none;
  padding: 20px 0 20px;
  position: relative;
}

.timeline:before {
  top: 0;
  bottom: 0;
  position: absolute;
  content: " ";
  width: 3px;
  background-color: #eeeeee;
  left: 50%;
  margin-left: -1.5px;
}

.timeline > li {
  margin-bottom: 20px;
  position: relative;
}

.timeline > li:before,
.timeline > li:after {
  content: " ";
  display: table;
}

.timeline > li:after {
  clear: both;
}

.timeline > li:before,
.timeline > li:after {
  content: " ";
  display: table;
}

.timeline > li:after {
  clear: both;
}

.timeline > li > .timeline-panel {
  width: 46%;
  float: left;
  border: 1px solid #d4d4d4;
  border-radius: 2px;
  padding: 20px;
  position: relative;
  -webkit-box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
  box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
}

.timeline > li > .timeline-panel:before {
  position: absolute;
  top: 26px;
  right: -15px;
  display: inline-block;
  border-top: 15px solid transparent;
  border-left: 15px solid #ccc;
  border-right: 0 solid #ccc;
  border-bottom: 15px solid transparent;
  content: " ";
}

.timeline > li > .timeline-panel:after {
  position: absolute;
  top: 27px;
  right: -14px;
  display: inline-block;
  border-top: 14px solid transparent;
  border-left: 14px solid #fff;
  border-right: 0 solid #fff;
  border-bottom: 14px solid transparent;
  content: " ";
}

.timeline > li > .timeline-badge {
  color: #fff;
  width: 50px;
  height: 50px;
  line-height: 50px;
  font-size: 1.4em;
  text-align: center;
  position: absolute;
  top: 16px;
  left: 50%;
  margin-left: -25px;
  background-color: #999999;
  z-index: 100;
  border-top-right-radius: 50%;
  border-top-left-radius: 50%;
  border-bottom-right-radius: 50%;
  border-bottom-left-radius: 50%;
}

.timeline > li.timeline-inverted > .timeline-panel {
  float: right;
}

.timeline > li.timeline-inverted > .timeline-panel:before {
  border-left-width: 0;
  border-right-width: 15px;
  left: -15px;
  right: auto;
}

.timeline > li.timeline-inverted > .timeline-panel:after {
  border-left-width: 0;
  border-right-width: 14px;
  left: -14px;
  right: auto;
}

.timeline-badge.primary {
  background-color: #2e6da4 !important;
}

.timeline-badge.success {
  background-color: #3f903f !important;
}

.timeline-badge.warning {
  background-color: #f0ad4e !important;
}

.timeline-badge.danger {
  background-color: #d9534f !important;
}

.timeline-badge.info {
  background-color: #5bc0de !important;
}

.timeline-title {
  margin-top: 0;
  color: inherit;
}

.timeline-body > p,
.timeline-body > ul {
  margin-bottom: 0;
}

.timeline-body > p + p {
  margin-top: 5px;
}
                        </style>
  <div class="page-header">
    <h1 id="timeline">Anstehende Projekte</h1>
  </div>
  <ul class="timeline">
    <?php include("timeline.php");?>
  </ul>
</div>
                    </main>
                  </div>
                </div>








      <!-- Site footer -->
      <?php include("../../includes/footer.php");?>

    </div> <!-- /container -->


    <!-- IE10-Anzeigefenster-Hack für Fehler auf Surface und Desktop-Windows-8 -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
