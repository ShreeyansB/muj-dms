<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>MUJ DMS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="google" content="notranslate">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/styles.css">

  <link rel="stylesheet" href="css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <script defer src="js/all.js"></script>

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
            <a href="https://jaipur.manipal.edu/" class="nav-link">Info</a>
          </li>
          <li class="nav-item">
            <a href="https://jaipur.manipal.edu/muj/contact-us.html" class="nav-link">Help</a>
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

  <!-- Image and Form -->

  <div class="container mt-2">
    <div class="row mb-5">
      <div class="col-12 col-lg-6 mb-5 mb-lg-3 animate__animated animate__bounceInLeft">
        <img class="img-fluid selectDisable" alt="DMS Image" draggable="false" src="img/dms-illus.svg">
      </div>
      <div class="col-12 col-lg-6 align-self-center animate__animated animate__bounceInRight">
        <div class="container p-3 border rounded-3">
          <!-- LOGIN FORM -->
          <form action="php/login.php" method="POST">
            <div class="row">
              <div class="col-auto pe-0">
                <legend class="mb-3 h3" id="legend-text">LOGIN</legend>
              </div>
              <div class="col-auto ps-2">
                <button type="button" class="btn btn-help p-0 fs-5" data-bs-toggle="popover" data-bs-animation="true" tabindex="0" title="Login details" data-bs-content="<u class='pop-cap'>Following users are registered :</u><br />• Registration Number: <span class='font-monospace'>199302019</span><br />&nbsp  Password: <span class='font-monospace'>password</span><br />• Registration Number: <span class='font-monospace'>199303069</span><br />&nbsp  Password: <span class='font-monospace'>password</span>" data-bs-html="true">?</button>
              </div>
            </div>
            <div class="mb-3">
              <label for="inputRegNo" class="form-label">Registration Number</label>
              <input type="number" class="form-control" placeholder="Reg No" id="inputRegNo" name="regno">
            </div>
            <div class="mb-3">
              <label for="inputPasswd" class="form-label">Password</label>
              <input type="password" class="form-control" placeholder="Password" id="inputPasswd" name="password">
            </div>
            <?php if (isset($_GET['err']) && ($_GET['err'] == "ur")) { ?>
              <div class="alert alert-danger p-2" role="alert">Registration Number Required</div>
            <?php } ?>
            <?php if (isset($_GET['err']) && ($_GET['err'] == "pr")) { ?>
              <div class="alert alert-danger p-2" role="alert">Password Required</div>
            <?php } ?>
            <?php if (isset($_GET['err']) && ($_GET['err'] == "in")) { ?>
              <div class="alert alert-danger p-2" role="alert">Incorrect Registration Number or Password</div>
            <?php } ?>
            <button type="submit" class="btn btn-primary mt-2 w-25" id="login-submit"><text class="text-white">Login</text></button>
          </form>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 mt-0"></div>
    </div>
  </div>

  <!-- Divider -->

  <div class="container mb-5 px-5">
    <hr class="solid divider">
  </div>

  <!-- Features -->
  <div class="container px-5 my-5">
    <div class="row px-5 justify-content-around">
      <div class="col-12 col-md-4 mb-4 mb-md-0 text-center animate_animated animate__bounceIn">
        <div class="fa-layers fa-fw fa-8x mb-4">
          <i class="fas fa-circle feat-bg"></i>
          <i class="fas fa-database text-white" data-fa-transform="shrink-10"></i>
        </div>
        <figure class="text-center px-lg-5">
          <blockquote class="blockquote fs-5 px-2">
            <p>Get all information related to you and the college right in one place</p>
          </blockquote>
        </figure>
      </div>
      <div class="col-12 col-md-4 mb-4 mb-md-0 text-center animate_animated animate__bounceIn">
        <div class="fa-layers fa-fw fa-8x mb-4">
          <i class="fas fa-circle feat-bg"></i>
          <i class="fas fa-hand-paper text-white pe-1" data-fa-transform="shrink-10"></i>
        </div>
        <figure class="text-center px-lg-5">
          <blockquote class="blockquote fs-5 px-2">
            <p>Track your attendace, lookup your timetable and much more</p>
          </blockquote>
        </figure>
      </div>
      <div class="col-12 col-md-4 mb-4 mb-md-0 text-center animate_animated animate__bounceIn">
        <div class="fa-layers fa-fw fa-8x mb-4">
          <i class="fas fa-circle feat-bg"></i>
          <i class="fas fa-table text-white" data-fa-transform="shrink-10"></i>
        </div>
        <figure class="text-center px-lg-5">
          <blockquote class="blockquote fs-5 px-2">
            <p>Check your grades, marks and other stuff related to your courses </p>
          </blockquote>
        </figure>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-dark py-4" id="my-footer">
    <div class="container">
      <p class="text-center text-white mb-0">&copy; <a href="https://github.com/ShreeyansB/muj-dms" alt="github" style="color: #fff;">Shreeyans Bahadkar</a>, Manipal University,
        jaipur.manipal.edu, Dehmi
        Kalan, Near GVK Toll Plaza, Jaipur-Ajmer Expressway, Jaipur, Rajasthan 303007.</p>
    </div>
  </footer>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script>
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

    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl)
    });
    let button = document.querySelector('#theme-btn');

    let isDarkMode = false;
    if (sessionStorage.getItem("isDarkMode") != null) {
      isDarkMode = sessionStorage.getItem("isDarkMode");
      isDarkMode = (isDarkMode == "true") ? true : false;
      if (isDarkMode) {
        document.documentElement.classList.toggle('dark-mode');
        document.documentElement.classList.toggle('inverted');
      }
    }
    sessionStorage.setItem("isDarkMode", isDarkMode);

    button.addEventListener('click', () => {
      animateCSS('.flip-icon', 'flip');
      isDarkMode = !isDarkMode;
      sessionStorage.setItem("isDarkMode", isDarkMode);
      document.documentElement.classList.toggle('dark-mode');
      document.documentElement.classList.toggle('inverted');
    });
  </script>
</body>

</html>