<?php
if (isset($_SESSION['user'])){
  header("Location: /php-2019/project-barney/src/index_log.php");
  exit;
}
?>

<div id="dynamic-navbar"></div>
