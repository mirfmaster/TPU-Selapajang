<?php 
// error_reporting(E_ALL);

debug_backtrace() || die ("<h2>Access Denied!</h2> This file is protected and not available to public.");
$page=@$_GET["page"];
$header=array();
$include="";
if (isset($page))
{
switch ($page) {
  case 'admin':
  echo "<script>window.location.replace('AdminLogin/general.php')</script>";

    break;
  default:
    $include= "../index.php";
    break;
}
}

 ?>
