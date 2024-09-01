<?php
include 'includes/db_connection.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

$sql = "SELECT id, Username, RegisterDate, admin FROM accounts WHERE Username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_id = $row['id'];
    $register_date = $row['RegisterDate'];
    $admin = $row['admin'];
    $role = ($admin == 1) ? "Admin" : "Player";

    // Query untuk mendapatkan karakter-karakter pengguna
    $char_sql = "SELECT char_name, level FROM characters WHERE account_id='$user_id'";
    $char_result = $conn->query($char_sql);
} else {
    echo "User not found!";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Dashboard</title>
</head>
<body>
    <div class="container">
        <h2>Akun UCP Anda adalah : <?php echo $username; ?></h2>
        <p>Anda sebagai <span class="role"><?php echo $role; ?></span>!</p>
        <p>Akun ini Anda buat pada <?php echo $register_date; ?></p>

        <h3>Karakter yang Anda Miliki</h3>
        <table>
            <thead>
                <tr>
                    <th>Nama Karakter</th>
                    <th>Level</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($char_result->num_rows > 0) {
                    while ($char_row = $char_result->fetch_assoc()) {
                        echo "<tr><td>" . htmlspecialchars($char_row['char_name']) . "</td><td>" . htmlspecialchars($char_row['level']) . "</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>Anda belum memiliki karakter.</td></tr>";
                }
                ?>
            </tbody>
        </table>
<br>
        <h3>Tambah Karakter Baru</h3>
        <form method="POST" action="add_character.php">
            <label for="char_name">Nama Karakter:</label>
            <input type="text" id="char_name" name="char_name" required>
            <button type="submit">Tambah Karakter</button>
        </form>
<br>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
