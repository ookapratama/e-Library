<?php
include 'fungsi.php';
$id = $_GET['id'];
$hapus= mysqli_query($conn, "DELETE FROM pengarang WHERE idpeng=$id");
if(mysqli_affected_rows($conn)>0){
  echo "<script>
            alert('Data berhasil dihapus');
            document.location.href ='pengarang.php';
        </script>";
}


?>