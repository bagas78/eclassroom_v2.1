
    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border"> 

          <div align="left"> 
            <a href="<?php echo base_url('assigment') ?>"><button class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</button></a>
          </div>
 
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div> 
        </div>
        <div class="box-body">
         
          <form method="POST" action="<?php echo base_url('assigment/update/'.$data['assigment_id']) ?>" enctype="multipart/form-data">
            <div class="row">
              <div class="form-group col-md-6">
                <label>Materi</label>
                <input required="" type="text" name="assigment_judul" value="<?php echo $data['assigment_judul'] ?>" class="form-control">
              </div>
              <div class="form-group col-md-6">
               <label>Jenis</label>
               <select id="jenis" class="form-control" name="assigment_jenis">
                 <option value="" hidden="">-- Pilih --</option>
                 <option value="individu">Individu</option>
                 <option value="kelompok">Kelompok</option>
               </select>
              </div>
            </div>

            <script type="text/javascript">
                $('#jenis').val('<?php echo $data['assigment_jenis'] ?>').change();
              </script>

            <div class="row">
              <div class="form-group col-md-6"> 
                <label>Pelajaran</label>
                <select id="pelajaran" required="" name="assigment_pelajaran" class="form-control">
                  <option value="" hidden="">-- Pilih --</option>
                  <?php foreach ($pelajaran_data as $pelajaran): ?>
                    <option value="<?php echo $pelajaran['pelajaran_id'] ?>"><?php echo $pelajaran['pelajaran_nama'] ?></option>
                  <?php endforeach ?>
                </select>

                <script type="text/javascript">
                  $('#pelajaran').val('<?php echo $data['assigment_pelajaran'] ?>').change();
                </script>

              </div>
              <div class="form-group col-md-6">
                <label>Kelas</label>
                <select id="kelas" name="assigment_kelas[]" class="form-control select2" multiple="multiple" data-placeholder="-- Pilih --"
                        style="width: 100%;">
                  <?php foreach ($kelas_data as $kelas): ?>
                    <option value="<?php echo $kelas['kelas_id'] ?>"><?php echo $kelas['kelas_nama'] ?></option>
                  <?php endforeach ?>
                </select>

                <script type="text/javascript">
                  $('#kelas').val([<?php echo $data['assigment_kelas'] ?>]).change();
                </script>

              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-4">
                <label>Tanggal</label>
                <input required="" type="date" name="assigment_tampil" class="form-control" value="<?php echo $data['assigment_tampil'] ?>">
              </div>
              <div class="form-group col-md-4">
                <label>Batas Unggah</label>
                <input required="" type="date" name="assigment_unggah" class="form-control" value="<?php echo $data['assigment_unggah']; ?>">
              </div>
              <div class="form-group col-md-4">
                <label>Jam</label>
                <input required="" type="time" name="assigment_jam" class="form-control" value="<?php echo $data['assigment_jam']; ?>">
              </div>
            </div>

            <div class="form-group">
              <textarea name="assigment_isi" id="editor1" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $data['assigment_isi'] ?></textarea>
            </div>

            <div class="form-group">
              <input type="file" name="file" class="form-control">
            </div>

            <?php if ($data['assigment_file'] != ''): ?>
              
              <span style="border-width: 1px;border-style: dashed;padding: 0.2%;"><?php echo $data['assigment_file']; ?></span> 

              <a href="#" onclick="del_file('<?php echo $data['assigment_id'] ?>','<?php echo $data['assigment_file'] ?>')" style="color: #dd4b39; font-size: 20px; margin-left: 1%;"><i class="fa fa-times"></i></a>

              <a href="<?php echo base_url('assets/assigment/'.$data['assigment_file']) ?>" download style="color: #00a65a; font-size: 20px; margin-left: 1%;"><i class="fa fa-download"></i></a>

            <?php endif ?>

            <div class="clearfix"></div>

          <br/> 
          <button class="btn btn-default" type="submit"><i class="fa fa-check"></i> Simpan</button>
          <a href="<?php echo base_url('assigment') ?>"><button type="button" class="btn btn-default"><i class="fa fa-times"></i> Batal</button></a>

          </form>

        </div>
      </div>
      <!-- /.box -->

<script type="text/javascript">
  <?php if ($this->session->userdata('level') == 2): ?>
    
    $('#pelajaran').attr('readonly', true);
    $('#pelajaran').val('<?php echo $this->session->userdata('pelajaran'); ?>').change();

    $('#pelajaran').change(function() {
      $('#pelajaran').val('<?php echo $this->session->userdata('pelajaran'); ?>').change();
    });

  <?php endif ?>

  function del_file(id,file){
    $.ajax({
      url: '<?php echo base_url('assigment/unlink') ?>',
      type: 'POST',
      dataType: 'json',
      data: {id: id, file: file},
    })
    .done(function(response) {
      if (response == 1) {
        location.reload();
      }else{
        alert('File gagal di hapus !!');
      }

    });
    
  }
</script>