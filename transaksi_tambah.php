<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	if (isset($_POST['submit'])) {
		if (tambahTransaksi($_POST) > 0) {
			setAlert('Berhasil!','Data Berhasil Ditambahkan','success');
			header("Location: transaksi_show.php");
			die;
		}
		else{
			setAlert('Gagal!','Data Gagal Ditambahkan','error');
			header("Location: transaksi_show.php");
			die;
		}
	}

	$id_user = $_SESSION['id_user'];
	$sql_user = "SELECT * FROM tb_user WHERE id_user = '$id_user'";
	$eksekusi_user = mysqli_query($koneksi, $sql_user);
	$data_user = mysqli_fetch_array($eksekusi_user);

	$sql_member = "SELECT * FROM tb_member ORDER BY id_member DESC";
	$eksekusi_member = mysqli_query($koneksi, $sql_member);

	if (isset($_GET['id_sepatu']) > 0) {
		$id_sepatu = $_GET['id_sepatu'];
		$sql_sepatu = "SELECT * FROM tb_sepatu WHERE id_sepatu = '$id_sepatu' ORDER BY id_sepatu DESC";
		$eksekusi_sepatu = mysqli_query($koneksi, $sql_sepatu);
	}else{
		$sql_sepatu = "SELECT * FROM tb_sepatu";
		$eksekusi_sepatu = mysqli_query($koneksi, $sql_sepatu);
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Tambah Transaksi</title>
	<link rel="icon" href="img/sneaker-fill.svg">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5 text-white">
		<div class="row justify-content-center">
			<div class="col-md-6 rounded" style="background-color: #005082;">
				<form method="POST">
					<h3 class="mt-3">TAMBAH TRANSAKSI</h3>

					<div class="form-group">
						<label for="id_member">MEMBER</label>
						<select class="form-control" name="id_member" id="id_member">
							<option hidden>PILIH MEMBER</option>
							<?php while ($data_member = mysqli_fetch_array($eksekusi_member)) : ?>
								<option value="<?= $data_member['id_member']; ?>"><?= $data_member['nama_member']; ?></option>
							<?php endwhile ?>
						</select>
					</div>
					<div class="form-group">
						<label for="id_sepatu">MEREK SEPATU</label>
						<select class="form-control" name="id_sepatu" id="id_sepatu">
							<?php while ($data_sepatu = mysqli_fetch_array($eksekusi_sepatu)) : ?>
								<option value="<?= $data_sepatu['id_sepatu']; ?>"><?= $data_sepatu['merek_sepatu']; ?></option>
							<?php endwhile ?>
						</select>
					</div>
					<div class="form-group">
						<label for="qty">QTY</label>
						<input type="number" name="qty" class="form-control">
					</div>
					<input type="hidden" name="pembayaran" value="Belum Dibayar">
					<input type="hidden" name="tanggal" value="<?= date('Y-m-d\TH:i:s'); ?>">
					<div class="form-group">
						<label for="id_user">ADMIN</label>
						<input class="form-control" type="text" value="<?= $data_user['nama_user']; ?>" disabled>
						<input class="form-control" type="hidden" name="id_user" value="<?= $id_user; ?>">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary" name="submit">BERIKUTNYA <i class="fa fa-arrow-right"></i></button>
						<a class="btn btn-outline-primary" href="transaksi_show.php">BATAL</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>