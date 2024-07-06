<?php 
	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	$id_sepatu = $_GET['id_sepatu'];

	if (hapusSepatu($id_sepatu) > 0) {
		setAlert('Berhasil!','Data Berhasil Dihapus','success');
		header("Location: sepatu_show.php");
		die;
	}
	else{
		setAlert('Gagal!','Data Gagal Dihapus','error');
		header("Location: sepatu_show.php");
		die;
	}
?>