<?php
include 'fungsi.php';

$id = $_GET['id'];
$row = mysqli_query($conn, "SELECT * FROM kategori WHERE id='$id'");
$data = mysqli_fetch_assoc($row);
?>
<div class="modal-body">
    <input type="text" name="id" id="id" value="<?= $id; ?>" hidden>
    <div class="form-group">
        <label for="name">Nama Kategori</label>
        <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama']; ?>" required>
        <input type="hidden"  name="fnama" value="nama">
    </div>
    <div class="form-group">
        <label for="email">Status</label>
        <select name="status" id="" class="form-control">
            <option value="">--</option>
            <option <?= $data['status'] == 1 ? 'selected' : '' ?> value="1">Aktif</option>
            <option <?= $data['status'] == 2 ? 'selected' : '' ?> value="2">Tidak Aktif</option>
        </select>
        <input type="hidden"  name="fstatus" value="status">
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" name="edit" class="btn btn-success">Edit</button>
</div>