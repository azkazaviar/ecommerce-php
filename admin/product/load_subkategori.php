<?php
include '../../config.php';

// Ambil ID kategori dari parameter
$kategori_id = $_GET['kategori_id'] ?? null;

if ($kategori_id) {
    // Query untuk mengambil subkategori berdasarkan kategori
    $result = $server->query("SELECT `id`, `nama` FROM `subkategori` WHERE `id_kategori` = '$kategori_id'");
    $subkategoris = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $subkategoris[] = $row;
    }

    // Kembalikan data dalam format JSON
    header('Content-Type: application/json');

    if (!empty($subkategoris)) {
        echo json_encode($subkategoris);
    } else {
        echo json_encode(['empty' => true]); // Tandai jika kosong
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'ID kategori tidak valid']);
}
