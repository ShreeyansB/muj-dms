<?php
session_start();

if (isset($_SESSION['regno'])) {
} else {
  header("Location: index.php?");
  exit();
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>MUJ DMS - Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="google" content="notranslate">
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <link rel="stylesheet" href="css/all.css">
  <script defer src="js/all.js"></script>

  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">
</head>

<body>
  <div class="container">
    <div class="row mt-5">
      <div class="col">
        <h1>Hello <?php echo $_SESSION['regno'] ?>!</h1>
      </div>
      <div class="col">
        <a href="logout.php" class="btn btn-primary float-end" role="button">LOGOUT</a>
      </div>
    </div>
  </div>

  <script src="js/bootstrap.bundle.min.js"></script>

  <body>

</html>