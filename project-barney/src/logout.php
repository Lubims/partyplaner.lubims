<?php
if (!isset($_SESSION['user'])){
  session_destroy();
  header("Location: /php-2019/project-barney/");
  exit;
}else{
  header("Location: /php-2019/project-barney/");
  exit;
}
?>
