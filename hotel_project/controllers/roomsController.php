<?php
include_once __DIR__ . '/../config/db.php';


function addRoom($request)
{
    global $conn;

    $room_title = $request['room_title'];
    $description = $request['description'];
    $price = $request['price'];
    $room_type = $request['type'];
    $wifi = $request['wifi'];
    $image = $_FILES['image'];

    $imagename = null;
    if ($image && $image['tmp_name']) {
        if ($image['error'] !== UPLOAD_ERR_OK) {
            return "Error saat mengupload file: " . $image['error'];
        }

        $imagename = time() . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);

        $targetDirectory = __DIR__ . '/../assets/room/';
        if (!is_dir($targetDirectory)) {
            mkdir($targetDirectory, 0755, true);
        }

        $targetFile = $targetDirectory . $imagename;
        if (!move_uploaded_file($image['tmp_name'], $targetFile)) {
            return "Gagal memindahkan file ke folder tujuan.";
        }
    }

    $sql = "INSERT INTO rooms (room_title, description, price, room_type, wifi, image, created_at, updated_at) 
            VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $room_title, $description, $price, $room_type, $wifi, $imagename);

    if ($stmt->execute()) {
        return null; 
    } else {
        return "Error: " . $stmt->error;
    }
}


function getAllRooms()
{
    global $conn;

    $sql = "SELECT * FROM rooms";
    $result = $conn->query($sql);

    $rooms = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $rooms[] = $row;
        }
    }

    return $rooms;
}

function deleteRoom($id)
{
    global $conn;

    $sql = "SELECT image FROM rooms WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        return "Kamar dengan ID tersebut tidak ditemukan.";
    }

    $room = $result->fetch_assoc();
    $imagePath = __DIR__ . '/../assets/room/' . $room['image'];

    if (file_exists($imagePath) && is_file($imagePath)) {
        unlink($imagePath);
    }

    $sql = "DELETE FROM rooms WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        return null; 
    } else {
        return "Error: " . $stmt->error;
    }
}

function editRoom($id, $request)
{
    global $conn;

    $room_title = $request['room_title'];
    $description = $request['description'];
    $price = $request['price'];
    $room_type = $request['type'];
    $wifi = $request['wifi'];
    $image = $_FILES['image'];

    $imagename = null;

    if ($image && $image['tmp_name']) {
        if ($image['error'] !== UPLOAD_ERR_OK) {
            return "Error saat mengupload file: " . $image['error'];
        }

        $imagename = time() . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);

        $targetDirectory = __DIR__ . '/../assets/room/';
        if (!is_dir($targetDirectory)) {
            mkdir($targetDirectory, 0755, true);
        }

        $targetFile = $targetDirectory . $imagename;
        if (!move_uploaded_file($image['tmp_name'], $targetFile)) {
            return "Gagal memindahkan file ke folder tujuan.";
        }

        // Hapus gambar lama
        $sql = "SELECT image FROM rooms WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $room = $result->fetch_assoc();
            $oldImagePath = __DIR__ . '/../assets/room/' . $room['image'];
            if (file_exists($oldImagePath) && is_file($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
    } else {
        // Ambil nama gambar lama jika tidak ada gambar baru diunggah
        $sql = "SELECT image FROM rooms WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $room = $result->fetch_assoc();
            $imagename = $room['image']; // Gunakan gambar lama
        }
    }

    $sql = "UPDATE rooms 
            SET room_title = ?, description = ?, price = ?, room_type = ?, wifi = ?, image = ?, updated_at = NOW() 
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $room_title, $description, $price, $room_type, $wifi, $imagename, $id);

    if ($stmt->execute()) {
        return null;
    } else {
        return "Error: " . $stmt->error;
    }
}




?>