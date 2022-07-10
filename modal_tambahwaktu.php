<?php
include 'fungsi.php';

$id = $_GET['id'];

?>
<div class="modal-body">
  <input type="text" name="id" id="id" value="<?= $id; ?>" hidden>  
  <p>Tambah Waktu Peminjaman(3 hari)?</p>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
    <button type="submit" name="edit" class="btn btn-success">Ya</button>
</div>