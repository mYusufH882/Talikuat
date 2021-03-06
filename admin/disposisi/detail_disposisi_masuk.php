<?php
session_start();
include "../../src/talikuat.php";
include "../../src/LogHistory.php";
include "../../fungsi/view/tampil.php";
include "../cekadmin.php";
include "../tgl_indo.php";
include "../../konfigurasi/koneksi.php";

if (!isset($_SESSION['nama'])) {
    echo '<script language="javascript">alert("Anda harus Login!"); document.location="../index.php";</script>';
}

$talikuat = new talikuat();
$tampil = new tampil();
$log = new LogHistory();
$hasil2 = $tampil->kontraktor_row();
$hasil3 = $tampil->konsultan_row();
$hasil4 = $tampil->ppk_row();
$hasil5 = $tampil->data_umum_admin();

$menu = "Detail Disposisi Masuk";
$log_write = $log->recordLog($menu);

$paket = mysqli_query($konek, "SELECT kegiatan, sum(volume) as persen FROM master_laporan_harian group by kegiatan");
while ($row = mysqli_fetch_array($paket)) {
    $nama_paket[] = $row['kegiatan'];

    $query = mysqli_query($konek, "SELECT kegiatan, sum(volume) as persen FROM master_laporan_harian where kegiatan='" . $row['kegiatan'] . "'");
    $row = $query->fetch_array();
    $jumlah_persen[] = $row['persen'];
    // die(var_dump($row));
}
// $pak = mysqli_query($konek, "SELECT kegiatan, sum(detail_jadual.volume + detail_laporan_harian_pekerjaan.volume) as persen FROM detail_laporan_harian_pekerjaan JOIN detail_jadual ON detail_laporan_harian_pekerjaan.no_trans = detail_jadual.id GROUP BY kegiatan");
$pak = mysqli_query($konek, "SELECT sum(detail_jadual.volume + detail_laporan_harian_pekerjaan.volume) as persen FROM detail_laporan_harian_pekerjaan JOIN detail_jadual ON detail_laporan_harian_pekerjaan.no_trans = detail_jadual.id");
while ($row = mysqli_fetch_array($pak)) {
    // $nama_pak[] = $row['kegiatan'];

    // $query = mysqli_query($konek, "SELECT kegiatan, sum(detail_jadual.volume + detail_laporan_harian_pekerjaan.volume) as persen FROM detail_laporan_harian_pekerjaan JOIN detail_jadual ON detail_laporan_harian_pekerjaan.no_trans = detail_jadual.id WHERE kegiatan = '" . $row['kegiatan'] . "'");
    $query = mysqli_query($konek, "SELECT sum(detail_jadual.volume + detail_laporan_harian_pekerjaan.volume) as persen FROM detail_laporan_harian_pekerjaan JOIN detail_jadual ON detail_laporan_harian_pekerjaan.no_trans = detail_jadual.id");
    $row = $query->fetch_array();
    $persen[] = $row['persen'];
    // die(var_dump($row));
}

// die(json_encode($persen));
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TaliKuatBimaJabar | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!--<link rel="stylesheet" href="../css/ionicons.min.css">-->
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../../plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <!--  
      <li class="nav-item d-none d-sm-inline-block">
        <a href="admin/index.php" class="nav-link">Home </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
	-->
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <!--
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
	-->
            </form>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <!--
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
		 -->
                <!-- Message Start -->
                <!--
		<div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
		-->
                <!-- Message End -->
                <!--
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
		-->
                <!-- Message Start -->
                <!--	
            <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
		-->
                <!-- Message End -->
                <!--	
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
		-->
                <!-- Message Start -->
                <!--	
            <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
		-->
                <!-- Message End -->
                <!--	
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
	  -->
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <!--
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
	  -->
                </li>
                <li class="nav-item">
                    <!--
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      -->
                    <a class="nav-link" data-slide="true" href="../../logout.php">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </li>
            </ul>

        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php require_once("navbar-menu.php"); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Disposisi Masuk</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Disposisi Masuk</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <section class="content">

                        <!-- Default box -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Disposisi Masuk</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                        <i class="fas fa-times"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="col-lg-12">

                                    <!-- Nav pills -->
                                    <ul class="nav nav-pills">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="pill" href="#detail">Detail</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="pill" href="#lampiran">Lampiran</a>
                                        </li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content p-4">
                                        <div class="tab-pane container active" id="detail">

                                            <h1 class="text-center">Detail Data</h1>
                                            <div class="table-responsive">
                                                <table class="table-bordered table-striped nowrap" cellpadding="8" align="center">
                                                    <?php
                                                        $id = $_SESSION['id_logged']; //id login admin
                                                        $data = $talikuat->getDetailMasuk($id);

                                                        if($data) {
                                                    ?>
                                                    <tr>
                                                        <th>Disposisi Code</th>
                                                        <td><?= $data[1]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Pemberi Disposisi</th>
                                                        <td><?= $data[2]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Surat dari</th>
                                                        <td><?= $data[3]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Perihal</th>
                                                        <td><?= $data[4]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Tanggal Surat</th>
                                                        <td><?= tgl_indo($data[5]); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>No Surat</th>
                                                        <td><?= $data[6]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Tanggal Penyelesaian</th>
                                                        <td><?= tgl_indo($data[7]); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Status</th>
                                                        <td>
                                                            <?php 
                                                                $status = $data[8];
                                                                if ($status == "1") {
                                                                    echo '<button class="  btn btn-inverse btn-mini btn-round">Submitted</button> ';
                                                                } else if ($status == "2") {
                                                                    echo '<button class="btn btn-info btn-mini btn-round">Accepted</button> ';
                                                                } else if ($status == "3") {
                                                                    echo '<button class="btn btn-success  btn-mini btn-round">On Progress</button> ';
                                                                } else if ($status == "4") {

                                                                    echo '<button class="btn btn-info  btn-mini btn-round">Finish</button> ';
                                                                }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Disposisi Kepada</th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Dibuat Tanggal</th>
                                                        <td><?= $data[10]; ?></td>
                                                    </tr>
                                                    <?php } else { ?>
                                                        <tr>
                                                            <td colspan="">Data Kosong</td>
                                                        </tr>
                                                    <?php } ?>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane container fade" id="lampiran">
                                            <?php if($data) { ?>
                                                <iframe src="../../lampiran/disposisi_pdf/<?= $data[9]; ?>" width="600" height="400" frameborder="0"></iframe>
                                            <?php } else { ?>
                                                <h2 class="text-center">Lampiran Tidak Tersedia</h2>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2020 <a href="#"></a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> Beta
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="../../plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="../../plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="../../plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="../../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../../plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="../../plugins/moment/moment.min.js"></script>
    <script src="../../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="../../plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../../dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <!-- ChartJS -->
    <script src="../../plugins/chart.js/Chart.js"></script>
    <script src="../../plugins/chart.js/Chart.min.js"></script>
    <script src="../../plugins/chart.js/highcharts.js"></script>
    <script src="http://code.highcharts.com/modules/exporting.js"></script>
</body>

</html>