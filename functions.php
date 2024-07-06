<?php 
	
	session_start();

	$host = "localhost";
	$user = "root";
	$password = "";
	$database = "db_shoehub";

	$koneksi = mysqli_connect($host,$user,$password,$database);

	date_default_timezone_set('asia/jakarta');

	function tambahSepatu($data){
		global $koneksi;
		$merek_sepatu = ucwords(strtolower($data['merek_sepatu']));
		$jenis_sepatu = $data['jenis_sepatu'];
		$ukuran_sepatu = $data['ukuran_sepatu'];
		$harga_sepatu = $data['harga_sepatu'];

		$sql = "INSERT INTO tb_sepatu VALUES('','$merek_sepatu','$jenis_sepatu','$ukuran_sepatu','$harga_sepatu')";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function tambahUser($data){
		global $koneksi;
		$username = $data['username'];
		$password = $data['password'];
		$password2 = $data['password2'];
		$nama_user = ucwords(strtolower($data['nama_user']));
		$jenis_kelamin = $data['jenis_kelamin'];
		$alamat_user = $data['alamat_user'];
		$telp_user = $data['telp_user'];

		$result = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$username'");

		if (mysqli_fetch_assoc($result)) {
			setAlert('Gagal!','Username Telah Digunakan','error');
			header("Location: user_tambah.php");
			die;
		}
		if ($password !== $password2) {
			setAlert('Gagal!','Konfirmasi Password Salah','error');
			header("Location: user_tambah.php");
			die;
		}

		$password = password_hash($password, PASSWORD_DEFAULT);

		$sql = "INSERT INTO tb_user VALUES('','$username','$password','$nama_user','$jenis_kelamin','$alamat_user', '$telp_user')";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);

	}

	function tambahMember($data){
		global $koneksi;
		$nama_member = ucwords(strtolower($data['nama_member']));
		$jenis_kelamin = $data['jenis_kelamin'];
		$alamat_member = $data['alamat_member'];
		$telp_member = $data['telp_member'];

		$result = mysqli_query($koneksi, "SELECT * FROM tb_member WHERE nama_member = '$nama_member'");

		if (mysqli_fetch_assoc($result)) {
			echo "
			<script>
			alert('Nama Pelanggan Sudah Digunakan!')
			</script>
			";	
		}

		$sql = "INSERT INTO tb_member VALUES('','$nama_member','$jenis_kelamin','$alamat_member','$telp_member')";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function tambahTransaksi($data){
		global $koneksi;
		$id_member = $data['id_member'];
		$id_sepatu = $data['id_sepatu'];
		$qty = $data['qty'];
		$pembayaran = $data['pembayaran'];
		$tanggal = $data['tanggal'];
		$id_user = $data['id_user'];


		$sql = "INSERT INTO tb_transaksi VALUES('','$id_member','$id_sepatu','$qty','$pembayaran','$tanggal','$id_user')";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_insert_id($koneksi);
	}

	function ubahUser($data){
		global $koneksi;
		$id_user = $data['id_user'];
		$username = $data['username'];
		$password = $data['password'];
		$password_hash = password_hash($password, PASSWORD_DEFAULT);
		$password2 = $data['password2'];
		$password_lama = $data['password_lama'];
		$nama_user = ucwords(strtolower($data['nama_user']));
		$jenis_kelamin = $data['jenis_kelamin'];
		$alamat_user = $data['alamat_user'];
		$telp_user = $data['telp_user'];

		$result = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$username'");
		$fetch = mysqli_fetch_assoc($result);
		$password_lama_verify = password_verify($password_lama, $fetch['password']);

		if ($password !== $password2) {
			echo "
			<script>
			alert('Konfirmasi Password tidak sama!')
			</script>
			";
			return false;
		}

		if ($password_lama_verify) {
			$sql = "UPDATE tb_user SET nama_user = '$nama_user', password = '$password_hash', jenis_kelamin = '$jenis_kelamin', alamat_user = '$alamat_user', telp_user = '$telp_user' WHERE id_user = '$id_user'";
			$eksekusi = mysqli_query($koneksi, $sql);

			return mysqli_affected_rows($koneksi);
		}else{
			echo "
			<script>
			alert('Password Lama tidak benar!')
			</script>
			";
			return false;
		}

	}

	function ubahSepatu($data){
		global $koneksi;
		$id_sepatu = $data['id_sepatu'];
		$merek_sepatu = ucwords(strtolower($data['merek_sepatu']));
		$jenis_sepatu = $data['jenis_sepatu'];
		$ukuran_sepatu = $data['ukuran_sepatu'];
		$harga_sepatu = $data['harga_sepatu'];

		$sql = "UPDATE tb_sepatu SET merek_sepatu = '$merek_sepatu', jenis_sepatu = '$jenis_sepatu', ukuran_sepatu = '$ukuran_sepatu', harga_sepatu = '$harga_sepatu' WHERE id_sepatu = '$id_sepatu'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function ubahMember($data){
		global $koneksi;
		$id_member = $data['id_member'];
		$nama_member = ucwords(strtolower($data['nama_member']));
		$alamat_member = $data['alamat_member'];
		$jenis_kelamin = $data['jenis_kelamin'];
		$telp_member = $data['telp_member'];

		$sql = "UPDATE tb_member SET nama_member = '$nama_member', alamat_member = '$alamat_member', jenis_kelamin = '$jenis_kelamin', telp_member = '$telp_member' WHERE id_member = '$id_member'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function ubahTransaksi($data){
		global $koneksi;
		$id_transaksi = $data['id_transaksi'];
		$id_member = $data['id_member'];
		$id_sepatu = $data['id_sepatu'];
		$qty = $data['qty'];
		$pembayaran = $data['pembayaran'];
		$tanggal = $data['tanggal'];
		$id_user = $data['id_user'];

		$sql = "UPDATE tb_transaksi SET id_member = '$id_member', id_sepatu = '$id_sepatu', qty = '$qty',pembayaran = '$pembayaran', tanggal = '$tanggal', id_user = '$id_user' WHERE id_transaksi = '$id_transaksi'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function hapusSepatu($id){
		global $koneksi;
		$sql = "DELETE FROM tb_sepatu WHERE id_sepatu = '$id'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function hapusUser($id){
		global $koneksi;
		$sql = "DELETE FROM tb_user WHERE id_user = '$id'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}
	
	function hapusMember($id){
		global $koneksi;
		$sql = "DELETE FROM tb_member WHERE id_member = '$id'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function hapusTransaksi($id){
		global $koneksi;
		$sql = "DELETE FROM tb_transaksi WHERE id_transaksi = '$id'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function setAlert($title='',$text='',$type='',$buttons=''){

		$_SESSION["alert"]["title"]		= $title;
		$_SESSION["alert"]["text"] 		= $text;
		$_SESSION["alert"]["type"] 		= $type;
		$_SESSION["alert"]["buttons"]	= $buttons; 

	}

	if (isset($_SESSION['alert'])) {

		function alert(){
			$title 		= $_SESSION["alert"]["title"];
			$text 		= $_SESSION["alert"]["text"];
			$type 		= $_SESSION["alert"]["type"];
			$buttons	= $_SESSION["alert"]["buttons"];

			echo"
			<div id='msg' data-title='".$title."' data-type='".$type."' data-text='".$text."' data-buttons='".$buttons."'></div>
			<script>
				let title 		= $('#msg').data('title');
				let type 		= $('#msg').data('type');
				let text 		= $('#msg').data('text');
				let buttons		= $('#msg').data('buttons');

				if(text != '' && type != '' && title != ''){
					Swal.fire({
						title: title,
						text: text,
						icon: type,
					});
				}
			</script>
			";
			unset($_SESSION["alert"]);
		}
	}
 ?>