<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= $title; ?></title>

  <!-- Custom fonts for this template-->
  <link href="<?= base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('manager'); ?>">
        <div class="sidebar-brand-icon rotate-n">
          <img class="rounded-circle" src="<?= base_url(); ?>assets/img/logokartika70px.jpg" alt="">
        </div>
        <div class="sidebar-brand-text mx-3">Distribusi Barang </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('manager/lihatBarang'); ?>">
          <i class="fas fa-database"></i>
          <span>Data Barang</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">


      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('manager/prosesDistribusi'); ?>">
          <i class="fas fa-shopping-cart"></i>
          <span>Permintaan Barang</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('manager/Distribusi'); ?>">
          <i class="fas fa-truck"></i>
          <span>Proses Lacak</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout') ?>" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          <span>Logout</span></a>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

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
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['nama'] ?> || <?= $titleGud; ?></span>
                <img class="img-profile rounded-circle" src="<?= base_url(); ?>assets/img/profile.png">
              </a>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <h3 class="h5 mb-4 text-gray-800">Selamat Datang Manager Toko Anda Dapat melakukan permintaan pengiriman sesuai procedure yang ada </h3>
          <!-- col lg 3 -->
          <div class="form-group">
            <div class="table-responsive">
              <span>Keranjang Distribusi</span>
              <form action="<?php echo base_url() ?>manager/ubah_cart" method="post" name="frmShopping" id="frmShopping" class="form-horizontal" enctype="multipart/form-data">
                <table id="dataTable2" class="table table-bordered" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>Name</th>
                      <th>qty</th>
                      <th>Tombol</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    $cart = $this->cart->contents();

                    // If cart is empty, this will show below message.
                    if (empty($cart)) {
                      ?>
                      <a class="list-group-item">Keranjang Belanja Kosong</a>
                    <?php
                  } else {
                    // $grand_total = 0;
                    foreach ($cart as $item) {
                      // $grand_total += $item['subtotal'];
                      ?>

                        <input type="hidden" name="cart[<?php echo $item['id']; ?>][id]" value="<?php echo $item['id']; ?>" />
                        <input type="hidden" name="cart[<?php echo $item['id']; ?>][rowid]" value="<?php echo $item['rowid']; ?>" />
                        <input type="hidden" name="cart[<?php echo $item['id']; ?>][name]" value="<?php echo $item['name']; ?>" />
                        <input type="hidden" name="cart[<?php echo $item['id']; ?>][price]" value="<?php echo $item['price']; ?>" />
                        <input type="hidden" name="cart[<?php echo $item['id']; ?>][qty]" value="<?php echo $item['qty']; ?>" />
                        <tr>
                          <td><?php echo $item['id']; ?></td>
                          <td><?php echo $item['name']; ?></td>
                          <td><input type="text" class="form-control input-sm" name="cart[<?php echo $item['id']; ?>][qty]" value="<?php echo $item['qty']; ?>" /></td>
                          <td><a href="<?php echo base_url() ?>manager/hapus/<?php echo $item['rowid']; ?>" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></a></td>
                        </tr>
                        <tr>

                        </tr>

                      <?php
                    }
                    ?>
                      <td colspan="4" align="right">
                        <a data-toggle="modal" data-target="#myModal" class='btn btn-sm btn-danger'>Kosongkan Cart</a>
                        <button class='btn btn-sm btn-success' type="submit">Update Cart</button>
                        <a data-toggle="modal" data-target="#myModul" class='btn btn-sm btn-primary'>Check Out</a>
                        <!-- href="<?php echo base_url() ?>manager/proses_distribusi" -->
                      <?php
                    }
                    ?>
                  </tbody>
                </table>
              </form>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Distribusi Barang Ke Toko</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?= base_url('auth/logout') ?>">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Penilai -->
  <div class="modal fade" id="myModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <!-- Modal content-->
      <div class="modal-content">
        <form method="post" action="<?php echo base_url() ?>manager/hapus/all">
          <div class="modal-header">
            <h4 class="modal-title">Konfirmasi</h4>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            Anda yakin mau mengosongkan Distribusi Cart?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Tidak</button>
            <button type="submit" class="btn btn-sm btn-default">Ya</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--End Modal-->
  <!-- modal checkOut -->
  <div class="modal fade" id="myModul" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <?php
          $grand_total = 0;
          if ($cart = $this->cart->contents()) {
            foreach ($cart as $item) {
              $grand_total = $grand_total + $item['qty'];
            }
            echo "<h4>Total Item: Rp." . number_format($grand_total, 0, ",", ".") . "</h4>";
            ?>
            <form class="form-horizontal" action="<?php echo base_url() ?>manager/proses_distribusi" method="post" name="frmCO" id="frmCO">
              <div class="form-group  has-success has-feedback">
                <label class="control-label col-xs-3" for="inputEmail">Nama:</label>
                <div class="col-xs-9">
                  <input type="hidden" name="iduser" id="iduser" value="<?= $user['iduser'] ?>">
                  <input type="hidden" name="idtoko" id="iduser" value="<?= $user4['idtoko'] ?>">
                  <input type="text" class="form-control" name="nama" id="nama" placeholder="nama" value="<?= $user['nama'] ?>">
                </div>
              </div>
              <div class="form-group  has-success has-feedback">
                <label class="control-label col-xs-3" for="firstName">Id Manager :</label>
                <div class="col-xs-9">
                  <input type="text" class="form-control" name="idmanager" id="idmanager" placeholder="idmanager" value="<?= $user4['idmanager'] ?>">
                </div>
              </div>
              <div class="form-group  has-success has-feedback">
                <label class="control-label col-xs-3" for="lastName">Tanggal:</label>
                <div class="col-xs-9">
                  <input type="date" class="form-control" name="tanggal" id="tanggal">
                </div>
              </div>
              <div class="form-group  has-success has-feedback">
                <div class="col-xs-offset-3 col-xs-9">
                  <button type="submit" class="btn btn-primary">Proses Order</button>
                </div>
              </div>
            </form>
          <?php
        } else {
          echo "<h5>Shopping Cart masih kosong</h5>";
        }
        ?>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url(); ?>assets/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="<?= base_url(); ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?= base_url(); ?>assets/js/demo/datatables-demo.js"></script>

  <script src="<?= base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
</body>

</html>