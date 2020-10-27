<?php

session_start();

unset($_SESSION);
session_destroy();

session_commit();


header("location: index.php");

die();
?>