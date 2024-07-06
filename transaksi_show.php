<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	$sql = "SELECT *, tb_transaksi.id_transaksi as kode_transaksi FROM tb_transaksi 
			INNER JOIN tb_sepatu ON tb_transaksi.id_sepatu = tb_sepatu.id_sepatu
			INNER JOIN tb_member ON tb_transaksi.id_member = tb_member.id_member
			INNER JOIN tb_user ON tb_transaksi.id_user = tb_user.id_user
			LEFT OUTER JOIN tb_pembayaran ON tb_transaksi.id_transaksi = tb_pembayaran.id_transaksi
			ORDER BY tb_transaksi.id_transaksi DESC
			";
	$eksekusi = mysqli_query($koneksi, $sql);

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Transaksi</title>
	<link rel="icon" href="img/sneaker-fill.svg">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5">
		<h3 class="mt-3">TRANSAKSI </h3>
		<table class="table table-striped" id="Table" style="width: 110%; margin-left: -5%">
			<thead class="text-white" style="background-color: #3282b8;">
				<tr>
					<th>NO</th>
					<th>MEMBER</th>
					<th>SEPATU</th>
					<th>QTY</th>
					<th>SATUAN</th>
					<th width="12%">TOTAL</th>
					<th width="12%">BAYAR</th>
					<th>KEMBALIAN</th>
					<th>STATUS</th>
					<th>TANGGAL</th>
					<th>USER</th>
					<th>AKSI</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1; while ($data = mysqli_fetch_array($eksekusi)) : ?>
				<tr>
					<td><?= $i++; ?></td>
					<td><a href="member_show.php?id_member=<?= $data['id_member']; ?>" style="text-decoration: none; font-weight: bold;"><?= $data['nama_member']; ?></a></td>
					<td><a href="sepatu_show.php?id_sepatu=<?= $data['id_sepatu']; ?>" style="text-decoration: none; font-weight: bold;"><?= $data['merek_sepatu']; ?></a></td>
					<td><?= $data['qty']; ?></td>
					<td>Rp <?= str_replace(",", ".", number_format($data['harga_sepatu'])); ?></td>
					<td>Rp <?= str_replace(",", ".", number_format($total_harga = ($data['harga_sepatu']*$data['qty']))); ?></td>
					<td>Rp <?= str_replace(",", ".", number_format($data['uang_bayar'])); ?></td>
					<td>Rp <?= str_replace(",", ".", number_format($data['kembalian'])); ?></td>
					<td>
						<?php if ($data['pembayaran'] == 'Belum Dibayar'): ?>
							<a class="badge badge-danger" href="pembayaran.php?id_transaksi=<?= $data['kode_transaksi']; ?>"><?= $data['pembayaran']; ?></a>
						<?php else: ?>
							<a class="btn btn-success" href><?= $data['pembayaran']; ?></a>
						<?php endif ?>
					</td>
					<td><?= $data['tanggal']; ?></td>
					<td><?= ucfirst($data['nama_user']); ?></td>
					<td>
						<?php if ($data['pembayaran'] == 'Belum Dibayar'): ?>
							<a href="transaksi_ubah.php?id_transaksi=<?= $data['kode_transaksi']; ?>" class="badge badge-success"> <i class="fa fa-edit"></i></a>
						<?php else: ?>
							<a onclick="return alert('Data tidak dapat diubah, karena sudah dibayar')" href="" class="badge badge-success"> <i class="fa fa-edit"></i></a>
						<?php endif ?>
						<a onclick="return confirm('Apakah anda ingin menghapus transaksi ini ?')" href="transaksi_hapus.php?id_transaksi=<?= $data['id_transaksi']; ?>" class="badge badge-danger"> <i class="fa fa-trash"></i></a>
					</td>
				</tr>
				<?php endwhile ?>
			</tbody>
		</table>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>