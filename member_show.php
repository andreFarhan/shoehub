<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}
	
	if (isset($_GET['id_member']) > 0) {
		$id_member = $_GET['id_member'];
		$sql = "SELECT * FROM tb_member WHERE id_member = '$id_member' ORDER BY id_member DESC";
		$eksekusi = mysqli_query($koneksi, $sql);
	}else{
		$sql = "SELECT * FROM tb_member ORDER BY id_member DESC";
	 	$eksekusi = mysqli_query($koneksi, $sql);
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Member</title>
	<link rel="icon" href="img/sneaker-fill.svg">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5">
		<h3 class="mt-3">MEMBER</h3>
		<table class="table table-striped" id="Table">
			<thead class="text-white" style="background-color: #3282b8">
				<tr>
					<th width="1%">NO</th>
					<th>NAMA</th>
					<th width="15%">JENIS KELAMIN</th>
					<th>ALAMAT</th>
					<th width="15%">NO. HP</th>
					<th width="1%">AKSI</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1; while ($data = mysqli_fetch_array($eksekusi)) : ?>
				<tr>
					<td><?= $i++; ?></td>
					<td><?= $data['nama_member']; ?></td>
					<td><?= $data['jenis_kelamin']; ?></td>
					<td><?= $data['alamat_member']; ?></td>
					<td><?= $data['telp_member']; ?></td>
					<td>
						<a href="member_ubah.php?id_member=<?= $data['id_member']; ?>" class="badge badge-success"><i class="fa fa-edit"></i></a>
						<a onclick="return confirm('Apakah anda ingin menghapus member <?= $data['nama_member']; ?> ?')" href="member_hapus.php?id_member=<?= $data['id_member']; ?>" class="badge badge-danger"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
				<?php endwhile ?>
			</tbody>
		</table>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>
