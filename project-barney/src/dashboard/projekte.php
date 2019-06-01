<?php include("../../includes/config.php");?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <script>
      function getProjektdaten(id) {
          jQuery.ajax({
              async: false,
              type: 'POST',
              url: 'projekte_get_daten.php',
              data: {id: id},
              success:function(projektdatenArray) {
                projektdatenArray = jQuery.parseJSON(projektdatenArray);
                document.getElementById("projektdaten_veranstaltungsname_neu").value = projektdatenArray[0][1];
                document.getElementById("projektdaten_termin_neu").value = projektdatenArray[0][2];
                document.getElementById("projektdaten_uhrzeit_neu").value = projektdatenArray[0][3];
                document.getElementById("projektdaten_ort_neu").value = projektdatenArray[0][4];
                document.getElementById("projektdaten_beschreibung_neu").value = projektdatenArray[0][5];
              }
          });
      }
    </script>

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

    <div class="container-fluid">

      <nav class="navbar navbar-light bg-light">
          <a href="/php-2019/project-barney"><img src="/php-2019/project-barney/pictures/logo.jpg" width="100" height="40" title="Logo"></a>
          <form class="form-inline">
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle btn-outline-success my-2 my-sm-0 mr-sm-2" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Hallo, <?php echo $_SESSION['user'];?>
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="profil.php">Profil</a>
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
                        <!-- HIER ACTION ÄNDERN -->
                        <form class="form-inline" method="post" action="">
                          <div class="modal-body">
                            <table>
                              <tr>
                                <td style="padding: 10px">Name:</td>
                                <td style="padding-left: 10px"><input class="form-control" name="veranstaltungsname_neu" id="projektdaten_veranstaltungsname_neu" required></td>
                              </tr>
                              <tr>
                                <td style="padding: 10px">Termin:</td>
                                <td style="padding-left: 10px"><input class="form-control" type="date" name="termin_neu" id="projektdaten_termin_neu" required></td>
                              </tr>
                              <tr>
                                <td style="padding: 10px">Uhrzeit:</td>
                                <td style="padding-left: 10px"><input class="form-control" type="time" name="uhrzeit_neu" id="projektdaten_uhrzeit_neu" required></td>
                              </tr>
                              <tr>
                                <td style="padding: 10px">Ort:</td>
                                <td style="padding-left: 10px"><input class="form-control" name="ort_neu" id="projektdaten_ort_neu" required></td>
                              </tr>
                              <tr>
                                <td style="padding: 10px">Beschreibung:</td>
                                <td style="padding-left: 10px">
                                  <textarea class="form-control" name="beschreibung_neu" id="projektdaten_beschreibung_neu" required></textarea>
                                </td>
                              </tr>
                            </table>
                          </div>
                          <div class="modal-footer">
                            <label for="modal-switch" class="btn btn-default" data-dismiss="modal">Schließen</label>
                            <button type="submit" name="projektdaten_change_submit" class="btn btn-primary">Ändern</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>


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
                      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                        <!--Tabelle-->
                        <div class="table-responsive">
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
                            <?php include("projekte_db.php");?>
                          </table>
                        </div>
                      </main>
                    </div>
                  </div>








      <!-- Site footer -->
      <?php include("../../includes/footer.php");?>

    </div> <!-- /container -->


    <!-- IE10-Anzeigefenster-Hack für Fehler auf Surface und Desktop-Windows-8 -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>

    <script
			  src="https://code.jquery.com/jquery-3.4.1.js"
			  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
			  crossorigin="anonymous"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
