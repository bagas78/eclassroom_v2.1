
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
                  <?php if ($this->session->userdata('level') == 3): ?>
                    <th>Status</th>  
                  <?php endif ?>
                  <th width="1">Action</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($data as $key): ?>
                                  
                  <tr>
                    <td><?php echo $key['pilihan_judul'] ?></td>
                    <td><?php echo $key['pilihan_jumlah'] ?></td>
                    <td><?php echo $key['pelajaran_nama'] ?></td>

                    <?php if ($this->session->userdata('level') == 3): ?>
                      <td>

                        <?php $soal = $key['pilihan_id'] ?>
                        <?php $iduser = $this->session->userdata('id'); ?>
                        <?php $count = $this->query_builder->view_row("SELECT * FROM t_pilihan_hasil WHERE pilihan_hasil_soal = '$soal' AND pilihan_hasil_siswa = '$iduser'"); ?>
                        <?= ($count > 0)?'Sudah Di kerjakan':'Belum Di Kerjakan' ?>
                      
                      </td>  
                    <?php endif ?>
                    
                    <td>
                      <div style="width: 80px;">

                        <?php if ($this->session->userdata('level') == 3): ?>
                          
                          <a href="<?php echo base_url('pilihan/kerjakan/'.$key['pilihan_id']) ?>"><button class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></button></a>

                        <?php endif ?>

                        <?php if ($this->session->userdata('level') < 3): ?>
                          
                          <a href="<?php echo base_url('pilihan/edit/').$key['pilihan_id'] ?>"><button class="btn btn-xs btn-default"><i class="fa fa-edit"></i></button></a>

                          <button onclick="del('<?php echo base_url() ?>pilihan/delete/<?php echo $key['pilihan_id'] ?>')" class="btn btn-xs btn-default"><i class="fa fa-trash"></i></button>

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
                <form role="form" method="post" action="<?php echo base_url() ?>pilihan/add" enctype="multipart/form-data">
                  <div class="box-body">

                    <div class="form-group">
                      <label>Judul</label>
                      <input required="" type="text" name="pilihan_judul" class="form-control">
                    </div>

                    <div class="form-group">
                       <label>Pelajaran</label>
                       <select id="pelajaran" name="pilihan_pelajaran" class="form-control">
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
                      <select name="pilihan_kelas[]" class="form-control select2" multiple="multiple" data-placeholder="-- Pilih --" style="width: 100%;">
                      <?php foreach ($kelas_data as $kelas): ?>
                        <option value="<?php echo $kelas['kelas_id'] ?>"><?php echo $kelas['kelas_nama'] ?></option>
                      <?php endforeach ?>
                      </select>
                    </div>
                    
                    <div class="form-group">
                      <label>Jumlah</label>
                      <input required="" type="number" name="pilihan_jumlah" class="form-control">
                    </div>

                    <div class="form-group">
                      <label>Acak</label>
                      <select class="form-control" name="pilihan_acak">
                        <option value="" hidden="">-- Pilih --</option>
                        <option value="ya">Ya</option>
                        <option value="tidak">Tidak</option>
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