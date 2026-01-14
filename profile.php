<?php
include "koneksi.php";

// ambil username dari session
$username = $_SESSION['username'];

// ambil data user login
$query = mysqli_query($conn,"SELECT * FROM user WHERE username='$username'");
$data  = mysqli_fetch_assoc($query);

// proses simpan
if(isset($_POST['simpan'])){

    // update password jika diisi
    if(!empty($_POST['password'])){
        $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
        mysqli_query($conn,"UPDATE user SET password='$pass' WHERE username='$username'");
    }

    // update foto jika diupload
    if(!empty($_FILES['foto']['name'])){
        $foto = $_FILES['foto']['name'];
        $tmp  = $_FILES['foto']['tmp_name'];
        move_uploaded_file($tmp,"img/".$foto);
        mysqli_query($conn,"UPDATE user SET foto='$foto' WHERE username='$username'");
    }

    echo "<script>
        alert('Profile berhasil diperbarui');
        location='admin.php?page=profile';
    </script>";
}
?>

<form method="POST" enctype="multipart/form-data">

  <label>Username</label>
  <input type="text" class="form-control" 
         value="<?= $data['username']; ?>" readonly>

  <label class="mt-3">Ganti Password</label>
  <input type="password" name="password" class="form-control"
         placeholder="Isi jika ingin mengganti password">

  <label class="mt-3">Ganti Foto Profil</label>
  <input type="file" name="foto" class="form-control">

  <label class="mt-3">Foto Profil Saat Ini</label><br>
  <img src="img/<?= $data['foto']; ?>" width="120">

  <br><br>
  <button type="submit" name="simpan" class="btn btn-primary">
    Simpan
  </button>

</form>
