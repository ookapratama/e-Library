<?php
include 'fungsi.php';
$id = $_GET['id'];
$hapus= mysqli_query($conn, "DELETE FROM penerbit WHERE idpen=$id");
if(mysqli_affected_rows($conn)>0){
  echo "<script>
            alert('Data berhasil dihapus');
            document.location.href ='penerbit.php';
        </script>";
}


?>