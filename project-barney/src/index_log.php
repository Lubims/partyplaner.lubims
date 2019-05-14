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



        <!--Slideshow-->

        <div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">
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
                <img class="d-block w-100 mx-auto" src="../pictures/biermeter.jpg" height="550px" alt="First slide">
                <div class="mask rgba-black-light"></div>
              </div>
              <div class="carousel-caption">
                <h1>Alkohol Rechner</h1>
                <p class="lead">Beschreibung zum Rechner</p>
                <p><a class="btn btn-lg btn-success" href="#" role="button">Los Gehts!</a></p>
              </div>
            </div>
            <div class="carousel-item">
              <!--Mask color-->
              <div class="view">
                <img class="d-block w-100 mx-auto" src="../pictures/wand.jpg" height="550px" alt="Second slide">
                <div class="mask rgba-black-strong"></div>
              </div>
              <div class="carousel-caption">
                <h1>Alkohol Rechner</h1>
                <p class="lead">Beschreibung zum Rechner</p>
                <p><a class="btn btn-lg btn-success" href="#" role="button">Los Gehts!</a></p>
              </div>
            </div>
            <div class="carousel-item">
              <!--Mask color-->
              <div class="view">
                <img class="d-block w-100 mx-auto" src="../pictures/flaschen.jpg" height="550px" alt="Third slide">
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

      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>Alkohol Rechner</h1>
        <p class="lead">Beschreibung zum Rechner</p>
        <p><a class="btn btn-lg btn-success" href="#" role="button">Los Gehts!</a></p>
      </div>

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
      <?php include("../includes/footer.php");?>

    </div> <!-- /container -->


    <!-- IE10-Anzeigefenster-Hack für Fehler auf Surface und Desktop-Windows-8 -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>

    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
