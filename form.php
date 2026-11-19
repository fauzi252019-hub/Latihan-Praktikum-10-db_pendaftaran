<?php
// form.php - Form pendaftaran mahasiswa (pengembangan form Pertemuan 9)
$status = isset($_GET["status"]) ? $_GET["status"] : "";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pendaftaran Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        h1 { color: #1f3864; }
        label { display: block; margin-top: 12px; font-weight: bold; }
        label.pilihan { display: inline; font-weight: normal;
                        margin-right: 16px; }
        input[type="text"], select, textarea { width: 320px; padding: 6px; }
        button { margin-top: 16px; padding: 8px 20px; }
        .sukses { background: #e6f4ea; border-left: 5px solid #2e7d32;
                  padding: 10px; width: 320px; }
    </style>
</head>
<body>
    <h1>Pendaftaran Mahasiswa</h1>

    <?php if ($status === "sukses") { ?>
        <p class="sukses">Data mahasiswa berhasil disimpan.</p>
    <?php } ?>

    <form action="proses.php" method="post">
        <label for="nama">Nama Lengkap</label>
        <input type="text" id="nama" name="nama">

        <label for="nim">NIM</label>
        <input type="text" id="nim" name="nim">

        <label for="prodi">Program Studi</label>
        <select id="prodi" name="prodi">
            <option value="">-- Pilih Program Studi --</option>
            <option value="D3 Teknik Informatika">D3 Teknik Informatika</option>
            <option value="D3 Teknik Mesin">D3 Teknik Mesin</option>
            <option value="D3 Teknik Elektro">D3 Teknik Elektro</option>
        </select>

        <label>Jenis Kelamin</label>
        <label class="pilihan">
            <input type="radio" name="jenis_kelamin" value="Laki-laki">
            Laki-laki
        </label>
        <label class="pilihan">
            <input type="radio" name="jenis_kelamin" value="Perempuan">
            Perempuan
        </label>

        <label for="alamat">Alamat</label>
        <textarea id="alamat" name="alamat" rows="4"></textarea>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>