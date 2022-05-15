<?php
include "../../include/config.php";
include "../../include/lib.php";
include "../../include/koneksi.php";
include "../../template/header.php";
include "../../template/sidebar.php";

//simpan
if(isset($_POST['simpan'])){
    $idbarang = sanitasi_input($_POST['idbarang']);
    $nama = sanitasi_input($_POST['nama']);
    $idkategori = sanitasi_input($_POST['idkategori']);
    $harga = sanitasi_input($_POST['harga']);
    $stok = sanitasi_input($_POST['stok']);
    $created_at = waktusekarang();
    $created_by = $_SESSION['username'];
    //cek udah ada nama barang yg sama?
    $sql = "SELECT * FROM barang WHERE nama='$nama'";
    $result = mysqli_query($koneksi,$sql);
    $jumlah = mysqli_num_rows($result);
    if($jumlah>0){
      $error = "Nama barang sudah pernah diinput ke database";
    }else{
      //siapkan kueri insert
      $sql2 = "insert into barang(idbarang,nama,idkategori,harga,stok,created_at,created_by) VALUES('$idbarang','$nama','$idkategori','$harga','$stok','$created_at','$created_by')";
      //die($sql2);
      $result2 = mysqli_query($koneksi,$sql2);
      if($result2){
        $success = "Data Berhasil Disimpan ke Database";
      }else{
        $error = "Data Gagal Disimpan ke Database ".mysqli_error();
      }
    }
}
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Master Barang</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 text-right">
            <a href="<?php echo BASE_URL;?>pages/masterbarang/index.php" class="btn btn-primary align-right"><i class="fa fa-arrow-left"></i>&nbsp;Kembali</a>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
         <div class="col-12">
         <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tambah Data Barang</h3>
              </div>
              <!-- /.card-header -->
            <?php
            if(isset($error)){
        echo "<div class='alert alert-danger text-center'>$error</div>";
      }
      if(isset($success)){
        echo "<div class='alert alert-success text-center'>$success</div>";
      }
            ?>
                <form id="form1" action="" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="idbarang">Kode Barang</label>
                    <input type="text" name="idbarang" class="form-control" id="idbarang" placeholder="Kode Barang" required>
                  </div>
                  <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Lengkap" required>
                  </div>
                  <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select name="idkategori" id="idkategori" class="form-control" required>
                      <?php 
                      $sql = "select * from kategori order by nama";
                      $data = mysqli_query($koneksi,$sql);
                      while($row=mysqli_fetch_assoc($data)){
                        echo "<option value='".$row['idkategori']."'>".$row['nama']."</option>";      
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="alamat">Harga</label>
                    <input type="number" name="harga" class="form-control" id="harga" placeholder="Harga" required>
                  </div>

                  <div class="form-group">
                    <label for="alamat">Stok</label>
                    <input type="number" name="stok" class="form-control" id="stok" placeholder="Barang" required>
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="submit" class="btn btn-primary" name="simpan" value="Simpan">
                </div>
              </form>
                
              <!-- /.card-body -->
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
include "../../template/footer.php";
?>
<!-- jquery-validation -->
<script src="<?php echo PLUGIN_URL;?>jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo PLUGIN_URL;?>jquery-validation/additional-methods.min.js"></script>
<script>
  $(function () {
  $('#form1').validate({
    rules: {
      idbarang: {
        required: true,
      },
      nama: {
        required: true,
        maxlength: 100
      },
      harga: {
        required: true
      },
      stok: {
        required: true
      },
    },
    messages: {
      idbarang: {
        required: "idbarang Harus Diisi"
      },
      nama: {
        required: "Nama Harus Diisi",
        maxlength: "Maksimal 100 karakter"
      },
      harga: {
        required : "Pilih Salah Satu"
      },
      stok: {
        required : "Harus Diisi"
      }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>