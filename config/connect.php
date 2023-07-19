<?php
define("BASE_URL","http://localhost/online_shop/");
define("WEBNAME","online_shop");
$host = "localhost";
$user = "root";
$password ="";
$database ="online_shop";

// membuat kineksi
// 1.OOP (Object Orianted Program)
$conn = new mysqli($host,$user,$password,$database);
if($conn->connect_error){
    die("Koneksi Gagal :".$conn->connect_errno);
}
?>