<?php
include_once __DIR__ . '/../../controllers/bookingController.php';
session_start();
$status = ''; 
$error = '';  
$rooms = getBookingDetails();

if (!isset($_SESSION['user']) || $_SESSION['user']['usertype'] !== 'admin') {
    header("Location: http://localhost/hotel_project/views/auth/loginPage.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['booking_id'])) {
  $error = deleteBooking($_POST['booking_id']);
  if ($error === null) {
      $status = true;
  } else {
      echo $error;
  }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Data Booking Page</title>
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
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <nav class="navbar bg-body-tertiary">
      <div class="container-fluid">
        <a href="../admin/homeAdmin.php" class="navbar-brand">Admin Hotel</a>
        <div class="d-flex">
          <ul class="navbar-nav flex-row gap-5">
            <li class="nav-item">
              <a class="nav-link" href="../admin/addNewRooms.php">Add New Rooms</a>
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
                     <h2>Bookings Data</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="container mt-4">
        <?php if ($status): ?>
          <div class="alert alert-success">
              <p class="text-center fs-3">Data Booking Berhasil di Hapus</p>
          </div>
        <?php endif; ?>
        <?php if ($error): ?>
          <div class="alert alert-danger">
              <?= htmlspecialchars($error); ?>
          </div>
        <?php endif; ?>
      </div>

        <table class="table container mt-3">
          <thead>
            <tr>
            <th scope="col">Room ID</th>
            <th scope="col">Foto</th>
            <th scope="col">Room Name</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Check-in Date</th>
            <th scope="col">Check-out Date</th>
            <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($rooms as $index => $booking): ?>
            <tr>
                <td><?= htmlspecialchars($booking['room_id']) ?></td>
                <td><img style="width: 150px; height: 150px;" src="../../assets/room/<?= htmlspecialchars($booking['room_image']) ?>" alt="<?= htmlspecialchars($booking['room_title']) ?>"/></td>
                <td><?= htmlspecialchars($booking['room_title']) ?></td>
                <td><?= htmlspecialchars($booking['booking_name']) ?></td>
                <td><?= htmlspecialchars($booking['email']) ?></td>
                <td><?= htmlspecialchars($booking['phone']) ?></td>
                <td><?= htmlspecialchars($booking['checkIn']) ?></td>
                <td><?= htmlspecialchars($booking['checkOut']) ?></td>
                <td>
                  <form action="dataBooking.php" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus booking ini?');">
                    <input type="hidden" name="booking_id" value="<?= htmlspecialchars($booking['id']) ?>">
                    <button type="submit" class="btn btn-danger">Hapus</button>
                  </form>
                </td>
            </tr>
        <?php endforeach; ?>
          </tbody>
        </table>

        <div class="mt-5 pt-5"></div>

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
