<?php
 session_start();
    if(!(isset($_SESSION['username'])))
    {
        header("location:login.php");
    }
    else
    {
        $name = $_SESSION['username'];
    }

    ?>