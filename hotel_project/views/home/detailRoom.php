<?php
include_once __DIR__ . '/../../controllers/bookingController.php';

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
                              <a href="index.php"><img  style="max-height: 80px;" src="../../assets/images/logohotel.png" alt="#" /></a>
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
                                 <a class="nav-link" href="index.php">Home</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="about.php">About</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="room.php">Our room</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="gallery.php">Gallery</a>
                              </li>

                              <li class="nav-item" style="padding-right : 0px">
                                 <a class="btn btn-success" href="../auth/loginPage.php">LOGIN</a>
                              </li>
                              <li class="nav-item" style="padding-left : 5px">
                                 <a class="btn btn-primary" href="../auth/register.php">REGISTER</a>
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
                     <h2><?= htmlspecialchars($room['room_title']); ?></h2>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="container mt-5">
    <div class="row g-4">
        <!-- Image Section -->
        <div class="col-lg-7">
            <div class="card shadow-sm">
                <img src="../../assets/room/<?= htmlspecialchars($room['image']); ?>" 
                     alt="<?= htmlspecialchars($room['room_title']); ?>" 
                     class="card-img-top rounded">
                <div class="card-body">
                    <h3 class="card-title">Description</h3>
                    <p class="card-text"><?= htmlspecialchars($room['description']); ?></p>
                </div>
            </div>
        </div>

        <!-- Room Information -->
        <div class="col-lg-5">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h2>Room Information</h2>
                </div>
                <div class="card-body">
                    <h4><i class="bi bi-wifi me-2"></i> Free Wifi: 
                        <span class="text-<?= htmlspecialchars($room['wifi'] ? 'success' : 'danger'); ?>">
                            <?= htmlspecialchars($room['wifi'] ? 'Yes' : 'No'); ?>
                        </span>
                    </h4>
                    <h4><i class="bi bi-door-open me-2"></i> Room Type: 
                        <?= htmlspecialchars($room['room_type']); ?>
                    </h4>
                    <h3 class="mt-4 text-success">
                        <i class="bi bi-currency-dollar me-2"></i> Price: Rp <?= number_format($room['price'], 0, ',', '.'); ?>
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Optional Footer Section -->
<div class="mt-5 text-center">
    <a href="javascript:history.back()" class="btn btn-outline-secondary">Back to Rooms</a>
    <a href="../auth/loginPage.php" class="btn btn-primary">Book This Room</a>
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
