<?php
include "php/db_conn.php";
session_start();

function convNull($data) // To replace NULL value with "-"
{
  if ($data == "") {
    return "-";
  } else {
    return $data;
  }
}


if (isset($_SESSION['regno'])) {
  $reg_no = $_SESSION['regno'];
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
  <link rel="stylesheet" href="css/styles.css">

  <link rel="stylesheet" href="css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <script defer src="js/all.js"></script>

  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">
</head>

<body>
  <nav class="navbar navbar-expand-md navbar-light bg-white">
    <div class="container">
      <a href="#" class="navbar-brand">
        <img class="align-middle img-fluid me-2" id="brand-image" src="img/muj-logo.svg" alt="MUJ Logo">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle Navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a href="https://jaipur.manipal.edu/" class="nav-link text-black-50">Info</a>
          </li>
          <li class="nav-item">
            <a href="https://jaipur.manipal.edu/muj/contact-us.html" class="nav-link text-black-50">Help</a>
          </li>
          <li class="nav-item">
            <a href="home.php" class="nav-link text-black-50">Home</a>
          </li>
          <li class="nav-item">
            <a href="php/logout.php" class="nav-link text-dark">Logout</a>
          </li>
          <li class="nav-item ms-1">
            <button type="button" class="btn btn-primary" data-bs-toggle="button" autocomplete="off" id="theme-btn">
              <div class="flip-icon">🌗</div>
            </button>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Form -->
  <div class="container mt-4">
    <form action="php/update.php" method="POST">
      <h1>Manage Account</h1>
      <h2 class="text-muted">Enter updated details if you wish to change them</h2>
      <br>
      <hr class="divider-theme mt-4">

      <div class="row pe-5">
        <div class="col col-12 mb-4">
          <fieldset disabled="disabled">
            <label for="fname-input" class="form-label my-label fs-5" id="name-label">Name</label>
            <div class="input-group">
              <span class="input-group-text" id="before">First</span>
              <input type="text" class="form-control" name="fname" id="fname-input" placeholder="<?php echo 'Shreeyans' ?>">
              <span class="input-group-text">Last</span>
              <input type="text" class="form-control" name="lname" id="lname-input" placeholder="<?php echo 'Bahadkar' ?>">
            </div>
          </fieldset>
        </div>
        <div class="col col-12 mb-4">
          <label for="email-input" class="form-label my-label fs-5" id="email-label">Email</label>
          <div class="input-group">
            <input type="email" class="form-control" name="email" id="email-input" placeholder="<?php echo 'bahadkar.199302019@muj.manipal.edu' ?>">
          </div>
        </div>
      </div>
    </form>
  </div>


  <!-- Footer -->
  <footer class="bg-dark py-4" id="my-footer">
    <div class="container">
      <p class="text-center text-white mb-0">&copy; Shreeyans Bahadkar, Manipal University,
        jaipur.manipal.edu, Dehmi
        Kalan, Near GVK Toll Plaza, Jaipur-Ajmer Expressway, Jaipur, Rajasthan 303007.</p>
    </div>
  </footer>
  <script src="js/bootstrap.bundle.min.js"></script>

  <script>
    function dlAsPDF(id) {
      let table = document.getElementById(id).parentNode;
      var win = window.open('', '', 'height=720,width=1200');
      win.document.write('<html><head>');
      win.document.write('<link rel="stylesheet" href="css/bootstrap.min.css">');
      win.document.write('<link rel="stylesheet" href="css/styles.css">');
      win.document.write('<link rel="stylesheet" href="css/all.css">');
      win.document.write('</head>');
      win.document.write('<body>');
      win.document.write(table.innerHTML);
      win.document.write('</body></html>');
      win.document.getElementById(id.concat('-cap')).classList.remove("invisible");
      win.document.getElementById('jsPDF').remove();
      win.document.close();
      win.print();
    }

    const animateCSS = (element, animation, prefix = 'animate__') =>
      new Promise((resolve, reject) => {
        const animationName = `${prefix}${animation}`;
        const node = document.querySelector(element);

        node.classList.add(`${prefix}animated`, animationName, 'animate__faster');

        function handleAnimationEnd(event) {
          event.stopPropagation();
          node.classList.remove(`${prefix}animated`, animationName, 'animate__faster');
          resolve('Animation ended');
        }

        node.addEventListener('animationend', handleAnimationEnd, {
          once: true
        });
      });

    let button = document.querySelector('#theme-btn');
    button.addEventListener('click', () => {
      animateCSS('.flip-icon', 'flip');
      document.documentElement.classList.toggle('dark-mode');
      document.documentElement.classList.toggle('inverted');

    });
  </script>
</body>

</html>