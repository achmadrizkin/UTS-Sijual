<?php
include "include/config.php";
include "include/lib.php";
include "include/koneksi.php";
if(!is_login()){
  header("Location:login.php");
}

include "template/header.php";
include "template/sidebar.php";


$sql = "select count(*) as jumlah from pelanggan";
$data = mysqli_query($koneksi,$sql);
$row = mysqli_fetch_assoc($data);
$jumlahpelanggan = $row['jumlah'];

//jumlahsiswa
$sql = "select count(*) as jumlah from kategori";
$data = mysqli_query($koneksi,$sql);
$row = mysqli_fetch_assoc($data);
$jumlahkategori = $row['jumlah'];

//jumlahkelas
$sql = "select count(*) as jumlah from barang";
$data = mysqli_query($koneksi,$sql);
$row = mysqli_fetch_assoc($data);
$jumlahbarang = $row['jumlah'];

?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $jumlahpelanggan;?></h3>

                <p>Data Pelanggan</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?php echo BASE_URL;?>pages/masterpelanggan/index.php" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $jumlahkategori;?></h3>

                <p>Data Kategori</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?php echo BASE_URL;?>pages/masterkategori/index.php" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $jumlahbarang;?></h3>

                <p>Data Barang</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="<?php echo BASE_URL;?>pages/masterbarang/index.php" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
include "template/footer.php";
?>