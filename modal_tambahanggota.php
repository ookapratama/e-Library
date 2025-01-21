
<div class="modal-body">
    <div class="form-group">
        <label for="idagt">ID Anggota</label>
        <input type="text" class="form-control" id="idagt" name="idagt" required>
    </div>
    <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" required>
    </div>
    <div class="form-group">
        <label for="nama">Password</label>
        <input type="password" class="form-control" id="pass" name="pass" required>
    </div>
    <div class="form-group">
        <label for="t4lahir">Tempat Lahir</label>
        <input type="text" class="form-control" id="t4lahir" name="t4lahir" required>
    </div>
    <div class="form-group">
        <label for="tglhr">Tanggal Lahir</label>
        <input type="date" class="form-control" id="tglhr" name="tglhr" required>
    </div>
    <div class="form-group">
        <label for="jkel">Jenis Kelamin</label>
        <select class="form-control" id="jkel" name="jkel" required>
            <option value="" selected disabled hidden>Choose here</option>
            <option>Laki-Laki</option>
            <option>Perempuan</option>
        </select>
    </div>
    <div class="form-group">
        <label for="alamat">Alamat</label>
        <input type="text" class="form-control" id="alamat" name="alamat" required>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" name="tambah" class="btn btn-success">Tambah Anggota</button>
</div>