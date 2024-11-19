function show_add_subkategori() {
  tambah_subkategori_form.style.display = "flex";
}

function batal_add_subkategori() {
  tambah_subkategori_form.style.display = "none";
}

function simpan_add_subkategori() {
  // Ambil nilai dari input
  const namaSubkategori = document.getElementById("nama_subkategori").value;
  const idKategori = document.getElementById("id_kategori").value;
  const textTkat = document.getElementById("text_tkat");
  const loadingTkat = document.getElementById("loading_tkat");

  if (!namaSubkategori || !idKategori) {
    alert("Nama subkategori dan kategori harus diisi!");
    return;
  }

  const data = new FormData();
  data.append("nama_subkategori", namaSubkategori);
  data.append("id_kategori", idKategori);

  const xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState === 1) {
      textTkat.style.display = "none";
      loadingTkat.style.display = "block";
    }
    if (this.readyState === 4 && this.status === 200) {
      textTkat.style.display = "block";
      loadingTkat.style.display = "none";

      alert("Subkategori berhasil ditambahkan!");

      window.location.reload();
    } else if (this.readyState === 4) {
      alert("Gagal menambahkan subkategori. Silakan coba lagi.");
      textTkat.style.display = "block";
      loadingTkat.style.display = "none";
    }
  };

  xhttp.open(
    "POST",
    "../../system/admin/subcategory/add-subkategori.php",
    true
  );
  xhttp.send(data);
}

function show_confirm_hapus(id_kat_hapus) {
  confirm_hapus.style.display = "flex";
  val_id_subkategori.value = id_kat_hapus;
}

function batal_hapus_subkategori() {
  confirm_hapus.style.display = "none";
  val_id_subkategori.value = "";
}

function hapus_subkategori_ya() {
  var data_hapus_subkategori = new FormData();
  data_hapus_subkategori.append(
    "val_id_subkategori",
    document.getElementById("val_id_subkategori").value
  );
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 1) {
      text_ha_kat.style.display = "none";
      loading_ha_kat.style.display = "block";
    }
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("res").innerHTML = this.responseText;
      text_ha_kat.style.display = "block";
      loading_ha_kat.style.display = "none";
      var getscriptres = document.getElementsByTagName("script");
      for (var i = 0; i < getscriptres.length - 0; i++) {
        if (getscriptres[i + 0].text != null) eval(getscriptres[i + 0].text);
      }
    }
  };
  xhttp.open(
    "POST",
    "../../system/admin/subcategory/delete-subkategori.php",
    true
  );
  xhttp.send(data_hapus_subkategori);
}

function show_edit_subkategori(id_kat_edit, nama_kat_edit, img_kat_edit) {
  edit_subkategori_form.style.display = "flex";
  val_id_kat_hapus.value = id_kat_edit;
  nama_subkategori_edit.value = nama_kat_edit;
  img_edit_subkategori.src = img_kat_edit;
}

function batal_edit_subkategori() {
  edit_subkategori_form.style.display = "none";
  val_id_kat_hapus.value = "";
}

function simpan_edit_subkategori() {
  if (nama_subkategori_edit.value == "") {
    nama_subkategori_edit.style.border = "1px solid #EA2027";
    p_nama_subkategori_edit.style.color = "#EA2027";
  } else {
    nama_subkategori_edit.style.border = "1px solid #e2e2e2";
    p_nama_subkategori_edit.style.color = "#505050";
  }
  if (nama_subkategori_edit.value) {
    var data_edit_subkategori = new FormData();
    data_edit_subkategori.append(
      "nama_subkategori_edit",
      document.getElementById("nama_subkategori_edit").value
    );
    data_edit_subkategori.append(
      "val_id_kat_hapus",
      document.getElementById("val_id_kat_hapus").value
    );
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 1) {
        text_ekat.style.display = "none";
        loading_ekat.style.display = "block";
      }
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("res").innerHTML = this.responseText;
        text_ekat.style.display = "block";
        loading_ekat.style.display = "none";
        var getscriptres = document.getElementsByTagName("script");
        for (var i = 0; i < getscriptres.length - 0; i++) {
          if (getscriptres[i + 0].text != null) eval(getscriptres[i + 0].text);
        }
      }
    };
    xhttp.open(
      "POST",
      "../../system/admin/subcategory/edit-subkategori.php",
      true
    );
    xhttp.send(data_edit_subkategori);
  }
}
