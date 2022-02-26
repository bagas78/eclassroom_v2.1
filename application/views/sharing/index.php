
    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">

          <?php if ($this->session->userdata('level') == 2): ?>
            <div align="left">
              <button class="btn btn-default" data-toggle="modal" data-target="#modal-album"><i class="fa fa-upload"></i> Upload File</button>
            </div>
          <?php endif ?>

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
                  <th>Nama Siswa</th>
                  <th style="width: 15%;">Deskripsi</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($data as $key): ?>
                                  
                  <tr>
                    <td><?php echo $key['user_name'] ?></td>
                    <td><?php echo $key['sharing_deskripsi'] ?></td>
                    <td <?= ($this->session->userdata('level') == 2)? 'style="width: 80px;"':'style="width: 10px;"' ?> >
                      <div>
                      <a href="<?php echo base_url('assets/file/'.$key['sharing_file']) ?>" target="_blank"><button class="btn btn-xs btn-default"><i class="fa fa-download"></i></button></a>

                    <?php if ($this->session->userdata('level') == 2): ?>
                      <button class="btn btn-xs btn-default" data-toggle="modal" data-target="#modal-edit<?php echo $key['sharing_id'] ?>"><i class="fa fa-edit"></i></button>
                      <button onclick="del('<?php echo base_url() ?>sharing/delete/<?php echo $key['sharing_id'] ?>')" class="btn btn-xs btn-default"><i class="fa fa-trash"></i></button>
                    <?php endif ?>

                      </div>
                    </td>
                  </tr>

                  <div class="modal fade" id="modal-edit<?php echo $key['sharing_id'] ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Edit File</h4>
                        </div>
                        <div class="modal-body">
                          <form role="form" method="post" action="<?php echo base_url() ?>sharing/update/<?php echo $key['sharing_id'] ?>" enctype="multipart/form-data">
                            <div class="box-body">
                              <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea required="" name="sharing_deskripsi" class="form-control"><?php echo $key['sharing_deskripsi'] ?></textarea>
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
                <h4 class="modal-title">Upload File Baru (doc/docx/pdf)</h4>
              </div>
              <div class="modal-body">
                <form role="form" method="post" action="<?php echo base_url() ?>sharing/add" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                      <label>File</label>
                      <input required="" type="file" name="sharing_file" class="form-control" placeholder="Nama Lengkap">
                    </div>
                    <div class="form-group">
                      <label>Deskripsi</label>
                      <textarea maxlength="120" required="" name="sharing_deskripsi" class="form-control"></textarea>
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


       

  


    
      