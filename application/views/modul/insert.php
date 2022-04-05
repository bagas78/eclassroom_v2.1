
    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">

          <div align="left"> 
            <a href="<?php echo base_url('modul') ?>"><button class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</button></a>
          </div>
 
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div> 
        </div> 
        <div class="box-body">
         
          <form method="POST" action="<?php echo base_url('modul/add') ?>" enctype="multipart/form-data">
            <div class="form-group">
              <label>Judul</label>
              <input required="" type="text" name="modul_judul" value="" class="form-control">
            </div>

            <div class="row">
              <div class="form-group col-md-6"> 
                <label>Pelajaran</label>
                <select id="pelajaran" required="" name="modul_pelajaran" class="form-control">
                  <option value="" hidden="">-- Pilih --</option>
                  <?php foreach ($pelajaran_data as $pelajaran): ?>
                    <option value="<?php echo $pelajaran['pelajaran_id'] ?>"><?php echo $pelajaran['pelajaran_nama'] ?></option>
                  <?php endforeach ?>
                </select>
              </div> 
              <div class="form-group col-md-6">
                <label>Kelas</label>
                <select name="modul_kelas[]" class="form-control select2" multiple="multiple" data-placeholder="-- Pilih --"
                        style="width: 100%;">
                  <?php foreach ($kelas_data as $kelas): ?>
                    <option value="<?php echo $kelas['kelas_id'] ?>"><?php echo $kelas['kelas_nama'] ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label>Deskripsi Singkat</label>
              <textarea name="modul_isi" id="editor1" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
            </div>

            <div class="form-group">
              <input type="file" name="file" class="form-control">
              <small style="margin-top: 1%;" class="badge">doc | docx | pdf | txt | xlsx</small>
            </div>

          <br/> 
          <button class="btn btn-default" type="submit"><i class="fa fa-check"></i> Simpan</button>
          <a href="<?php echo base_url('modul') ?>"><button type="button" class="btn btn-default"><i class="fa fa-times"></i> Batal</button></a>

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
</script>