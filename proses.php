
<?php
// proses.php - Memvalidasi data form, lalu menyimpannya dengan INSERT

// Halaman ini hanya boleh dibuka melalui pengiriman form (POST)
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: form.php");
    exit;
}

// 1. Ambil data dan bersihkan spasi di awal/akhir
$nama          = isset($_POST["nama"])          ? trim($_POST["nama"])          : "";
$nim           = isset($_POST["nim"])           ? trim($_POST["nim"])           : "";
$prodi         = isset($_POST["prodi"])         ? trim($_POST["prodi"])         : "";
$alamat        = isset($_POST["alamat"])        ? trim($_POST["alamat"])        : "";
$jenis_kelamin = isset($_POST["jenis_kelamin"])
                 ? trim($_POST["jenis_kelamin"]) : "";

// 2. Validasi di sisi server
$daftar_prodi = array("D3 Teknik Informatika", "D3 Teknik Mesin",
                      "D3 Teknik Elektro");
$daftar_jk    = array("Laki-laki", "Perempuan");
$errors       = array();

if (empty($nama)) {
    $errors[] = "Nama lengkap tidak boleh kosong.";
} elseif (strlen($nama) > 100) {
    $errors[] = "Nama lengkap maksimal 100 karakter.";
}

if (empty($nim)) {
    $errors[] = "NIM tidak boleh kosong.";
} elseif (!ctype_digit($nim)) {
    $errors[] = "NIM hanya boleh berisi angka.";
} elseif (strlen($nim) > 20) {
    $errors[] = "NIM maksimal 20 digit.";
}

if (empty($prodi)) {
    $errors[] = "Program studi wajib dipilih.";
} elseif (!in_array($prodi, $daftar_prodi, true)) {
    $errors[] = "Program studi tidak valid.";
}

if (empty($jenis_kelamin)) {
    $errors[] = "Jenis kelamin wajib dipilih.";
} elseif (!in_array($jenis_kelamin, $daftar_jk, true)) {
    $errors[] = "Jenis kelamin tidak valid.";
}

if (empty($alamat)) {
    $errors[] = "Alamat tidak boleh kosong.";
}

// 3. Bila semua data valid, simpan ke database
$berhasil = false;
$pesan_db = "";

if (empty($errors)) {
    require_once "koneksi.php";

    $sql = "INSERT INTO mahasiswa (nim, nama, prodi, jenis_kelamin, alamat) "
         . "VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param(
            $stmt, "sssss", $nim, $nama, $prodi, $jenis_kelamin, $alamat
        );

        if (mysqli_stmt_execute($stmt)) {
            $berhasil = true;
        } else {
            $pesan_db = mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        $pesan_db = mysqli_error($koneksi);
    }
    mysqli_close($koneksi);

    // 4. Bila berhasil, kembali ke form dengan notifikasi
    if ($berhasil) {
        header("Location: form.php?status=sukses");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Penyimpanan Data</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        h1 { color: #1f3864; }
        .gagal { background: #fdecea; border-left: 5px solid #c0392b;
                 padding: 10px; }
    </style>
</head>
<body>
    <?php if (!empty($errors)) { ?>

        <h1>Data Tidak Valid</h1>
        <p class="gagal">Data belum dapat disimpan. Perbaiki kesalahan:</p>
        <ul>
            <?php foreach ($errors as $pesan) { ?>
                <li><?php echo htmlspecialchars($pesan); ?></li>
            <?php } ?>
        </ul>

    <?php } else { ?>

        <h1>Data Gagal Disimpan</h1>
        <p class="gagal">Terjadi kesalahan saat menyimpan data ke database.</p>
        <p>Pesan dari MySQL: <?php echo htmlspecialchars($pesan_db); ?></p>

    <?php } ?>

    <p><a href="javascript:history.back()">Kembali dan perbaiki data</a></p>
</body>
</html>



