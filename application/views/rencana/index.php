
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
         
          <form method="POST" action="<?php echo base_url('rencana/save') ?>" enctype="multipart/form-data">
            <div class="form-group">
              <label>Kelas</label>
              <select id="kelas" name="rencana_kelas[]" class="form-control select2" multiple="multiple" data-placeholder="-- Pilih --"
                      style="width: 100%;">
                <?php foreach ($kelas_data as $kelas): ?>
                  <option value="<?php echo $kelas['kelas_id'] ?>"><?php echo $kelas['kelas_nama'] ?></option>
                <?php endforeach ?>
              </select>

              <script type="text/javascript">
                $('#kelas').val([<?php echo $data['rencana_kelas']; ?>]).change();
              </script>

            </div>

            <div class="form-group">
              <label>Rencana Pembelajaran Semester</label>
              <textarea name="rencana_isi" id="editor1" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo @$data['rencana_isi'] ?></textarea>
            </div>

            <div class="form-group">
              <label>Unggah File</label>
              <input type="file" name="file" class="form-control">
              <small style="margin-top: 1%;" class="badge">doc | docx | pdf | txt | xlsx</small>
            </div>

            <?php if ($data['rencana_file'] != ''): ?>
              
              <span style="border-width: 1px;border-style: dashed;padding: 0.2%;"><?php echo $data['rencana_file']; ?></span> 

              <a href="#" onclick="del_file('<?php echo $data['rencana_id'] ?>','<?php echo $data['rencana_file'] ?>')" style="color: #dd4b39; font-size: 20px; margin-left: 1%;"><i class="fa fa-times"></i></a>

              <a href="<?php echo base_url('assets/materi/'.$data['rencana_file']) ?>" download style="color: #00a65a; font-size: 20px; margin-left: 1%;"><i class="fa fa-download"></i></a>

            <?php endif ?>

            <div class="clearfix"></div>

          <br/> 
          <button class="btn btn-default" type="submit"><i class="fa fa-check"></i> Simpan</button>
          <a href="<?php echo base_url('rencana') ?>"><button type="button" class="btn btn-default"><i class="fa fa-times"></i> Batal</button></a>

          </form>

        </div>
      </div>
      <!-- /.box -->