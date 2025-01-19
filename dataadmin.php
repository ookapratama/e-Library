<?php
session_start();
include 'header.php';
$title = 'admin';
// if(!$_SESSION['login']){
//     echo "<script>
// 			alert('Anda belum login!');
// 			history.go(-1);
// 			</script>";
// }

//tambah admin
if (isset($_POST['tambah'])) {
  try {
    $nama = $_POST['name'];
    $email = $_POST['email'];
    $adminid = $_POST['adminId'];
    $password = $_POST['password'];
    $data = array($nama, $email, $adminid, $password);

    // validate if value null
    $validateValue = validateValue($data);
    if (!$validateValue) {
      echo "<script>
      alert('Periksa kembali form anda');
      document.location.href ='dataadmin.php';
      </script>";
      return;
    }

    // clear special characters in form
    $isCleared = clearCharacters($data);

    // validate if data is exist in database
    $isExistData = isExistData($title, 'adminid', $isCleared[2]);
    if ($isExistData == 1) {
      echo "<script>
              alert('username admin sudah ada');
              document.location.href ='dataadmin.php';
          </script>";
      return;
    }

    $tambah = tambah($title, $isCleared);

    if ($tambah == 1) {
      echo "<script>
              alert('data berhasil ditambahkan');
              document.location.href ='dataadmin.php?status=success';
          </script>";
      return;
    } else {
      echo "<script>
          alert('data gagal ditambahkan');
          document.location.href ='dataadmin.php';
          </script>";
      return;
    }
  } catch (\Exception $e) {
    dd($e);
  }
}

//edit user
if (isset($_POST['edit'])) {
  try {

    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $adminid = $_POST['adminid'];
    $password = $_POST['password'];

    $fnama = $_POST['fnama'];
    $femail = $_POST['femail'];
    $fadminid = $_POST['fadminid'];
    $fpassword = $_POST['fpassword'];

    $key = $password == null ? array($fnama, $femail, $fadminid) : array($fnama, $femail, $fadminid, $fpassword);
    $data = $password == null ? array($nama, $email, $adminid) : array($nama, $email, $adminid, $password);

    // validate if value null
    $validateValue = validateValue($data);
    if (!$validateValue) {
      echo "<script>
      alert('Periksa kembali form anda');
      document.location.href ='dataadmin.php';
      </script>";
      return;
    }
    // clear special characters in form
    $isCleared = clearCharacters($data);

    // validate if data is exist in database
    $isExistData = isExistData($title, 'adminid', $isCleared[2], $id);
    if ($isExistData == 1) {
      echo "<script>
              alert('username admin sudah ada');
              document.location.href ='dataadmin.php';
          </script>";
      return;
    }

    // update data
    $update = update($title, $isCleared, $key, $id);


    if ($update == 1) {
      $_SESSION['nama'] = $row["nama"];
      echo "<script>
                  alert('data berhasil diedit');
                  document.location.href ='dataadmin.php';
                  </script>";
    } else {
      echo "<script>
              alert('tidak ada perubahan data');
              document.location.href ='dataadmin.php';
          </script>";
    }
  } catch (\Exception $e) {
    dd($e);
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
              <tr class="table-ac">
                <td><?= $no; ?></td>
                <td><?= $data["nama"]; ?></td>
                <td><?= $data["email"]; ?></td>
                <td><?= $data["adminid"]; ?></td>
                <td><a href="#" class="btn btn-warning" onclick="edit(<?= $data['id']; ?>)" data-toggle="modal" data-target="#exampleModalCenter">edit</a>
                  <a class="btn btn-danger" href="hapusadmin.php?id=<?= $data["id"]; ?>" onclick="return confirm('yakin ingin hapus data?')">hapus</a>
                </td>
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
      <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
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