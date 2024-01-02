<?php
include('config_query.php');
$db = new database();
session_start();
$id_admin = $_SESSION['id_admin'];
$action = $_GET['aksi'];

if ($action == "add") {
    // Insert Data
    // File checking if already choose

    // echo "<pre>";
    // print_r($_FILES);
    // echo "</pre>";
    // die;

    if ($_FILES["imageurl"]["name"] != '') {
        $tmp = explode('.', $_FILES['imageurl']['name']); // Memecah nama file dan extension
        $ext = end($tmp); // Mengambil extension
        $filename = $tmp[0]; // Mengambil nilai nama file tanpa extension
        $allowed_ext = array("jpg", "png", "jpeg", "webp");

        if (in_array($ext, $allowed_ext)) { // Cek validasi extension

            if ($_FILES["imageurl"]["size"] <= 1280000) { // cek ukuran gambar, maks 1mb
                $name = $filename . '_' . rand() . '.' . $ext; // Rename nama file gambar
                $path = "../files/" . $name; // lokasi upload file
                $uploaded = move_uploaded_file($_FILES["imageurl"]["tmp_name"], $path); // Memindahkan file

                if ($uploaded) {
                    $insertData = $db->insert_data(
                        $name,
                        $_POST["title"],
                        $_POST["content"],
                        $_POST["ispublished"],
                        $id_admin
                    ); // Query insert data
                    
                    if ($insertData) {
                        echo "<script>alert('Data berhasil ditambahkan');document.location.href = 'index.php';</script>";
                    } else {
                        echo "<script>alert('Maaf, data gagal ditambahkan');document.location.href = 'index.php';</script>";
                    }
                } else {
                    echo "<script>alert('Maaf, upload file gagal');document.location.href = 'insert_data.php';</script>";
                }
            } else {
                echo "<script>alert('Maaf, ukuran gambar lebih dari 1Mb');document.location.href = 'insert_data.php';</script>";
            }
        } else {
            echo "<script>alert('Maaf, file yang diupload tidak sesuai extension yang diizinkan');document.location.href = 'insert_data.php';</script>";
        }
    } else {
        echo "<script>alert('Silahkan pilih file gambar');document.location.href = 'insert_data.php';</script>";
    }
} elseif ($action == "edit") {
    // Edit Data
} elseif ($action == "delete") {
    // Delte data
} else {
    echo "<script>alert('Anda tidak mendapatkan akses untuk operasi ini!');document.location.href = 'index.php';</script>";
}


?>