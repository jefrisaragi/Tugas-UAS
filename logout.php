<?php
session_start();
session_destroy();
unset($_SESSION['userID']);
header('location:/distro/index.php');
exit();
?> 