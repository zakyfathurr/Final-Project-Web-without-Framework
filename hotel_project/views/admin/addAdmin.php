<?php
include_once __DIR__ . '/../../controllers/authController.php';

session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['usertype'] !== 'admin') {
    header("Location: http://localhost/hotel_project/views/auth/loginPage.php");
    exit;
}

$status = false;
$msg = null;
$success = null; // Inisialisasi variabel $success

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = trim($_POST['password']);

    if (empty($nama) || empty($email) || empty($phone) || empty($password)) {
        $msg = "Semua field wajib diisi!";
        $success = false;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "Format email tidak valid!";
        $success = false;
    } else {
        $success = tambahAdmin($nama, $email, $phone, $password);

        if ($success) {
            $msg = "berhasil menambahkan admin";
        } else {
            $msg = "Gagal mendaftarkan pengguna. Coba lagi.";
        }
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
            <h2>Add Admin</h2>
          </div>
        </div>
      </div>
    </div>
  </div>

    <div class="card container mt-3">
        <div class="mt-3">
            <?php if ($success === true): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($msg); ?>
                </div>
            <?php elseif ($success === false): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($msg); ?>
                </div>
            <?php endif; ?>

        </div>
        <div class="card-body">
        <form method="POST">
            <label for="nama">Admin Name</label>
            <div class="input-group flex-nowrap">
                <input
                    type="text"
                    class="form-control"
                    name="nama"
                    placeholder="Name"
                    aria-label="Name"
                    aria-describedby="addon-wrapping"
                    id="nama"
                />
            </div>
            <label for="email" class="mt-3">Admin Email</label>
            <div class="input-group flex-nowrap">
                <input
                    type="email"
                    class="form-control"
                    name="email"
                    placeholder="Email"
                    aria-label="Email"
                    aria-describedby="addon-wrapping"
                    id="email"
                />
            </div>
            <label for="password" class="mt-3">Admin Password</label>
            <div class="input-group flex-nowrap">
                <input
                    type="password"
                    class="form-control"
                    name="password"
                    placeholder="Password"
                    aria-label="Password"
                    aria-describedby="addon-wrapping"
                    id="password"
                />
            </div>
            <label for="phone" class="mt-3">Admin Phone Number</label>
            <div class="input-group flex-nowrap">
                <input
                    type="text"
                    class="form-control"
                    name="phone"
                    placeholder="Phone Number"
                    aria-label="Phone"
                    aria-describedby="addon-wrapping"
                    id="phone"
                />
            </div>
            <div class="d-flex justify-content-center mt-3">
                <button type="submit" class="btn btn-primary">Add Admin</button>
            </div>
        </form>

        </div>
    </div>



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