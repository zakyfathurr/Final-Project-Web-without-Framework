<?php

include_once __DIR__ . '/../config/db.php';

function getRoomDetails($roomId) {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM rooms WHERE id = ?");
    $stmt->bind_param("i", $roomId);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_assoc();
}

function addBooking($data) {
    global $conn;

    // Periksa apakah tanggal booking tumpang tindih
    $stmt = $conn->prepare("SELECT COUNT(*) FROM bookings WHERE room_id = ? AND (checkIn < ? AND checkOut > ?)");
    $stmt->bind_param(
        "iss",
        $data['room_id'],
        $data['checkOut'], // Check jika tanggal keluar dari booking baru lebih besar dari check-in yang sudah ada
        $data['checkIn']  // Dan check jika tanggal masuk dari booking baru lebih kecil dari check-out yang sudah ada
    );
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        // Jika ada booking yang tumpang tindih, return false atau error
        return [
            'success' => false,
            'message' => 'Tanggal booking ini sudah dipesan. Silakan pilih tanggal lain.'
        ];
    }

    // Jika tidak ada konflik, lanjutkan insert booking
    $stmt = $conn->prepare("INSERT INTO bookings (room_id, name, email, phone, checkIn, checkOut, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())");
    $stmt->bind_param(
        "isssss",
        $data['room_id'],
        $data['name'],
        $data['email'],
        $data['phone'],
        $data['checkIn'],
        $data['checkOut']
    );

    $result = $stmt->execute();
    $stmt->close();

    return [
        'success' => $result,
        'message' => $result ? 'Booking berhasil!' : 'Terjadi kesalahan saat booking.'
    ];
}


function getBookingDetails() {
    global $conn;

    $stmt = $conn->prepare("
        SELECT bookings.id, bookings.room_id, bookings.name AS booking_name, bookings.email, bookings.phone, bookings.checkIn, bookings.checkOut, 
               rooms.room_title, rooms.price, rooms.room_type, rooms.image AS room_image
        FROM bookings
        INNER JOIN rooms ON bookings.room_id = rooms.id
    ");
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    $bookings = [];
    
    while ($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }
    
    return $bookings;
}

function deleteBooking($id)
{
    global $conn;

    $sql = "DELETE FROM bookings WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        return null; 
    } else {
        return "Error: " . $stmt->error;
    }
}

?>