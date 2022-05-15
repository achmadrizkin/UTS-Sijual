<?php
include "../../include/config.php";
include "../../include/lib.php";
include "../../include/koneksi.php";
include "../../template/header.php";
include "../../template/sidebar.php";

//simpan
if(isset($_POST['simpan'])){
    $kdplg = sanitasi_input($_POST['kdplg']);
    $nama = sanitasi_input($_POST['nama']);
    $telp = sanitasi_input($_POST['telp']);
    $alamat = sanitasi_input($_POST['alamat']);
    $created_at = waktusekarang();
    $created_by = $_SESSION['username'];
    //cek udah ada kdplg yg sama?
    $sql = "SELECT * FROM pelanggan WHERE kdplg='$kdplg'";
    $result = mysqli_query($koneksi,$sql);
    $jumlah = mysqli_num_rows($result);
    if($jumlah>0){
      $error = "kode pelanggan sudah pernah diinput ke database";
    }else{
      //siapkan kueri insert
      $sql2 = "insert into pelanggan(kdplg,nama,telp,alamat,created_at,created_by) VALUES('$kdplg','$nama','$telp','$alamat','created_at','$created_by')";
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
            <h1 class="m-0">Master Pelanggan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 text-right">
            <a href="<?php echo BASE_URL;?>pages/masterpelanggan/index.php" class="btn btn-primary align-right"><i class="fa fa-arrow-left"></i>&nbsp;Kembali</a>
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
                <h3 class="card-title">Tambah Data Pelanggan</h3>
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
                    <label for="kdplg">Kode Pelanggan</label>
                    <input type="text" name="kdplg" class="form-control" id="kdplg" placeholder="Harus 8 Karakter" required maxlength="8">
                  </div>
                  <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Lengkap" required>
                  </div>
                  <div class="form-group">
                    <label for="tgllahir">Telp</label>
                    <input type="text" name="telp" class="form-control" id="telp" required>
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Alamat" required>
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
      kdplg: {
        required: true,
        maxlength: 8,
        minlength:8
      },
      nama: {
        required: true,
        maxlength: 100
      },
      telp: {
        required: true
      },
      alamat: {
        required: true
      },
    },
    messages: {
      kdplg: {
        required: "kdplg Harus Diisi",
        minlength: "Minimal 8 Karakter",
        maxlength: "Maksimal 8 Karakter",
      },
      nama: {
        required: "Nama Harus Diisi",
        maxlength: "Maksimal 100 karakter"
      },
      telp: {
        required : "Harus Diisi"
      },
      alamat: {
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