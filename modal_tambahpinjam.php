<?php 
include 'fungsi.php';
?>
<?php 
$row=tampil('anggota');

?>
<div class="modal-body">
    <div class="form-group">
        <label for="idagt">Anggota</label>
        <select class="form-control" id="idagt" name="idagt" required>
            <option value="" selected disabled hidden>Choose here</option>
            <?php while($data= mysqli_fetch_assoc($row)): ?>
            <option value="<?= $data['idagt'];?>"><?= $data['nama'];?></option>
            <?php endwhile; ?>
        </select>
    </div>

<?php 
$row=mysqli_query($conn, "SELECT * FROM buku WHERE jumlah>0");
?>
    <div class="form-group">
        <label for="kdbuku">Buku</label>
        <select class="form-control" id="kdbuku" name="kdbuku" required>
            <option value="" selected disabled hidden>Choose here</option>
            <?php while($data= mysqli_fetch_assoc($row)): ?>
            <option value="<?= $data['kdbuku'];?>"><?= $data['judul'];?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="tglp">Tanggal Pinjam</label>
        <input type="date" value="<?php echo date("Y-m-d"); ?>" class="form-control" id="tglp" name="tglp" readonly>
    </div>

    <div class="form-group">
        <label for="tglhk">Tanggal Harus Kembali</label>
        <input type="date" value="<?php echo date("Y-m-d", strtotime("+ 4  day")); ?>" class="form-control" id="tglhk" name="tglhk">
    </div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" name="tambah" class="btn btn-success">Tambah Peminjaman</button>
</div>
</div>