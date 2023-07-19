<?php

require "incudes/header.php";

$id = $_GET['id'];

$conn = mysqli_connect("localhost", "root", "", "online_shop");
$query = mysqli_query($conn, "DELETE FROM kategori WHERE id_kategori = '$id'");

if($query){
    header("Location: " . BASE_URL . "admin/kategori.php");
    exit;
}
