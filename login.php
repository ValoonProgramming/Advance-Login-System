<?php
error_reporting(E_ALL);
require "configuration/index.php";
if ($login === true) {
  $loginclosed = false;
} elseif {
  $loginclosed = true;
} else {
}
session_start();
if ($_SESSION["logged"] === true) {
  header("Location: ".$url."/dashboard");
  exit;
} else {
}
if (isset($_POST["account-login"])) {
  $account_email = $_POST['account-email'];
  $account_password = $_POST['account-password'];
  
}
?>
