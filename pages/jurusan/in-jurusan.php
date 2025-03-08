<?php
if (isset($_POST['submit'])){
    do {
        $id = rand(10, 99); // Generate a random 2-digit integer
        $check_id = mysqli_query($koneksi, "SELECT id_jurusan FROM tb_jurusan WHERE id_jurusan='$id'");
    } while (mysqli_num_rows($check_id) > 0); // Check for duplicate ID and regenerate if necessary

    $jurusan = substr($_POST['jurusan'], 0, 5);

    $result = mysqli_query($koneksi, "INSERT INTO tb_jurusan VALUES ('$id','$jurusan')");

    if ($result){
        echo "<script>window.location.href = 'dashboard.php?page=re-jurusan'; alert('data berhasil masuk')</script>";
    }else{
        echo "<script>window.location.href = 'dashboard.php?page=re-jurusan'; alert('data gagal masuk')</script>";
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Input Data Jurusan</h3>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <input type="text" class="form-control" name="jurusan" id="jurusan" maxlength="5"
                                placeholder="Jurusan" required>
                        </div>
                        <button name="submit" type="submit" class="btn btn-primary w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="m-5 p-5"></div>