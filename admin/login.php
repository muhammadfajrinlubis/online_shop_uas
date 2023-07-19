<?php
    session_start(); // tambahkan ini untuk memulai session
    $title = "Login Admin";
    require "incudes/head.php";
    $err = ""; // tambahkan tanda "=" pada baris ini untuk menginisialisasi variabel $err

    if(isset($_POST['login'])){
        $user = $_POST['user'];
        $pass = md5($_POST['pass']);

        // Tambahkan koneksi ke database
        $conn = mysqli_connect("localhost", "root", "", "online_shop");
        if (!$conn) {
            die("Koneksi database gagal: " . mysqli_connect_error());
        }

        // Ubah query menjadi prepared statement untuk mencegah serangan SQL Injection
        $stmt = mysqli_prepare($conn, "SELECT * FROM admin WHERE user_admin = ? AND pass_admin = ?");
        mysqli_stmt_bind_param($stmt, "ss", $user, $pass);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $row = mysqli_num_rows($result);
        if($row > 0){
            // Berhasil
            $_SESSION['admin'] = true;
            header("Location: " . BASE_URL . "admin/index.php");
            exit(); // tambahkan ini untuk menghentikan eksekusi script setelah pengalihan header
        }else{
            // Gagal
            $err = "Login gagal";
        }

        mysqli_stmt_close($stmt); // tambahkan ini untuk menutup prepared statement
        mysqli_close($conn); // tambahkan ini untuk menutup koneksi ke database
    }
?>

<style>
    /* Animasi */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes slideIn {
    from {
        transform: translateY(-50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

/* Gaya */
body {
    background-color: #343a40;
}

.container {
    animation: fadeIn 1s ease-in;
}

.card-login {
    animation: slideIn 0.5s ease-in-out;
    max-width: 400px;
    margin: 0 auto;
    margin-top: 5%;
}

.card-header {
    background-color: #343a40;
    color: #fff;
    font-weight: bold;
    text-align: center;
    padding: 20px;
    border-bottom: none;
}

.card-body {
    background-color: #f8f9fa;
    padding: 20px;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
}

.form-label-group {
    position: relative;
    margin-bottom: 1.5rem;
}

.form-label-group input {
    height: auto;
    padding: 10px;
}

.form-label-group>label {
    position: absolute;
    top: 0;
    left: 0;
    display: block;
    width: 100%;
    padding: 10px;
    color: #495057;
    font-size: 0.875rem;
    pointer-events: none;
    cursor: text;
    transition: all 0.15s ease-in-out;
}

.form-label-group input:focus~label,
.form-label-group input:not(:placeholder-shown)~label {
    font-size: 0.75rem;
    top: -20px;
    left: 0;
    color: #007bff;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    background-color: #0069d9;
    border-color: #0062cc;
}

.card-body p {
    text-align: center;
    color: #dc3545;
    margin-top: 15px;
    animation: fadeIn 1s ease-in;
}

</style>
<body class="bg-dark">

    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Login</div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="text" id="inputEmail" name="user" class="form-control" placeholder="Email address" required="required" autofocus="autofocus">
                            <label for="inputEmail">Username</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="password" name="pass" id="inputPassword" class="form-control" placeholder="Password" required="required">
                            <label for="inputPassword">Password</label>
                        </div>
                    </div>
                    <!-- Ubah <a> menjadi <button> dan tambahkan atribut type="submit" -->
                    <button type="submit" class="btn btn-primary btn-block" name="login">Login</button>
                </form>

                <a href="http://localhost/online_shop/index.php">Kembali</a>
                <p><?= $err; ?></p>
            </div>
        </div>
    </div>

    <script src="<?= BASE_URL; ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= BASE_URL; ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= BASE_URL; ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
