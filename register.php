<?php
include 'conn.php';

session_start();

// Initialize the $message variable
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['no_hp']) && isset($_POST['nama'])) {
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $no_hp = $_POST['no_hp'];
        $nama = $_POST['nama'];

        // Specify the directory where you want to save the image
        $uploadDirectory = 'profile/';

        // Get information about the uploaded file
        $profileImageName = $_FILES['profile_image']['name'];
        $profileImageTmpName = $_FILES['profile_image']['tmp_name'];
        $profileImageSize = $_FILES['profile_image']['size'];
        $profileImageError = $_FILES['profile_image']['error'];

        // Move the image to the desired directory
        move_uploaded_file($profileImageTmpName, $uploadDirectory . $profileImageName);

        // Use prepared statements for security
        $stmt = $conn->prepare("INSERT INTO user_tbl (username, password, no_hp, nama, profile_image) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $user, $pass, $no_hp, $nama, $profileImageName);

        if ($stmt->execute()) {
            $message = "Registration successful!";
        } else {
            // Log detailed error for yourself
            error_log("Registration attempt failed: " . $stmt->error);

            // Provide user-friendly error message
            $message = "Registration failed. Please try again later.";
        }

        $stmt->close();
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 16px;
            line-height: 1.6;
            background-color: #f2f2f2;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .form-container {
            background: #fff;
            width: 400px;
            box-sizing: border-box;
            padding: 30px;
            border: 2px solid #f5ba1a;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            transform-origin: 50% 0%;
            transform: scale3d(1, 1, 1);
            transition: none;
            animation: expand 0.8s 0.6s ease-out forwards;
            opacity: 0;
        }

        h2 {
            font-size: 2em;
            line-height: 1.2em;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: #555;
        }

        input[type="text"],
        input[type="password"],
        input[type="tel"],
        input[type="file"] {
            width: calc(100% - 24px);
            padding: 12px;
            margin-bottom: 20px;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            color: #666;
        }

        button {
            background: #f5ba1a;
            color: #fff;
            padding: 15px 20px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.3s ease;
            width: 100%;
        }

        button:hover {
            background: #e1a115;
        }

        .message {
            margin-top: 20px;
            font-size: 16px;
            color: #27ae60;
            text-align: center;
        }

        .login-button {
            text-align: center;
            margin-top: 20px;
        }

        a {
            color: #333;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #f5ba1a;
        }

        @keyframes expand {
            0% {
                transform: scale3d(1, 0, 1);
                opacity: 0;
            }

            25% {
                transform: scale3d(1, 1.2, 1);
            }

            50% {
                transform: scale3d(1, 0.85, 1);
            }

            75% {
                transform: scale3d(1, 1.05, 1);
            }

            100% {
                transform: scale3d(1, 1, 1);
                opacity: 1;
            }
        }
    </style>
</head>

<body>

    <div class="form-container">
        <h2>Registration Form</h2>
        <form id="registrationForm" action="" method="post" enctype="multipart/form-data">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="no_hp">Phone Number:</label>
            <input type="text" id="no_hp" name="no_hp" required>

            <label for="nama">Name:</label>
            <input type="text" id="nama" name="nama" required>


            <label for="profile_image">Profile Image:</label>
            <input type="file" id="profile_image" name="profile_image" accept="image/*">

            <button type="submit">Register</button>
        </form>

        <div class="message"><?php echo $message; ?></div>

        <div class="login-button">
            <a href="index.php"><button>Login</button></a>
        </div>
    </div>

</body>

</html>
