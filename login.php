<?php
session_start();
include "db_conn.php";

if (isset($_POST['regno']) && isset($_POST['password'])) {

  function validate($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  $regno = validate($_POST['regno']);
  $password = validate($_POST['password']);

  if (empty($regno)) {
    header("Location: index.php?err=ur");
    exit();
  } else if (empty($password)) {
    header("Location: index.php?err=pr");
    exit();
  } else {
    $password = MD5($password);
    $sql = "SELECT * FROM login_details WHERE RegNo='$regno' AND password='$password'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
      $row = mysqli_fetch_assoc($result);
      if ($row['RegNo'] === $regno && $row['Password'] === $password) {
        $_SESSION['regno'] = $row['RegNo'];
        $_SESSION['email'] = $row['EMail'];
        header("Location: home.php");
        exit();
      }
    } else {
      header("Location: index.php?err=in");
      exit();
    }
  }
} else {
  header("Location: index.php?");
  exit();
}
