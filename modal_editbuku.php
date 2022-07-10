<?php
include 'fungsi.php';

$id = $_GET['id'];
$row = mysqli_query($conn, "SELECT * FROM buku WHERE id='$id'");
$data = mysqli_fetch_assoc($row);

?>
<div class="modal-body">
    <input type="text" name="id" id="id" value="<?= $id; ?>" hidden>
    <div class="form-group">
        <label for="kdbuku">Kode Buku</label>
        <input type="text" class="form-control" id="kdbuku" name="kdbuku" value="<?= $data['kdbuku']; ?>" required>
    </div>
    <div class="form-group">
        <label for="judul">Judul</label>
        <input type="text" class="form-control" id="judul" name="judul" value="<?= $data['judul']; ?>" required> 
    </div>
    <div class="form-group">
        <label for="tahun">Tahun</label>
        <input type="text" class="form-control" id="tahun" name="tahun" value="<?= $data['tahun']; ?>" required> 
    </div>
    <div class="form-group">
        <label for="jumlah">Jumlah</label>
        <input type="text" class="form-control" id="jumlah" name="jumlah" value="<?= $data['jumlah']; ?>" required> 
    </div>
<?php 
$row=tampil('pengarang');
?>
    <div class="form-group">
        <label for="idpeng">Pengarang</label>
        <select class="form-control" id="idpeng" name="idpeng" required>
            <?php while($data= mysqli_fetch_assoc($row)): ?>
            <option value=<?= $data['idpeng'];?>"><?= $data['nm_pengarang'];?></option>
            <?php endwhile; ?>
        </select>
    </div>

    <?php 
$row=tampil('penerbit');
?>
    <div class="form-group">
        <label for="idpen">Penerbit</label>
        <select class="form-control" id="idpen" name="idpen" required>
            <?php while($data= mysqli_fetch_assoc($row)): ?>
            <option value="<?= $data['idpen'];?>"><?= $data['penerbit'];?></option>
            <?php endwhile; ?>
        </select>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" name="edit" class="btn btn-success">Edit</button>
</div>