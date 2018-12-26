<?php 
include "cfg/helpers.php";
include "cfg/command.php";
$db= new DB();
session_start();
include "pageroutes.php";
include "components/head.php";
include "components/header.php";
include "components/body.php";
include "components/footer.php"; 
?>