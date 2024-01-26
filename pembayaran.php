<?php
include 'conn.php';

// Mendapatkan ID produk dari URL
if (isset($_GET['product_ids'])) {
    $productIds = explode(',', $_GET['product_ids']);
} else {
    // Redirect jika tidak ada produk yang dipilih
    header('Location: index.php');
    exit();
}

// Mengambil informasi produk dari database berdasarkan ID
$selectedProducts = [];
$totalHarga = 0;

foreach ($productIds as $productId) {
    $queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE id = '$productId'");
    $rowProduk = mysqli_fetch_assoc($queryProduk);
    $selectedProducts[] = $rowProduk;

    // Menambahkan harga produk ke total
    $totalHarga += $rowProduk['harga'];
}

// Jika formulir pembayaran disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Proses pembayaran atau penyimpanan data pembayaran ke database
    $metodePembayaran = $_POST['metode_pembayaran'];
    // Lakukan penanganan pembayaran sesuai dengan metode pembayaran yang dipilih
    // ...

    // Setelah proses pembayaran selesai, bisa diarahkan ke halaman konfirmasi atau lainnya
    header('Location: konfirmasi.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pembayaran</title>
    <!-- Tambahkan stylesheet atau gaya sesuai kebutuhan Anda -->
</head>

<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #c3b6b6;
    margin: 0;
    padding: 0;
}

header {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 10px 0;
}

section {
    margin: 20px;
}

.product-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.product-card {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin: 10px;
    padding: 20px;
    width: calc(25% - 20px);
    box-sizing: border-box;
    position: relative;
}

.product-image {
    max-width: 100%;
    height: auto;
    max-height: 200px;
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

.product-price {
    color: #007bff;
    font-size: 16px;
}

form {
    margin-top: 20px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 8px;
}

label {
    display: block;
    margin-bottom: 5px;
}

select {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

input[type="submit"] {
    background-color: #007bff;
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

ul {
    list-style: none;
    padding: 0;
}

li {
    margin-bottom: 10px;
}

footer {
    margin-top: 20px;
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 10px 0;
}

</style>
<body>

    <header>
        <h1>Form Pembayaran</h1>
        <!-- ... (Tambahkan elemen header atau navigasi sesuai kebutuhan) ... -->
    </header>
    <section>
    <h2>Ringkasan Pembelian</h2>
    <form method="post" action="" oninput="updateTotal()">
        <ul>
            <?php foreach ($selectedProducts as $product) : ?>
                <li>
                    <div class="product-summary">
                        <strong><?php echo $product['nama']; ?></strong> - Rp <?php echo number_format($product['harga']); ?>
                        <label for="quantity_<?php echo $product['id']; ?>">Jumlah:</label>
                        <input type="number" name="quantity_<?php echo $product['id']; ?>" id="quantity_<?php echo $product['id']; ?>" value="1" min="1" onchange="updateTotal()">
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>

        <p>Total Harga: Rp <span id="totalHarga"><?php echo number_format($totalHarga); ?></span></p>

        <!-- Pilihan Metode Pembayaran -->
        <label for="metode_pembayaran">Pilih Metode Pembayaran:</label>
        <select name="metode_pembayaran" id="metode_pembayaran">
            <option value="dana">Dana</option>
            <option value="gopay">Gopay</option>
            <option value="ovo">OVO</option>
            <option value="bri">BRI</option>
        </select>

        <!-- ... (Tambahkan elemen formulir pembayaran seperti nama, alamat, dll.) ... -->

        <!-- Tombol Submit -->
        <input type="submit" value="Bayar Sekarang">
    </form>

    <script>
        function updateTotal() {
            var totalHarga = 0;

            <?php foreach ($selectedProducts as $product) : ?>
                var quantity<?php echo $product['id']; ?> = parseInt(document.getElementById('quantity_<?php echo $product['id']; ?>').value);
                totalHarga += <?php echo $product['harga']; ?> * (isNaN(quantity<?php echo $product['id']; ?>) ? 0 : quantity<?php echo $product['id']; ?>);
            <?php endforeach; ?>

            document.getElementById('totalHarga').textContent = totalHarga.toLocaleString('id-ID');
        }
    </script>
</section>


    <footer>
        <!-- ... (Tambahkan elemen footer atau informasi lain sesuai kebutuhan) ... -->
    </footer>

</body>

</html>
