<?php
$title = "Beli Produk";
require "includes/header.php";
?>

<form action="bayar.php" method="POST">
    <div class="row">
        <div class="col-md-4">
            <h2>Isi Detail Informasi Mu</h2>
            <div class="form-group">
                <div class="form-label-group">
                    <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" required>
                </div>
            </div>
            <div class="form-group">
                <div class="form-label-group">
                    <input type="text" class="form-control" name="phone" placeholder="No. Telp" required>
                </div>
            </div>
            <div class="form-group">
                <div class="form-label-group">
                    <textarea class="form-control" placeholder="Alamat Lengkap" name="alamat" required></textarea>
                </div>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-sm btn-success" name="bayar" value="Bayar Sekarang">
                <input type="hidden" name="qty" value="<?= $_POST['qty']; ?>">
                <input type="hidden" name="id_barang" value="<?= $_POST['id_barang']; ?>">
            </div>
        </div>
    </div>
</form>

<?php
// Asumsikan Anda telah menutup koneksi database pada akhir script
require "includes/footer.php";
?>
