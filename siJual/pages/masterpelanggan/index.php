<?php
include "../../include/config.php";
include "../../include/lib.php";
include "../../include/koneksi.php";
include "../../template/header.php";
include "../../template/sidebar.php";
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
            <a href="<?php echo BASE_URL;?>pages/masterpelanggan/tambah.php" class="btn btn-primary align-right"><i class="fa fa-plus"></i>&nbsp;Tambah</a>
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
                <h3 class="card-title">Data Pelanggan Keseluruhan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                          <th>Kode</th>
                          <th>Nama</th>
                          <th>Telp</th>
                          <th>Alamat</th>
                          <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                          $sql = "select * from pelanggan";
                          $data = mysqli_query($koneksi,$sql);
                          
                          while($row=mysqli_fetch_assoc($data)){
                            ?>
                              <tr>
                          <td><?php echo $row['kdplg'];?></td>
                          <td><?php echo $row['nama'];?></td>
                          <td><?php echo $row['telp'];?></td>
                          <td><?php echo $row['alamat'];?></td>
                          <td><a title="edit" href="<?php echo BASE_URL;?>pages/masterpelanggan/edit.php?id=<?php echo $row['kdplg'];?>" class="btn btn-warning text-white align-right"><i class="fa fa-edit"></i></a> 
                          &nbsp;
                          <a title="hapus" href="<?php echo BASE_URL;?>pages/masterpelanggan/hapus.php?id=<?php echo $row['kdplg'];?>" class="btn btn-danger text-white show_confirm align-right"><i class="fa fa-trash"></i></a>
                           </td>
                        </tr>
                            <?php
                          }
                        ?>
                    </tbody>
                      <tfoot>
                        <tr>
                          <th>Kode</th>
                          <th>Nama</th>
                          <th>Telp</th>
                          <th>Alamat</th>
                          <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
                
              </div>
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
<!-- DataTables  & Plugins -->
<script src="<?php echo PLUGIN_URL;?>datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo PLUGIN_URL;?>datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo PLUGIN_URL;?>datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo PLUGIN_URL;?>datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo PLUGIN_URL;?>datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo PLUGIN_URL;?>datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo PLUGIN_URL;?>jszip/jszip.min.js"></script>
<script src="<?php echo PLUGIN_URL;?>pdfmake/pdfmake.min.js"></script>
<script src="<?php echo PLUGIN_URL;?>pdfmake/vfs_fonts.js"></script>
<script src="<?php echo PLUGIN_URL;?>datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo PLUGIN_URL;?>datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo PLUGIN_URL;?>datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
  $(function () {
     $('.show_confirm').click(function(e) {
        if(!confirm('Yakin ingin menghapus data ini?')) {
            e.preventDefault();
        }
    });
    
    $("#datatable").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');
  });
</script>