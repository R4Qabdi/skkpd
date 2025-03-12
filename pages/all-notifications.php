<div class="container mt-5">
    <div class="card">
        <div class="card-header text-center">
            <h2>All Notifications</h2>
        </div>
        <div class="card-body">
            <?php
                $notifications = mysqli_query($koneksi, "SELECT * FROM tb_notifikasi ORDER BY tanggal DESC");
                if (mysqli_num_rows($notifications) > 0) {
                    while ($notif = mysqli_fetch_assoc($notifications)) {
                        echo "<div class='alert alert-secondary' role='alert'>
                                <p>{$notif['pesan']}</p>
                                <small class='text-muted'>{$notif['tanggal']}</small>
                              </div>";
                    }
                } else {
                    echo "<p class='text-center'>No notifications available.</p>";
                }
                ?>
        </div>
    </div>
</div>

<div class="m-5 p-5"></div>