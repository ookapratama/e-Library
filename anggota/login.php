<?php
session_start();
session_unset();

require '../fungsi.php';
//login
if (isset($_POST["login"])) {
    //mengambil data dari post
    $username = $_POST["idAng"];
    $password = $_POST["password"];
    //mencari data didatabase sesuai post
    $result = mysqli_query($conn, "SELECT * FROM anggota WHERE  idagt ='$username'");
    //cek apakah data ditemukan
    if (mysqli_num_rows($result) === 1) {
        //mengambil data dari dari variable result merubah jadi array
        $row = mysqli_fetch_assoc($result);
        //cek password
        if ($password == $row["password"]) {
                $_SESSION['agt'] = true;
                $_SESSION['nama'] = $row["nama"];
                $_SESSION['idagt'] = $_POST["idAng"];
                header("location:index.php");
        } else {
            echo "<script>
                alert('password salah');
                document.location.href ='login.php';
            </script>";
        }
    } else {
        echo "<script>
        alert('username salah');
        document.location.href ='login.php';
    </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
    
        <title>Login Anggota E-Library</title>
    
        <!-- Custom fonts for this template -->
        <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
        <link href="../https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    
        <!-- Custom styles for this template -->
        <link href="../css/sb-admin-2.min.css" rel="stylesheet" />
    
        <!-- Custom styles for this page -->
        <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />
    </head>
<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-black my-4">Anggota E-Library</h3>
                                </div>
                                <div class="card-body">
                                    <form class="user" method="POST" action="login.php">
                                            <div class=" form-group">
                                            <input class="form-control py-4 mb-4" id="idAng" type="text" name="idAng" placeholder="Id Anggota" />
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control py-4 mb-1 " id="password" type="password" name="password" placeholder="Password" />
                                            </div>
                                            <div class="small form-group">
                                                <input type="checkbox" id="show" class="small from-checkbox mt-0 " onclick="showpass()">
                                                <label for="show">Show Password</label>
                                            </div>
                                            <div class="form-group d-flex justify-content-between mt-3 mb-0">
                                                <a href="../index.php" class="btn btn-danger" style="font-size: medium;">
                                                    Batal
                                                </a>
                                                <button type="submit" class="btn btn-success" name="login">
                                                    Login
                                                </button>
                                            </div>
                                        </div>
                                    
                                        <script src="js/jquery-3.5.1.min.js"></script>
                                        <script src="js/popper.min.js"></script>
                                        <script src="js/bootstrap.js"></script>
                                        <script src="js/scripts.js"></script>
</body>
<script>
    function showpass() {
  var show = document.getElementById("show");
  var pass = document.getElementById("password");
  if (show.checked == true) {
    pass.type = "text";
  } else {
    pass.type = "password";
  }
}
</script>
</html>