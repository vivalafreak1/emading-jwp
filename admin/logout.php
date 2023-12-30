<?php
session_start();

// Unset semua session Variabel
unset($_SESSION['username']);
unset($_SESSION['id_admin']);

// Unset All
session_unset();

// Destroy Session
session_destroy();

// Arahkan ke halaman Login
header('location: ../login.php?pesan=logout');
exit;
