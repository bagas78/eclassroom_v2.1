
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
                  <th>Judul</th>
                  <th>Jumlah Soal</th>
                  <th>Pelajaran</th>
                  <th>Kelas</th>
                  <th>Waktu Berakhir</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($data as $key): ?>
                                  
                  <tr>
                    <td><?php echo $key['ujian_judul'] ?></td>
                    <td><?php echo $key['ujian_jumlah'] ?></td>
                    <td><?php echo $key['pelajaran_nama'] ?></td>
                    <td><?php $str = str_replace(['[',']'], '', $key['ujian_kelas']); $db = $this->db->query("SELECT kelas_nama FROM t_kelas WHERE kelas_id IN($str)")->result_array(); foreach ($db as $val) {echo '<span class="badge">'.$val['kelas_nama'].'</span> ';} ?></td>
                    <td><?= ($key['ujian_berakhir'] >= date('Y-m-d'))? '<span class="badge" style="background: #4caf50">'.$key['ujian_berakhir'].'</span>' : '<span class="badge" style="background: #f44336">'.$key['ujian_berakhir'].'</span>'; ?></td>
                    <td>
                      <div style="width: 80px;">

                        <?php if ($this->session->userdata('level') == 3): ?>
                          
                          <a href="<?php echo base_url('ujian/kerjakan/'.$key['ujian_id'].'/'.$key['ujian_berakhir']) ?>"><button class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></button></a>

                        <?php endif ?>

                        <?php if ($this->session->userdata('level') < 3): ?>
                          
                          <a href="<?php echo base_url('ujian/edit/').$key['ujian_id'] ?>"><button class="btn btn-xs btn-default"><i class="fa fa-edit"></i></button></a>

                          <button onclick="del('<?php echo base_url() ?>ujian/delete/<?php echo $key['ujian_id'] ?>')" class="btn btn-xs btn-default"><i class="fa fa-trash"></i></button>

                        <?php endif ?>

                      </div>
                    </td>
                  </tr>
                
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
                <h4 class="modal-title">Tambah Soal</h4>
              </div>
              <div class="modal-body">
                <form role="form" method="post" action="<?php echo base_url() ?>ujian/add" enctype="multipart/form-data">
                  <div class="box-body">

                    <div class="form-group">
                      <label>Judul</label>
                      <input required="" type="text" name="ujian_judul" class="form-control">
                    </div>

                    <div class="form-group">
                       <label>Pelajaran</label>
                       <select id="pelajaran" name="ujian_pelajaran" class="form-control">
                          <option value="" hidden="">-- Pilih --</option>
                          <?php foreach ($pelajaran_data as $val): ?>
                            <option value="<?php echo $val['pelajaran_id'] ?>"><?php echo $val['pelajaran_nama'] ?></option>
                          <?php endforeach ?>
                        </select>
                        <script type="text/javascript">
                          $('#pelajaran').val(<?php echo $pelajaran; ?>).change();
                        </script>
                     </div>

                    <div class="form-group">
                      <label>Kelas </label>
                      <select name="ujian_kelas[]" class="form-control select2" multiple="multiple" data-placeholder="-- Pilih --" style="width: 100%;">
                      <?php foreach ($kelas_data as $kelas): ?>
                        <option value="<?php echo $kelas['kelas_id'] ?>"><?php echo $kelas['kelas_nama'] ?></option>
                      <?php endforeach ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Timer ( Menit )</label>
                      <input required="" type="number" name="ujian_timer" class=" form-control" value="">
                    </div>
                    
                    <div class="form-group">
                      <label>Jumlah</label>
                      <input required="" type="text" name="ujian_jumlah" class="form-control">
                    </div>

                    <div class="form-group">
                      <label>Waktu Berakhir </label>
                      <input required="" type="date" name="ujian_berakhir" class="form-control">
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