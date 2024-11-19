<?php
include '../../../config.php';

$nama_subkategori_edit = $_POST['nama_subkategori_edit'];
$val_id_kat_hapus = $_POST['val_id_kat_hapus'];

if (empty($nama_subkategori_edit) || empty($val_id_kat_hapus)) {
  echo "<script>
            alert('Nama subkategori dan ID wajib diisi!');
            window.history.back();
          </script>";
  exit;
}

$update_subkategori = $server->query("UPDATE `subkategori` SET `nama`='$nama_subkategori_edit' WHERE `id`='$val_id_kat_hapus'");

if ($update_subkategori) {
  echo "<script>
            alert('Subkategori berhasil diperbarui!');
            window.location.href = 'index.php';
          </script>";
} else {
  echo "<script>
            alert('Gagal memperbarui subkategori: {$server->error}');
            window.history.back();
          </script>";
}
