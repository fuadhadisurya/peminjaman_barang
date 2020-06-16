<div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Main</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-tachometer-alt"></i>
                                </div>
                            Dashboard</a>
                            <div class="sb-sidenav-menu-heading">Data</div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                Data user
                                <div class="sb-sidenav-collapse-arrow">
                                    <i class="fas fa-angle-down"></i>
                                </div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="data_pegawai.php">Data pegawai</a>
                                    <a class="nav-link" href="data_mahasiswa.php">Data mahasiswa</a>
                                </nav>
                            </div>
                            <a class="nav-link" href="data_barang.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-boxes"></i></div>
                            Data barang</a>
                            <div class="sb-sidenav-menu-heading">Transaksi</div>
                            <a class="nav-link" href="form_transaksi.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-plus"></i></div>
                            Form transaksi</a>
                            <a class="nav-link" href="data_transaksi.php"
                                ><div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Transaksi</a>
                            <a class="nav-link" href="data_laporan.php"
                                ><div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                            Laporan Transaksi</a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?=$_SESSION['email'];?>
                    </div>
                </nav>
            </div>