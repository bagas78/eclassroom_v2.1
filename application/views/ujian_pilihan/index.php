
    <!-- Main content --> 
    <section class="content"> 
  
      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">  

          <?php if ($this->session->userdata('level') < 3): ?>
            <div align="left">
              <button class="btn btn-default" data-toggle="modal" data-target="#modal-album"><i class="fa fa-plus"></i> Tambah</button>
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
                  <th>Kelas</th>
                  <th>Tanggal</th>
                  <th>Jam</th>
                  <th width="1">Action</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($data as $key): ?>

                  <?php $tgl = date_create($key['ujian_pilihan_pelaksanaan']); ?>
                                  
                  <tr>
                    <td><?php $str = str_replace(['[',']'], '', $key['ujian_pilihan_kelas']); $db = $this->db->query("SELECT kelas_nama FROM t_kelas WHERE kelas_id IN($str)")->result_array(); foreach ($db as $val) {echo '<span class="badge">'.$val['kelas_nama'].'</span> ';} ?></td>
                    <td><?php echo date_format($tgl,'Y-m-d') ?></td>
                    <td><?php echo date_format($tgl,'H:i') ?></td>
                    <td>
                      <div style="width: 80px;">

                        <?php if ($this->session->userdata('level') == 3): ?>
                          
                          <a href="<?php echo base_url('ujian_pilihan/kerjakan/'.$key['ujian_pilihan_id']) ?>"><button class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></button></a>

                        <?php endif ?>

                        <?php if ($this->session->userdata('level') < 3): ?>
                          
                          <a href="<?php echo base_url('ujian_pilihan/edit/').$key['ujian_pilihan_id'] ?>"><button class="btn btn-xs btn-default"><i class="fa fa-edit"></i></button></a>

                          <button onclick="del('<?php echo base_url() ?>ujian_pilihan/delete/<?php echo $key['ujian_pilihan_id'] ?>')" class="btn btn-xs btn-default"><i class="fa fa-trash"></i></button>

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
                <form role="form" method="post" action="<?php echo base_url() ?>ujian_pilihan/add" enctype="multipart/form-data">
                  <div class="box-body">

                    <div class="form-group">
                      <label>Semester</label>
                      <select onchange="get_pertemuan(this.value)" required="" class="form-control" name="semester">
                        <option value="" hidden="">-- Pilih --</option>
                        <?php foreach ($semester_data as $key): ?>
                          <option value="<?php echo $key['semester_no'] ?>"><?php echo $key['semester_no'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Pertemuan</label>
                      <select id="pertemuan" required="" class="form-control" name="pertemuan">

                      </select>
                    </div>
                    
                    <div class="form-group">
                      <label>Jumlah</label>
                      <input required="" type="text" name="ujian_pilihan_jumlah" class="form-control">
                    </div>

                    <div class="form-group">
                      <label>Kelas </label>
                      <select name="ujian_pilihan_kelas[]" class="form-control select2" multiple="multiple" data-placeholder="-- Pilih --" style="width: 100%;">
                      <?php foreach ($kelas_data as $kelas): ?>
                        <option value="<?php echo $kelas['kelas_id'] ?>"><?php echo $kelas['kelas_nama'] ?></option>
                      <?php endforeach ?>
                      </select>
                    </div>

                    <div class="form-group">
                       <label>Mata Kuliah</label>
                       <select id="pelajaran" name="ujian_pilihan_pelajaran" class="form-control">
                          <option value="" hidden="">-- Pilih --</option>
                          <?php foreach ($pelajaran_data as $val): ?>
                            <option value="<?php echo $val['pelajaran_id'] ?>"><?php echo $val['pelajaran_nama'] ?></option>
                          <?php endforeach ?>
                        </select>

                        <span hidden="" id="pelajaran-alert" class="small text-danger">* Pelajaran telah di hapus, hubungi admin untuk merubah</span>
                        
                        <script type="text/javascript">
                          $('#pelajaran').val(<?php echo $pelajaran; ?>).change();
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

<script type="text/javascript">
  <?php if ($this->session->userdata('level') == 2): ?>
    
    var l = $('#pelajaran').val('<?php echo $this->session->userdata('pelajaran'); ?>');

    $('#pelajaran').attr('readonly', true);

    $('#pelajaran').change(function() {
      l.val('<?php echo $this->session->userdata('pelajaran'); ?>').change();
    }); 

    if (l.val() == null) {
     $('#pelajaran-alert').removeAttr('hidden',true); 
    }

  <?php endif ?>

  function get_pertemuan(no){
      $.ajax({
        url: '<?php echo base_url('ujian_essay/get_pertemuan') ?>',
        type: 'POST',
        dataType: 'json',
        data: {no: no},
      })
      .done(function(data) {
        
        $.each(data, function(index) {

            var html = '';

              html += '<option value="'+data[index].pertemuan_no+'">'+data[index].pertemuan_no+'</option>';

              $('#pertemuan').append(html);
            });
        });
      
    }
</script>