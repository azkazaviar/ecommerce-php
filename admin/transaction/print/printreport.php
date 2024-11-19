<?php
include '../../../config.php';

// Menangkap parameter bulan dan tahun dari URL
$bulan = isset($_GET['bulan']) ? intval($_GET['bulan']) : date('m');
$tahun = isset($_GET['tahun']) ? intval($_GET['tahun']) : date('Y');

// Query untuk mengambil data laporan bulanan dengan format waktu YY-MM-DD HH:MM:SS
$query = $server->prepare("SELECT id_user, id_iklan, SUM(harga_i) AS total_pendapatan, COUNT(id_invoice) AS jumlah_transaksi
                           FROM invoice
                           WHERE MONTH(waktu) = ? AND YEAR(waktu) = ? AND tipe_progress = 'Selesai'
                           GROUP BY id_user, id_iklan");
$query->bind_param('ii', $bulan, $tahun);
$query->execute();
$result = $query->get_result();

// Memeriksa apakah data ditemukan
if ($result->num_rows > 0) {
    $data_laporan = $result->fetch_all(MYSQLI_ASSOC);
} else {
    die("Data tidak ditemukan untuk bulan dan tahun tersebut.");
}

// Menutup query
$query->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan Bulanan - <?php echo $bulan; ?>-<?php echo $tahun; ?></title>
    <link rel="icon" href="../../../../assets/icons/<?php echo $logo; ?>" type="image/svg">
    <link rel="stylesheet" href="../../../../assets/css/admin/transaction/print/report.css">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="report-title">
                    <img src="../../../../assets/icons/<?php echo $logo; ?>" style="width: 40px; height: 40px; margin-right: 15px; margin-top: -12px;">
                    <h2>Laporan Penjualan Bulanan</h2>
                    <h3 class="pull-right">Bulan: <?php echo $bulan; ?>, Tahun: <?php echo $tahun; ?></h3>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-12">
                        <table class="table table-bordered table-condensed">
                            <thead>
                                <tr>
                                    <th>ID User</th>
                                    <th>ID Iklan</th>
                                    <th>Jumlah Transaksi</th>
                                    <th>Total Pendapatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total_pendapatan_bulanan = 0;
                                foreach ($data_laporan as $row) {
                                    // Menjumlahkan pendapatan total bulanan
                                    $total_pendapatan_bulanan += $row['total_pendapatan'];
                                    ?>
                                    <tr>
                                        <td><?php echo $row['id_user']; ?></td>
                                        <td><?php echo $row['id_iklan']; ?></td>
                                        <td class="text-center"><?php echo $row['jumlah_transaksi']; ?></td>
                                        <td class="text-right">Rp <?php echo number_format($row['total_pendapatan'], 0, ".", "."); ?></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="3" class="text-right"><strong>Total Pendapatan Bulanan:</strong></td>
                                    <td class="text-right"><strong>Rp <?php echo number_format($total_pendapatan_bulanan, 0, ".", "."); ?></strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.print(); // Memanggil print dialog ketika halaman dibuka
    </script>
</body>
</html>
