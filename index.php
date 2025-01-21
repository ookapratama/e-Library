<?php
session_start();
include 'header.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="row">
    <!-- card data user -->
    <?php if(isset($_SESSION['login'])):?>
    <div class="col-lg-3 md-4 sl-6">
      <div class="card text-white  mb-3" style="max-width: 18rem; background-color: darkblue;">
        <div class="card-header bg-transparent border-primary">Data Admin
        </div>
        <div class="card-body ">
          <div class="row">
            <div class="col-4">
              <i class="fa-3x fas fa-users"></i>
            </div>
            <div class="col text-center">
              <?php
              $data = mysqli_query($conn, "SELECT COUNT(*) FROM admin ");
              $admin = mysqli_fetch_array($data)
              ?>
              <h6 class="card-text"><?= $admin[0]; ?></h6>
              <h6 class="card-text">Admin
              </h6>
            </div>
          </div>
        </div>
        <div class="card-footer border-dark text-dark" style="background-color: white;"><a href="dataadmin.php">View Details</a></div>
      </div>
    </div>
            <?php endif;?>
    <!-- end card user -->
    <!-- card data anggota -->
    <div class="col-lg-3 md-4 sl-6">
      <div class="card text-white  mb-3" style="max-width: 18rem; background-color: green;">
        <div class="card-header bg-transparent border-primary">Data Anggota</div>
        <div class="card-body ">
          <div class="row">
            <div class="col-4">
              <i class="fa-3x fas fa-address-card"></i>
            </div>
            <div class="col text-center">
              <?php
              $data = mysqli_query($conn, "SELECT COUNT(*) FROM anggota ");
              $anggota = mysqli_fetch_array($data)
              ?>
              <h6 class="card-text"><?= $anggota[0]; ?></h6>
              <h6 class="card-text">ANGGOTA</h6>
            </div>
          </div>
        </div>
        <div class="card-footer border-dark text-dark" style="background-color: white;"><a href="dataanggota.php">View Details</a></div>
      </div>
    </div>
    <!-- end card anggota -->   
    <!-- card data pengarang -->
    <div class="col-lg-3 md-4 sl-6">
      <div class="card text-white  mb-3" style="max-width: 18rem; background-color: purple;">
        <div class="card-header bg-transparent border-primary">Data Pengarang</div>
        <div class="card-body ">
          <div class="row">
            <div class="col-4">
              <i class="fa-3x fas fa-user-tie"></i>
            </div>
            <div class="col text-center">
              <?php
              $data = mysqli_query($conn, "SELECT COUNT(*) FROM pengarang ");
              $pengarang = mysqli_fetch_array($data)
              ?>
              <h6 class="card-text"><?= $pengarang[0]; ?></h6>
              <h6 class="card-text">PENGARANG</h6>
            </div>
          </div>
        </div>
        <div class="card-footer border-dark text-dark" style="background-color: white;"><a href="pengarang.php">View Details</a></div>
      </div>
    </div>
    <!-- end card pengarang -->
    
    <!-- card data penerbit -->
    <div class="col-lg-3 md-4 sl-6">
      <div class="card text-white  mb-3" style="max-width: 18rem; background-color: teal;">
        <div class="card-header bg-transparent border-primary">Data Penerbit</div>
        <div class="card-body ">
          <div class="row">
            <div class="col-4">
              <i class="fa-3x fas fa-building"></i>
            </div>
            <div class="col text-center">
              <?php
              $data = mysqli_query($conn, "SELECT COUNT(*) FROM penerbit ");
              $penerbit = mysqli_fetch_array($data)
              ?>
              <h6 class="card-text"><?= $penerbit[0]; ?></h6>
              <h6 class="card-text">PENERBIT</h6>
            </div>
          </div>
        </div>
        <div class="card-footer border-dark text-dark" style="background-color: white;"><a href="penerbit.php">View Details</a></div>
      </div>
    </div>
    <!-- end card penerbit -->
    <!-- card data buku -->
    <div class="col-lg-3 md-4 sl-6">
      <div class="card text-white  mb-3" style="max-width: 18rem; background-color: crimson;">
        <div class="card-header bg-transparent border-primary">Data Buku</div>
        <div class="card-body ">
          <div class="row">
            <div class="col-4">
              <i class="fa-3x fas fa-book"></i>
            </div>
            <div class="col text-center">
              <?php
              $data = mysqli_query($conn, "SELECT COUNT(*) FROM buku ");
              $buku = mysqli_fetch_array($data)
              ?>
              <h6 class="card-text"><?= $buku[0]; ?></h6>
              <h6 class="card-text">BUKU</h6>
            </div>
          </div>
        </div>
        <div class="card-footer border-dark text-dark" style="background-color: white;"><a href="buku.php">View Details</a></div>
      </div>
    </div>
    <!-- end card buku -->
    <!-- card data peminjaman -->
    <?php if(isset($_SESSION['login'])):?>
    <!-- <div class="col-lg-3 md-4 sl-6">
      <div class="card text-white  mb-3" style="max-width: 18rem; background-color: deeppink;">
        <div class="card-header bg-transparent border-primary">Data Peminjaman</div>
        <div class="card-body ">
          <div class="row">
            <div class="col-4">
              <i class="fa-3x fas fa-share"></i>
            </div>
            <div class="col text-center">
              <?php
              $data = mysqli_query($conn, "SELECT COUNT(*) FROM pinjam ");
              $pinjam = mysqli_fetch_array($data)
              ?>
              <h6 class="card-text"><?= $pinjam[0]; ?></h6>
              <h6 class="card-text">PEMINJAMAN</h6>
            </div>
          </div>
        </div>
        <div class="card-footer border-dark text-dark" style="background-color: white;"><a href="pinjam.php">View Details</a></div>
      </div>
    </div> -->
    <!-- end card peminjaman -->
    <!-- card data pengembalian -->
    <!-- <div class="col-lg-3 md-4 sl-6">
      <div class="card text-white  mb-3" style="max-width: 18rem; background-color: orangered;">
        <div class="card-header bg-transparent border-primary">Data Pengembalian</div>
        <div class="card-body ">
          <div class="row">
            <div class="col-4">
              <i class="fa-3x fas fa-reply"></i>
            </div>
            <div class="col text-center">
              <?php
              $data = mysqli_query($conn, "SELECT COUNT(*) FROM kembali ");
              $kembali = mysqli_fetch_array($data)
              ?>
              <h6 class="card-text"><?= $kembali[0]; ?></h6>
              <h6 class="card-text">PENGEMBALIAN</h6>
            </div>
          </div>
        </div>
        <div class="card-footer border-dark text-dark" style="background-color: white;"><a href="pengembalian.php">View Details</a></div>
      </div>
    </div> -->
    <!-- end card peminjaman -->
    <?php endif;?>

</div>
</div>
<!-- /.container-fluid -->

<!-- End of Main Content -->
<?php include 'footer.php' ?>
<script>
  document.getElementById("dashboard").className = "nav-item active";
</script>