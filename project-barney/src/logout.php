<?php
  session_start();
  session_unset();
  session_destroy();
  header("Location: /php-2019/project-barney");
  exit;
?>
