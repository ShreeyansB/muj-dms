<?php

$sname = "localhost";
$uname = "student";
$password = "";

$db_name = "muj_dms";
$conn = mysqli_connect($sname, $uname, $password, $db_name);

print("HELOOOO");
if ($conn) {

} else {
  header("Location: /offline.html");
}
