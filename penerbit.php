<?php
session_start();

include 'header.php';
$title = 'penerbit';
//tambah penerbit
if (isset($_POST['tambah'])) {
    $penerbit = $_POST['penerbit'];
    $alamat = $_POST['alamat'];

    $data = array($penerbit, $alamat);

    // validate if value null
    $validateValue = validateValue($data);
    if (!$validateValue) {
        echo "<script>
                alert('Periksa kembali form anda');
                document.location.href ='penerbit.php';
                </script>";
        return;
    }

    // clear special characters in form
    $isCleared = clearCharacters($data);

    $query = tambah($title, $isCleared);

    if ($query == 1) {
        echo "<script>
            alert('data berhasil ditambahkan');
            document.location.href ='penerbit.php';
        </script>";
    } else {
        echo "<script>
            alert('data gagal ditambahkan');
            document.location.href ='penerbit.php';
        </script>";
    }
}

//edit penerbit
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $penerbit = $_POST['penerbit'];
    $alamat = $_POST['alamat'];


    $data = array($penerbit, $alamat);
    $key = ['penerbit', 'alamat'];

    if (update($title, $data, $key, $id) > 0) {
        echo "<script>
                alert('data berhasil diedit');
                document.location.href ='penerbit.php';
            </script>";
    } else {
        echo "<script>
                alert('tidak ada perubahan data');
                document.location.href ='penerbit.php';
            </script>";
    }
}

?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <?php if (isset($_SESSION['login'])): ?>
        <a href="" class="btn btn-success btn-md mb-3" onclick="tambah()" data-toggle="modal" data-target="#exampleModalCenter">Tambah Penerbit</a>
    <?php endif; ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">
                Daftar Penerbit
            </h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Penerbit</th>
                            <th>Alamat</th>
                            <?php if (isset($_SESSION['login'])): ?>
                                <th>Action</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        $row = tampil("penerbit");
                        while ($data = mysqli_fetch_assoc($row)) : ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $data["penerbit"]; ?></td>
                                <td><?= $data["alamat"]; ?></td>
                                <?php if (isset($_SESSION['login'])): ?>
                                    <td><a class="btn btn-warning" href="#" onclick="edit(<?= $data['id']; ?>)" data-toggle="modal" data-target="#exampleModalCenter">edit</a>
                                        <a class="btn btn-danger" href="hapuspenerbit.php?id=<?= $data["id"]; ?>" onclick="return confirm('yakin ingin hapus data?')">hapus</a>
                                    </td>
                                <?php endif; ?>
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
                <h5 class="modal-title" id="exampleModalLongTitle">Data Penerbit</h5>
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

        xhr.open('GET', 'modal_editpenerbit.php?id=' + id, true);
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

        xhr.open('GET', 'modal_tambahpenerbit.php', true);
        xhr.send();
    }


    document.getElementById("penerbit").className = "nav-item active";
</script>