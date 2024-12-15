<?php
include_once __DIR__ . '/../config/db.php';

/**
 * Fungsi untuk login
 * @param string $username
 * @param string $password
 */
function login($email, $password)
{
    global $conn;

    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    var_dump($user);
    var_dump($password);
    if ($user && password_verify($password, $user['password'])) {

        return [
            'status' => true,
            'user' => [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'phone' => $user['phone'],
                'usertype' => $user['usertype'],
                'photo_profile_path' => $user['photo_profile_path'],
            ],
        ];
    } else {
        return [
            'status' => false,
            'message' => 'Invalid email or password!',
        ];
    }
}

/**
 * Fungsi untuk logout
 */
function logout()
{
    session_unset();
    session_destroy();
    header('Location:  http://localhost/hotel_project/views/auth/loginPage.php');
    exit();
}

function tambahUser($nama, $email, $phone, $role, $password)
{
    global $conn;

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $sql = "INSERT INTO users (name, email, phone, usertype, password, created_at, updated_at) VALUES (?, ?, ?, ?, ?, NOW(), NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nama, $email, $phone, $role, $hashedPassword);

    return $stmt->execute();
}

function tambahPelanggan($nama, $email, $phone, $password)
{
    $role = "user";
    return tambahUser($nama, $email, $phone, $role, $password);
}

function tambahAdmin($nama, $email, $phone, $password)
{
    $role = "admin";
    return tambahUser($nama, $email, $phone, $role, $password);
}




