<?php
include '../../../config.php';
$nama_subkategori = $_POST['nama_subkategori'];
$id_kategori = $_POST['id_kategori'];
if (empty($nama_subkategori) || empty($id_kategori)) {
?>
    <script>
        alert("Nama subkategori dan kategori wajib diisi!");
        window.history.back();
    </script>
<?php
    exit;
}

$insert_add_subkategori = $server->query("INSERT INTO `subkategori`(`nama`, `id_kategori`) VALUES ('$nama_subkategori', '$id_kategori')");

if ($insert_add_subkategori) {
?>
    <script>
        alert("Subkategori berhasil ditambahkan!");
        window.location.href = 'index.php';
    </script>
<?php
} else {
?>
    <script>
        alert("Gagal menambahkan subkategori: <?php echo $server->error; ?>");
        window.history.back();
    </script>
<?php
}
?>