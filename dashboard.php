<?php
include "koneksi.php";

// ===== Ambil username dari session =====
$username = $_SESSION['username'];

// ===== Ambil data user login =====
$qUser = $conn->query("SELECT * FROM user WHERE username='$username'");
$user  = $qUser->fetch_assoc();

// ===== Query Article =====
$sql1 = "SELECT * FROM article ORDER BY tanggal DESC";
$hasil1 = $conn->query($sql1);

$jumlah_article = $hasil1->num_rows;


// ===== Query Gallery =====
$sql2 = "SELECT * FROM gallery";
$hasil2 = $conn->query($sql2);
$jumlah_gallery = $hasil2->num_rows;
?>

<!-- ===== Tampilan User Login ===== -->
<div class="text-center pt-3">
    <h5>Selamat Datang,</h5>
    <h2 class="text-danger fw-bold"><?= $_SESSION['username']; ?></h2>

    <img src="img/<?= $user['foto']; ?>" 
         width="150" height="150"
         class="rounded-circle border shadow mt-3">
</div>

<!-- ===== Card Statistik ===== -->
<div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center pt-4">

    <!-- Card Article -->
    <div class="col">
        <div class="card border border-danger mb-3 shadow" style="max-width: 18rem;">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="p-3">
                        <h5 class="card-title">
                            <i class="bi bi-newspaper"></i> Article
                        </h5> 
                    </div>
                    <div class="p-3">
                        <span class="badge rounded-pill text-bg-danger fs-2">
                            <?php echo $jumlah_article; ?>
                        </span>
                    </div> 
                </div>
            </div>
        </div>
    </div> 

    <!-- Card Gallery -->
    <div class="col">
        <div class="card border border-danger mb-3 shadow" style="max-width: 18rem;">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="p-3">
                        <h5 class="card-title">
                            <i class="bi bi-camera"></i> Gallery
                        </h5> 
                    </div>
                    <div class="p-3">
                        <span class="badge rounded-pill text-bg-danger fs-2">
                            <?php echo $jumlah_gallery; ?>
                        </span>
                    </div> 
                </div>
            </div>
        </div>
    </div> 

</div>
