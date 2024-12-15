<?php
include_once __DIR__ . '/../../controllers/authController.php';
include_once __DIR__ . '/../../controllers/roomsController.php';
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['usertype'] !== 'admin') {
    header("Location: http://localhost/hotel_project/views/auth/loginPage.php");
    exit;
}
$status = null;
$error = null; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $error = addRoom($_POST);
    if (!$error) {
        $status = "Room berhasil ditambahkan!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add New Rooms</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
    <!-- style css -->
    <link rel="stylesheet" href="../../assets/css/style.css" />
    <!-- Responsive-->
    <link rel="stylesheet" href="../../assets/css/responsive.css" />
    <!-- fevicon -->
    <link rel="icon" href="../../assets/images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link
      rel="stylesheet"
      href="../../assets/css/jquery.mCustomScrollbar.min.css"
    />
    <!-- Tweaks for older IEs-->
    <link
      rel="stylesheet"
      href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
      media="screen"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
  </head>

  <nav class="navbar bg-body-tertiary">
    <div class="container-fluid">
      <a href="../admin/homeAdmin.php" class="navbar-brand">Admin Hotel</a>
      <div class="d-flex">
        <ul class="navbar-nav flex-row gap-5">
          <li class="nav-item">
            <a class="nav-link" href="../admin/addNewRooms.php"
              >Add New Rooms</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/dataBooking.php">Booking Data</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/addAdmin.php">Add Admin</a>
          </li>
          <a href="../../controllers/LogoutController.php">
            <button type="button" class="btn btn-danger">Logout</button>
          </a>
        </ul>
      </div>
    </div>
  </nav>

  <div class="back_re">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title">
            <h2>Add New Room</h2>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container mt-4">
    <?php if ($status): ?>
        <div class="alert alert-success">
            <?=htmlspecialchars($status);?>
        </div>
    <?php endif;?>
    <?php if ($error): ?>
        <div class="alert alert-danger">
            <?=htmlspecialchars($error);?>
        </div>
    <?php endif;?>
  </div>


  <div class="card container">
    <div class="card-body ">
      <form action="" method="POST" enctype="multipart/form-data">
        <label for="roomTitle">Room Title</label>
        <div class="input-group flex-nowrap">
          <input
            type="text"
            class="form-control"
            name="room_title"
            placeholder="Room Title"
            aria-label="roomTitle"
            aria-describedby="addon-wrapping"
          />
        </div>

        <label for="descRoom" class="mt-3">Room Description</label>
        <div class="input-group flex-nowrap">
          <div class="input-group">
            <textarea
              class="form-control"
              name="description"
              aria-label="With textarea"
              id="descRoom"
            ></textarea>
          </div>
        </div>

        <label for="priceRoom" class="mt-3">Room Price</label>
        <div class="input-group mb-3">
          <span class="input-group-text">Rp. </span>
          <input
            type="text"
            name="price"
            class="form-control"
            aria-label="Dollar amount (with dot and two decimal places)"
          />
        </div>

        <label for="roomType">Room Type</label>
        <div class="input-group mb-3">
          <select name="type" class="form-select" id="inputGroupSelect01">
            <!-- Menambahkan atribut name -->
            <option selected>Choose...</option>
            <option value="reguler">Reguler</option>
            <option value="premium">Premium</option>
            <option value="deluxe">Deluxe</option>
          </select>
        </div>

        <label for="wifi">Free Wifi</label>
        <div class="input-group mb-3">
          <select name="wifi" class="form-select" id="inputGroupSelect01">
            <!-- Menambahkan atribut name -->
            <option selected>Choose...</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
          </select>
        </div>

        <label for="photo">Photo</label>
        <div class="input-group mb-3">
          <input
            type="file"
            name="image"
            class="form-control"
            id="inputGroupFile02"
          />
          <label class="input-group-text" for="inputGroupFile02">Upload</label>
        </div>

        <div class="d-flex justify-content-center">
          <button type="submit" class="btn btn-primary">Add Room</button>
        </div>
      </form>
    </div>
  </div>
  </div>
  <div class="mt-5 pt-5"></div>
  <body>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/jquery-3.0.0.min.js"></script>
    <!-- sidebar -->
    <script src="../../assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../../assets/js/custom.js"></script>
  </body>
</html>
