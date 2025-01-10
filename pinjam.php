<?php
session_start();

include 'header.php';

//tambah pinjam
if (isset($_POST['tambah'])) {
    $idagt = $_POST['idagt'];
    $kdbuku = $_POST['kdbuku'];
    $tglp = $_POST['tglp'];
    $tglhk = $_POST['tglhk'];

    $query = "(null,'$idagt','$kdbuku','$tglp','$tglhk')";
    tambah("pinjam", $query);
    $sql=mysqli_query($conn, "SELECT * FROM buku WHERE kdbuku='$kdbuku'");
    $data= mysqli_fetch_assoc($sql);
    $jumlahbuku=$data['jumlah']-1;
    $query = "jumlah='$jumlahbuku' WHERE kdbuku='$kdbuku'";
    if (update('buku',$query)==1) {
        echo "<script>
            alert('data berhasil ditambahkan');
            document.location.href ='pinjam.php';
        </script>";
    } else {
        echo "<script>
            alert('data gagal ditambahkan');
            document.location.href ='pinjam.php';
        </script>";
    }
}


//edit pinjam
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $row =mysqli_query($conn,"SELECT * FROM pinjam WHERE id='$id'");
    $data= mysqli_fetch_assoc($row);
    $tanggalawal = $data['tglhk'];
    $tanggalbaru = date('Y-m-d', strtotime('+3 days', strtotime($tanggalawal)));
    $query = "tglhk='$tanggalbaru' WHERE id='$id'";
    if (update('pinjam', $query) == 1) {
        echo "<script>
                alert('Tanggal Peminjaman Berhasil ditambah');
                document.location.href ='pinjam.php';
            </script>";
    } else {
        echo "<script>
                alert('data gagal diedit');
                document.location.href ='pinjam.php';
            </script>";
    }
}

//
if(isset($_POST['kembali'])){
    $id=$_POST['id'];
    $denda = $_POST['denda'];
    $row= mysqli_query($conn,"SELECT * FROM pinjam WHERE id='$id'");
    $data= mysqli_fetch_assoc($row);
    $idagt =$data['idagt'];
    $kdbuku =$data['kdbuku'];
    $tglp =$data['tglp'];
    $tglhk =$data['tglhk'];
    $tglk =date('Y-m-d');
    $query = "(null,'$idagt','$kdbuku','$tglp','$tglhk','$tglk','$denda')";
    hapus('pinjam',$id);
    tambah("kembali", $query);
    $sql=mysqli_query($conn, "SELECT * FROM buku WHERE kdbuku='$kdbuku'");
    $data= mysqli_fetch_assoc($sql);
    $jumlahbuku=$data['jumlah']+1;
    $query = "jumlah='$jumlahbuku' WHERE kdbuku='$kdbuku'";
    if (update('buku',$query)==1) {
        echo "<script>
            alert('Buku Berhasil Kembali');
            document.location.href ='pinjam.php';
        </script>";
    } else {
        echo "<script>
            alert('Buku Gagal Kembali');
            document.location.href ='pinjam.php';
        </script>";
    }
}

?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <?php if(isset($_SESSION['login'])):?>
    <a href="" class="btn btn-success btn-md mb-3" onclick="tambah()" data-toggle="modal" data-target="#exampleModalCenter">Tambah Peminjaman</a>
     <?php endif;?> 
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">
                Daftar Peminjaman
            </h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Anggota</th>
                            <th>Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Harus Kembali</th>
                            <?php if(isset($_SESSION['login'])):?>
                            <th>Action</th>
                            <?php endif;?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        $row = mysqli_query($conn,"SELECT a.id, a.tglp, a.tglhk, b.nama, c.judul FROM pinjam a, anggota b, buku c WHERE a.idagt=b.idagt AND a.kdbuku=c.kdbuku ");
                        while ($data = mysqli_fetch_assoc($row)) : ?>
                        <tr >
                            <td><?= $no; ?></td>
                            <td><?= $data["nama"]; ?></td>
                            <td><?= $data["judul"]; ?></td>
                            <td><?= $data["tglp"]; ?></td>
                            <td><?= $data["tglhk"]; ?></td>
                            <?php if(isset($_SESSION['login'])):?>
                            <td><a class="btn btn-warning" href="#" onclick="edit(<?= $data['id']; ?>)" data-toggle="modal" data-target="#exampleModalCenter">Tambah Waktu Pinjam </a>
                            <a class="btn btn-danger" href="#" onclick="kembali(<?= $data['id']; ?>)" data-toggle="modal" data-target="#exampleModalCenter"> Kembalikan</a></td>
                            <?php endif;?>
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
                <h5 class="modal-title" id="exampleModalLongTitle">Data Peminjaman</h5>
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

        xhr.open('GET', 'modal_tambahwaktu.php?id=' + id, true);
        xhr.send();
    }

    function kembali(a) {
        var id = a;
        var form = document.getElementById('form');
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {

            if (xhr.readyState == 4 && xhr.status == 200) {
                form.innerHTML = xhr.responseText;
            }
        }

        xhr.open('GET', 'modal_kembali.php?id=' + id, true);
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

        xhr.open('GET', 'modal_tambahpinjam.php', true);
        xhr.send();
    }


    document.getElementById("pinjam").className = "nav-item active";
</script>