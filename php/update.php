<?php
session_start();

if (isset($_SESSION['regno'])) {
  include "db_conn.php";
  $regno = $_SESSION['regno'];
  $par = "";
  function validate($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  if (isset($_POST['email'])) {
    $email = validate($_POST['email']);

    if (empty($email)) {
      $par = $par . "es=emp&";
    } else {
      $email_change_sql = "UPDATE student SET email='$email' WHERE reg_no=$regno";
      $email_change_result = mysqli_query($conn, $email_change_sql);
      if ($email_change_result) {
        $par = $par . "es=don&";
      } else {
        $par = $par . "es=wro&";
      }
    }
  }

  if (isset($_POST['pass']) && isset($_POST['npass']) && isset($_POST['cpass'])) {
    $op = validate($_POST['pass']);
    $np = validate($_POST['npass']);
    $cp = validate($_POST['cpass']);

    if (empty($op) || empty($np) || empty($cp)) {
      $par = $par . "ps=emp&";
    } else if ($np != $cp) {
      $par = $par . "ps=dif&";
    } else {
      $op = md5($op);
      $np = md5($np);
      $pass_check_sql = "SELECT password FROM student WHERE reg_no=$regno AND password='$op'";
      $pass_check_result = mysqli_query($conn, $pass_check_sql);
      if (mysqli_num_rows($pass_check_result) === 1) {
        $pass_change_sql = "UPDATE student SET password = '$np' WHERE reg_no=$regno";
        $pass_change_result = mysqli_query($conn, $pass_change_sql);
        $par = $par . "ps=don&";
      } else {
        $par = $par . "ps=wro&";
      }
    }
  }

  if (isset($_FILES['img'])) {
    $img_name = $_FILES['img']['name'];
    $img_size = $_FILES['img']['size'];
    $img_type = $_FILES['img']['type'];
    $tmp_name = $_FILES['img']['tmp_name'];
    $error = $_FILES['img']['error'];
    $img_ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));

    if ($error === 0) {
      if ($img_ext != "jpeg" && $img_ext != "jpg") {
        $par = $par . "is=typ&";
      } else if ($img_size > 1048576) {
        $par = $par . "is=lar&";
      } else {
        $img = base64_encode(file_get_contents(addslashes($tmp_name)));
        $img_upload_sql = "UPDATE student SET picture='$img' WHERE reg_no = $regno";
        if(mysqli_query($conn, $img_upload_sql)) {
          $par = $par . "is=don&";
        } else {
          $par = $par . "is=err&";
        }
      }
    } else {
      $par = $par . "is=err&";
    }
    // $img_ret_sql = "SELECT picture FROM student WHERE reg_no = $regno";
    // $img_ret_res = mysqli_query($conn, $img_ret_sql);
    // $img_ret_row = mysqli_fetch_assoc($img_ret_res);
    // echo "<html><head><title>Test</title></head><body>";
    // echo "<hr>";
    // echo '<img src=data:image;base64,'.$img_ret_row['picture'].' />';
    // echo "<hr>";
    // echo "</body></html>";
    // exit();
  }

  header("Location: /account.php?" . $par);
  exit();
} else {
  header("Location: /index.php?");
  exit();
}
