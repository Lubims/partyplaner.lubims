<?php
//löschen aller daten in der session für den logout
  session_start();
  session_unset();
  session_destroy();
  header("Location: /");
  exit;
?>
