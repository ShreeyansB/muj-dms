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

function genTtSql($reg_no, $day) // To generate query based on Day
{
  return "SELECT timetable.*,course_name FROM student JOIN class ON (student.reg_no = $reg_no AND student.class_id = class.class_id) JOIN timetable ON (timetable.class_id = class.class_id AND timetable.course_day = $day) JOIN course ON timetable.course_id = course.course_id ORDER BY course_day,course_slot";
}

function labCheck($data)
{ // To add emoji if current class is a lab class
  if (preg_match('/\bLab\b/', $data)) {
    $data .= " ";
    $data .= "💻";
    return $data;
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

  $tt_sql = "SELECT timetable.* FROM student JOIN class ON (student.reg_no = $reg_no AND student.class_id = class.class_id) JOIN timetable ON timetable.class_id = class.class_id JOIN course ON timetable.course_id = course.course_id ORDER BY course_day,course_slot";

  $course_sql = "SELECT learning.course_id, course.course_name, course.course_credits, teacher.first_name,teacher.last_name, teacher.email FROM student JOIN class ON (reg_no = $reg_no AND student.class_id = class.class_id) JOIN learning ON (student.reg_no = learning.reg_no) JOIN course ON (learning.course_id = course.course_id) JOIN teaches ON (teaches.class_id = student.class_id AND learning.course_id = teaches.course_id) JOIN teacher ON (teaches.teacher_id = teacher.teacher_id) ORDER BY course_id";

  $grade_sql = "SELECT learning.course_id, course.course_name, course.course_credits, learning.grade FROM student JOIN class ON (reg_no = $reg_no AND student.class_id = class.class_id) JOIN learning ON (student.reg_no = learning.reg_no) JOIN course ON (learning.course_id = course.course_id) ORDER BY course_id";

  $gpa_sql = "SELECT gpa.sem,gpa.gpa FROM student JOIN gpa ON (student.reg_no = $reg_no AND student.reg_no = gpa.reg_no) ORDER BY gpa.sem";

  $img_ret_sql = "SELECT picture FROM student WHERE reg_no = $reg_no";
  $img_ret_res = mysqli_query($conn, $img_ret_sql);
  $img_ret_row = mysqli_fetch_assoc($img_ret_res);
  $calc_sql = "SELECT learning.course_id, course.course_name, course.course_credits FROM student JOIN class ON (reg_no = $reg_no AND student.class_id = class.class_id) JOIN learning ON (student.reg_no = learning.reg_no) JOIN course ON (learning.course_id = course.course_id) ORDER BY course_id";
  $calc_res = mysqli_query($conn, $calc_sql);
  $courses = (array) null;
  $grade_list = array("A+", "A", "B", "C", "D", "E", "F");
  $point_list = array(10, 9, 8, 7, 6, 5, 0);
  $credit_list = (array) null;

  class Course
  {
    public $code;
    public $name;
    public $credits;

    function setCourse($code, $name, $credits)
    {
      $this->code = $code;
      $this->name = $name;
      $this->credits = $credits;
    }
  }
  $num_courses = 0;
  while ($calc_row = mysqli_fetch_assoc($calc_res)) {
    $course = new Course();
    $code = $calc_row['course_id'];
    $name = $calc_row['course_name'];
    $credits = $calc_row['course_credits'];
    array_push($credit_list, (int) $credits);
    $course->setCourse($code, $name, $credits);
    array_push($courses, $course);
    $num_courses++;
  }

  function echoGradeSelector($i, $courses)
  {
    echo '<div class="col col-4 float-start pt-2 mb-2">
    <p>', '<b>', $i + 1, '.  ', '</b>', $courses[$i]->name, ' (', $courses[$i]->code, ') ', '</p>
  </div>
  <div class="col col-1"></div>
  <div class="col col-7 float-end mb-2" id="my-grp">
    <div class="btn-group float-end">
      <input type="radio" class="btn-check" name="radioToggleButton', $i + 1, '" id="radioToggleButton', $i + 1, '1" autocomplete="off" checked="true" value="a+">
      <label class="btn btn-secondary my-rad-1" for="radioToggleButton', $i + 1, '1">A+</label>
      <input type="radio" class="btn-check" name="radioToggleButton', $i + 1, '" id="radioToggleButton', $i + 1, '2" autocomplete="off" value="a">
      <label class="btn btn-secondary my-rad-2" for="radioToggleButton', $i + 1, '2">A</label>
      <input type="radio" class="btn-check" name="radioToggleButton', $i + 1, '" id="radioToggleButton', $i + 1, '3" autocomplete="off" value="b">
      <label class="btn btn-secondary my-rad-3" for="radioToggleButton', $i + 1, '3">B</label>
      <input type="radio" class="btn-check" name="radioToggleButton', $i + 1, '" id="radioToggleButton', $i + 1, '4" autocomplete="off" value="c">
      <label class="btn btn-secondary my-rad-4" for="radioToggleButton', $i + 1, '4">C</label>
      <input type="radio" class="btn-check" name="radioToggleButton', $i + 1, '" id="radioToggleButton', $i + 1, '5" autocomplete="off" value="d">
      <label class="btn btn-secondary my-rad-5" for="radioToggleButton', $i + 1, '5">D</label>
      <input type="radio" class="btn-check" name="radioToggleButton', $i + 1, '" id="radioToggleButton', $i + 1, '6" autocomplete="off" value="e">
      <label class="btn btn-secondary my-rad-6" for="radioToggleButton', $i + 1, '6">E</label>
      <input type="radio" class="btn-check" name="radioToggleButton', $i + 1, '" id="radioToggleButton', $i + 1, '7" autocomplete="off" value="f">
      <label class="btn btn-secondary my-rad-7" for="radioToggleButton', $i + 1, '7">F</label>
    </div>
  </div>';
  }
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
            <a href="account.php" class="nav-link text-black-50">Account</a>
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

  <!-- Banner -->
  <div id="banner">
    <div class="container">
      <div class="row">
        <div class="col-2 col-md-1 col-lg-2 col-xl-3"></div>
        <div class="col-8 col-md-10 col-lg-8 col-xl-6 my-2" align="center">
          <div class="card my-5 text-start border border-0 shadow-lg my-card animate__animated animate__jackInTheBox">
            <div class="row g-0 p-0">
              <div class="col-12 col-md-4 pt-4 pt-md-0 d-flex justify-content-center justify-content-md-start">
                <?php
                if ($img_ret_row['picture'] != NULL) {
                  echo '<img src=data:image;base64,' . $img_ret_row['picture'] . ' alt="..." class="img-fluid rounded-start inverted">';
                } else {
                  echo '<img src="/img/avatar.png" alt="..." class="img-fluid rounded-start inverted">';
                }
                ?>
              </div>
              <div class="col-12 col-md-8 ps-3 pt-2 animate__animated animate__lightSpeedInRight">
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

  <div class="container my-4 animate__animated animate__fadeIn">
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
          <li class="nav-item" role="calculate">
            <button class="nav-link" id="calculate-tab" data-bs-toggle="tab" data-bs-target="#calculate" type="button" role="tab" aria-controls="calculate" aria-selected="false">Calculate</button>
          </li>
        </ul>
        <div class="col-12 my-4" align="center">
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active mt-3" id="attendance" role="tabpanel" aria-labelledby="attendance-tab">
              <div class="container">
                <div class="table-responsive">
                  <table class="table table-hover" id="attendance-table">
                    <caption class="invisible" id="attendance-table-cap"><?php date_default_timezone_set('Asia/Kolkata');
                                                                          echo date('d/m/Y h:i:s a', time()); ?></caption>
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
                <button type="button" class=" mt-2 btn theme-btn" data-bs-toggle="button" autocomplete="off" id="jsPDF" onclick="dlAsPDF('attendance-table')">Download as PDF</button>
              </div>
            </div>
            <div class="tab-pane fade" id="timetable" role="tabpanel" aria-labelledby="timetable-tab">

              <div class="table-responsive round-table">
                <table class="table table-bordered table-striped" id="timetable-table">
                  <caption class="invisible" id="timetable-table-cap"><?php date_default_timezone_set('Asia/Kolkata');
                                                                      echo date('d/m/Y h:i:s a', time()); ?></caption>
                  <thead>
                    <tr class="table-myaccent text-nowrap">
                      <th scope="col">Day/Time</th>
                      <th scope="col">09:00-09:45</th>
                      <th scope="col">09:55-10:40</th>
                      <th scope="col">10:50-11:35</th>
                      <th scope="col">11:45-12:30</th>
                      <th scope="col">12:40-01:25</th>
                      <th scope="col">01:35-02:20</th>
                      <th scope="col">02:30-03:15</th>
                      <th scope="col">03:25-04:10</th>
                      <th scope="col">04:20-05:05</th>
                      <th scope="col">05:15-06:00</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 1;
                    $days = array("MON", "TUE", "WED", "THU", "FRI");
                    while ($i != 6) {
                      $j = 1;
                      $ctr = 0;
                      $tt_result = mysqli_query($conn, genTtSql($reg_no, $i));
                      echo "<tr>";
                      echo "<th scope=\"row\" style=\"vertical-align: middle;\">{$days[$i - 1]}</th>";
                      while ($tt_row = mysqli_fetch_assoc($tt_result)) {
                        while ($tt_row['course_slot'] != $j) {
                          echo "<td> </td>";
                          $j++;
                          $ctr++;
                        }
                        echo "<td>" . labCheck($tt_row['course_name']) . "</td>";
                        $j++;
                        $ctr++;
                      }
                      $i++;
                      while ($ctr != 10) {
                        echo "<td> </td>";
                        $ctr++;
                      }
                      echo "</tr>";
                    }
                    ?>
                  </tbody>
                </table>
                <button type="button" class=" mt-2 btn theme-btn" data-bs-toggle="button" autocomplete="off" id="jsPDF" onclick="dlAsPDF('timetable-table')">Download as PDF</button>
              </div>
            </div>
            <div class="tab-pane fade mt-3" id="courses" role="tabpanel" aria-labelledby="courses-tab">
              <div class="table-responsive">
                <table class="table table-hover" id="courses-table">
                  <caption class="invisible" id="courses-table-cap"><?php date_default_timezone_set('Asia/Kolkata');
                                                                    echo date('d/m/Y h:i:s a', time()); ?></caption>
                  <thead>
                    <th scope="col">#</th>
                    <th scope="col">Code</th>
                    <th scope="col">Course Name</th>
                    <th scope="col">Credits</th>
                    <th scope="col">Teacher</th>
                    <th scope="col">EMail</th>
                  </thead>
                  <tbody>
                    <?php
                    $i = 0;
                    $course_result = mysqli_query($conn, $course_sql);
                    while ($course_row = mysqli_fetch_assoc($course_result)) {
                      $i++;
                      echo "<tr>";
                      echo "<th scope=\"row\">{$i}</th>";
                      echo "<td>{$course_row["course_id"]}</td>";
                      echo "<td>{$course_row["course_name"]}</td>";
                      echo "<td>{$course_row["course_credits"]}</td>";
                      echo "<td>{$course_row["first_name"]} {$course_row["last_name"]}</td>";
                      echo "<td> <a class=\"link-mycolor\" href=\"mailto:{$course_row["email"]}\">{$course_row["email"]}</a></td>";
                      echo "</tr>";
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <button type="button" class=" mt-2 btn theme-btn" data-bs-toggle="button" autocomplete="off" id="jsPDF" onclick="dlAsPDF('courses-table')">Download as PDF</button>
            </div>
            <div class="tab-pane fade mt-3" id="grades" role="tabpanel" aria-labelledby="grades-tab">
              <div class="container">
                <div class="container" id="grades-table">
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <th scope="col">#</th>
                        <th scope="col">Code</th>
                        <th scope="col">Course Name</th>
                        <th scope="col">Credits</th>
                        <th scope="col">Grade</th>
                      </thead>
                      <tbody>
                        <?php
                        $i = 0;
                        $grade_result = mysqli_query($conn, $grade_sql);
                        while ($grade_row = mysqli_fetch_assoc($grade_result)) {
                          $i++;
                          echo "<tr>";
                          echo "<th scope=\"row\">{$i}</th>";
                          echo "<td>{$grade_row["course_id"]}</td>";
                          echo "<td>{$grade_row["course_name"]}</td>";
                          echo "<td>{$grade_row["course_credits"]}</td>";
                          echo "<td scope=\"row\">" . convNull($grade_row["grade"]) . "</td>";
                          echo "</tr>";
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <br>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <caption class="invisible" id="grades-table-cap"><?php date_default_timezone_set('Asia/Kolkata');
                                                                        echo date('d/m/Y h:i:s a', time()); ?></caption>
                      <thead>
                        <th scope="col">Semester</th>
                        <th scope="col">GPA</th>
                      </thead>
                      <tbody>
                        <?php
                        $gpa_result = mysqli_query($conn, $gpa_sql);
                        while ($gpa_row = mysqli_fetch_assoc($gpa_result)) {
                          echo "<tr>";
                          echo "<td>{$gpa_row["sem"]}</td>";
                          echo "<td>{$gpa_row["gpa"]}</td>";
                          echo "</tr>";
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <button type="button" class=" mt-2 btn theme-btn" data-bs-toggle="button" autocomplete="off" id="jsPDF" onclick="dlAsPDF('grades-table')">Download as PDF</button>
              </div>
            </div>

            <div class="tab-pane fade mt-3" id="calculate" role="tabpanel" aria-labelledby="calculate-tab">
              <div class="container text-start" id="calc-gpa-container">
                <b class="fs-5">Select expected grades in given subjects:-</b>
                <br><br>
                <form method="post" name="gpa-form">
                  <div class="row">
                    <?php
                    for ($x = 0; $x < count($courses); $x++) {
                      echoGradeSelector($x, $courses);
                    }
                    ?>
                  </div>
                  <button type="button" class="btn theme-btn float-end" onclick="<?php echo 'calcGPA(', $num_courses, ',', json_encode($credit_list), ')'; ?>">Calculate</button>
                </form>
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
      <p class="text-center text-white mb-0">&copy; <a href="https://github.com/ShreeyansB/muj-dms" alt="github" style="color: #fff;">Shreeyans Bahadkar</a>, Manipal University,
        jaipur.manipal.edu, Dehmi
        Kalan, Near GVK Toll Plaza, Jaipur-Ajmer Expressway, Jaipur, Rajasthan 303007.</p>
    </div>
  </footer>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="js/my.js"></script>
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
      if (win.document.getElementById('jsPDF') != null) {
        win.document.getElementById('jsPDF').remove();
      }
      win.document.close();
      win.focus();
      win.print();
    };

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

    let on = false;
    let button = document.querySelector('#theme-btn');
    button.addEventListener('click', () => {
      animateCSS('.flip-icon', 'flip');
      on = !on;
      if (on == true) {
        document.getElementById("banner").style.backgroundImage = "url(\"/img/home_banner_inv.png\")";
      } else {
        document.getElementById("banner").style.backgroundImage = "url(\"/img/home_banner.png\")";
      }
      document.documentElement.classList.toggle('dark-mode');
      document.documentElement.classList.toggle('inverted');

    });
  </script>
</body>

</html>