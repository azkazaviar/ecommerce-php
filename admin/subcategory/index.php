<?php
include '../../config.php';

$page_admin = 'subkategori';

if (isset($_COOKIE['login_admin'])) {
    if ($akun_adm == 'false') {
        header("location: " . $url . "system/admin/logout");
    }
} else {
    header("location: " . $url . "admin/login/");
}

$select_subkategori_adm = $server->query("SELECT * FROM `subkategori`");
$jumlah_subkategori_adm = mysqli_num_rows($select_subkategori_adm);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Subkategori</title>
    <link rel="icon" href="../../assets/icons/<?php echo $logo; ?>" type="image/svg">
    <link rel="stylesheet" href="../../assets/css/admin/subcategory/index.css">
</head>

<body>
    <!-- TAMBAH subkategori FORM -->
    <div class="tambah_subkategori_form" id="tambah_subkategori_form">
        <div class="isi_tambah_subkategori_form">
            <h1>Tambah Subkategori</h1>
            <div class="box_form_tk">
                <div class="isi_box_form_tk">
                    <p id="p_nama_subkategori">Nama</p>
                    <input type="text" class="input" id="nama_subkategori" name="nama_subkategori" placeholder="Nama Subkategori" required>
                </div>
                <div class="isi_box_form_tk">
                    <p id="p_kategori">Pilih Kategori</p>
                    <select class="input" id="id_kategori" name="id_kategori" required>
                        <?php
                        $select_kategori_adm = $server->query("SELECT * FROM `kategori`");
                        while ($data_kategori = mysqli_fetch_assoc($select_kategori_adm)) {
                            echo "<option value='" . $data_kategori['id'] . "'>" . $data_kategori['nama'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="box_button_edit_akun">
                <div class="button_cancel_edit_akun" onclick="batal_add_subkategori()">
                    <p>Batal</p>
                </div>
                <div class="button_confirm_edit_akun" onclick="simpan_add_subkategori()">
                    <p id="text_tkat">Simpan</p>
                    <img src="../../assets/icons/loading-w.svg" id="loading_tkat" style="display:none;">
                </div>
            </div>
        </div>
    </div>



    <!-- HAPUS subkategori -->
    <div class="back_popup_confirm" id="confirm_hapus">
        <div class="popup_confirm">
            <div class="head_popup_confirm">
                <i class="ri-delete-bin-line"></i>
                <p>Hapus subkategori</p>
            </div>
            <h5>subkategori yang sudah di hapus tidak dapat dipulihkan kembali, produk yang subkategori nya sudah di hapus tidak akan di tampilkan, apakah anda yakin ingin manghapus subkategori ini?</h5>
            <div class="box_button_popup_confirm">
                <div class="button_cancel_popup_confirm" id="hide_confirm_hapus" onclick="batal_hapus_subkategori()">
                    <p>Batal</p>
                </div>
                <div class="button_confirm_popup_confirm" onclick="hapus_subkategori_ya()">
                    <p id="text_ha_kat">Hapus</p>
                    <img src="../../assets/icons/loading-w.svg" id="loading_ha_kat">
                </div>
            </div>
        </div>
        <input type="hidden" id="val_id_subkategori">
    </div>
    <!-- HAPUS subkategori -->

    <!-- EDIT subkategori FORM -->
    <div class="tambah_subkategori_form" id="edit_subkategori_form">
        <div class="isi_tambah_subkategori_form">
            <h1>Edit subkategori</h1>
            <div class="box_form_tk">
                <div class="isi_box_form_tk">
                    <p id="p_nama_subkategori_edit">Ubah Nama</p>
                    <input type="text" class="input" id="nama_subkategori_edit" placeholder="Nama subkategori">
                </div>
            </div>
            <div class="box_button_edit_akun">
                <div class="button_cancel_edit_akun" onclick="batal_edit_subkategori()">
                    <p>Batal</p>
                </div>
                <div class="button_confirm_edit_akun" onclick="simpan_edit_subkategori()">
                    <p id="text_ekat">Simpan</p>
                    <img src="../../assets/icons/loading-w.svg" id="loading_ekat">
                </div>
            </div>
        </div>
        <input type="hidden" id="val_id_kat_hapus">
    </div>
    <!-- EDIT subkategori FORM -->

    <div class="admin">
        <?php include '../partials/menu.php'; ?>
        <div class="content_admin">
            <h1 class="title_content_admin">subkategori</h1>
            <div class="isi_content_admin">
                <!-- CONTENT -->
                <div class="jumlah_users_admin">
                    <h1>Jumlah subkategori</h1>
                    <h1><?php echo $jumlah_subkategori_adm; ?> subkategori</h1>
                </div>
                <div class="add_subkategori_adm" onclick="show_add_subkategori()">
                    <p>Tambah subkategori</p>
                    <i class="ri-play-list-add-fill"></i>
                </div>
                <div class="all_users_admin">
                    <?php
                    while ($data_subkategori_adm = mysqli_fetch_assoc($select_subkategori_adm)) {
                        $id_subkategori_adm = $data_subkategori_adm['id'];
                        $select_produk_kat = $server->query("SELECT * FROM `iklan` WHERE `id_subkategori`='$id_subkategori_adm'");
                        $jumlah_produk_kat = mysqli_num_rows($select_produk_kat);
                    ?>
                        <div class="isi_all_users_admin">
                            <div class="box_left_aua">

                                <div class="isi_box_left_aua">
                                    <h5><?php echo $data_subkategori_adm['nama']; ?></h5>
                                </div>
                            </div>
                            <div class="box_right_aua">
                                <div class="isi_box_right_aua">
                                    <h3>Jumlah Produk</h3>
                                    <p><?php echo $jumlah_produk_kat; ?></p>
                                </div>
                            </div>
                            <div class="bu_edit_aua" onclick="show_edit_subkategori('<?php echo $data_subkategori_adm['id']; ?>', '<?php echo $data_subkategori_adm['nama']; ?>')">
                                <i class="ri-pencil-line"></i>
                            </div>
                            <div class="bu_delete_aua" onclick="show_confirm_hapus('<?php echo $data_subkategori_adm['id']; ?>')">
                                <i class="ri-delete-bin-line"></i>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <!-- CONTENT -->
            </div>
        </div>
    </div>
    <div id="res"></div>

    <!-- JS -->
    <script src="../../assets/js/admin/subcategory/index.js"></script>
    <!-- JS -->
</body>

</html>