<?php
session_start();
if (!isset($_SESSION['username']) and (!isset($_SESSION['id_admin']))) {
  die;
}
include('config_query.php');
$db = new database();

$id_article = $_GET['id'];

if (!empty($id_article)) {
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
    echo "<script>alert('Anda belum memilih artikel untuk dihapus');document.location.href='index.php';</script>";
}
?>