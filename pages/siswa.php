<div class="container-lg">
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="table-responsive-lg">
                <?php
                include"koneksi.php";
                $id_terpilih;
                $data_siswa = mysqli_query($koneksi, "SELECT * FROM tb_siswa");
                ?>
                <table class="table table-secondary">
                    <thead>
                        <tr>
                            <th scope="col">NIS</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">No. Telp</th>
                            <th scope="col">Email</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Angkatan</th>
                            <th scope="col">Jurusan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while ($data = mysqli_fetch_assoc($data_siswa)){
                        ?>
                        <tr class="">
                            <td scope="row"><?=$data['nis']?></td>
                            <td><?=$data['nama_siswa']?></td>
                            <td><?=$data['telp']?></td>
                            <td><?=$data['email']?></td>
                            <td><?=$data['kelas']?></td>
                            <td><?=$data['angkatan']?></td>
                            <td><?=$data['id_jurusan']?></td>
                            <td>
                                <button name="<?=$data['nis']?>" value="<?=$data['nis']?>" type="submit"
                                    class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                    edit
                                </button>
                                <?php
                                if (isset($data['nis'])){
                                    $id_terpilih = $data['nis'];
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- The Modal -->
            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Modal Heading</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            Modal body..
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">Update</button>
                            <?php
                                echo $ceknis = $id_terpilih;
                                $result = mysqli_query($koneksi, "SELECT nis FROM tb_siswa INNER JOIN tb_sertifikat USING(nis) where nis = '$ceknis'");
                                if(mysqli_num_rows($result)>0){
                            ?>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                onclick="return alert('delete sertifikat terlebih dahulu')">Delete</button>
                            <?php
                                }else{
                            ?>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
                            <?php
                                }
                            ?>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-2"></div>
    </div>

</div>