<?php
// profil.php
session_start();

include 'conn.php'; // Sesuaikan dengan nama file dan path yang sesuai

// Cek apakah pengguna sudah login, jika tidak, arahkan ke halaman login
if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit();
}

// Ambil data pengguna dari sesi
$user_id = $_SESSION['userID'];

// Ambil informasi pengguna dari database (contoh: user_tbl)
$queryUserInfo = mysqli_query($conn, "SELECT * FROM user_tbl WHERE userID = '$user_id'");
$rowUserInfo = mysqli_fetch_assoc($queryUserInfo);

// Pastikan nomor HP ada sebelum mencoba mengaksesnya
$user_hp = isset($rowUserInfo['no_hp']) ? $rowUserInfo['no_hp'] : 'Nomor HP tidak tersedia';

$user_name = $rowUserInfo['nama']; // Gantilah dengan cara mengambil nama pengguna dari database atau sesuai kebutuhan
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <style>
        body {
    font-family: Arial, sans-serif;

    background-color: #333333; /* Dark gray color */
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
}

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            width: 100%;
            text-align: center;
        }

        section {
            margin: 20px;
            text-align: center;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2, h3, p {
            color: #333;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 15px;
        }

        .profile-image {
            max-width: 200px;
            border-radius: 50%;
            margin-top: 20px;
        }

        .go-to-shop {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            border: 1px solid #fff;
            padding: 8px 16px;
            margin: 0 8px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .go-to-shop:hover {
            background-color: #fff;
            color: #007bff;
        }
    </style>
</head>

<body>

<header>
    <h1>Profil Pengguna</h1>
    <div><a href="shop.php" class="go-to-shop">Pergi ke Toko</a></div>
</header>

<section>
    <h2>Selamat datang, <?php echo $user_name; ?>!</h2>

    <?php
    // Cek apakah ada gambar profil
    if (!empty($rowUserInfo['profile_image'])) {
        $uploadDirectory = "profile/" . $rowUserInfo['profile_image'];
        echo '<img class="profile-image" src="' . $uploadDirectory . '" alt="Profile Image">';
    }
    ?>

    <p><?php echo $rowUserInfo['nama']; ?></p>

    <h3>Informasi Lengkap Pengguna</h3>
    <p>ID Pengguna: <?php echo $rowUserInfo['userID']; ?></p>
    <p>Username: <?php echo $rowUserInfo['username']; ?></p>
    <p>No HP: <?php echo $user_hp; ?></p>
   
    <!-- Tambahkan kolom lain sesuai kebutuhan -->

    <button onclick="window.location.href='logout.php'">Logout</button>
</section>

</body>

</html>
