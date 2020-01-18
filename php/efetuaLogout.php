<?php

  session_start();

  unset($_SESSION['idLogado']);
  unset($_SESSION['emailLogado']);
  unset($_SESSION['nivelLogado']);

  header("Location: ../paginasSite/login.php");




 ?>
