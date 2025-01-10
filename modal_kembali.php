<?php
include 'fungsi.php';
$id = $_GET['id'];
$row = mysqli_query($conn, "SELECT * FROM pinjam WHERE id='$id'");
$data = mysqli_fetch_assoc($row);
$now = strtotime(date('Y-m-d'));
$kembali = strtotime($data['tglhk']);
$selisih = $now - $kembali;
$days = $selisih / 3600 / 24;
if ($days < 0) {
    $denda = 0;
} else {
    $denda = 3000 * $days;
}
?>
<div class="modal-body">
    <input type="text" name="id" id="id" value="<?= $id; ?>" hidden>
    <input type="text" name="denda" id="denda" value="<?= $denda; ?>" hidden>
    <h4>Buku Di Kembalikan ?</h4>
    <?php if ($days > 0): ?>
        <h4>Denda Terlambat <?= $days; ?> hari = Rp.<?= $denda; ?></h4>
    <?php endif; ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" name="kembali" class="btn btn-success">Ya</button>
</div>