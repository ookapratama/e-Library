<?php
include 'fungsi.php';

$id = $_GET['id'];
$row = mysqli_query($conn, "SELECT * FROM admin WHERE id='$id'");
$data = mysqli_fetch_assoc($row);

?>
<div class="modal-body">
    <input type="text" name="id" id="id" value="<?= $id; ?>" hidden>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama']; ?>" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="email" name="email" value="<?= $data['email']; ?>" required> 
    </div>
    <div class="form-group">
        <label for="adminid">AdminID</label>
        <input type="text" class="form-control" id="adminid" name="adminid" value="<?= $data['adminid']; ?>" required> 
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" name="edit" class="btn btn-success">Edit</button>
</div>