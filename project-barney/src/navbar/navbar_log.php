<?php session_start(); ?>
<nav class="navbar fixed-top navbar-light bg-light">
  <a href="/php-2019/project-barney"><img src="/php-2019/project-barney/pictures/logo.jpg" width="100" height="40" title="Logo"></a>
    <form class="form-inline">
      <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle btn-outline-success my-2 my-sm-0 mr-sm-2" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Hallo, <?php echo $_SESSION['user'];?>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="src/profil_bearbeiten.php">Profil</a>
          <a class="dropdown-item" href="src/freunde.php">Freunde</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="src/dashboard/profil.php">Zum Dashboard</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="src/logout.php">Ausloggen</a>
        </div>
      </div>
    </form>
</nav>
