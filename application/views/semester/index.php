
    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">

          <div align="left">
              <button class="btn btn-default" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i> Tambah</button>
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
                  <th>Semester</th>
                  <th>Jumlah Pertemuan</th>
                  <th width="1">Action</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($data as $key): ?>
                                  
                  <tr>
                    <td><?php echo $key['semester_no'] ?></td>
                    <td><?php echo $key['semester_pertemuan'] ?></td>
                    <td style="width: 80px;">
                      <div>
                     <button class="btn btn-xs btn-default" data-toggle="modal" data-target="#edit<?php echo $key['semester_id'] ?>"><i class="fa fa-edit"></i></button>
                      <button onclick="del('<?php echo base_url() ?>semester/delete/<?php echo $key['semester_no'] ?>')" class="btn btn-xs btn-default"><i class="fa fa-trash"></i></button>

                      </div>
                    </td>
                  </tr>

                  <div class="modal fade" id="edit<?php echo $key['semester_id'] ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Edit Semester</h4>
                        </div>
                        <div class="modal-body">
                          <form role="form" method="post" action="<?php echo base_url() ?>semester/update">
                            <div class="box-body">
                              <div class="form-group">
                                <label>Semester</label>
                                <input required="" type="number" name="semester_no" class="form-control" value="<?php echo $key['semester_no'] ?>">
                              </div>
                              <div class="form-group">
                                <label>Jumlah Pertemuan</label>
                                <input required="" type="number" name="semester_pertemuan" class="form-control" value="<?php echo $key['semester_pertemuan'] ?>">
                              </div>
                              
                            </div>

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

<div class="modal fade" id="add">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Semester</h4>
      </div>
      <div class="modal-body">
        <form role="form" method="post" action="<?php echo base_url() ?>semester/insert" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label>Semester</label>
              <input required="" type="number" name="semester_no" class="form-control" value="">
            </div>
            <div class="form-group">
              <label>Jumlah Pertemuan</label>
              <input required="" type="number" name="semester_pertemuan" class="form-control">
            </div>
            
          </div>

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