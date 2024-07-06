<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	if (isset($_POST['submit'])) {
		if (ubahTransaksi($_POST) > 0) {
			setAlert('Berhasil!','Data Berhasil Diubah','success');
			header("Location: transaksi_show.php");
			die;
		}
		else{
			setAlert('Gagal!','Data Gagal Diubah','error');
			header("Location: transaksi_show.php");
			die;
		}
	}

	$id_transaksi = $_GET['id_transaksi'];

	$id_user = $_SESSION['id_user'];
	$sql_user = "SELECT * FROM tb_user WHERE id_user = '$id_user'";
	$eksekusi_user = mysqli_query($koneksi, $sql_user);
	$data_user = mysqli_fetch_array($eksekusi_user);

	$sql_member = "SELECT * FROM tb_member ORDER BY id_member DESC";
	$eksekusi_member = mysqli_query($koneksi, $sql_member);

	$sql_sepatu = "SELECT * FROM tb_sepatu ORDER BY id_sepatu DESC";
	$eksekusi_sepatu = mysqli_query($koneksi, $sql_sepatu);

	$sql_transaksi = "SELECT * FROM tb_transaksi 
					LEFT OUTER JOIN tb_member ON tb_member.id_member = tb_transaksi.id_member
					LEFT OUTER JOIN tb_sepatu ON tb_sepatu.id_sepatu = tb_transaksi.id_sepatu
					WHERE id_transaksi = '$id_transaksi'";
	$eksekusi_transaksi = mysqli_query($koneksi, $sql_transaksi);
	$data_transaksi = mysqli_fetch_array($eksekusi_transaksi);


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ubah Transaksi</title>
	<link rel="icon" href="img/sneaker-fill.svg">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5 text-white">
		<div class="row justify-content-center">
			<div class="col-md-6 rounded" style="background-color: #005082;">
				<form method="POST">
					<h3 class="mt-3">UBAH TRANSAKSI</h3>
					<input type="hidden" name="id_transaksi" value="<?= $data_transaksi['id_transaksi']; ?>">
					<div class="form-group">
						<label for="id_member">MEMBER</label>
						<select class="form-control" name="id_member" id="id_member">
							<option value="<?= $data_transaksi['id_member']; ?>" hidden><?= $data_transaksi['nama_member']; ?></option>
							<?php while ($data_member = mysqli_fetch_array($eksekusi_member)) : ?>
								<option value="<?= $data_member['id_member']; ?>"><?= $data_member['nama_member']; ?></option>
							<?php endwhile ?>
						</select>
					</div>
					<div class="form-group">
						<label for="id_sepatu">SEPATU</label>
						<select class="form-control" name="id_sepatu" id="id_sepatu">
							<option value="<?= $data_transaksi['id_sepatu']; ?>" hidden><?= $data_transaksi['merek_sepatu']; ?></option>
							<?php while ($data_sepatu = mysqli_fetch_array($eksekusi_sepatu)) : ?>
								<option value="<?= $data_sepatu['id_sepatu']; ?>"><?= $data_sepatu['merek_sepatu']; ?></option>
							<?php endwhile ?>
						</select>
					</div>
					<div class="form-group">
						<label for="qty">QTY</label>
						<input type="number" name="qty" value="<?= $data_transaksi['qty']; ?>" class="form-control">
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