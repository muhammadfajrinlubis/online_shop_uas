<?php
    $title = "Daftar penjualan";
    require "incudes/header.php";

    $conn = mysqli_connect("localhost", "root", "", "online_shop");
    if (!$conn) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    $query = mysqli_query($conn, "SELECT barang.*, penjualan.*, customer.* FROM penjualan
                                LEFT JOIN barang ON barang.id_barang = penjualan.id_barang
                                LEFT JOIN customer ON customer.id_customer = penjualan.id_penjualan");
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
                <i class="fas fa-table"></i> Data Table Penjualan
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NO.</th>
                                <th>Nama Pembeli</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(mysqli_num_rows($query) > 0){
                                    $no = 1;
                                    $total = 0;
                                    while($data = mysqli_fetch_assoc($query)){
                                        $total += $data['qty_penjualan'] * $data['harga_barang'];
                            ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $data['nama_customer']; ?></td>
                                <td><?= $data['nama_barang']; ?></td>
                                <td style="text-align:right">Rp.<?= number_format($data['harga_barang'], 0, ',', '.'); ?></td>
                                <td style="text-align:right"><?= $data['qty_penjualan']; ?></td>
                                <td style="text-align:right"><?= number_format($data['qty_penjualan'] * $data['harga_barang'], 0, ',', '.'); ?></td>
                            </tr>
                            <?php
                                    }
                                    echo "<tr>
                                            <td style='text-align:right' colspan='5'>Total</td>
                                            <td style='text-align:right'>Rp. ".number_format($total, 0, ',', '.').",-</td>
                                          </tr>";
                                } else {
                                    echo "<tr><td colspan='6'><center>belum ada data</center></td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
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
<script src="<?=BASE_URL;?>assets/vendor/datatables/jquery.dataTables.js"></script>
<script src="<?=BASE_URL;?>assets/vendor/datatables/dataTables.bootstrap4.js"></script>
<script src="<?=BASE_URL;?>assets/js/sb-admin.min.js"></script>
<script src="<?=BASE_URL;?>assets/js/demo/datatables-demo.js"></script>

</body>
</html>
