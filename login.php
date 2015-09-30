<?php
error_reporting(E_ALL);
require "configuration/link.php";
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
  $account_email = safe($_POST['account-email']);
  $account_password = safe($_POST['account-password']);
  $account_email = mysqli_real_escape_string($account_email);
  $account_password = mysqli_real_escape_string($account_password);
  if (!filter_var($account_email, FILTER_VALIDATE_EMAIL)) {
    $loginerror = "The email is not valid.";
  } elseif {
    $sql = "SELECT `id`,`username`,`password`,`email` FROM `users` WHERE `email` = ?";
    
  }
}
function safe($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
