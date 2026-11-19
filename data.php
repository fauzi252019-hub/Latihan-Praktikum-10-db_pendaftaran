<?php 

require_once "koneksi.php";

$sql = " SELECT * FROM  mahasiswa ";
$hasil = (mysqli_query($koneksi, $sql));
$jumlah = mysqli_num_rows ($hasil);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
   <h3>Berapakah Jumlah Data yang anda simpan di database : <?php echo $jumlah ?></h3>

   <table>
    <tr>
      <th>no</th>
      <th>nim</th>
      <th>nama</th>
      <th>program studi</th>
      <th>aksi</th>
</tr>
<?php $no=1; while ($baris = mysqli_fetch_assoc($hasil)) { ?>
<tr>
  <td><?php echo $no++; ?></td>
  <td><?php echo htmlspecialchars($baris['nim']); ?></td>
  <td><?php echo htmlspecialchars($baris['nama']); ?></td>
  <td><?php echo htmlspecialchars($baris['prodi']); ?></td>
<td>
<a href="detail.php?id=<?php echo (int) $baris["id"]; ?>">Detail</a>

<form class= "inline" action="hapus.php" method="post" onsubmit="return confirm('Yakin ingin menghapus data ini?');">

<input type ="hidden" name="id" value="<?php echo (int) $baris["id"]; ?>">

<button type="submit">Hapus</button>

</form>
</td>
</tr>
<?php } ?>
</table>



</body>
</html>


