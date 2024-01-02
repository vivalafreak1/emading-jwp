<?php
include('config_query.php');
$db = new database();
session_start();
$id_admin = $_SESSION['id_admin'];
$action = $_GET['aksi'];

if ($action == "add") {
    // Insert Data
    // File checking if already choose

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
    $id_article = $_POST['id_article'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $ispublished = $_POST['ispublished'];

    // Check if a new image is uploaded
    if ($_FILES["imageurl"]["name"] != '') {
        $tmp = explode('.', $_FILES['imageurl']['name']);
        $ext = end($tmp);
        $filename = $tmp[0];
        $allowed_ext = array("jpg", "png", "jpeg", "webp");

        if (in_array($ext, $allowed_ext)) {
            if ($_FILES["imageurl"]["size"] <= 1280000) {
                $name = $filename . '_' . rand() . '.' . $ext;
                $path = "../files/" . $name;
                $uploaded = move_uploaded_file($_FILES["imageurl"]["tmp_name"], $path);

                if ($uploaded) {
                    // Update data with new image
                    $updateData = $db->update_data(
                        $name,
                        $title,
                        $content,
                        $ispublished,
                        $id_article,
                        $id_admin
                    );
                } else {
                    echo "<script>alert('Maaf, upload file gagal');document.location.href = 'edit.php?id=$id_article';</script>";
                }
            } else {
                echo "<script>alert('Maaf, ukuran gambar lebih dari 1Mb');document.location.href = 'edit.php?id=$id_article';</script>";
            }
        } else {
            echo "<script>alert('Maaf, file yang diupload tidak sesuai extension yang diizinkan');document.location.href = 'edit.php?id=$id_article';</script>";
        }
    } else {
        // Update data without changing the image
        $updateData = $db->update_data(
            'not_set',
            $title,
            $content,
            $ispublished,
            $id_article,
            $id_admin
        );
    }

    if ($updateData) {
        echo "<script>alert('Data berhasil diubah');document.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Maaf, data gagal diubah');document.location.href = 'edit.php?id=$id_article';</script>";
    }
} elseif ($action == "delete") {
    // Delete data
    $id_article = $_GET['id'];

    // Check if the article exists
    $data = $db->get_by_id($id_article);
    if (empty($data)) {
        echo "<script>alert('Id artikel tidak ditemukan!');document.location.href='index.php';</script>";
    } else {
        // Perform the delete operation
        $deleteData = $db->delete_data($id_article);

        if ($deleteData) {
            echo "<script>alert('Data berhasil dihapus');document.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('Maaf, data gagal dihapus');document.location.href = 'index.php';</script>";
        }
    }
} else {
    echo "<script>alert('Anda tidak mendapatkan akses untuk operasi ini!');document.location.href = 'index.php';</script>";
}

?>