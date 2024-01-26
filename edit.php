<?php
include 'conn.php';
include 'session.php';

$id = $_GET['id'];
$view = "SELECT * from produk where md5(id) = '$id'";
$result = $conn->query($view);
$row = $result->fetch_assoc();

if(isset($_POST['update'])){

	$ID = $_GET['id'];

	$nama = $_POST['nama'];
	$harga = $_POST['harga'];
	$detai = $_POST['detai'];
	$stok = $_POST['stok'];
	$insert = "UPDATE produk set nama = '$nama', harga = '$harga', detai = '$detai', stok = '$stok' where md5(id) = '$ID'";
	if($conn->query($insert)== TRUE){

			echo "Sucessfully update data";
			header('location:addproduk.php');			
	}else{

		echo "Ooppss cannot add data" . $conn->error;
		header('location:addproduk.php');
	}
	$conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link rel="stylesheet" type="text/css" href="mycss.css">
    <style>
        body {
            background-color: black;
            color: white;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        #body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        #menu {
            background-color: #333;
            padding: 10px;
            width: 100%;
            text-align: center;
        }

        #menu ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        #menu ul li {
            display: inline;
            margin-right: 20px;
        }

        #content {
            padding: 20px;
            border: 1px solid #333;
            border-radius: 10px;
            margin-top: 20px;
        }

        table {
            width: 100%;
        }

        table input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        table td {
            padding: 10px;
        }

        table tr:nth-child(odd) {
            background-color: #444;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div id="body">
        <div id="menu">
            <ul>
                <?php
                require_once('layout/header.php');
                require_once('layout/navbar.php');
                ?>
            </ul>
        </div>
        <div id="content">
            <h2>Edit Produk</h2>
            <form action="" method="POST">
                <table>
                    <tr>
                        <td>Nama:</td>
                        <td><input type="text" name="nama" value="<?php echo $row['nama']; ?>" placeholder="Nama" required></td>
                    </tr>
                    <tr>
                        <td>Harga:</td>
                        <td><input type="text" name="harga" value="<?php echo $row['harga']; ?>" placeholder="" required></td>
                    </tr>
                    <tr>
                        <td>Detail:</td>
                        <td><input type="text" name="detai" value="<?php echo $row['detai']; ?>" placeholder="" required></td>
                    </tr>
                    <tr>
                        <td>Stok:</td>
                        <td><input type="text" name="stok" value="<?php echo $row['stok']; ?>" placeholder="" required></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" name="update" value="Update"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>

</html>
