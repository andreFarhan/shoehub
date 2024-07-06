<?php 
	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

    $nama_user = ucwords($_SESSION['nama_user']);

    if (isset($_GET['id_sepatu']) > 0) {
		$id_sepatu = $_GET['id_sepatu'];
		$sql = "SELECT * FROM tb_sepatu WHERE id_sepatu = '$id_sepatu' ORDER BY id_sepatu DESC";
		$eksekusi = mysqli_query($koneksi, $sql);
	}else{
		$sql = "SELECT * FROM tb_sepatu ORDER BY id_sepatu DESC";
	 	$eksekusi = mysqli_query($koneksi, $sql);
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sepatu</title>
	<link rel="icon" href="img/sneaker-fill.svg">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5">
		<h3 class="mt-3">SEPATU</h3>
		<table class="table table-striped" id="Table">
			<thead class="text-white" style="background-color: #3282b8;">
				<tr>
					<th>NO</th>
					<th>MEREK SEPATU</th>
					<th>JENIS SEPATU</th>
					<th>UKURAN</th>
					<th>HARGA</th>
					<th>AKSI</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1; while ($data = mysqli_fetch_array($eksekusi)) : ?>
				<tr>
					<td><?= $i++; ?></td>
					<td><?= $data['merek_sepatu']; ?></td>
					<td><?= $data['jenis_sepatu']; ?></td>
					<td><?= $data['ukuran_sepatu']; ?></td>
					<td>Rp <?= str_replace(",", ".", number_format($data['harga_sepatu'])); ?></td>
					<td>
						<a href="sepatu_ubah.php?id_sepatu=<?= $data['id_sepatu']; ?>" class="badge badge-success"><i class="fa fa-edit"></i></a>
						<a onclick="return confirm('Apakah anda ingin menghapus sepatu <?= $data['merek_sepatu']; ?> ?')" href="sepatu_hapus.php?id_sepatu=<?= $data['id_sepatu']; ?>" class="badge badge-danger"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
				<?php endwhile ?>
			</tbody>
		</table>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>