<?php
$title = "Lihat Produk";
require "includes/header.php";

// Asumsikan Anda telah melakukan koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "online_shop");

// Periksa apakah koneksi ke database berhasil
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}



$query = "SELECT kategori.*, barang.*
            FROM barang
            LEFT JOIN kategori ON kategori.id_kategori = barang.id_kategori
            WHERE barang.id_barang = '".$_GET['id']."'";
$barangQuery = mysqli_query($conn, $query);

?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="my-4">Detail Produk</h1>
        <?php
        if (mysqli_num_rows($barangQuery) > 0) {
            $data = mysqli_fetch_assoc($barangQuery);
            ?>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <img class="card-img-top" src="<?= BASE_URL; ?>assets/barang/<?= $data['gambar_barang']; ?>" alt="">
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card-body">
                        <h5 class="card-title"><?= $data['nama_barang']; ?></h5>
                        <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                         
                        <h6 class="card-subtitle mb-2 text-muted">Rp. <?=number_format($data['harga_barang']); ?>/<?= $data['nama_kategori']; ?></h6>
                        <form action="beli.php" method="post">
                            <div class="form-group">
                                <label for="qty">Qty:</label>
                                <input type="number" id="qty" name="qty" class="col-lg-2 form-control" value="1" required>
                                <input type="hidden" name="id_barang" value="<?= $data['id_barang']; ?>">
                            </div>
                            <input type="submit" name="beli" value="Beli" class="btn btn-primary">
                            <input type="hidden" value="<?=$_GET['id'];?>">
                        </form>
                    </div>
                </div>
            </div>
            <?php
        } else {
            echo "Produk tidak ditemukan.";
        }
        ?>
    </div>
</div>

<?php
// Asumsikan Anda telah menutup koneksi database pada akhir script
mysqli_close($conn);
require "includes/footer.php";
?>
