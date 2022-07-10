<?php
include 'fungsi.php';
$id = $_GET['id'];
if(hapus('admin',$id)>0){
  echo "<script>
            alert('Data berhasil dihapus');
            document.location.href ='dataadmin.php';
        </script>";
}


?>