<?php
session_start();

include 'header.php';
$title = 'buku';

//tambah buku
if (isset($_POST['tambah'])) {
  $kdbuku = $_POST['kdbuku'];
  $judul = $_POST['judul'];
  $tahun = $_POST['tahun'];
  $jumlah = $_POST['jumlah'];
  // pengarang
  $idpeng = $_POST['idpeng'];
  // penerbit
  $idpen = $_POST['idpen'];
  $jenis = $_POST['jenis'];
  $file = $_FILES['file'];

  // upload file
  $result = uploadFile($file);
  if ($result['status']) {
    $datas = array($kdbuku, $judul, $tahun, $jumlah, $jenis, $result['fileName'], $idpeng, $idpen);
  } else {
    echo "<script>
              alert('" . $result['message'] . "');
              document.location.href ='buku.php';
              </script>";
  }

  $validateValue = validateValue($datas);
  if (!$validateValue) {
    echo "<script>
      alert('Periksa kembali form anda');
      document.location.href ='buku.php';
      </script>";
    return;
  }

  // clear special characters in form
  $isCleared = clearCharacters($datas);

  $query = tambah($title, $isCleared);

  try {
    if ($query == 1) {
      echo "<script>
              alert('data berhasil ditambahkan');
              document.location.href ='buku.php?status=success';
          </script>";
    } else {
      echo "<script>
              alert('data gagal ditambahkan');
              document.location.href ='buku.php';
          </script>";
    }
  } catch (\Exception $e) {
    dd($e);
  }
}

//edit buku
if (isset($_POST['edit'])) {
  $id = $_POST['id'];

  // Data yang akan diupdate
  $datas = [
    $_POST['kdbuku'],
    $_POST['judul'],
    $_POST['tahun'],
    $_POST['jumlah'],
    $_POST['jenis'],
    $_POST['idpeng'],
    $_POST['idpen']
  ];

  // Key/nama kolom sesuai urutan data
  $key = ['kdbuku', 'judul', 'tahun', 'jumlah', 'jenis', 'idpeng', 'idpen'];

  // Handle file upload jika ada file baru
  if (!empty($_FILES['file']['name'])) {
    $uploadResult = uploadFile($_FILES['file']);

    if ($uploadResult['status']) {
      // Tambahkan file ke array data dan key
      $datas[] = $uploadResult['fileName'];
      $key[] = 'file';

      // Hapus file lama jika ada
      $oldFile = $_POST['oldFile'];
      if (!empty($oldFile) && file_exists('asset/img/buku/' . $oldFile)) {
        unlink('asset/img/buku/' . $oldFile);
      }
    } else {
      echo "<script>
              alert('Upload file gagal: " . $uploadResult['message'] . "');
              history.back();
          </script>";
      exit;
    }
  }

  if (update($title, $datas, $key, $id) > 0) {
    echo "<script>
          alert('Data berhasil diedit');
          document.location.href = 'buku.php';
      </script>";
  } else {
    echo "<script>
          alert('Data gagal diedit');
          document.location.href = 'buku.php';
      </script>";
  }
}

?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <?php if (isset($_SESSION['login'])): ?>
    <a href="" class="btn btn-success btn-md mb-3" onclick="tambah()" data-toggle="modal" data-target="#exampleModalCenter">Tambah Buku</a>
  <?php endif; ?>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h3 class="m-0 font-weight-bold text-primary">
        Data Buku
      </h3>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead class="thead-dark">
            <tr>
              <th>No</th>
              <th>File</th>
              <th>Judul</th>
              <th>Tahun</th>
              <th>Jumlah</th>
              <th>Pengarang</th>
              <th>Penerbit</th>
              <th>Jenis</th>
              <?php if (isset($_SESSION['login'])): ?>
                <th>Action</th>
              <?php endif; ?>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1;
            $row = mysqli_query($conn, "SELECT * FROM buku a, pengarang b, penerbit c WHERE a.idpeng=b.idpeng AND a.idpen=c.idpen");
            while ($data = mysqli_fetch_assoc($row)) : ?>
              <tr>
                <td><?= $no; ?></td>
                <td>
                  <?php if ($data['file'] != null) { ?>
                    <a href="asset/img/buku/<?= $data['file'] ?>" class="btn btn-primary btn-sm" target="_blank">Preview</a>
                  <?php } else { ?>
                    <a href="#" class="btn btn-danger btn-sm">Tidak ada file</a>
                  <?php } ?>
                </td>
                <td><?= $data["judul"]; ?></td>
                <td><?= $data["tahun"]; ?></td>
                <td><?= $data["jumlah"]; ?></td>
                <td><?= $data["nm_pengarang"]; ?></td>
                <td><?= $data["penerbit"]; ?></td>
                <td><?= $data["jenis"] ?? '-'; ?></td>
                <?php if (isset($_SESSION['login'])): ?>
                  <td><a class="btn btn-warning" href="#" onclick="edit(<?= $data['id']; ?>)" data-toggle="modal" data-target="#exampleModalCenter">edit</a>
                    <a class="btn btn-danger" href="hapusbuku.php?id=<?= $data["id"]; ?>" onclick="return confirm('yakin ingin hapus data?')">hapus</a>
                  </td>
                <?php endif; ?>
              </tr>
              <?php $no++; ?>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!--modal-->
<div class="modal fade" id="exampleModalCenter">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Data Buku</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST" enctype="multipart/form-data">
        <div id="form">
          <div class="modal-body">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="edit">tambah</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!--Endmodal-->
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<?php include 'footer.php'; ?>
<script>
  const xhr = new XMLHttpRequest();

  function jenisFile() {
    var kodeBuku = document.getElementById('kdbuku')
    var jenisFile = document.getElementById('jenis').value

    fetch('generateKode.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'prefix=' + encodeURIComponent(jenisFile)
      })
      .then(response => response.text())
      .then(result => {
        kodeBuku.value = result
      })
      .catch(error => {
        console.log(error);
      })
  }

  function edit(a) {
    var id = a;
    var form = document.getElementById('form');
    xhr.onreadystatechange = function() {

      if (xhr.readyState == 4 && xhr.status == 200) {
        form.innerHTML = xhr.responseText;
      }
    }

    xhr.open('GET', 'modal_editbuku.php?id=' + id, true);
    xhr.send();
  }

  function tambah() {
    var form = document.getElementById('form');
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {

      if (xhr.readyState == 4 && xhr.status == 200) {
        form.innerHTML = xhr.responseText;
      }
    }

    xhr.open('GET', 'modal_tambahbuku.php', true);
    xhr.send();
  }
  document.getElementById("buku").className = "nav-item active";
</script>