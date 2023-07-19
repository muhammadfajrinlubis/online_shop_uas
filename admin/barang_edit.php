<?php
    $title = "Update Barang";
    require "incudes/header.php";

    // Periksa apakah form telah disubmit
    if(isset($_POST['update'])){
        $id_barang = $_POST['id_barang'];
        $nama = $_POST['nama'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];
        $satuan = $_POST['satuan'];
        $kategori = $_POST['kategori'];

        $conn = mysqli_connect("localhost", "root", "", "online_shop");

        // Perbarui data tanpa mengubah foto
        if(empty($_FILES['gambar']['name'])){
            $query = mysqli_query($conn, "UPDATE barang SET nama_barang='$nama', harga_barang='$harga', stok_barang='$stok', satuan_barang='$satuan', id_kategori='$kategori' WHERE id_barang='$id_barang'");
        }
        // Perbarui data dengan foto
        else {
            $gambar = $_FILES['gambar']['name'];
            $gambar_tmp = $_FILES['gambar']['tmp_name'];
            $path = "../assets/barang/";

            if(move_uploaded_file($gambar_tmp, $path . $gambar)){
                $query = mysqli_query($conn, "UPDATE barang SET nama_barang='$nama', harga_barang='$harga', stok_barang='$stok', satuan_barang='$satuan', id_kategori='$kategori', gambar_barang='$gambar' WHERE id_barang='$id_barang'");
            }
        }

        if($query){
            header("Location: " . BASE_URL . "admin/barang.php");
            exit;
        }
    }

    // Ambil data barang yang dipilih
    $id_barang = $_GET['id'];
    $conn = mysqli_connect("localhost", "root", "", "online_shop");
    $query_barang = mysqli_query($conn, "SELECT * FROM barang WHERE id_barang='$id_barang'");
    $barang = mysqli_fetch_assoc($query_barang);
?>

<div id="content-wrapper">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Tables</li>
        </ol>

        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i> Contoh Tabel Data
            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="hidden" name="id_barang" value="<?php echo $barang['id_barang']; ?>">
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" name="nama" class="form-control" placeholder="Nama Barang required" value="<?php echo $barang['nama_barang']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Harga Barang</label>
                                <input type="number" name="harga" class="form-control" placeholder="Harga Barang required" value="<?php echo $barang['harga_barang']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Stok Barang</label>
                                <input type="number" name="stok" class="form-control" placeholder="Stok Barang required" value="<?php echo $barang['stok_barang']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Satuan Barang</label>
                                <input type="text" name="satuan" class="form-control" placeholder="Satuan Barang required" value="<?php echo $barang['satuan_barang']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Gambar Barang</label>
                                <input type="file" name="gambar" class="form-control">
                                <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                            </div>
                            <div class="form-group">
                                <label>Kategori</label>
                                <select name="kategori" id="" class="form-control" required>
                                    <option value="">Pilih Kategori</option>
                                    <?php
                                        $query_kategori = mysqli_query($conn, "SELECT * FROM kategori");
                                        while($kategori = mysqli_fetch_assoc($query_kategori)){
                                            $selected = ($kategori['id_kategori'] == $barang['id_kategori']) ? "selected" : "";
                                            echo "<option value='".$kategori['id_kategori']."' $selected>".$kategori['nama_kategori']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="update" value="Update" class="btn btn-sm btn-info">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Tombol Keluar</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>

<script src="<?=BASE_URL;?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?=BASE_URL;?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?=BASE_URL;?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?=BASE_URL;?>assets/js/sb-admin.min.js"></script>

</body>

</html>
