<?php include("../../includes/config.php");?>
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
                      <form class="form-inline">
                        <div class="modal-body">
                          <table>
                            <tr>
                              <td style="padding: 10px">Name:</td>
                              <td style="padding-left: 10px"><input class="form-control" placeholder="Name der Veranstaltung" name="veranstaltung_name" required></td>
                            </tr>
                            <tr>
                              <td style="padding: 10px">Termin:</td>
                              <td style="padding-left: 10px"><input class="form-control" type="date" placeholder="Datum" name="veranstaltung_termin" required></td>
                            </tr>
                            <tr>
                              <td style="padding: 10px">Uhrzeit:</td>
                              <td style="padding-left: 10px"><input class="form-control" type="time" placeholder="Uhrzeit" name="veranstaltung_uhrzeit" required></td>
                            </tr>
                            <tr>
                              <td style="padding: 10px">Beschreibung:</td>
                              <td style="padding-left: 10px">
                                <textarea class="form-control" rows="3" cols=75% placeholder="Beschreibung der Veranstaltung" name="veranstaltung_termin" required></textarea>
                              </td>
                            </tr>
                          </table>
                          <button class="btn btn-outline-success my-2 my-sm-0 mr-sm-2 mt-lg-1" type="submit">Anlegen</button>
                        </div>
                      </form>
                    </div>
                  </main>
                </div>
              </div>








      <!-- Site footer -->
      <?php include("../../includes/footer.php");?>

    </div> <!-- /container -->


    <!-- IE10-Anzeigefenster-Hack für Fehler auf Surface und Desktop-Windows-8 -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>

    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
