<?php
	session_start();
	if (!isset($_SESSION['idadmin'])) {
	echo "You cannot enter this zone, this zone is restricted!";die;
	}

	require_once "../../cfg/config.php";
	include_once  ROOT."cfg/command.php";
	include_once ROOT."cfg/helpers.php";
	$dbAdmin= new DB();
	include_once "cfg/routes.php";
	include "components/header.php";
	include "components/nav.php";
	include "components/sidebar.php";
	include "components/body.php";
	include "components/footer.php";
?>