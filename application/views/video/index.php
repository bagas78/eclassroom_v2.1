

    <!-- Main content -->  
    <section class="content"> 
      
      <!-- Default box --> 
      <div class="box">
        <div class="box-header with-border">

          <?php if ($this->session->userdata('level') < 3): ?>
            <div align="left">
              <button class="btn btn-default" data-toggle="modal" data-target="#modal-album"><i class="fa fa-plus"></i> Playlist</button>
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
              <th>Playlist</th>
              <th>Jumlah Video</th>
              <th>Pelajaran</th>
              <th>Kelas</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data as $key): ?>

            <tr>
              <td><?php echo $key['album_name'] ?></td>
              <td>
                <?php $album = $key['album_id']; 
                $jum = $this->db->query("SELECT count(video_judul) as jum_video FROM t_video WHERE video_album = '$album'")->result_array(); ?>
                <?php echo $jum[0]['jum_video']; ?>
              </td>
              <td><?php echo $key['pelajaran_nama'] ?></td>
              <td><?php $str = str_replace(['[',']'], '', $key['album_kelas']); $db = $this->db->query("SELECT kelas_nama FROM t_kelas WHERE kelas_id IN($str)")->result_array(); foreach ($db as $val) {echo '<span class="badge">'.$val['kelas_nama'].'</span> ';} ?></td>
              <td width="80">
                
                <a href="<?php echo base_url() ?>video/index_video/<?php echo $key['album_id'].'/'.$key['album_name'] ?>">
                  <button class="btn btn-xs btn-default" type="button"><i class="fa fa-eye"></i></button>
                </a>

                <?php if ($this->session->userdata('level') < 3): ?>
                    
                  <button class="btn btn-xs btn-default" type="button" data-toggle="modal" data-target="#modal-edit<?php echo $key['album_id'] ?>"><i class="fa fa-edit"></i></button>

                  <button onclick="del('<?php echo base_url() ?>video/album_delete/<?php echo $key['album_id'] ?>')" class="btn btn-xs btn-default" type="button"><i class="fa fa-trash"></i></button>

                <?php endif ?>

              </td>
            </tr>

               <!--modal edit-->
               <div class="modal fade" id="modal-edit<?php echo $key['album_id'] ?>">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Add new playlist</h4>
                    </div>
                    <div class="modal-body">
                      <form role="form" method="post" action="<?php echo base_url() ?>video/album_edit/<?php echo $key['album_id'] ?>" enctype="multipart/form-data">
                        <div class="box-body">
                          <div class="form-group">
                            <label>Playlist name</label>
                            <input type="text" name="album_name" class="form-control" required="" value="<?php echo $key['album_name'] ?>">
                          </div>
                          <div class="form-group"> 
                            <label>Pelajaran</label>
                            <select id="pelajaran<?php echo $key['album_id']; ?>" required="" name="album_pelajaran" class="form-control">
                              <option value="" hidden="">-- Pilih --</option>
                              <?php foreach ($pelajaran_data as $pelajaran): ?>
                                <option value="<?php echo $pelajaran['pelajaran_id'] ?>"><?php echo $pelajaran['pelajaran_nama'] ?></option>
                              <?php endforeach ?>
                            </select>
                            <script type="text/javascript">
                              $('#pelajaran<?php echo $key['album_id']; ?>').val(<?php echo $key['album_pelajaran']; ?>).change();
                            </script>
                          </div>
                          <div class="form-group">
                            <label>Kelas </label>
                            <select id="kelas<?php echo $key['album_id']; ?>" name="album_kelas[]" class="form-control select2" multiple="multiple" data-placeholder="-- Pilih --" style="width: 100%;">
                              <?php foreach ($kelas_data as $val): ?>
                                <option value="<?php echo $val['kelas_id'] ?>"><?php echo $val['kelas_nama'] ?></option>
                              <?php endforeach ?>
                            </select>
                            <script type="text/javascript">
                              $('#kelas<?php echo $key['album_id']; ?>').val([<?php echo $key['album_kelas']; ?>]).change();
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
          </tbody>
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
          <h4 class="modal-title">Add new playlist</h4>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="<?php echo base_url() ?>video/album" enctype="multipart/form-data">
            <div class="box-body">
              <div class="form-group">
                <label>Playlist name</label>
                <input type="text" name="album_name" class="form-control" required="">
              </div>
              <div class="form-group"> 
                <label>Pelajaran</label>
                <select id="pelajaran" required="" name="album_pelajaran" class="form-control">
                  <option value="" hidden="">-- Pilih --</option>
                  <?php foreach ($pelajaran_data as $pelajaran): ?>
                    <option value="<?php echo $pelajaran['pelajaran_id'] ?>"><?php echo $pelajaran['pelajaran_nama'] ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="form-group">
                <label>Kelas </label>
                <select name="album_kelas[]" class="form-control select2" multiple="multiple" data-placeholder="-- Pilih --" style="width: 100%;">
                <?php foreach ($kelas_data as $kelas): ?>
                  <option value="<?php echo $kelas['kelas_id'] ?>"><?php echo $kelas['kelas_nama'] ?></option>
                <?php endforeach ?>
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
  <?php if ($this->session->userdata('level') == 2): ?>
    
    $('#pelajaran').attr('readonly', true);
    $('#pelajaran').val('<?php echo $this->session->userdata('pelajaran'); ?>').change();

    $('#pelajaran').change(function() {
      $('#pelajaran').val('<?php echo $this->session->userdata('pelajaran'); ?>').change();
    });

  <?php endif ?>
</script>

    
      