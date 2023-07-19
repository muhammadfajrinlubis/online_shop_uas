<?php
    $title = "Hapus Barang";
    require "incudes/header.php";

    // Periksa apakah parameter ID barang telah diberikan
    if(isset($_GET['id'])){
        $id_barang = $_GET['id'];
        $conn = mysqli_connect("localhost", "root", "", "online_shop");

        // Hapus data barang berdasarkan ID
        $query = mysqli_query($conn, "DELETE FROM barang WHERE id_barang='$id_barang'");

        if($query){
            header("Location: " . BASE_URL . "admin/barang.php");
            exit;
        }else {
            echo "<script>alert('Anda Yakin Ingin Menghapus..!');</script>";
        }
    }
?>