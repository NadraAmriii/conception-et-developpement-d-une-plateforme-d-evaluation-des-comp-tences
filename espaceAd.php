<?php
  session_start();
  require_once 'config.php';

  if(!isset($_SESSION['user'])){
    header('Location:index.php');
    die();
}
?>