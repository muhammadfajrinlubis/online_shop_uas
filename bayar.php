<?php
$title = "Bayar Produk";
require "includes/header.php";

$conn = mysqli_connect("localhost", "root", "", "online_shop");

// Periksa apakah koneksi ke database berhasil
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

if (isset($_POST['bayar'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $telp = mysqli_real_escape_string($conn, $_POST['phone']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);

    $insert = mysqli_query($conn, "INSERT INTO customer (nama_customer, alamat_customer, telp_customer) VALUES ('$nama', '$alamat', '$telp')");

    if ($insert) {
        $cust_id = mysqli_insert_id($conn);

        $qty = $_POST['qty'];
        $id = $_POST['id_barang'];

        $setpenjualan = mysqli_query($conn, "INSERT INTO penjualan (qty_penjualan, id_barang, id_customer) VALUES ('$qty', '$id', '$cust_id')");

        if ($setpenjualan) {
            $Qbarang = mysqli_query($conn, "SELECT * FROM barang WHERE id_barang = '$id'");
            $data = mysqli_fetch_assoc($Qbarang);
            ?>
            <div class="row">
                <div class="col-md-12">
                    <h2>Detail Yang Harus Dibayar</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama barang</th>
                                <th>Harga Satuan</th>
                                <th>Qty</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $data['nama_barang']; ?></td>
                                <td>Rp.<?= number_format($data['harga_barang']); ?></td>
                                <td><?= $qty; ?></td>
                                <td>Rp.<?= number_format($data['harga_barang'] * $qty); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <h3>Total yang Harus Dibayar: Rp.<?= number_format($data['harga_barang'] * $qty); ?></h3>
                </div>
                <div class="col-md-12">
                    <hr>
                    <p>Informasi Pembayaran </p>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    <p>Why do we use it? It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                </div>
            </div>
            <?php
        } else {
            // Handle error when setting penjualan fails
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Handle error when inserting customer fails
        echo "Error: " . mysqli_error($conn);
    }
}

// Tutup koneksi database setelah selesai menggunakan
mysqli_close($conn);

require "includes/footer.php";
?>
