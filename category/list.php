<?php
include '../config.php';

// Validasi dan ambil data kategori
$idkategori = $_GET['idkategori'] ?? null;

if (!$idkategori) {
    die("Error: ID Kategori tidak ditemukan.");
}

$kategori = $server->query("SELECT * FROM `kategori` WHERE `id`='$idkategori'");

if ($kategori && $kategori->num_rows > 0) {
    $kategori_data = mysqli_fetch_assoc($kategori);
} else {
    die("Error: Kategori tidak ditemukan.");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes" />
    <title><?php echo htmlspecialchars($kategori_data['nama']); ?></title>
    <link rel="icon" href="../../assets/icons/<?php echo $logo; ?>" type="image/svg">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/category/list.css">
</head>

<body>
    <!-- HEADER -->
    <?php include '../partials/header.php'; ?>
    <!-- HEADER -->

    <!-- CONTENT -->
    <div class="width">
        <div class="title_kategori">
            <p>Kategori <span><?php echo htmlspecialchars($kategori_data['nama']); ?></span></p>
        </div>

        <!-- SUBKATEGORI -->
        <div class="subkategori_section">
            <h2>Subkategori</h2>
            <ul>
                <?php
                $subkategori = $server->query("SELECT * FROM `subkategori` WHERE `id_kategori`='$idkategori'");

                if ($subkategori && $subkategori->num_rows > 0) {
                    while ($subkategori_data = mysqli_fetch_assoc($subkategori)) {
                        echo '<li><a href="' . $url . 'subcategory/list.php?idsubkategori=' . $subkategori_data['id'] . '">' . htmlspecialchars($subkategori_data['nama']) . '</a></li>';
                    }
                } else {
                    echo "<p>Tidak ada subkategori yang ditemukan untuk kategori ini.</p>";
                }
                ?>
            </ul>
        </div>
        <!-- END SUBKATEGORI -->

    </div>

    <!-- FOOTER -->
    <?php include '../partials/footer.php'; ?>
    <!-- FOOTER -->
</body>

</html>
