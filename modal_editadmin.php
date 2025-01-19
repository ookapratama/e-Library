<?php
include 'fungsi.php';

$id = $_GET['id'];
$row = mysqli_query($conn, "SELECT * FROM admin WHERE id='$id'");
$data = mysqli_fetch_assoc($row);

?>
<div class="modal-body">
    <input type="text" name="id" id="id" value="<?= $id; ?>" hidden>
    <div class="form-group">
        <label for="name">Nama Lengkap</label>
        <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama']; ?>" required>
        <input type="hidden"  name="fnama" value="nama">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= $data['email']; ?>" required> 
        <input type="hidden"  name="femail" value="email">
    </div>
    <div class="form-group">
        <label for="adminid">Username</label>
        <input type="text" class="form-control" id="adminid" name="adminid" value="<?= $data['adminid']; ?>" required> 
        <input type="hidden"  name="fadminid" value="adminid">
    </div>
    <div class="form-group">
        <label for="password">Password (bisa dikosongkan)</label>
        <input type="password" class="form-control" id="password" name="password" value="" > 
        <input type="hidden"  name="fpassword" value="pasw">
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" name="edit" class="btn btn-success">Edit</button>
</div>