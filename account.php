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
  $name_sql = "SELECT first_name, last_name FROM student WHERE reg_no=$reg_no";
  $name_result = mysqli_query($conn, $name_sql);
  $name_row = mysqli_fetch_assoc($name_result);
  $fname = $name_row['first_name'];
  $lname = $name_row['last_name'];
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
              <div class="flip-icon">????</div>
            </button>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Form -->
  <div class="container mt-4">
    <form action="php/update.php" method="POST" enctype="multipart/form-data">
      <div class="animate__animated animate__fadeIn animate__fast">
        <h1>Manage Account</h1>
        <h2 class="text-muted">Enter updated details if you wish to change them</h2>
      </div>
      <br>

      <hr class="divider-theme mt-4">

      <div class="row pe-5 animate__animated animate__fadeIn animate__fast">
        <?php if (isset($_GET['es']) && ($_GET['es'] == "don")) { ?>
          <div class="alert animate__animated animate__headShake animate__animated animate__headShake  alert-success alert-dismissible fade show ms-3 ms-sm-0" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Success!</strong> You have changed your <u>email</u>.
          </div>
        <?php } ?>
        <?php if (isset($_GET['es']) && ($_GET['es'] == "wro")) { ?>
          <div class="alert animate__animated animate__headShake alert-danger alert-dismissible fade show ms-3 ms-sm-0" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Alert!</strong> Entered email is <u>already registered</u> to another user.
          </div>
        <?php } ?>
        <?php if (isset($_GET['ps']) && ($_GET['ps'] == "don")) { ?>
          <div class="alert animate__animated animate__headShake alert-success alert-dismissible fade show ms-3 ms-sm-0" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Success!</strong> You have changed your <u>password</u>.
          </div>
        <?php } ?>
        <?php if (isset($_GET['ps']) && ($_GET['ps'] == "wro")) { ?>
          <div class="alert animate__animated animate__headShake alert-danger alert-dismissible fade show ms-3 ms-sm-0" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Alert!</strong> Entered password <u>does not match</u> current password.
          </div>
        <?php } ?>
        <?php if (isset($_GET['ps']) && ($_GET['ps'] == "dif")) { ?>
          <div class="alert animate__animated animate__headShake alert-danger alert-dismissible fade show ms-3 ms-sm-0 ms-3 ms-sm-0" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Alert!</strong> Entered passwords <u>do not match</u>.
          </div>
        <?php } ?>
        <?php if (isset($_GET['is']) && ($_GET['is'] == "don")) { ?>
          <div class="alert animate__animated animate__headShake animate__animated animate__headShake  alert-success alert-dismissible fade show ms-3 ms-sm-0" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Success!</strong> You have changed your <u>profile picture</u>.
          </div>
        <?php } ?>
        <?php if (isset($_GET['is']) && ($_GET['is'] == "rem")) { ?>
          <div class="alert animate__animated animate__headShake animate__animated animate__headShake  alert-success alert-dismissible fade show ms-3 ms-sm-0" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Success!</strong> You have removed your <u>profile picture</u>.
          </div>
        <?php } ?>
        <?php if (isset($_GET['is']) && ($_GET['is'] == "err")) { ?>
          <div class="alert animate__animated animate__headShake animate__animated animate__headShake  alert-danger alert-dismissible fade show ms-3 ms-sm-0" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Error!</strong> There was a problem while <u>uploading</u> your profile picture.
          </div>
        <?php } ?>
        <?php if (isset($_GET['is']) && ($_GET['is'] == "typ")) { ?>
          <div class="alert animate__animated animate__headShake animate__animated animate__headShake  alert-danger alert-dismissible fade show ms-3 ms-sm-0" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Alert!</strong> Only images of filetype <u>.jpg/.jpeg</u> are allowed.
          </div>
        <?php } ?>
        <?php if (isset($_GET['is']) && ($_GET['is'] == "lar")) { ?>
          <div class="alert animate__animated animate__headShake animate__animated animate__headShake  alert-danger alert-dismissible fade show ms-3 ms-sm-0" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Alert!</strong> Only images of below the size of <u>1MB</u> are allowed.
          </div>
        <?php } ?>

        <div class="col col-12 mb-4">
          <fieldset disabled="disabled">
            <label for="fname-input" class="form-label my-label fs-5" id="name-label">Name</label>
            <div class="input-group">
              <span class="input-group-text" id="before">First</span>
              <input type="text" class="form-control" name="fname" id="fname-input" placeholder="<?php echo $fname ?>">
              <span class="input-group-text">Last</span>
              <input type="text" class="form-control" name="lname" id="lname-input" placeholder="<?php echo $lname ?>">
            </div>
          </fieldset>
        </div>
        <div class="col col-12 mb-4">
          <label for="email-input" class="form-label my-label fs-5" id="email-label">Email</label>
          <div class="input-group">
            <input type="email" class="form-control" name="email" id="email-input" placeholder="<?php echo $_SESSION['email']; ?>">
          </div>
        </div>
        <div class="col col-12 mb-4">
          <label for="pass-input" class="form-label my-label fs-5" id="pass-label">Password</label>
          <input type="password" class="form-control mb-2" name="pass" id="pass-input" placeholder="Old Password">
          <input type="password" class="form-control mb-2" name="npass" id="npass-input" placeholder="New Password">
          <input type="password" class="form-control mb-2" name="cpass" id="cpass-input" placeholder="Confirm Password">
        </div>
        <div class="col col-12 mb-4">
          <label for="img-input" class="form-label my-label fs-5 m-0" id="img-label">Profile Picture</label>
          <p><span class="small text-muted">Supported file type is .jpg and max size is 2MB</span></p>
          <div class="input-group">
            <input type="file" class="form-control" id="img-input" name="img">
            <input type="submit" class="btn btn-secondary" value="Remove Picture" data-bs-toggle="tooltip" title="Delete your picture from the server" data-bs-placement="top" name="remove_pic">
          </div>
        </div>
        <div class="col col-12 mb-4">
          <button type="submit" class="btn btn-primary theme-btn px-4 float-end">Submit</button>
        </div>
      </div>
    </form>
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

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
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