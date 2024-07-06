<?php 
	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

    $nama_user = ucwords($_SESSION['nama_user']);

    $sql = "SELECT * FROM tb_sepatu";
    $eksekusi = mysqli_query($koneksi, $sql);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Shoe Hub</title>
	<link rel="icon" href="img/sneaker-fill.svg">
	<link rel="stylesheet" href="bootstrap/css/charity.css">
</head>
<body>
	<?php include 'nav.php'; ?>

	<div class="container mt-3">
	
		<div class="alert alert-info text-center">
			<h4><b>Selamat Datang <b><?= $nama_user; ?></b></b></h4>
		</div>
		
        <div class="row">

            <div class="col-lg-10 col-12 text-center mx-auto">
                <h2 class="mb-5 text-dark">Produk Kami</h2>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0">
                <div class="featured-block d-flex justify-content-center align-items-center">
					<a href="transaksi_tambah.php?id_sepatu=1" class="d-block">
						<img src="img/nike.jpg" width="125px" class="featured-block-image img-fluid">

                        <p class="featured-block-text"><strong>Nike</strong></p>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0">
                <div class="featured-block d-flex justify-content-center align-items-center">
					<a href="transaksi_tambah.php?id_sepatu=2" class="d-block">
						<img src="img/adidas.jpg" width="125px" class="featured-block-image img-fluid">

                        <p class="featured-block-text"><strong>Adidas</strong></p>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 mb-md-4">
                <div class="featured-block d-flex justify-content-center align-items-center">
					<a href="transaksi_tambah.php?id_sepatu=3" class="d-block">
						<img src="img/ventela.jpg" width="125px" class="featured-block-image img-fluid">

                        <p class="featured-block-text"><strong>Ventela</strong></p>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 mb-md-4">
                <div class="featured-block d-flex justify-content-center align-items-center">
					<a href="transaksi_tambah.php?id_sepatu=4" class="d-block">
						<img src="img/pantofel.jpg" width="125px" class="featured-block-image img-fluid">

                        <p class="featured-block-text"><strong>Pantofel</strong></p>
                    </a>
                </div>
            </div>

        </div>
    </div>
</body>

<?php include 'footer.php'; ?>

</html>