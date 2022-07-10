<?php
session_start();

include 'header.php';

?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">
                Daftar Pengembalian
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
                            <th>Tanggal Kembali</th>
                            <th>Denda</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; 
                        $row = mysqli_query($conn,"SELECT a.id, a.tglp, a.tglhk, a.tglk, a.denda, b.nama, c.judul FROM kembali a, anggota b, buku c WHERE a.idagt = b.idagt AND a.kdbuku = c.kdbuku ");
                        while ($data = mysqli_fetch_assoc($row)) : ?>
                        <tr >
                            <td><?= $no; ?></td>
                            <td><?= $data["nama"]; ?></td>
                            <td><?= $data["judul"]; ?></td>
                            <td><?= $data["tglp"]; ?></td>
                            <td><?= $data["tglhk"]; ?></td>
                            <td><?= $data["tglk"]; ?></td>
                            <td><?= $data["denda"]; ?></td>
                            
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
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<?php include 'footer.php'; ?>
<script>document.getElementById("kembali").className = "nav-item active";
</script>