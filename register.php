<?php
include 'includes/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Password di-hash menggunakan MD5
    $discord = $_POST['discord'];

    $sql = "INSERT INTO accounts (Username, Email, Password, Discord, RegisterDate, Online, Quiz, Admin, DonateRank, SecretHint, SecretWord, LoginDate, IP, LastIP, Answer1, Answer2, answered_questions, Namechanges, Phonechanges, Forum, AdminNote, Serial )
            VALUES ('$username', '$email', '$password', '$discord', NOW(), 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)";

    if ($conn->query($sql) === TRUE) {
        echo "Registrasi Berhasil!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Register</title>
</head>
<body>
    <div class="container-content">
        <h2>Register</h2>
        <form method="POST" action="register.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <label for="discord">Discord ID:</label>
            <input type="number" id="discord" name="discord" required>
            <p style="color:#ccc;"><b>Catatan</b> : Untuk Discord ID kalian dapat mengetahuinya melalui bot Official kami dengan cara <i>"Memberikan pesan pribadi kepada bot dengan menggunakan command <b>/myid</b>."</i> maka secara otomatis bot akan mengirimkan ID Discord anda.</p>
            <button type="submit">Register</button>
        </form>
        <p>Sudah memilki akun? <a href="login.php">Login</a></p>
    </div>
</body>
</html>
