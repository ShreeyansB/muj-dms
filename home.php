<?php
include "php/db_conn.php";
session_start();

function convNull($data)
{
  if ($data == "") {
    return "-";
  } else {
    return $data;
  }
}

if (isset($_SESSION['regno'])) {
  $reg_no = $_SESSION['regno'];

  $info_sql = "SELECT student.*, class.class_name FROM student JOIN class ON (reg_no = $reg_no AND student.class_id = class.class_id)";
  $info_result = mysqli_query($conn, $info_sql);
  if (mysqli_num_rows($info_result) === 1) {
    $info_row = mysqli_fetch_assoc($info_result);
  }

  $att_sql = "SELECT course.course_name,learning.num_attended,learning.num_classes,learning.attendance FROM learning JOIN course ON (learning.course_id = course.course_id AND learning.reg_no = $reg_no) ORDER BY course_name";
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
            <a href="https://jaipur.manipal.edu/" class="nav-link text-black-50">Info</a>
          </li>
          <li class="nav-item">
            <a href="https://jaipur.manipal.edu/muj/contact-us.html" class="nav-link text-black-50">Help</a>
          </li>
          <li class="nav-item">
            <a href="php/logout.php" class="nav-link text-dark">Logout</a>
          </li>
          <li class="nav-item ms-1">
            <button type="button" class="btn btn-primary" data-bs-toggle="button" autocomplete="off" id="theme-btn">🌗</button>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Banner -->
  <div id="banner">
    <div class="container">
      <div class="row">
        <div class="col-2 col-md-1 col-lg-2 col-xl-3"></div>
        <div class="col-8 col-md-10 col-lg-8 col-xl-6 my-2" align="center">
          <div class="card my-5 text-start border border-0 shadow-lg">
            <div class="row g-0 p-0">
              <div class="col-12 col-md-4 pt-4 pt-md-0 d-flex justify-content-center justify-content-md-start">
                <img src="/img/avatar.png" alt="..." class="img-fluid rounded-start inverted">
              </div>
              <div class="col-12 col-md-8 ps-2 ps-md-0 pt-2">
                <div class="card-body ps-md-2">
                  <text class="id-heading m-0">NAME</text>
                  <h5 class="card-title mb-2 mb-2"><?php echo "{$info_row['first_name']} {$info_row['last_name']}" ?></h5>
                  <text class="id-heading">REGISTRATION NUMBER</text>
                  <h5 class="card-title mb-2"><?php echo "{$info_row['reg_no']}" ?></h5>
                  <div class="row">
                    <div class="col-6">
                      <text class="id-heading">SECTION</text>
                      <h5 class="card-title mb-2"><?php echo "{$info_row['class_name']}" ?></h5>
                    </div>
                    <div class="col-6">
                      <text class="id-heading">BRANCH</text>
                      <h5 class="card-title mb-2"><?php echo "{$info_row['branch']}" ?></h5>
                    </div>
                  </div>
                  <text class="id-heading">ACADEMIC YEAR</text>
                  <h5 class="card-title mb-2"><?php echo "{$info_row['acad_year']}" ?></h5>

                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-2 col-md-1 col-lg-2 col-xl-3"></div>
      </div>
    </div>
  </div>

  <!-- Navs -->

  <div class="container my-4">
    <div class="row">
      <div class="col-12" align="center">
        <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active nav-head" id="attendance-tab" data-bs-toggle="tab" data-bs-target="#attendance" type="button" role="tab" aria-controls="attendance" aria-selected="true">Attendance</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="timetable-tab" data-bs-toggle="tab" data-bs-target="#timetable" type="button" role="tab" aria-controls="timetable" aria-selected="false">Timetable</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="courses-tab" data-bs-toggle="tab" data-bs-target="#courses" type="button" role="tab" aria-controls="courses" aria-selected="false">Courses</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="grades-tab" data-bs-toggle="tab" data-bs-target="#grades" type="button" role="tab" aria-controls="grades" aria-selected="false">Grades</button>
          </li>
        </ul>
        <div class="col-12 my-4" align="center">
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active mt-3" id="attendance" role="tabpanel" aria-labelledby="attendance-tab">
              <div class="container">
                <table class="table table-hover rounded-3 border-3">
                  <thead>
                    <th scope="col">#</th>
                    <th scope="col">Course Name</th>
                    <th scope="col">Classes Attended</th>
                    <th scope="col">Total Classes</th>
                    <th scope="col">Attendance (%)</th>
                  </thead>
                  <tbody>
                    <?php
                    $i = 0;
                    $att_result = mysqli_query($conn, $att_sql);
                    while ($att_row = mysqli_fetch_assoc($att_result)) {
                      $i++;
                      echo "<tr>";
                      echo "<th scope=\"row\">{$i}</th>";
                      echo "<td>{$att_row["course_name"]}</td>";
                      echo "<td>" . convNull($att_row["num_attended"]) . "</td>";
                      echo "<td>" . convNull($att_row["num_classes"]) . "</td>";
                      echo "<td>" . convNull($att_row["attendance"]) . "</td>";
                      echo "</tr>";
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tab-pane fade" id="timetable" role="tabpanel" aria-labelledby="timetable-tab">
              <div class="container">
                <p>Hello</p>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
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
    let on=false;
    let button = document.querySelector('#theme-btn')
    button.addEventListener('click', () => {
      on = !on;
      if(on == true) {
        document.getElementById("banner").style.backgroundImage = "url(\"/img/home_banner_inv.png\")";
      } else {
        document.getElementById("banner").style.backgroundImage = "url(\"/img/home_banner.png\")";
      }
      document.documentElement.classList.toggle('dark-mode')
      document.documentElement.classList.toggle('inverted')
    })
  </script>
</body>

</html>