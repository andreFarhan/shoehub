<?php 
  include 'functions.php';

  $id_user = $_SESSION['id_user'];
  $user = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id_user = '$id_user'");
  $data_user = mysqli_fetch_assoc($user);
  
  $i=1;$jml_total=0;

  $id_transaksi = $_GET['id_transaksi'];

  $sql_sepatu = "SELECT * FROM tb_sepatu 
    INNER JOIN tb_transaksi ON tb_transaksi.id_sepatu = tb_sepatu.id_sepatu
    ORDER BY id_transaksi DESC LIMIT 1";
  $eksekusi_sepatu = mysqli_query($koneksi, $sql_sepatu);

  $sql_transaksi = mysqli_query($koneksi, "SELECT * FROM tb_transaksi 
    INNER JOIN tb_member ON tb_transaksi.id_member =  tb_member.id_member 
    WHERE id_transaksi = '$id_transaksi'");
  $fetch_transaksi = mysqli_fetch_assoc($sql_transaksi);

  $sql_total_harga = mysqli_query($koneksi, "SELECT SUM(harga_sepatu*qty) as jml_harga FROM tb_transaksi
    INNER JOIN tb_sepatu ON tb_sepatu.id_sepatu = tb_transaksi.id_sepatu
  WHERE tb_transaksi.id_transaksi = '$id_transaksi'
  ");
  $eksekusi_total_harga = mysqli_fetch_assoc($sql_total_harga);
  $total_harga = $eksekusi_total_harga['jml_harga'];


  if (isset($_POST['bayar'])) {
    $transaksi_harga = $_POST['transaksi_harga'];
    $nama_member = $_POST['nama_member'];
    $uang_bayar = $_POST['uang_bayar'];
    if ($uang_bayar >= $transaksi_harga) {
      $kembalian = $uang_bayar - $transaksi_harga;
      $id_transaksi = $_POST['id_transaksi'];
      
      $cek_sql_update = mysqli_affected_rows($koneksi);

    } else {
      $kembalian = (int)$uang_bayar - (int)$transaksi_harga;
        setAlert('Gagal!','Uang Yang Dibayar Kurang!','error');
        header("Location: pembayaran.php?id_transaksi=$id_transaksi");
        die;
    }
  }

  if (isset($_POST['selesai'])) {
    $transaksi_harga = $_POST['transaksi_harga'];
    $uang_bayar = $_POST['uang_bayar'];
    $kembalian = $uang_bayar - $transaksi_harga;
    $id_transaksi = $_POST['id_transaksi'];

    $sql_pembayaran = mysqli_query($koneksi, "INSERT INTO tb_pembayaran VALUES ('', '$total_harga', '$uang_bayar', '$kembalian', '$id_user', '$id_transaksi')");

    $sql_bayar = mysqli_query($koneksi, "UPDATE tb_transaksi SET pembayaran = 'Lunas' WHERE id_transaksi = '$id_transaksi'");

    setAlert('Berhasil!','Pembayaran Berhasil','success');
    header("Location: transaksi_show.php?id_transaksi=$id_transaksi");
    die;
    
  }

  $transaksi_harga = $total_harga;


?>

<!DOCTYPE html>
<html lang="en" id="page-top">
  <head>
    <title>Pembayaran</title>
    <link rel="icon" href="img/sneaker-fill.svg">
  </head>
  <body>
    <?php include 'nav.php'; ?>
      <div class="container mt-5">
        <h1>Pembayaran</h1>
        <div class="row mb-3">
          <div class="col-md-4 mx-2 p-4 rounded text-white" style="background-color: #005082;">
            <h5>Pembayaran</h5>
            <form method="post">
              <?php if (isset($_POST['bayar'])): ?>
                <input type="hidden" name="id_transaksi" value="<?= $id_transaksi; ?>">
                <input type="hidden" name="uang_bayar" value="<?= $uang_bayar; ?>">
              <?php endif ?>
              <input type="hidden" name="id_transaksi" value="<?= $fetch_transaksi['id_transaksi']; ?>">
              <input type="hidden" name="nama_member" value="<?= $fetch_transaksi['nama_member']; ?>">
              
              <div class="form-group">
                <label for="Nama member">Nama member</label>
                <?php if (isset($_POST['bayar'])): ?>
                  <input style="cursor: not-allowed;" disabled value="<?= $nama_member; ?>" type="text" id="Nama member" class="form-control" name="Nama member">
                <?php else: ?>
                  <input style="cursor: not-allowed;" disabled value="<?= $fetch_transaksi['nama_member']; ?>" type="text" id="Nama member" class="form-control" name="Nama member">
                <?php endif ?>
              </div>

              <hr style="border: 1px solid">

              <div class="form-group">
                <label for="transaksi_harga"><b>TOTAL PEMBAYARAN</b></label>
                <input style="cursor: not-allowed;" type="text" disabled value="Rp <?= str_replace(",", ".", number_format($transaksi_harga)); ?>" id="transaksi_harga" class="form-control text-right">
              </div>

              <input type="hidden" name="transaksi_harga" value="<?= $transaksi_harga; ?>">

              <hr style="border: 1px dotted">

              <div class="form-group">
                <label for="uang_bayar">Uang yang dibayar</label>
                <?php if (isset($_POST['bayar'])): ?>
                <input style="cursor: not-allowed;" disabled type="text" id="uang_bayar" class="form-control text-right" name="uang_bayar" value="Rp <?= str_replace(",", ".", number_format($uang_bayar)); ?>">
                <?php else: ?>
                <input type="number" id="uang_bayar" class="form-control text-right" name="uang_bayar">
                <?php endif ?>
              </div>
              <?php if (isset($_POST['bayar'])): ?>
                <div class="form-group">
                  <label for="kembalian">Kembalian</label>
                  <input style="cursor: not-allowed;" disabled type="text" id="kembalian" class="form-control text-right" name="kembalian" value="Rp <?= str_replace(",", ".", number_format($kembalian)); ?>">
                </div>
              <?php endif ?>
              <?php if (isset($_POST['bayar'])): ?>
                <button type="submit" name="selesai" class="btn btn-primary"><i class="fas fa-fw fa-handshake"></i> Selesai</button>
              <?php else: ?>
                <button type="submit" name="bayar" class="btn btn-primary"><i class="fas fa-fw fa-handshake"></i> Bayar</button>
                <a href="transaksi_show.php" class="btn btn-outline-primary"> Batal</a>
              <?php endif ?>
            </form>
          </div>
          <div class="col-md-7 mx-2 p-4 rounded text-white" style="background-color: #005082;">
            <div class="table-responsive">
              <h4>Daftar Pembelian</h4>
              <table class="table text-white">
                <tr>
                  <th>Merk Sepatu</th>
                  <th>Qty</th>
                  <th>Harga</th>
                  <th>Total</th>
                </tr>
                <?php while ($data_sepatu = mysqli_fetch_array($eksekusi_sepatu)): ?>
                  <tr>
                    <td><?= $data_sepatu['merek_sepatu']; ?></td>
                    <td><?= $data_sepatu['qty']; ?></td>
                    <td>Rp <?= str_replace(",", ".", number_format($data_sepatu['harga_sepatu'])); ?></td>
                    <td>Rp <?= str_replace(",", ".", number_format($total=($data_sepatu['qty']*$data_sepatu['harga_sepatu']))); ?></td>
                  </tr>
                <?php endwhile ?>
              </table>
            </div>
          </div>
        </div>
      </div>
  </body>
  <?php include 'footer.php'; ?>
</html>