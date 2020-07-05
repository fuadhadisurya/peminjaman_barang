<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKPBK POLINDRA</title>
</head>
<body>
    <?
    include('include/config.php');
    $id=$_GET['id'];
    $query=mysqli_query($conn,"SELECT *, admin.nama AS nama_admin, pegawai.nama AS nama_pegawai, pegawai.no_hp AS no_hp_pegawai, pegawai.email AS email_pegawai, mahasiswa.nama AS nama_mahasiswa, mahasiswa.no_hp AS no_hp_mahasiswa, mahasiswa.email AS email_mahasiswa, barang.nama AS nama_barang
    FROM transaksi INNER JOIN admin ON transaksi.id_admin=admin.id LEFT JOIN pegawai ON transaksi.id_pegawai=pegawai.no_pegawai LEFT JOIN mahasiswa ON transaksi.id_mahasiswa=mahasiswa.nim INNER JOIN barang ON transaksi.id_barang=barang.kode_barang WHERE transaksi.id='$id'");
    while($row = mysqli_fetch_array($query))
    {
    ?>
    <h2 style="text-align: center"><u>SURAT KETERANGAN PEMINJAMAN BARANG KAMPUS</u></h2>
    <h3 style="text-align: center">NOMOR : <?php echo $row['no_surat']; ?></h3>
    Berdasarkan SPB Nomor : <?php echo $row['no_surat']; ?> Tanggal <?php echo $row['tanggal_pinjam']; echo" " ;echo $row['tujuan']?>
    <br>
    masing masing yang bertanda tangan dibawah ini :
    <br>
    <br>
    <table>
        <tr>
            <td>1. <?php echo $row['nama_admin'];?></td>
            <td> : </td>
            <td>AN. Kepala Bagian Peminjaman Barang Kampus Politeknik Negeri Indramayu Selanjutnya disebut <b>PIHAK PERTAMA</b></td>
        </tr>
        <tr>
            <td>
                2. <?php echo $row['nama_pegawai']; 
                if($row['nama_pegawai'] && $row['nama_mahasiswa']==TRUE){
                echo " / ";}
                echo $row['nama_mahasiswa']?>
            </td>
            <td> : </td>
            <td>Selaku peminjam barang di Kampus Politeknik Negeri Indramayu Selanjutnya disebut <b>PIHAK KEDUA</b></td>
        </tr>
    </table>
    <p><b>PIHAK PERTAMA</b> telah menyerahkan kepada <b>PIHAK KEDUA</b> dan <b>PIHAK KEDUA</b> menerima dari <b>PIHAK PERTAMA</b> barang tersebut di bawah ini dalam keadaan baik, dan cukup satuan maupun jumlahnya dengan perincian sebagai berikut : </p>
    <table border="1">
        <tr style="text-align:center;background-color:#d5d9e8">
            <th>No. Transaksi</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Merk</th>
            <th>Model</th>
            <th>Kondisi barang</th>
            <th>Unit</th>
            <th>Keterangan</th>
        </tr>
        <tr>
            <td><?php echo $row['id'] ?></td>
            <td><?php echo $row['id_barang'] ?></td>
            <td><?php echo $row['nama_barang'] ?></td>
            <td><?php echo $row['merk'] ?></td>
            <td><?php echo $row['model'] ?></td>
            <td>Baik</td>
            <td><?php echo $row['jumlah_pinjam'] ?></td>
            <td><?php echo $row['catatan'] ?></td>
        </tr>
    </table>
    <p>Selanjutnya setelah serah terima pinjam pakai barang ini, <b>PIHAK KEDUA</b> dapat mempergunakan barang terhitung sejak tanggal <?php echo $row['tanggal_pinjam']?> sampai dengan tanggal <?php echo $row['tanggal_pinjam']?> <b>PIHAK KEDUA</b> bertanggung jawab untuk barang tersebut serta sanggup untuk mengembalikan kepada kampus dalam keadaan baik dan tanpa syarat apapun juga.</p>
    <p>Apabila terjadi kehilangan atau kerusakan Barang Milik kampus tersebut, sehingga menimbulkan kerugian kampus, <b>PIHAK KEDUA</b> bertanggung jawab mutlak, dan tunduk pada peraturan yang berlaku.</p>
    <p>Demikian Surat Peminjaman Barang Kampus ini dibuat menurut keadaan yang sebenarnya.</p>
    <table style="position:relative; left: 0px;">
        <tr style="text-align:center">
            <th><b>PIHAK PERTAMA</b></th>
            <th style="width:350px"></th>
            <th><b>PIHAK KEDUA</b></th>
        </tr>
        <tr style="height:60px"></tr>
        <tr style="text-align:center">
            <td><?php echo $row['nama_admin'] ?></td>
            <td></td>
            <td>
                <?php echo $row['nama_pegawai']; 
                if($row['nama_pegawai'] && $row['nama_mahasiswa']==TRUE){
                echo "/";}
                echo $row['nama_mahasiswa']?>
            </td>
        </tr>
    </table>
    <br>
    <table border="1" cellpadding="10px" style=width:700px;height:150px">
        <tr>
            <td colspan="5" style="text-align:center">Paraf Peminjaman Barang</td>
        </tr>
        <tr>
            <td colspan="5"></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <?php } ?>
    <script>
		window.print();
	</script>
</body>
</html>