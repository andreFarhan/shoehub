<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	if (isset($_POST['submit'])) {
		if (tambahSepatu($_POST) > 0) {
			setAlert('Berhasil!','Data Berhasil Ditambahkan','success');
			header("Location: sepatu_show.php");
			die;
		}
		else{
			setAlert('Gagal!','Data Gagal Ditambahkan','error');
			header("Location: sepatu_show.php");
			die;
		}
	}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Tambah Sepatu</title>
	<link rel="icon" href="img/sneaker-fill.svg">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5 text-white">
		<div class="row justify-content-center">
			<div class="col-md-6 rounded" style="background-color: #005082;">
				<form method="POST">
					<h3 class="mt-3">TAMBAH SEPATU</h3>
					<div class="form-group">
						<label for="merek_sepatu">MEREK SEPATU</label>
						<input type="text" class="form-control" name="merek_sepatu" required>
					</div>
					<div class="form-group">
						<label for="jenis_sepatu">JENIS SEPATU</label>
						<select name="jenis_sepatu" class="form-control" required>
							<option hidden>PILIH JENIS SEPATU</option>
							<option value="Sneakers">Sneakers</option>
							<option value="Flat Shoes">Flat Shoes</option>
							<option value="Pantofel">Pantofel</option>
							<option value="Boots">Boots</option>
						</select>
					</div>
					<div class="form-group">
						<label for="ukuran_sepatu">UKURAN SEPATU</label>
						<input type="number" class="form-control" name="ukuran_sepatu" required>
					</div>
					<div class="form-group">
						<label for="harga_sepatu">HARGA SEPATU</label>
						<input type="number" class="form-control" name="harga_sepatu" required>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary" name="submit">TAMBAH <i class="fa fa-paper-plane"></i></button>
						<a class="btn btn-outline-primary" href="sepatu_show.php">BATAL</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>