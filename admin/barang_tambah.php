<?php
    $title = "Tambah Barang";
    require "incudes/header.php";

    if(isset($_POST['insert'])){
        $nama = $_POST['nama'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];
        $satuan = $_POST['satuan'];
        $gambar = $_FILES['gambar']['name'];
        $kategori = $_POST['kategori'];
        $gambar_tmp = $_FILES['gambar']['tmp_name'];
        $path = "../assets/barang/";
            if(move_uploaded_file($gambar_tmp, $path . $gambar)){
            $conn = mysqli_connect("localhost", "root", "", "online_shop");
            $query = mysqli_query($conn, "INSERT INTO barang (nama_barang, harga_barang, stok_barang, satuan_barang, id_kategori, gambar_barang) VALUES ('$nama', '$harga', '$stok', '$satuan', '$kategori', '$gambar')");

            if($query){
                header("Location: " . BASE_URL . "admin/barang.php");
                exit;
            }
        }
    }
?>

<div id="content-wrapper">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?=BASE_URL;?>admin/">Dashboard</a>
                <li class="breadcrumb-item">
            </li>
                
                <a href="<?=BASE_URL;?>admin/barang.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item active"> Tambah Barang</li>
          
        </ol>

        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i> Tambah Data Barang
            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" name="nama" class="form-control" placeholder="Nama Barang required">
                            </div>
                            <div class="form-group">
                                <label>Harga Barang</label>
                                <input type="number" name="harga" class="form-control" placeholder="Harga Barang required">
                            </div>
                            <div class="form-group">
                                <label>Stok Barang</label>
                                <input type="number" name="stok" class="form-control" placeholder="Stok Barang required">
                            </div>
                            <div class="form-group">
                                <label>Satuan Barang</label>
                                <input type="text" name="satuan" class="form-control" placeholder="Satuan Barang required">
                            </div>
                            <div class="form-group">
                                <label>Gambar Barang</label>
                                <input type="file" name="gambar" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Kategori</label>
                                <select name="kategori" id="" class="form-control" required>
                                    <option value="">Pilih Kategori</option>
                                    <?php
                                        $conn = mysqli_connect("localhost", "root", "", "online_shop");
                                        $query_kategori = mysqli_query($conn, "SELECT * FROM kategori");
                                        while($kategori = mysqli_fetch_assoc($query_kategori)){
                                            echo "<option value='".$kategori['id_kategori']."'>".$kategori['nama_kategori']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="insert" value="Tambah" class="btn btn-sm btn-info">
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
