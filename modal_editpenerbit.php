<?php
include 'fungsi.php';

$id = $_GET['id'];
$row = mysqli_query($conn, "SELECT * FROM penerbit WHERE idpen='$id'");
$data = mysqli_fetch_assoc($row);

?>
<div class="modal-body">
    <input type="text" name="id" id="id" value="<?= $id; ?>" hidden>
    <div class="form-group">
        <label for="penerbit">Penerbit</label>
        <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= $data['penerbit']; ?>" required>
    </div>
    <div class="form-group">
        <label for="alamat">Alamat</label>
        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $data['alamat']; ?>" required>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" name="edit" class="btn btn-success">Edit</button>
</div>