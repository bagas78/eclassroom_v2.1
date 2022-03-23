
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
                  <th>Kelompok</th>
                  <th>Kelas</th>
                  <th>Anggota</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($data as $key): ?>
                                  
                  <tr>
                    <td><?php echo $key['kelompok_nama'] ?></td>
                    <td><?php echo $key['kelas_nama'] ?></td>
                    <td><?php $str = str_replace(['[',']'], '', $key['kelompok_siswa']); $db = $this->db->query("SELECT * FROM t_user WHERE user_id IN($str)")->result_array(); foreach ($db as $val) {echo '<span class="badge">'.$val['user_email'].' '.$val['user_name'].'</span> ';} ?></td>
                    <td style="width: 50px;">
                      <div>
                      <button class="btn btn-xs btn-default" data-toggle="modal" data-target="#modal-edit<?php echo $key['kelompok_id'] ?>"><i class="fa fa-edit"></i></button>
                      <button onclick="del('<?php echo base_url() ?>kelompok/delete/<?php echo $key['kelompok_id'] ?>')" class="btn btn-xs btn-default"><i class="fa fa-trash"></i></button>

                      </div>
                    </td>
                  </tr>


                <div class="modal fade" id="modal-edit<?php echo $key['kelompok_id'] ?>">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Edit Kelompok</h4>
                      </div>
                      <div class="modal-body">
                        <form role="form" method="post" action="<?php echo base_url() ?>kelompok/update/<?php echo $key['kelompok_id'] ?>" enctype="multipart/form-data">
                          <div class="box-body">
                            <div class="form-group">
                              <label>Kelompok Nama</label>
                              <input required="" type="text" name="kelompok_nama" class="form-control" placeholder="Nama Kelompok" value="<?php echo $key['kelompok_nama'] ?>">
                            </div>
                            <div class="form-group">
                              <label>kelas</label>
                              <select id="kelas<?php echo $key['kelompok_id'] ?>" onchange="get_siswa(this.value,'siswa<?php echo $key['kelompok_id'] ?>')" class="form-control" name="kelompok_kelas">
                                <option value="" hidden="">-- Kelas --</option>
                                <?php foreach ($kelas_data as $k): ?>
                                  <option value="<?php echo $k['kelas_id'] ?>"><?php echo $k['kelas_nama'] ?></option>
                                <?php endforeach ?>
                              </select>

                              <script type="text/javascript">
                                $('#kelas<?php echo $key['kelompok_id'] ?>').val(<?php echo $key['kelompok_kelas']; ?>).change();
                              </script>

                            </div>
                            <div class="form-group">
                              <label>Siswa</label><br/>
                              <select id="siswa<?php echo $key['kelompok_id'] ?>" style="width: 100%;" class="form-control select2" multiple="multiple" name="kelompok_siswa[]" data-placeholder="-- Pilih --">

                                <?php $kls = $key['kelompok_kelas'] ?>
                                <?php $siswa_data = $this->db->query("SELECT * FROM t_user WHERE user_hapus = 0 AND user_kelas = '$kls'")->result_array(); ?>
                                <?php foreach ($siswa_data as $s): ?>
                                  <option value="<?php echo $s['user_id'] ?>"><?php echo $s['user_name'] ?></option>
                                <?php endforeach ?>
                                
                              </select>

                              <script type="text/javascript">
                                $('#siswa<?php echo $key['kelompok_id'] ?>').val([<?php echo $key['kelompok_siswa']; ?>]).change();
                              </script>

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
          <h4 class="modal-title">Tambah Kelompok</h4>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="<?php echo base_url() ?>kelompok/add" enctype="multipart/form-data">
            <div class="box-body">
              <div class="form-group">
                <label>Kelompok Nama</label>
                <input required="" type="text" name="kelompok_nama" class="form-control" placeholder="Nama Kelompok" value="">
              </div>
              <div class="form-group">
                <label>kelas</label>
                <select onchange="get_siswa(this.value,'siswa')" class="form-control" name="kelompok_kelas">
                  <option value="" hidden="">-- Kelas --</option>
                  <?php foreach ($kelas_data as $key): ?>
                    <option value="<?php echo $key['kelas_id'] ?>"><?php echo $key['kelas_nama'] ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="form-group">
                <label>Siswa</label><br/>
                <select id="siswa" style="width: 100%;" class="form-control select2" multiple="multiple" name="kelompok_siswa[]" data-placeholder="-- Pilih --">
                  
                </select>
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

  <script type="text/javascript">
    function get_siswa(kelas,target){
      $.ajax({
        url: '<?php echo base_url('kelompok/get_siswa') ?>',
        type: 'POST',
        dataType: 'json',
        data: {kelas: kelas},
      })
      .done(function(data) {

        $('#'+target).empty();

          $.each(data, function(index) {

            var html = '';

            html += '<option value="'+data[index].user_id+'">'+data[index].user_name+'</option>';

            $('#'+target).append(html);

          });

      });
      
    }
  </script>