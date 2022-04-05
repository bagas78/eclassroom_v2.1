
    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
 
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div> 
        </div> 
        <div class="box-body">
         
          <form method="POST" action="<?php echo base_url('collassion/save') ?>" enctype="multipart/form-data">
            <div class="form-group">
              <label>Kelas</label>
              <select id="kelas" name="collassion_kelas[]" class="form-control select2" multiple="multiple" data-placeholder="-- Pilih --"
                      style="width: 100%;">
                <?php foreach ($kelas_data as $kelas): ?>
                  <option value="<?php echo $kelas['kelas_id'] ?>"><?php echo $kelas['kelas_nama'] ?></option>
                <?php endforeach ?>
              </select>

              <script type="text/javascript">
                $('#kelas').val([<?php echo $data['collassion_kelas']; ?>]).change();
              </script>

            </div>

            <div class="form-group">
              <label>Tentang Collassion Learning</label>
              <textarea name="collassion_isi" id="editor1" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo @$data['collassion_isi'] ?></textarea>
            </div>

          <br/> 
          <button class="btn btn-default" type="submit"><i class="fa fa-check"></i> Simpan</button>
          <a href="<?php echo base_url('collassion') ?>"><button type="button" class="btn btn-default"><i class="fa fa-times"></i> Batal</button></a>

          </form>

        </div>
      </div>
      <!-- /.box -->