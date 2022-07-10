<?php
session_start();
if(isset($_SESSION['agt'])){
  include 'header.php';
  $sua = mysqli_query($conn, "SELECT COUNT(*) FROM pinjam WHERE idagt = '$id'");
  $ass = mysqli_fetch_array($sua);
  if($_GET['back'] != 1){ ?>
    <script>alert("Welcome <?= $nama ?> , Anda Memiliki <?= $ass[0] ?> Buku Yang Belum Dikembalikan")</script>
  
  <?php
    }
  ?>
  
<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="row">
    <!-- card data peminjaman -->
    <div class="col-lg-3 md-4 sl-6">
      <div class="card text-white  mb-3" style="max-width: 18rem; background-color: deeppink;">
        <div class="card-header bg-transparent border-primary">Data Peminjaman</div>
        <div class="card-body ">
          <div class="row">
            <div class="col-4">
              <i class="fa-3x fas fa-share"></i>
            </div>
            <div class="col text-center">
              <?php
              $data = mysqli_query($conn, "SELECT COUNT(*) FROM pinjam WHERE idagt = '$id'");
              $pinjam = mysqli_fetch_array($data)
              ?>
              <h6 class="card-text"><?= $pinjam[0]; ?></h6>
              <h6 class="card-text">PEMINJAMAN</h6>
            </div>
          </div>
        </div>
        <div class="card-footer border-dark text-dark" style="background-color: white;"><a href="pinjam.php">View Details</a></div>
      </div>
    </div>
    <!-- end card peminjaman -->
    <!-- card data pengembalian -->
    <div class="col-lg-3 md-4 sl-6">
      <div class="card text-white  mb-3" style="max-width: 18rem; background-color: orangered;">
        <div class="card-header bg-transparent border-primary">Data Pengembalian</div>
        <div class="card-body ">
          <div class="row">
            <div class="col-4">
              <i class="fa-3x fas fa-reply"></i>
            </div>
            <div class="col text-center">
              <?php
              $data = mysqli_query($conn, "SELECT COUNT(*) FROM kembali WHERE idagt = '$id'");
              $kembali = mysqli_fetch_array($data)
              ?>
              <h6 class="card-text"><?= $kembali[0]; ?></h6>
              <h6 class="card-text">PENGEMBALIAN</h6>
            </div>
          </div>
        </div>
        <div class="card-footer border-dark text-dark" style="background-color: white;"><a href="pengembalian.php">View Details</a></div>
      </div>
    </div>
    <!-- end card peminjaman -->

</div>
</div>
<!-- /.container-fluid -->

<!-- End of Main Content -->
<?php include 'footer.php' ?>
<script>
  document.getElementById("dashboard").className = "nav-item active";
</script>

<?php }else{
  echo "<script>
          alert('Anda Belum Login');
          document.location.href ='login.php';
      </script>";
} ?>