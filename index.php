<?php
$title = "Home";
require "includes/header.php";

// Asumsikan Anda telah melakukan koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "online_shop");

// Periksa apakah koneksi ke database berhasil
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$query = "";

if (isset($_GET['filter'])) {
                $filter = mysqli_real_escape_string($conn, $_GET['filter']); // Melindungi dari serangan SQL Injection
                $query = "SELECT * FROM barang WHERE id_kategori = '$filter'";
            } elseif (isset($_GET['s'])) {
                $search = mysqli_real_escape_string($conn, $_GET['s']); // Melindungi dari serangan SQL Injection
                $key = "%" . $search . "%";
                $query = "SELECT * FROM barang WHERE nama_barang LIKE '$key'";
            } else {
                $query = "SELECT * FROM barang ORDER BY id_barang DESC";
            }

$barangQuery = mysqli_query($conn, $query);
?>


<div class="row">
    <div class="col-lg-3">
        <h1 class="my-4">Nama Shop</h1>
        <div class="btn btn-success">
            <a href="<?= BASE_URL; ?>" class="list-group-item">Semua Kategori</a>
            <?php
            $Qkategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY nama_kategori ASC");
            while ($kategori = mysqli_fetch_assoc($Qkategori)) {
                ?>
                <a href="?filter=<?= $kategori['id_kategori']; ?>" class="list-group-item"><?= $kategori['nama_kategori']; ?></a>
                <?php
            }
            ?>
        </div>
    </div>

    <div class="col-lg-9">
        <div class="row">
            <div class="col-lg-12 mt-3">
                <form action="" method="get" class="form-search-c">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="search" value="<?php if(isset($_GET['s'])){echo $_GET['s'];}?>" name="s" class="form-control" placeholder="Masukkan Nama Produk">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="submit" class="btn btn-info btn-sm" value="Cari Produk">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <?php
            if (mysqli_num_rows($barangQuery) > 0) {
                while ($data = mysqli_fetch_assoc($barangQuery)) {
                    ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <a class="link-image-product" href="tampil.php?id=<?= $data['id_barang']; ?>">
                                <img class="card-img-top" src="<?= BASE_URL; ?>assets/barang/<?= $data['gambar_barang']; ?>" >
                            </a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="tampil.php?id=<?= $data['id_barang']; ?>"><?= $data['nama_barang']; ?></a>
                                </h4>
                                <h5>Rp. <?=number_format($data['harga_barang']); ?></h5>
                            </div>
                            <div class="card-footer">
                                <a class="btn-beli" href="tampil.php?id=<?= $data['id_barang']; ?>">BELI</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<div class='col-lg-12'>Tidak ada produk yang ditampilkan.</div>";
            }
            ?>
        </div>
    </div>
</div>
<?php
// Asumsikan Anda telah menutup koneksi database pada akhir script
mysqli_close($conn);
require "includes/footer.php";
?>
