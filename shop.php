<?php
include 'conn.php';

$queryProduk = mysqli_query($conn, "SELECT * FROM produk"); 
require_once('layout/header.php');
require_once('layout/navbar.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHOP</title>
    <style>
   

section {
    margin: 20px;
    width: 100%;
    max-width: 1200px;
}


body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url('gambar/banner-bg.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            flex-direction: column;
        }

.product-container {
display: flex;
flex-wrap: wrap;
justify-content: center;
margin: 0 auto;
max-width: 1200px;
}

.product-card {
background-color: #333;
border: 1px solid #555;
border-radius: 8px;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
margin: 20px;
padding: 20px;
width: calc(25% - 40px);
box-sizing: border-box;
position: relative;
transition: transform 0.3s ease;
display: flex;
flex-direction: column;
align-items: center;
}

.product-card:hover {
transform: scale(1.05);
}

.product-title,
.product-price,
.product-stock {
color: #fff; /* Warna teks white */
}


button {
background-color: #007bff;
color: #fff;
border: none;
padding: 10px 20px;
border-radius: 4px;
cursor: pointer;
transition: background-color 0.3s ease;
}

button:hover {
background-color: #0056b3;
}

/* Menghilangkan warna latar belakang button saat hover (jika tidak diinginkan) */
button:hover {
background-color: #007bff;
}


.product-image {
    max-width: 100%;
    height: auto;
    max-height: 200px;
    border-radius: 8px;
}

.product-info {
    text-align: center;
    margin-top: 10px;
    color: #333;
}

.product-title {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 5px;
}



.action-buttons {
    margin-top: 20px;
    text-align: center;
}

.action-buttons button {
    margin-right: 10px;
}

a {
    text-decoration: none;
    color: #007bff;
    font-weight: bold;
}

a:hover {
    text-decoration: underline;
}

.whatsapp-button {
    background-color: #25d366;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    text-decoration: none;
    display: inline-block;
    margin-top: 10px;
}

.whatsapp-button:hover {
    background-color: #128c7e;
}
</style>
</head>

<body>
    <section>
        <div class="product-container">
            <?php showProducts($queryProduk); ?>
        </div>

        <div class="action-buttons">
            <button onclick="selectAll()">Pilih Semua</button>
            <button onclick="redirectToPaymentForm()">Lanjut ke Pembayaran</button>
        </div>

        <div style="margin-top: 20px; text-align: center;">
            <a href="home.php">Informasi Produk</a>
            <div>
                <a class="whatsapp-button" href="https://wa.me/6282267423365" target="_blank">BANTUAN</a>
            </div>
        </div>
    </section>

    <script>
        var selectedProducts = [];

        function addToCart(productId) {
            if (!selectedProducts.includes(productId)) {
                selectedProducts.push(productId);
            } else {
                selectedProducts = selectedProducts.filter(id => id !== productId);
            }
        }

        function selectAll() {
            selectedProducts = <?php
                                $productIds = [];
                                mysqli_data_seek($queryProduk, 0);
                                while ($rowProduk = mysqli_fetch_assoc($queryProduk)) {
                                    $productIds[] = $rowProduk['id'];
                                }
                                echo json_encode($productIds);
                                ?>;
        }

        function redirectToPaymentForm() {
            if (selectedProducts.length > 0) {
                window.location.href = 'pembayaran.php?product_ids=' + selectedProducts.join(',');
            } else {
                alert('Pilih setidaknya satu produk sebelum melanjutkan ke pembayaran.');
            }
        }
    </script>
</body>

</html>

<?php
function showProducts($queryProduk)
{
    while ($rowProduk = mysqli_fetch_assoc($queryProduk)) {
        echo '<div class="product-card">';
        echo '<img class="product-image" src="gambar/' . $rowProduk['gambar'] . '" alt="' . $rowProduk['gambar'] . '">';
        echo '<div class="product-info">';
        echo '<div class="product-title">' . $rowProduk['nama'] . '</div>';
        echo '<div class="product-price">Rp ' . number_format($rowProduk['harga']) . '</div>';
        echo '<div class="product-stock">Stok: ' . $rowProduk['stok'] . '</div>';
        echo '</div>';
        echo '<button onclick="addToCart(\'' . $rowProduk['id'] . '\')">Tambah ke Keranjang</button>';
        echo '</div>';
    }
}
?>
