<?php
session_start();

unset($_SESSION['name']);
unset($_SESSION['email']);
unset($_SESSION['phone']);
unset($_SESSION['user_type']);

header("Location: http://localhost/fruitables/shop.php");
?>