<?php
include_once __DIR__ . '/../../controllers/authController.php';
include_once __DIR__ . '/../../controllers/roomsController.php';
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['usertype'] !== 'admin') {
    header("Location: http://localhost/hotel_project/views/auth/loginPage.php");
    exit;
}

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: http://localhost/hotel_project/views/admin/homeAdmin.php");
    exit;
}

$room = null;
$error = null;
$status = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $error = editRoom($id, $_POST);
    if (!$error) {
        $status = "Room berhasil diperbarui!";
    }
}

$rooms = getAllRooms();
foreach ($rooms as $r) {
    if ($r['id'] == $id) {
        $room = $r;
        break;
    }
}

if (!$room) {
    header("Location: http://localhost/hotel_project/views/admin/homeAdmin.php");
    exit;
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
<body>
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
                     <h2>EDIT ROOM</h2>
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
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="roomTitle">Room Title</label>
            <input type="text" class="form-control" name="room_title" value="<?=htmlspecialchars($room['room_title']);?>">

            <label for="descRoom" class="mt-3">Room Description</label>
            <textarea class="form-control" name="description"><?=htmlspecialchars($room['description']);?></textarea>

            <label for="priceRoom" class="mt-3">Room Price</label>
            <input type="text" class="form-control" name="price" value="<?=htmlspecialchars($room['price']);?>">

            <label for="roomType">Room Type</label>
            <select name="type" class="form-select">
                <option value="reguler" <?= $room['room_type'] === 'reguler' ? 'selected' : '' ?>>Reguler</option>
                <option value="premium" <?= $room['room_type'] === 'premium' ? 'selected' : '' ?>>Premium</option>
                <option value="deluxe" <?= $room['room_type'] === 'deluxe' ? 'selected' : '' ?>>Deluxe</option>
            </select>

            <label for="wifi">Free Wifi</label>
            <select name="wifi" class="form-select">
                <option value="Yes" <?= $room['wifi'] === 'Yes' ? 'selected' : '' ?>>Yes</option>
                <option value="No" <?= $room['wifi'] === 'No' ? 'selected' : '' ?>>No</option>
            </select>

            <label for="photo" class="mt-3">Photo</label>
            <input type="file" name="image" class="form-control">
            <small>biarkan jika foto tidak ingin diubah</small>

            <div class="text-center"><button type="submit" class="btn btn-primary mt-4">Update Room</button></div>
        </form>
    </div>
</body>
</html>
