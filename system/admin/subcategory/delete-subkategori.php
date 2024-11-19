<?php
include '../../../config.php';

$val_id_subkategori = $_POST['val_id_subkategori'];

$hapus_subkategori_adm = $server->query("DELETE FROM `subkategori` WHERE `id`='$val_id_subkategori' ");

if ($hapus_subkategori_adm) {
?>
    <script>
        confirm_hapus.style.display = 'none';
        val_id_subkategori.value = '';
        window.location.href = 'index.php';
    </script>
<?php
}
?>