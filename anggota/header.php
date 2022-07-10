<?php
include '../fungsi.php';
error_reporting(0);

if(isset($_SESSION['agt'])){
$nama = $_SESSION['nama'];
$id = $_SESSION['idagt'];
}else{
    $nama="user";
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
    <link rel="icon" type="image" href="../icon.png">
    <title>E-Perpustakaan</title>

    <!-- Custom fonts for this template -->
    <link href="../vendor/fontawesome-free-5.14.0-web/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="../https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet" />

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />
</head>

<body id="page-top" style="background-color: blue ;">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <img src="../buku.png" alt="">
                </div>
                <div class="sidebar-brand-text mx-3">perpustakaan</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- menu 1 -->
            <li class="nav-item" id="dashboard">
                <a class="nav-link" href="index.php?back=1">
                    <i class="fa fa-desktop" aria-hidden="true"></i>
                    <span>Dashboard</span></a>
            </li>            
            <!-- menu 4 -->
            <li class="nav-item" id="dataanggota">
                <a class="nav-link" href="pinjam.php">
                    <i class="fa fa-address-card" aria-hidden="true"></i>
                    <span>Pinjam</span></a>
            </li>
            <!-- menu 5 -->
            <li class="nav-item" id="pengarang">
                <a class="nav-link" href="pengembalian.php">
                    <i class="fa fa-user-tie" aria-hidden="true"></i>
                    <span>Pengembalian</span></a>
            </li>
            <?php if(isset($_SESSION['agt'])):?>
                <li class="nav-item" id="menu6">
                    <a class="nav-link" href="logout.php">
                        <i class="fa fa-outdent" aria-hidden="true"></i>
                        <span>Logout</span></a>
            </li>
            <?php else:?>
            <li class="nav-item" id="menu6">
                <a class="nav-link" href="login.php">
                    <i class="fa fa-indent" aria-hidden="true"></i>
                    <span>Login</span></a>
            </li>
            <?php endif;?>
            

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php if($nama!=null){echo $nama;};?></span>
                    </ul>

                </nav>
                <!-- End of Topbar -->