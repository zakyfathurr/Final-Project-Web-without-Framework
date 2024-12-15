git remote -v<?php
include_once __DIR__ . '/../../controllers/bookingController.php';

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: http://localhost/zakifaturrahman/views/auth/loginPage.php");
    exit;
}

$roomId = $_GET['id'] ?? null;
if (!$roomId) {
    echo "Room ID not provided!";
    exit;
}
$room = getRoomDetails($roomId);

if (!$room) {
    echo "Room not found!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookingData = [
        'room_id' => $roomId,
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'checkIn' => $_POST['checkIn'],
        'checkOut' => $_POST['checkOut'],
    ];

    $result = addBooking($bookingData);

    if ($result['success']) {
        $successMessage = $result['message'];
    } else {
        $errorMessage = $result['message'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Detail Room</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="../../assets/css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="../../assets/css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="../../assets/images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="../../assets/css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
   </head>
   <!-- body -->
   <body class="main-layout">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="../../assets/images/loading.gif" alt="#"/></div>
      </div>
      <!-- end loader -->
      <!-- header -->
      <header>
         <!-- header inner -->
         <div class="header">
            <div class="container">
               <div class="row">
                  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                     <div class="full">
                        <div class="center-desk">
                           <div class="logo">
                              <a href="indexUser.php"><img src="../../assets/images/logo.png" alt="#" /></a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                     <nav class="navigation navbar navbar-expand-md navbar-dark ">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarsExample04">
                           <ul class="navbar-nav mr-auto">
                              <li class="nav-item ">
                                 <a class="nav-link" href="indexUser.php">Home</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="aboutUser.php">About</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="roomUser.php">Our room</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="galleryUser.php">Gallery</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="blogUser.php">Blog</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="contactUser.php">Contact Us</a>
                              </li>
                              <li class="nav-item" style="padding-right : 0px">
                                 <a class="btn btn-success" href="../auth/loginPage.php">LOGIN</a>
                              </li>
                              <li class="nav-item" style="padding-left : 5px">
                              <a class="btn btn-danger" href="../../controllers/LogoutController.php">LOGOUT</a>
                              </li>
                           </ul>
                        </div>
                     </nav>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- end header inner -->
      <!-- end header -->
      <div class="back_re">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="title">
                     <h2>Book Now</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="container">
         <h1 class="mt-4"><?=htmlspecialchars($room['room_title']);?></h1>
         <div class="row">
            <div class="col-md-7">
                  <img src="../../assets/room/<?=htmlspecialchars($room['image']);?>" alt="<?=htmlspecialchars($room['room_title']);?>" class="img-fluid">
                  <h3>Description:</h3>
                  <p><?=htmlspecialchars($room['description']);?></p>
                  <h4>Free Wifi: <?=htmlspecialchars($room['wifi'] ? 'Yes' : 'No');?></h4>
                  <h4>Room Type: <?=htmlspecialchars($room['room_type']);?></h4>
                  <h3>Price: Rp <?=number_format($room['price'], 0, ',', '.');?></h3>
            </div>
            <div class="col-md-5">
                  <h2>Book This Room</h2>
                  <?php if (!empty($errorMessage)): ?>
                     <div class="alert alert-danger"><?=$errorMessage;?></div>
                  <?php endif;?>
                  <?php if (!empty($successMessage)): ?>
                     <div class="alert alert-success"><?=$successMessage;?></div>
                  <?php endif;?>
                  <form method="POST">
                     <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" id="name" required>
                     </div>
                     <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                     </div>
                     <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" name="phone" class="form-control" id="phone" required>
                     </div>
                     <div class="mb-3">
                        <label for="checkIn" class="form-label">Check-In</label>
                        <input type="date" name="checkIn" class="form-control" id="checkIn" required>
                     </div>
                     <div class="mb-3">
                        <label for="checkOut" class="form-label">Check-Out</label>
                        <input type="date" name="checkOut" class="form-control" id="checkOut" required>
                     </div>
                     <button type="submit" class="btn btn-primary">Book Now</button>
                  </form>
            </div>
         </div>
      </div>
<!--  footer -->
<footer>
         <div class="footer">
            <div class="container">
               <div class="row">
                  <div class=" col-md-4">
                     <h3>Contact US</h3>
                     <ul class="conta">
                        <li><i class="fa fa-map-marker" aria-hidden="true"></i> Address</li>
                        <li><i class="fa fa-mobile" aria-hidden="true"></i> +01 1234569540</li>
                        <li> <i class="fa fa-envelope" aria-hidden="true"></i><a href="#"> demo@gmail.com</a></li>
                     </ul>
                  </div>
                  <div class="col-md-4">
                     <h3>Menu Link</h3>
                     <ul class="link_menu">
                        <li><a href="#">Home</a></li>
                        <li><a href="about.php"> about</a></li>
                        <li class="active"><a href="room.php">Our Room</a></li>
                        <li><a href="gallery.php">Gallery</a></li>
                        <li><a href="blog.php">Blog</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                     </ul>
                  </div>
                  <div class="col-md-4">
                     <h3>News letter</h3>
                     <form class="bottom_form">
                        <input class="enter" placeholder="Enter your email" type="text" name="Enter your email">
                        <button class="sub_btn">subscribe</button>
                     </form>
                     <ul class="social_icon">
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="copyright">
               <div class="container">
                  <div class="row">
                     <div class="col-md-10 offset-md-1">
                        <p>
                           © 2019 All Rights Reserved. Design by <a href="https://html.design/"> Free Html Templates</a>
                           <br><br>
                           Distributed by <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
                           </p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <!-- end footer -->
      <!-- Javascript files-->
      <script src="../../assets/js/jquery.min.js"></script>
      <script src="../../assets/js/bootstrap.bundle.min.js"></script>
      <script src="../../assets/js/jquery-3.0.0.min.js"></script>
      <!-- sidebar -->
      <script src="../../assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="../../assets/js/custom.js"></script>
</body>
</html>
