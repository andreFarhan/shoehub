  <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="bootstrap/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="font-awesome/css/all.min.css">
<style type="text/css">
    .container {
        margin-top: 30px;
    }
    .dropdown-toggle,
    .dropdown-menu {
        border-radius: 0px !important;
    }
    .dropdown-item:hover {
        color: white;
        background-color: #0f4c81;
    }
    .btn-danger {
        width: 55%;
    }
    .dropdown:hover>.dropdown-menu {
      display: block;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #0f4c75">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <?php if ($_SERVER['REQUEST_URI'] == '/shoehub/dashboard.php'): ?>
        <li class="nav-item active">
          <a class="nav-link" href="dashboard.php"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 256 256"><path fill="white" d="m228.65 129.11l-28.06-9.35a4 4 0 0 0-2.63 0l-43.23 15.72a8.14 8.14 0 0 1-2.73.52a8 8 0 0 1-7.71-5.88a8.17 8.17 0 0 1 5.22-9.73l18.49-6.72a2.54 2.54 0 0 0-.06-4.8a23.93 23.93 0 0 1-8.8-5.25a4 4 0 0 0-4.17-.91l-24.22 8.8a8 8 0 0 1-10.44-5.39a8.17 8.17 0 0 1 5.22-9.73L146 88.93a4 4 0 0 0 2.31-5.34l-3.06-7.16a4 4 0 0 0-5.05-2.19l-25.5 9.27a8 8 0 0 1-10.44-5.39a8.17 8.17 0 0 1 5.22-9.73l24-8.73a4 4 0 0 0 2.31-5.33l-5.4-12.73v-.1a16 16 0 0 0-20.14-8.5L34.53 60.49A16.05 16.05 0 0 0 24 75.53V192a16 16 0 0 0 16 16h200a16 16 0 0 0 16-16v-24.94a40 40 0 0 0-27.35-37.95ZM240 192H40v-16h200Z"/></svg> SHOEHUB</a>
      <?php else: ?>
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256"><path fill="white" d="m228.65 129.11l-28.06-9.35a4 4 0 0 0-2.63 0l-43.23 15.72a8.14 8.14 0 0 1-2.73.52a8 8 0 0 1-7.71-5.88a8.17 8.17 0 0 1 5.22-9.73l18.49-6.72a2.54 2.54 0 0 0-.06-4.8a23.93 23.93 0 0 1-8.8-5.25a4 4 0 0 0-4.17-.91l-24.22 8.8a8 8 0 0 1-10.44-5.39a8.17 8.17 0 0 1 5.22-9.73L146 88.93a4 4 0 0 0 2.31-5.34l-3.06-7.16a4 4 0 0 0-5.05-2.19l-25.5 9.27a8 8 0 0 1-10.44-5.39a8.17 8.17 0 0 1 5.22-9.73l24-8.73a4 4 0 0 0 2.31-5.33l-5.4-12.73v-.1a16 16 0 0 0-20.14-8.5L34.53 60.49A16.05 16.05 0 0 0 24 75.53V192a16 16 0 0 0 16 16h200a16 16 0 0 0 16-16v-24.94a40 40 0 0 0-27.35-37.95ZM240 192H40v-16h200Z"/></svg> SHOEHUB</a>
      <?php endif ?>
        </li>

      
      <?php if ($_SERVER['REQUEST_URI'] == '/shoehub/sepatu_show.php' OR $_SERVER['REQUEST_URI'] == '/shoehub/sepatu_tambah.php' OR $_SERVER['SCRIPT_NAME'] == '/shoehub/sepatu_ubah.php'): ?>
      <li class="nav-item dropdown active">
      <?php else: ?>
      <li class="nav-item dropdown">
      <?php endif ?>
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-home"></i> Sepatu
        </a>
        <div class="dropdown-menu mt-n2" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="sepatu_show.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256"><path fill="black" d="m228.65 129.11l-28.06-9.35a4 4 0 0 0-2.63 0l-43.23 15.72a8.14 8.14 0 0 1-2.73.52a8 8 0 0 1-7.71-5.88a8.17 8.17 0 0 1 5.22-9.73l18.49-6.72a2.54 2.54 0 0 0-.06-4.8a23.93 23.93 0 0 1-8.8-5.25a4 4 0 0 0-4.17-.91l-24.22 8.8a8 8 0 0 1-10.44-5.39a8.17 8.17 0 0 1 5.22-9.73L146 88.93a4 4 0 0 0 2.31-5.34l-3.06-7.16a4 4 0 0 0-5.05-2.19l-25.5 9.27a8 8 0 0 1-10.44-5.39a8.17 8.17 0 0 1 5.22-9.73l24-8.73a4 4 0 0 0 2.31-5.33l-5.4-12.73v-.1a16 16 0 0 0-20.14-8.5L34.53 60.49A16.05 16.05 0 0 0 24 75.53V192a16 16 0 0 0 16 16h200a16 16 0 0 0 16-16v-24.94a40 40 0 0 0-27.35-37.95ZM240 192H40v-16h200Z"/></svg> Sepatu</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="sepatu_tambah.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256"><path fill="black" d="M256 200.41A15.91 15.91 0 0 1 240 216h-92.69a15.93 15.93 0 0 1-11.26-4.63L28.78 107.42l-.09-.09a16 16 0 0 1 0-22.62l64-64.12l.15-.14a15.91 15.91 0 0 1 22.35.27L123.4 29a16 16 0 0 1 4.66 10.54c1.13 22.83 16.91 38.26 41.19 40.26A16.13 16.13 0 0 1 184 95.7V108a4 4 0 0 1-4 4h-28a8 8 0 0 0-8 8.53a8.18 8.18 0 0 0 8.25 7.47h28a4 4 0 0 1 4 3.55a31.31 31.31 0 0 0 1.64 7.14a4 4 0 0 1-3.77 5.3H160a8 8 0 0 0-8 8.53a8.17 8.17 0 0 0 8.25 7.47H216a40 40 0 0 1 40 40.42ZM72 176a8 8 0 0 0-8-8H32a8 8 0 0 0 0 16h32a8 8 0 0 0 8-8Zm24 24H48a8 8 0 0 0 0 16h48a8 8 0 0 0 0-16Z"/></svg> Tambah Sepatu</a>
        </div>
      </li>

      <?php if ($_SERVER['REQUEST_URI'] == '/shoehub/user_show.php' OR $_SERVER['REQUEST_URI'] == '/shoehub/user_tambah.php' OR $_SERVER['SCRIPT_NAME'] == '/shoehub/user_ubah.php'): ?>
      <li class="nav-item dropdown active">
      <?php else: ?>
      <li class="nav-item dropdown">
      <?php endif ?>
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-user-alt"></i> User
        </a>
        <div class="dropdown-menu mt-n2" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="user_show.php"><i class="fa fa-user-alt"></i> User</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="user_tambah.php"><i class="fa fa-user-plus"></i> Tambah User</a>
        </div>
      </li>

      <?php if ($_SERVER['REQUEST_URI'] == '/shoehub/member_show.php' OR $_SERVER['REQUEST_URI'] == '/shoehub/member_tambah.php' OR $_SERVER['SCRIPT_NAME'] == '/shoehub/member_ubah.php'): ?>
      <li class="nav-item dropdown active">
      <?php else: ?>
      <li class="nav-item dropdown">
      <?php endif ?>
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-users"></i> Member
        </a>
        <div class="dropdown-menu mt-n2" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="member_show.php"><i class="fa fa-users"></i> Member</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="member_tambah.php"><i class="fa fa-user-plus"></i> Tambah Member</a>
        </div>
      </li>

      <?php if ($_SERVER['REQUEST_URI'] == '/shoehub/transaksi_show.php' OR $_SERVER['REQUEST_URI'] == '/shoehub/transaksi_tambah.php' OR $_SERVER['SCRIPT_NAME'] == '/shoehub/transaksi_ubah.php' OR $_SERVER['SCRIPT_NAME'] == '/shoehub/pembayaran.php'): ?>
      <li class="nav-item dropdown active">
      <?php else: ?>
      <li class="nav-item dropdown">
      <?php endif ?>
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-shopping-cart"></i> transaksi
        </a>
        <div class="dropdown-menu mt-n2" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="transaksi_show.php"><i class="fa fa-shopping-cart"></i> transaksi</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="transaksi_tambah.php"><i class="fa fa-cart-plus"></i> Tambah transaksi</a>
        </div>
      </li>


      <li class="nav-item">
        <a onclick="return confirm('Apakah anda ingin keluar?')" class="nav-link" href="logout.php"><i class="fa fa-door-open"></i> Keluar</a>
      </li>
    </ul>
      <?php 
        $username = ucwords($_SESSION['username']);
       ?>
      <b class="mr-sm-2 mb-n1 text-white">Admin, <?= $username; ?></b>
  </div>
</nav>