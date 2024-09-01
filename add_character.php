<?php
include 'includes/db_connection.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
    $char_name = $_POST['char_name'];
    $level = $_POST['level'];

    // Mendapatkan ID pengguna
    $sql = "SELECT id FROM accounts WHERE Username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];

        // Menyimpan data karakter ke database
        $sql = "INSERT INTO characters (id, char_name, level) VALUES ('$user_id', '$char_name', '1')";

        if ($conn->query($sql) === TRUE) {
            echo "Karakter berhasil ditambahkan!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "User not found!";
    }

    $conn->close();
}
?>
