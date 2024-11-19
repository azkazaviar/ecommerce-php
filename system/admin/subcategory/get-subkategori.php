<?php
include '../../../config.php';

$id_kategori = $_POST['id_kategori'];

// Validasi input
if (empty($id_kategori)) {
    echo json_encode([]);
    exit;
}

// Ambil subkategori berdasarkan kategori
$query = $server->query("SELECT * FROM `subkategori` WHERE `id_kategori` = '$id_kategori'");
$subkategori = [];
while ($row = $query->fetch_assoc()) {
    $subkategori[] = $row;
}

echo json_encode($subkategori);
