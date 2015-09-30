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
    $options = [
      'cost' => 11,
      'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
    ];
    $account_password = password_hash($account_password, PASSWORD_BCRYPT, $options)."\n";
    $sql = "SELECT `id`,`username`,`password`,`email` FROM `users` WHERE `email` = ?";
    if ($stmt = $link->prepare($sql)) {
      $stmt->bind_param('s', $account_email);
      $stmt->execute();
      $stmt->store_result();
      if ($stmt->num_rows == 1) {
        $stmt->bind_result($db_id, $db_username, $db_password, $db_email);
        $stmt->fetch();
        if ($password == $db_password) {
          // start users session
          $_SESSION["logged"] = true;
          $_SESSION["username"] = $db_username;
          $_SESSION["email"] = $db_email
          $_SESSION["string"] = "" . $db_id . "" . $db_password . "" . $db_username . "";
          $_SESSION["redirectcode"] = "9247";
        } else {
          $loginerror = "The password is incorrect.";
        }
      } else {
        $loginerror = "The email does not exist.";
      }
    }
    $stmt->close();
  }
}
if (isset($_POST["account-register"])) {
  $_SESSION["redirectcode"] = "3345";
}
if (isset($_POST["account-forgot"])) {
  $_SESSION["redirectcode"] = "6945";
}
if (isset($_POST["account-admin"])) {
  $_SESSION["redirectcode"] = "9900";
}
if ($_SESSION["redirectcode"] === "9247") {
  $_SESSION["redirectcode"] = "";
  header("Location: ".$url."/dashboard");
  exit;
} else {
}
if ($_SESSION["redirectcode"] === "3345") {
  $_SESSION["redirectcode"] = "";
  header("Location: ".$url."/register");
  exit;
} else {
}
if ($_SESSION["redirectcode"] === "6945") {
  $_SESSION["redirectcode"] = "";
  header("Location: ".$url."/forgot");
  exit;
} else {
}
if ($_SESSION["redirectcode"] === "9900") {
  $_SESSION["redirectcode"] = "";
  header("Location: ".$url."/admin");
  exit;
} else {
}
$_SESSION["redirectcode"] = "";
function safe($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
