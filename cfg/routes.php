<section class="intro-section pt100 pb50">
  <div class="container">
<?php
// debug_backtrace() || die ("<h2>Access Denied!</h2> This file is protected and not available to public.");
if (isset($_GET['i'])){        
switch ($_GET['i'])
{
  case "about";
  include "modules/about.php";
  break;
  case "login";
  include "modules/login.php";
  break;
  case "logout";
      $db->logoutKlien();
      echo "<script> alert('Logout Berhasil!');location.replace('index.php?i=home'); </script>";
  break;
  case 'services':
    include "modules/services.php";
  break;
  case "test";
    include "modules/test.php";
  break;
  case "order";
    include "modules/order.php";
  break;
  case "myorder";
    include "modules/myorder.php";
  break;
  case "profile";
    include "modules/profile.php";
  break;
  case "register";
  include "modules/register.php";
  break;
  case "upload";
  include "modules/uploadbukti.php";
  break;
  case "detail";
  include "modules/detail.php";
  break;
  case "how";
  include "modules/howto.php";
  break;
  case 'home':
  include "modules/home.php";
  break;
  case 'printPdf':
  include "modules/printPdf.php";
  break;
  default:echo "Error PHP 404:Not Found";
}}
else{
  include "modules/home.php";
}
?>
</section>
</div>