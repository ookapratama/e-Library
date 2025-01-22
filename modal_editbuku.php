<?php
include 'fungsi.php';

$id = $_GET['id'];
$row = mysqli_query($conn, "SELECT * FROM buku WHERE id='$id'");
$data = mysqli_fetch_assoc($row);

?>
<input type="hidden" name="id" value="<?= $data['id'] ?>">
<div class="modal-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="kdbuku">Kode Buku</label>
                <input type="text" class="form-control" id="kdbuku" name="kdbuku" value="<?= $data['kdbuku'] ?>" readonly required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" value="<?= $data['judul'] ?>" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="tahun">Tahun</label>
                <input type="text" class="form-control" id="tahun" value="<?= $data['tahun'] ?>" maxlength="4" minlength="4" name="tahun" required>
            </div>

        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="text" class="form-control" id="jumlah" name="jumlah" value="<?= $data['jumlah'] ?>" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="jenis">Kategori</label>
                <select name="jenis" id="jenis" onchange="jenisFile()" class="form-control">
                    <option value="">-- Pilih jenis --</option>
                    <option <?= $data['jenis'] == 'Jurnal' ? 'selected' : '' ?> value="Jurnal">Jurnal</option>
                    <option <?= $data['jenis'] == 'E-Book' ? 'selected' : '' ?> value="E-Book">E-Book</option>
                    <option <?= $data['jenis'] == 'Skripsi' ? 'selected' : '' ?> value="Skripsi  ">Skripsi </option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="file">Upload file</label>
                <input type="file" class="form-control" id="file" name="file" >
                <input type="hidden" class="form-control" id="oldFile" name="oldFile" value="<?= $data['file'] ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?php
            $row = tampil('pengarang');
            ?>
            <div class="form-group">
                <label for="idpeng">Pengarang</label>
                <select class="form-control" id="idpeng" name="idpeng" required>
                    <option value="" selected disabled hidden>Choose here</option>
                    <?php while ($pengarang = mysqli_fetch_assoc($row)):  ?>
                        <option <?= $pengarang['id'] == $data['idpeng'] ? 'selected' : '' ?> value="<?= $pengarang['id']; ?>"><?= $pengarang['nm_pengarang']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

        </div>
        <div class="col-md-6">
            <?php
            $row = tampil('penerbit');
            ?>
            <div class="form-group">
                <label for="idpen">Penerbit</label>
                <select class="form-control" id="idpen" name="idpen" required>
                    <option value="" selected disabled hidden>Choose here</option>
                    <?php while ($penerbit = mysqli_fetch_assoc($row)): ?>
                        <option <?= $penerbit['id'] == $data['idpen'] ? 'selected' : '' ?> value="<?= $penerbit['id']; ?>"><?= $penerbit['penerbit']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" name="edit" class="btn btn-success">Edit</button>
</div>