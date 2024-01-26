<?php
include 'conn.php';

if(isset($_POST['add'])){
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $detai = $_POST['detai'];
    $stok = $_POST['stok'];

    // Upload gambar
    $nama_file_gambar = $_FILES['gambar']['name'];
    $lokasi_file_gambar = $_FILES['gambar']['tmp_name'];
    $folder_gambar = 'gambar/';

    // Check file type
    $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
    $file_info = pathinfo($nama_file_gambar);
    $file_extension = strtolower($file_info['extension']);

    if (in_array($file_extension, $allowed_types)) {
        // Generate unique file name
        $unique_file_name = uniqid('img_', true) . '.' . $file_extension;

        // Pindahkan gambar ke folder yang ditentukan dengan nama unik
        move_uploaded_file($lokasi_file_gambar, $folder_gambar . $unique_file_name);

        // Simpan data produk ke database dengan prepared statement
        $queryTambahProduk = "INSERT INTO produk (nama, harga, detai, stok, gambar) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($queryTambahProduk);
        $stmt->bind_param("sssss", $nama, $harga, $detai, $stok, $unique_file_name);

        if ($stmt->execute()) {
            echo "Successfully add data";
        } else {
            echo "Oops, cannot add data: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Invalid file type. Allowed types: jpg, jpeg, png, gif";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRODUK</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Roboto', sans-serif;
            color: #212529;
            padding-top: 20px;
        }

        #content {
            margin-top: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        table {
            margin: auto;
            border-collapse: collapse;
            width: 80%;
            color: #212529;
        }

        th,
        td {
            border: none;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        .btn-outline-primary {
            border-color: #007bff;
            color: #007bff;
            border-radius: 5px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .btn-outline-primary:hover {
            background-color: #0056b3;
        }

        .btn-outline-bg-danger {
            background-color: #dc3545;
            color: white;
            border: none;
        }

        .btn-outline-bg-danger:hover {
            background-color: #c82333;
        }

        .form-table-container {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }

        .form-table-container form,
        .form-table-container table {
            width: 45%;
        }
    </style>
</head>

<body>
    <?php
    require_once('layout/header.php');
    require_once('layout/navbar.php');
    ?>

    <div id="content">
        <div class="form-table-container">
            <!-- Form -->
            <form action="addproduk.php" method="POST" enctype="multipart/form-data">
                <table align="center">
                    <tr>
                        <td><input type="text" name="nama" class="form-control" placeholder="Input Nama" required></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="harga" class="form-control" placeholder="Input Harga" required></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="detai" class="form-control" placeholder="Input Detail"></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="stok" class="form-control" placeholder="Input Stok" required></td>
                    </tr>
                    <tr>
                        <td><input type="file" name="gambar" accept="image/*" class="form-control" required></td>
                    </tr>
                    <tr>
                        <td><input class="btn btn-outline-primary" type="submit" name="add" value="Add"></td>
                    </tr>
                </table>
            </form>

            <!-- Tabel -->
            <table align="center" border="1" cellspacing="0" width="80%" class="btn btn-outline-bg-danger">
                <tr>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Detail</th>
                    <th>STOK</th>
                    <th>Action</th>
                </tr>
                <?php
                $sql = "SELECT * FROM produk";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_array()) {
                ?>
                        <tr class="hover">
                            <td align="center"><?php echo $row['nama']; ?></td>
                            <td align="center"><?php echo $row['harga']; ?></td>
                            <td align="center"><?php echo $row['detai']; ?></td>
                            <td align="center"><?php echo $row['stok']; ?></td>
                            <td align="center"><a href="edit.php?id=<?php echo md5($row['id']); ?>">Edit</a>/<a
                                    href="delete.php?id=<?php echo md5($row['id']); ?>">Delete</a></td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='5' align='center'>No Records</td></tr>";
                }
                $conn->close();
                ?>
            </table>
        </div>
    </div>
</body>

</html>
