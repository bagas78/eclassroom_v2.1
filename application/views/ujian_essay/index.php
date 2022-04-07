
    <!-- Main content --> 
    <section class="content"> 
 
      <!-- Default box --> 
      <div class="box">
        <div class="box-header with-border">
        
          <?php if ($this->session->userdata('level') < 3): ?>
            <div align="left">
              <button class="btn btn-default" data-toggle="modal" data-target="#modal"><i class="fa fa-plus"></i> Tambah</button>
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
                  <th>Tanggal Pelaksanaan</th>
                  <th>Jam</th>

                  <?php if ($this->session->userdata('level') == 3): ?>
                    <th>Status</th>  
                  <?php endif ?>
                  
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($data as $key): ?>

                  <?php $tgl = date_create($key['ujian_essay_pelaksanaan']); ?>
                                  
                  <tr>
                    <td><?php $str = str_replace(['[',']'], '', $key['ujian_essay_kelas']); $db = $this->db->query("SELECT kelas_nama FROM t_kelas WHERE kelas_id IN($str)")->result_array(); foreach ($db as $val) {echo '<span class="badge">'.$val['kelas_nama'].'</span> ';} ?></td>
                    <td><?php echo date_format($tgl,'Y-m-d') ?></td>
                    <td><?php echo date_format($tgl,'H:i') ?></td>

                    <?php if ($this->session->userdata('level') == 3): ?>
                      <td>

                        <?php $soal = $key['ujian_essay_id'] ?>
                        <?php $iduser = $this->session->userdata('id'); ?>
                        <?php $count = $this->query_builder->view_row("SELECT * FROM t_ujian_essay_hasil WHERE ujian_essay_hasil_soal = '$soal' AND ujian_essay_hasil_siswa = '$iduser'"); ?>
                        <?= ($count > 0)?'Sudah Di kerjakan':'Belum Di Kerjakan' ?>
                      
                      </td>  
                    <?php endif ?>
                    
                    <td style="width: 80px;">
                      <div>

                      <?php if ($this->session->userdata('level') > 2): ?>
                        <a href="<?php echo base_url('ujian_essay/kerjakan/'.$key['ujian_essay_id']) ?>"><button class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></button></a>
                      <?php else: ?>
                         <a href="<?php echo base_url('ujian_essay/edit/'.$key['ujian_essay_id']) ?>"><button class="btn btn-xs btn-default"><i class="fa fa-edit"></i></button></a>
                      <button onclick="del('<?php echo base_url() ?>ujian_essay/delete/<?php echo $key['ujian_essay_id'] ?>')" class="btn btn-xs btn-default"><i class="fa fa-trash"></i></button>
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

    <div class="modal fade" id="modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Tambah ujian_essay</h4>
          </div>
          <div class="modal-body">
            <form role="form" method="post" action="<?php echo base_url() ?>ujian_essay/add" enctype="multipart/form-data">
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
                  <input required="" type="text" name="jumlah" class="form-control" placeholder="Jumlah Soal" value="">
                </div>
                <div class="form-group">
                  <label>Kelas</label>
                  <select name="kelas[]" class="form-control select2" multiple="multiple" data-placeholder="-- Pilih --"
                        style="width: 100%;">
                    <option value="" hidden="">-- Kelas --</option>
                    <?php foreach ($kelas_data as $key): ?>
                      <option value="<?php echo $key['kelas_id'] ?>"><?php echo $key['kelas_nama'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Mata Kuliah</label>
                  <select id="pelajaran" required="" class="form-control" name="pelajaran">
                    <option value="" hidden="">-- Pelajaran --</option>
                    <?php foreach ($pelajaran_data as $key): ?>
                      <option value="<?php echo $key['pelajaran_id'] ?>"><?php echo $key['pelajaran_nama'] ?></option>
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