
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
                  <th>Materi</th>
                  <th>Kelas</th>
                  <th>Jenis</th>
                  <th>Batas Unggah</th>

                  <?php if ($this->session->userdata('level') == 3): ?>
                    <th>Status</th>  
                  <?php endif ?>
                  
                  <th width="1">Action</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($data as $key): ?>
                                  
                  <tr>
                    <td><?php echo $key['latihan_judul'] ?></td>
                    <td><?php $str = str_replace(['[',']'], '', $key['latihan_kelas']); $db = $this->db->query("SELECT kelas_nama FROM t_kelas WHERE kelas_id IN($str)")->result_array(); foreach ($db as $val) {echo '<span class="badge">'.$val['kelas_nama'].'</span> ';} ?></td>

                    <td><?php echo $key['latihan_jenis'] ?></td>
                    <td><?php echo $key['latihan_batas_unggah'] ?></td>

                    <?php if ($this->session->userdata('level') == 3): ?>
                      <td>

                        <?php $soal = $key['latihan_id'] ?>
                        <?php $iduser = $this->session->userdata('id'); ?>
                        <?php $count = $this->query_builder->view_row("SELECT * FROM t_latihan_hasil WHERE latihan_hasil_soal = '$soal' AND latihan_hasil_siswa = '$iduser'"); ?>
                        <?= ($count > 0)?'Sudah Di kerjakan':'Belum Di Kerjakan' ?>
                      
                      </td>  
                    <?php endif ?>
                    
                    <td style="width: 80px;">
                      <div>

                      <?php if ($this->session->userdata('level') > 2): ?>
                        <a href="<?php echo base_url('latihan/kerjakan/'.$key['latihan_id']) ?>"><button class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></button></a>
                      <?php else: ?>
                         <a href="<?php echo base_url('latihan/edit/'.$key['latihan_id']) ?>"><button class="btn btn-xs btn-default"><i class="fa fa-edit"></i></button></a>
                      <button onclick="del('<?php echo base_url() ?>latihan/delete/<?php echo $key['latihan_id'] ?>')" class="btn btn-xs btn-default"><i class="fa fa-trash"></i></button>
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
            <h4 class="modal-title">Tambah Latihan</h4>
          </div>
          <div class="modal-body">
            <form role="form" method="post" action="<?php echo base_url() ?>latihan/add" enctype="multipart/form-data">
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
                  <select required="" name="kelas[]" class="form-control select2" multiple="multiple" data-placeholder="-- Pilih --"
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

                  <span hidden="" id="pelajaran-alert" class="small text-danger">* Pelajaran telah di hapus, hubungi admin untuk merubah</span>
                  
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
        url: '<?php echo base_url('latihan/get_pertemuan') ?>',
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