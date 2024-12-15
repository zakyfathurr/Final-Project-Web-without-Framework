<?php
include_once __DIR__ . '/../config/db.php';

session_start();
session_unset();
session_destroy();
header('Location:  http://localhost/hotel_project/views/auth/loginPage.php');
exit();
?>