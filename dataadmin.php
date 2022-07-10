<?php
session_start();
include 'header.php';
// if(!$_SESSION['login']){
//     echo "<script>
// 			alert('Anda belum login!');
// 			history.go(-1);
// 			</script>";
// }

//tambah admin
if (isset($_POST['tambah'])) {
  $nama = $_POST['name'];
  $email = $_POST['email'];
  $adminid = $_POST['adminid'];
  $password = $_POST['password'];
  $query = "('','$nama', '$email','$adminid','$password')";
  if (tambah("admin", $query) == 1) {
    echo "<script>
            alert('data berhasil ditambahkan');
            document.location.href ='dataadmin.php?status=success';
        </script>";
  } else {
    echo "<script>
            alert('data gagal ditambahkan');
            document.location.href ='dataadmin.php';
        </script>";
  }
}

//edit user
if (isset($_POST['edit'])) {
  $id = $_POST['id'];
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $adminid = $_POST['adminid'];
  $query = "nama='$nama',email='$email', adminid='$adminid' WHERE id='$id'";

  if (update('admin', $query) == 1) {
    $_SESSION['nama'] = $row["nama"];
    echo "<script>
                alert('data berhasil diedit');
                document.location.href ='dataadmin.php';
            </script>";
  } else {
    echo "<script>
                alert('data gagal diedit');
                document.location.href ='dataadmin.php';
            </script>";
  }
}

?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <a href="" class="btn btn-success btn-md mb-3" onclick="tambah()" data-toggle="modal" data-target="#exampleModalCenter">Tambah Admin</a>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h3 class="m-0 font-weight-bold text-primary">
        Data Admin
      </h3>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead class="thead-dark">
            <try">
              <th>No</th>
              <th>Name</th>
              <th>Email</th>
              <th>AdminId
              </th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1;
            $row = tampil("admin");
            while ($data = mysqli_fetch_assoc($row)) : ?>
              <tr  class="table-ac">
                <td><?= $no; ?></td>
                <td><?= $data["nama"]; ?></td>
                <td><?= $data["email"]; ?></td>
                <td><?= $data["adminid"]; ?></td>
                <td><a href="#" class="btn btn-warning" onclick="edit(<?= $data['id']; ?>)" data-toggle="modal" data-target="#exampleModalCenter">edit</a>
                <a class="btn btn-danger" href="hapusadmin.php?id=<?= $data["id"]; ?>" onclick="return confirm('yakin ingin hapus data?')">hapus</a></td>
              </tr>
              <?php $no++; ?>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!--modal-->
<div class="modal fade" id="exampleModalCenter">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Data Admin
        </h5>
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
        <div id="form">
          <div class="modal-body">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="edit">tambah</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!--Endmodal-->
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<?php include 'footer.php'; ?>
<script>
  function edit(a) {
    var id = a;
    var form = document.getElementById('form');
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {

      if (xhr.readyState == 4 && xhr.status == 200) {
        form.innerHTML = xhr.responseText;
      }
    }

    xhr.open('GET', 'modal_editadmin.php?id=' + id, true);
    xhr.send();
  }

  function tambah() {
    var form = document.getElementById('form');
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {

      if (xhr.readyState == 4 && xhr.status == 200) {
        form.innerHTML = xhr.responseText;
      }
    }

    xhr.open('GET', 'modal_tambahadmin.php', true);
    xhr.send();
  }
  document.getElementById("dataadmin").className = "nav-item active";
</script> 