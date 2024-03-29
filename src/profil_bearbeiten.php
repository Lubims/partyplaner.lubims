<?php include("../includes/config.php");
$user = getUserData();
$USER_NAME = $user['Username'];
$USER_EMAIL = $user['Email'];

?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <script>
      function emailConfirm() {
        if(<?php if(isset($_GET['email_confirm'])){echo $_GET['email_confirm'];} else{echo 0;}?> == 1) {
          document.getElementById("modal-switch").checked = true;
          loadDynamicContentModal('email_aendern_confirm.html');
        }
      }
      function loadDynamicContentModal(modal) {
        isCodeSet = <?php if(isset($_SESSION['newemail_code'])){echo 'true';} else{echo 'false';}?>;
        if(modal.localeCompare('email_aendern.html') == 0) {
          if(isCodeSet == true) {
            console.log("test");
            modal = 'email_aendern_confirm.html';
          }
        }
    		var options = {
    			modal : true,
    			height : 300,
    			width : 500
    		};
    		$('#modal-profilbearbeiten').load('profil_bearbeiten/' + modal,
    				function() {
    					$('#bootstrap-modal').modal({
    						show : true
    					});
    				});
    	}
      //Überprüft die Passwörter
      function checkPasswords(form) {
        altes_passwort = form.old_pwd.value;
        neues_passwort = form.new_pwd.value;
        neues_passwort2 = form.new_pwd2.value;

        if (neues_passwort != neues_passwort2) {
            alert ("Passwörter stimmen nicht überein.");
            return false;
        } else if(altes_passwort == neues_passwort) {
            alert ("Altes und neues Passwort sind identisch.");
            return false;
        } else {
          var returnVal;
          jQuery.ajax({
              async: false,
              type: 'POST',
              url: 'profil_bearbeiten/passwort_aendern.php',
              data: {old_pwd: form.old_pwd.value, new_pwd: form.new_pwd.value},
              success:function(isPasswordCorrect) {
                  if(isPasswordCorrect.localeCompare('true') == 0) {
                    returnVal = true;
                  } else if(isPasswordCorrect.localeCompare('false') == 0){
                    alert ("Altes Passwort inkorrekt.")
                    returnVal = false;
                  } else {
                    alert ("Ein Fehler ist aufgetreten. Erneut versuchen.");
                    returnVal = false;
                  }
              }
          });
          return returnVal;
        }
      }
      //Überprüft den bestätigungscode
      function checkInputCode(form) {
        userCode = <?php if(isset($_SESSION['newemail_code'])){echo $_SESSION['newemail_code'];} else{echo -1;}?>;
        inputCode = form.checkCode.value;
        if(userCode == inputCode) {
            return true;
        } else {
            alert ("Registrierungs-Code inkorrekt");
            return false;
        }
      }
      //Überprüft die neue Email
      function checkNewEmail(form) {
          var returnVal;
          jQuery.ajax({
              async: false,
              type: 'POST',
              url: 'profil_bearbeiten/email_aendern.php',
              data: {new_email: form.new_email.value},
              success:function(isEmailNew) {
                  if(isEmailNew.localeCompare("true") == 0) {
                    returnVal = true;
                  } else if(isEmailNew.localeCompare("false_same") == 0) {
                    alert ("Ein Konto mit der Email existiert bereits.");
                    returnVal = false;
                  } else if(isEmailNew.localeCompare("false_exists") == 0) {
                    alert ("Ein Konto mit der Email existiert bereits.");
                    returnVal = false;
                  } else {
                    alert ("Ein Fehler ist aufgetreten");
                    returnVal = false;
                  }
              }
          });
          return returnVal;
      }
      //Überprüft den neuen Username
      function checkNewUser(form) {
        var returnVal;
        jQuery.ajax({
            async: false,
            type: 'POST',
            url: 'profil_bearbeiten/username_aendern.php',
            data: {new_username: form.new_username.value},
            success:function(isUserNew) {
              console.log(isUserNew);
                if(isUserNew.localeCompare("true") == 0) {
                  returnVal = true;
                } else if(isUserNew.localeCompare("false_same") == 0) {
                  alert ("Ein Konto mit dem Nutzernamen existiert bereits.");
                  returnVal = false;
                } else if(isUserNew.localeCompare("false_exists") == 0) {
                  alert ("Ein Konto mit dem Nutzernamen existiert bereits.");
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

  <body onLoad="emailConfirm()">

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


        <input type="checkbox" id="modal-switch" onchange="emailConfirm()"/>


        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <label class="modal-backdrop fade" for="modal-switch"></label>

          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div id="modal-profilbearbeiten"></div>
            </div>
          </div>
        </div>
      </div>

    <nav class="navbar navbar-light bg-light">
        <a href="/"><img src="/pictures/logo.jpg" width="100" height="40" title="Logo"></a>
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
    <!--Profil bearbeiten-->

    <div class="modal-body text-center">
      <table class="table">
        <tr>
          <td style="padding: 10px"><input type="text" readonly class="form-control-plaintext" value="Benutzername:"></td>
          <td style="padding-left: 10px"><input type="text" readonly class="form-control-plaintext" id="staticUser" value=<?php echo $USER_NAME;?>></td>
          <td style="padding-left: 10px"><label for="modal-switch" class="btn btn-outline-success my-2 my-sm-0" role="button" data-toggle="modal" onclick="loadDynamicContentModal('username_aendern.html')">ändern</label></td>
        </tr>
        <tr>
          <td style="padding: 10px"><input type="text" readonly class="form-control-plaintext" value="Email:"></td>
          <td style="padding-left: 10px"><input type="text" readonly class="form-control-plaintext" id="staticUser" value=<?php echo $USER_EMAIL;?>></td>
          <td style="padding-left: 10px"><label for="modal-switch" class="btn btn-outline-success my-2 my-sm-0" role="button" data-toggle="modal" onclick="loadDynamicContentModal('email_aendern.html')">ändern</label></td>
        </tr>
      </table>
      <td style="padding-left: 10px"><label for="modal-switch" class="btn btn-outline-success my-2 my-sm-0" role="button" data-toggle="modal" onclick="loadDynamicContentModal('passwort_aendern.html')">Passwort ändern</label></td>
      <td style="padding-left: 10px"><label for="modal-switch" class="btn btn-outline-danger my-2 my-sm-0" role="button" data-toggle="modal" onclick="loadDynamicContentModal('account_loeschen.html')">Account löschen</label></td>
    </div>

    <!-- Site footer -->
    <?php include("../includes/footer.php");?>

    </div> <!-- /container -->

    <!-- IE10-Anzeigefenster-Hack für Fehler auf Surface und Desktop-Windows-8 -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>

    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
