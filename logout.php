<?php 
session_start();
session_unset();


echo "<script>
          alert('Anda Telah Logout');
          document.location.href ='index.php';
      </script>";
?>