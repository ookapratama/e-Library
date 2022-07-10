<?php
session_start();

include 'header.php';
?>
<!-- Begin Page Content -->
<div class="container-fluid">
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
                            <th>Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        $row = mysqli_query($conn,"SELECT a.id, a.tglp, a.tglhk, b.nama, c.judul FROM pinjam a, anggota b, buku c WHERE a.idagt = '$id' AND a.idagt=b.idagt AND a.kdbuku=c.kdbuku ");
                        while ($data = mysqli_fetch_assoc($row)) : ?>
                        <tr >
                            <td><?= $no; ?></td>
                            <td><?= $data["nama"]; ?></td>
                            <td><?= $data["judul"]; ?></td>
                            <td><?= $data["tglp"]; ?></td>
                            <td><?= $data["tglhk"]; ?></td>
                            <?php 
                                $now = strtotime(date('Y-m-d'));
                                $kembali = strtotime($data['tglhk']);
                                $selisih = $now-$kembali;
                                $days = $selisih/3600/24;
                                if($days<0){
                                    $denda = 0;
                                }else{
                                    $denda = 3000*$days;
                                }
                            ?>
                            <td><?= $denda ?></td>
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