<?php
include 'session.php';
require 'conn.php';

require_once('layout/header.php');
require_once('layout/navbar.php');

$jumlahkategori = 0;

if (isset($_POST['simpan_kategori'])) {
    $nama = $_POST['kategori'];
    $insert = "INSERT INTO kategori (nama) VALUES (?)";
    $stmt = $conn->prepare($insert);
    $stmt->bind_param("s", $nama);

    if ($stmt->execute()) {
        echo "BERHASIL MENAMBAHKAN DATA";
        echo '<meta http-equiv="refresh" content="1;url=kategori.php">';
    } else {
        echo "Ooppss, tidak dapat menambah data. Error: " . $stmt->error;
    }

    $stmt->close();
}

$queryKategory = mysqli_query($conn, "SELECT * FROM kategori");
$jumlahkategori = mysqli_num_rows($queryKategory);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #2c3e50; /* Dark background color */
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container-fluid {
            margin-top: 20px;
        }

        h3 {
            color: #007bff;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn-primary,
        .btn-danger {
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e6f7ff;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>
    <?php require_once('layout/navbar.php'); ?>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="my-2">
                <h3>Tambah Kategori</h3>
                <form action="" method="post">
                    <div>
                        <label for="kategori">Kategori</label>
                        <input type="text" id="kategori" name="kategori" placeholder="Input Nama Kategori"
                            class="form-control">
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-primary" type="submit" name="simpan_kategori">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="mt-2">
            <h2>List Kategori</h2>
            <div class="table-responsive mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>NAMA</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($jumlahkategori == 0) {
                            ?>
                            <tr>
                                <td colspan="3" class="text-center">Data Kategori tidak tersedia</td>
                            </tr>
                        <?php
                        } else {
                            $jumlah = 1;
                            while ($row = mysqli_fetch_assoc($queryKategory)) {
                                ?>
                                <tr class="hover">
                                    <td><?php echo $jumlah; ?></td>
                                    <td><?php echo $row['nama']; ?></td>
                                    <td align="center">
                                        <a href="hps_kategori.php?id=<?php echo md5($row['id']); ?>"
                                            class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                                <?php
                                $jumlah++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
