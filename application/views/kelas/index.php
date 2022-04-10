
    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">

            <div align="left">
              <button class="btn btn-default" data-toggle="modal" data-target="#modal-album"><i class="fa fa-plus"></i> Tambah</button>
            </div>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
         
          <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Kelas / Jurusan</th>
                  <th>Kepanjangan</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($data as $key): ?>
                                  
                  <tr>
                    <td><?php echo $key['kelas_nama'] ?></td>
                    <td><?php echo $key['kelas_kepanjangan'] ?></td>
                    <td style="width: 50px;">
                      <div>
                      <button class="btn btn-xs btn-default" data-toggle="modal" data-target="#modal-edit<?php echo $key['kelas_id'] ?>"><i class="fa fa-edit"></i></button>
                      <!-- <button onclick="del('<?php echo base_url() ?>kelas/delete/<?php echo $key['kelas_id'] ?>')" class="btn btn-xs btn-default"><i class="fa fa-trash"></i></button> -->

                      </div>
                    </td>
                  </tr>

                  <div class="modal fade" id="modal-edit<?php echo $key['kelas_id'] ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Edit Kelas</h4>
                        </div>
                        <div class="modal-body">
                          <form role="form" method="post" action="<?php echo base_url() ?>kelas/update/<?php echo $key['kelas_id'] ?>" enctype="multipart/form-data">
                            <div class="box-body">
                              <div class="form-group">
                                <label>Kelas / Jurusan</label>
                                <input required="" type="text" name="kelas_nama" class="form-control" placeholder="Nama Kelas" value="<?php echo $key['kelas_nama'] ?>">
                              </div>
                              <div class="form-group">
                                <label>Kepanjangan</label>
                                <input required="" type="text" name="kelas_kepanjangan" class="form-control" placeholder="Nama Kelas" value="<?php echo $key['kelas_kepanjangan'] ?>">
                              </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                              <button type="submit" class="btn btn-default">Submit <i class="fa fa-check"></i></button>
                               <button type="reset" class="btn btn-default">Reset <i class="fa fa-times"></i></button>
                            </div>
                          </form>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->
                <?php endforeach ?>

                </tfoot>
              </table>

        </div>

        
      </div>
      <!-- /.box -->


  <div class="modal fade" id="modal-album">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Kelas</h4>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="<?php echo base_url() ?>kelas/add" enctype="multipart/form-data">
            <div class="box-body">
              <div class="form-group">
                <label>Kelas / Jurusan</label>
                <input required="" type="text" name="kelas_nama" class="form-control" placeholder="Nama Kelas" value="">
              </div>
              <div class="form-group">
                <label>Kepanjangan</label>
                <input required="" type="text" name="kelas_kepanjangan" class="form-control" placeholder="Nama Kelas" value="">
              </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" class="btn btn-default">Submit <i class="fa fa-check"></i></button>
               <button type="reset" class="btn btn-default">Reset <i class="fa fa-times"></i></button>
            </div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->