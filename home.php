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
        </ul>
      </div>
    </div>
  </nav>

  <!-- Banner -->
  <div id="banner">
    <div class="container">
      <div class="row">
        <div class="col-12 my-2" align="center">
          <div class="card my-5 w-50 text-start">
            <div class="row g-0">
              <div class="col-md-4">
                <img src="/img/avatar.png"" alt=" ..." class="img-fluid p-3 rounded">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">Floppa Flimppy</h5>
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Navs -->

  <div class="container my-4">
    <div class="row">
      <div class="col-12" align="center">
        <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="attendance-tab" data-bs-toggle="tab" data-bs-target="#attendance" type="button" role="tab" aria-controls="attendance" aria-selected="true">Attendance</button>
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
            <div class="tab-pane fade show active" id="attendance" role="tabpanel" aria-labelledby="attendance-tab">
              <p class="text-start">Quis officia laboris officia et cupidatat occaecat anim deserunt aliquip. Officia commodo est nulla ex. Deserunt duis reprehenderit Lorem deserunt sit est fugiat excepteur irure eu. Quis id ullamco cupidatat proident velit id. Aute consequat commodo occaecat ullamco consequat non dolore duis occaecat excepteur mollit nulla esse.
                Quis officia laboris officia et cupidatat occaecat anim deserunt aliquip. Officia commodo est nulla ex. Deserunt duis reprehenderit Lorem deserunt sit est fugiat excepteur irure eu. Quis id ullamco cupidatat proident velit id. Aute consequat commodo occaecat ullamco consequat non dolore duis occaecat excepteur mollit nulla esse.Quis officia laboris officia et cupidatat occaecat anim deserunt aliquip. Officia commodo est nulla ex. Deserunt duis reprehenderit Lorem deserunt sit est fugiat excepteur irure eu. Quis id ullamco cupidatat proident velit id. Aute consequat commodo occaecat ullamco consequat non dolore duis occaecat excepteur mollit nulla esse.
                Quis officia laboris officia et cupidatat occaecat anim deserunt aliquip. Officia commodo est nulla ex. Deserunt duis reprehenderit Lorem deserunt sit est fugiat excepteur irure eu. Quis id ullamco cupidatat proident velit id. Aute consequat commodo occaecat ullamco consequat non dolore duis occaecat excepteur mollit nulla esse.Quis officia laboris officia et cupidatat occaecat anim deserunt aliquip. Officia commodo est nulla ex. Deserunt duis reprehenderit Lorem deserunt sit est fugiat excepteur irure eu. Quis id ullamco cupidatat proident velit id. Aute consequat commodo occaecat ullamco consequat non dolore duis occaecat excepteur mollit nulla esse.
                Quis officia laboris officia et cupidatat occaecat anim deserunt aliquip. Officia commodo est nulla ex. Deserunt duis reprehenderit Lorem deserunt sit est fugiat excepteur irure eu. Quis id ullamco cupidatat proident velit id. Aute consequat commodo occaecat ullamco consequat non dolore duis occaecat excepteur mollit nulla esse.Quis officia laboris officia et cupidatat occaecat anim deserunt aliquip. Officia commodo est nulla ex. Deserunt duis reprehenderit Lorem deserunt sit est fugiat excepteur irure eu. Quis id ullamco cupidatat proident velit id.
                Quis officia laboris officia et cupidatat occaecat anim deserunt aliquip. Officia commodo est nulla ex. Quis officia laboris officia et cupidatat occaecat anim deserunt aliquip. Officia commodo est nulla ex.</p>
            </div>
            <div class="tab-pane fade" id="timetable" role="tabpanel" aria-labelledby="timetable-tab">
              <p>Quis officia laboris officia et cupidatat occaecat anim deserunt aliquip. Officia commodo est nulla ex. Deserunt duis reprehenderit Lorem deserunt sit est fugiat excepteur irure eu. Quis id ullamco cupidatat proident velit id. Aute consequat commodo occaecat ullamco consequat non dolore duis occaecat excepteur mollit nulla esse.
                Quis officia laboris officia et cupidatat occaecat anim deserunt aliquip. Officia commodo est nulla ex. Deserunt duis reprehenderit Lorem deserunt sit est fugiat excepteur irure eu. Quis id ullamco cupidatat proident velit id. Aute consequat commodo occaecat ullamco consequat non dolore duis occaecat excepteur mollit nulla esse.</p>
            </div>
            <div class="tab-pane fade" id="courses" role="tabpanel" aria-labelledby="courses-tab">
              <p>Quis officia laboris officia et cupidatat occaecat anim deserunt aliquip. Officia commodo est nulla ex. Deserunt duis reprehenderit Lorem deserunt sit est fugiat excepteur irure eu. Quis id ullamco cupidatat proident velit id. Aute consequat commodo occaecat ullamco consequat non dolore duis occaecat excepteur mollit nulla esse.
                Quis officia laboris officia et cupidatat occaecat anim deserunt aliquip. Officia commodo est nulla ex. Deserunt duis reprehenderit Lorem deserunt sit est fugiat excepteur irure eu. Quis id ullamco cupidatat proident velit id. Aute consequat commodo occaecat ullamco consequat non dolore duis occaecat excepteur mollit nulla esse.</p>
            </div>
            <div class="tab-pane fade" id="grades" role="tabpanel" aria-labelledby="grades-tab">
              <p>Quis officia laboris officia et cupidatat occaecat anim deserunt aliquip. Officia commodo est nulla ex. Deserunt duis reprehenderit Lorem deserunt sit est fugiat excepteur irure eu. Quis id ullamco cupidatat proident velit id. Aute consequat commodo occaecat ullamco consequat non dolore duis occaecat excepteur mollit nulla esse.
                Quis officia laboris officia et cupidatat occaecat anim deserunt aliquip. Officia commodo est nulla ex. Deserunt duis reprehenderit Lorem deserunt sit est fugiat excepteur irure eu. Quis id ullamco cupidatat proident velit id. Aute consequat commodo occaecat ullamco consequat non dolore duis occaecat excepteur mollit nulla esse.</p>
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
</body>

</html>