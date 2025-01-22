<?php
session_start();
include 'header.php';
$title = 'kategori';
// if(!$_SESSION['login']){
//     echo "<script>
// 			alert('Anda belum login!');
// 			history.go(-1);
// 			</script>";
// }

//tambah kategori
if (isset($_POST['tambah'])) {
    try {
        $nama = $_POST['nama'];
        $status = 1;
        $created_at = date('Y-m-d');
        $data = array($nama, $status, $created_at);

        // validate if value null
        $validateValue = validateValue($data);
        if (!$validateValue) {
            echo "<script>
            alert('Periksa kembali form anda');
            document.location.href ='kategori.php';
            </script>";
            return;
        }

        // clear special characters in form
        $isCleared = clearCharacters($data);

        $tambah = tambah($title, $isCleared);

        if ($tambah == 1) {
            echo "<script>
              alert('data berhasil ditambahkan');
              document.location.href ='kategori.php?status=success';
          </script>";
            return;
        } else {
            echo "<script>
          alert('data gagal ditambahkan');
          document.location.href ='kategori.php';
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
        $status =  $_POST['status'];

        $fnama = $_POST['fnama'];
        $fstatus = $_POST['fstatus'];

        $key =  array($fnama, $fstatus);
        $data =  array($nama, $status);

        // validate if value null
        $validateValue = validateValue($data);
        if (!$validateValue) {
            echo "<script>
            alert('Periksa kembali form anda');
            document.location.href ='kategori.php';
            </script>";
            return;
        }
        // clear special characters in form
        $isCleared = clearCharacters($data);

        // update data
        $update = update($title, $isCleared, $key, $id);


        if ($update == 1) {
            $_SESSION['nama'] = $row["nama"];
            echo "<script>
                  alert('data berhasil diedit');
                  document.location.href ='kategori.php';
                  </script>";
        } else {
            echo "<script>
              alert('tidak ada perubahan data');
              document.location.href ='kategori.php';
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
    <a href="" class="btn btn-success btn-md mb-3" onclick="tambah()" data-toggle="modal" data-target="#exampleModalCenter">Tambah kategori</a>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">
                Data kategori
            </h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <try">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Dibuat tgl</th>
                            <th>Action</th>
                            </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        $row = tampil("kategori");
                        while ($data = mysqli_fetch_assoc($row)) : ?>
                            <tr class="table-ac">
                                <td><?= $no; ?></td>
                                <td><?= $data["nama"]; ?></td>
                                <td class="">
                                    <?php if ($data['status'] == 1) { ?>
                                        <span class="badge badge-success">Aktif</span>
                                    <?php } else { ?>
                                        <span class="badge badge-danger">Tidak Aktif</span>
                                    <?php } ?>
                                </td>
                                <td><?= date('d-M-Y', strtotime($data["created_at"])); ?></td>
                                <td><a href="#" class="btn btn-warning" onclick="edit(<?= $data['id']; ?>)" data-toggle="modal" data-target="#exampleModalCenter">edit</a>
                                    <a class="btn btn-danger" href="hapuskategori.php?id=<?= $data["id"]; ?>" onclick="return confirm('yakin ingin hapus data?')">hapus</a>
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
                <h5 class="modal-title" id="exampleModalLongTitle">Data kategori
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

        xhr.open('GET', 'modal_editkategori.php?id=' + id, true);
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

        xhr.open('GET', 'modal_tambahkategori.php', true);
        xhr.send();
    }
    document.getElementById("datakategori").className = "nav-item active";
</script>