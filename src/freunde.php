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
    <link href="css/justified-nav.css" rel="stylesheet">

    <!-- Footer CSS -->
    <link href="css/sticky-footer.css" rel="stylesheet">

    <!-- Unterstützung für Media Queries und HTML5-Elemente in IE8 über HTML5 shim und Respond.js -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <script>
    function loadDynamicContentModal(modal) {
      var options = {
        modal : true,
        height : 300,
        width : 500
      };
      $('#modal-freunde_hinzufuegen').load('profil_bearbeiten/' + modal,
          function() {
            $('#bootstrap-modal').modal({
              show : true
            });
          });
    }

    function newFriend(form) {

      var returnVal;
      jQuery.ajax({
          async: false,
          type: 'POST',
          url: 'profil_bearbeiten/freunde_hinzufuegen.php',
          data: {freund_username: form.freund_username.value},
          success:function(freundCheck) {
            console.log(freundCheck);
              if(freundCheck.localeCompare("true") == 0) {
                returnVal = true;
              } else if(freundCheck.localeCompare("false_not_exists") == 0) {
                alert ("Diesen Account gibt es nicht");
                returnVal = false;
              } else if(freundCheck.localeCompare("false_exists") == 0) {
                  alert ("Ihr seit schon Freunde");
                  returnVal = false;
              } else if(freundCheck.localeCompare("false_own_user") == 0) {
                  alert ("Das bist du selber du dödel");
                  returnVal = false;
              } else {
                alert ("Ein Fehler ist aufgetreten");
                returnVal = false;
              }
          }

      });
      return returnVal;
    }
</script>

<body>

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
            <div id="modal-freunde_hinzufuegen"></div>
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
                <a class="dropdown-item" href="profil_bearbeiten.php">Profil</a>
                <a class="dropdown-item" href="freunde.php">Freunde</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="dashboard/profil.php">Zum Dashboard</a>
                <a class="dropdown-item" href="../index.php">Zur Startseite</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">Ausloggen</a>
              </div>
            </div>
          </form>
      </nav>
    <!--Freunde suchen-->
    <div class="mt-lg-1">
    <form class="form-inline mt-2 mt-md-0 justify-content-center">
      <label for="modal-switch" class="btn btn-outline-success my-2 my-sm-0 mr-sm-2" role="button" data-toggle="modal" onclick="loadDynamicContentModal('freunde_hinzufuegen.html')">Freunde hinzufügen</label>
    </form>
    </div>

    <main role="main" class="ml-sm-auto">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <!--Tabelle-->
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Name</th>
                <th>Nächstes gemeinsames Projekt</th>
              </tr>
            </thead>
            <?php include("freunde_db.php");?>
          </table>
        </div>
      </main>


      <!-- Site footer -->
      <?php include("../includes/footer.php");?>

    </div> <!-- /container -->




    <script
			  src="https://code.jquery.com/jquery-3.4.1.js"
			  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
			  crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
