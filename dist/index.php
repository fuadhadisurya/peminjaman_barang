<?php
include('layout/header.php');
include('layout/navbar.php');
include('layout/sidebar.php');
include('include/config.php');
?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Admin Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Data pegawai</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="data_pegawai.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-secondary text-white mb-4">
                                    <div class="card-body">Data mahasiswa</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="data_mahasiswa.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Data barang</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="data_barang.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Data transaksi</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="data_transaksi.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Profil</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                            <?php
                            //untuk menampilkan data sebelum di update/diedit
                            $id = $_SESSION['id'];
                            $result = mysqli_query($conn, "SELECT * FROM admin WHERE id = '$id'");
                            $user = mysqli_fetch_array($result);
                            ?>
                            <form method='post'>
                                <div class="form-group row">
                                    <label for="staticNama" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control-plaintext" id="staticNama" value="<?php echo $user['nama']?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo $user['email']?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticNo_HP" class="col-sm-2 col-form-label">No. HP</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control-plaintext" id="staticNo_HP" value="<?php echo $user['no_hp']?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticAlamat" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control-plaintext" name="alamat" id="inputAlamat" rows="2" placeholder="Masukkan alamat" required="required" autofocus="autofocus"><?php echo $user['alamat'] ?></textarea>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </main>
<?php
include('layout/footer.php');
?>