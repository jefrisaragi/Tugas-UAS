<?php
require_once('layout/header.php');
require_once('layout/navbar.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataProduk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-image: linear-gradient(45deg, #1c7ed6 0%, #60e7fd 100%);
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }

        nav {
            background-color: #444;
            padding: 10px;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            padding: 8px 16px;
            margin: 0 8px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: #666;
        }

        section {
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #444;
            color: #fff;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>
    <section id="kategori">
        <h2>Kategori</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'conn.php'; // Update this with your database connection file

                $queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
                $no = 1;
                while ($rowKategori = mysqli_fetch_assoc($queryKategori)) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . $rowKategori['nama'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <section id="produk">
        <h2>Produk</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $queryProduk = mysqli_query($conn, "SELECT * FROM produk");
                $no = 1;
                while ($rowProduk = mysqli_fetch_assoc($queryProduk)) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . $rowProduk['nama'] . "</td>";
                    echo "<td>" . $rowProduk['harga'] . "</td>";
                    echo "</tr>";
                }

                // Close the database connection
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </section>

</body>

</html>
