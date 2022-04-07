
    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border"> 

          <div align="left"> 
            <a href="<?php echo base_url('ujian_essay') ?>"><button class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</button></a>
          </div>
 
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div> 
        </div>
        <div class="box-body">
         
          <form method="POST" action="<?php echo base_url('ujian_essay/insert') ?>" enctype="multipart/form-data">

            <!--hidden-->
            <input type="hidden" name="ujian_essay_jumlah" value="<?php echo $data['jumlah'] ?>">
            <input type="hidden" name="ujian_essay_id" value="<?php echo $idsoal ?>">
            <input type="hidden" name="ujian_essay_semester" value="<?php echo $data['semester'] ?>">
            <input type="hidden" name="ujian_essay_pertemuan" value="<?php echo $data['pertemuan'] ?>">

            <div class="row">

              <div class="form-group col-md-6">
                <label>Materi</label>
                <input required="" type="text" name="ujian_essay_judul" class="form-control" value="">
              </div>

              <div class="form-group col-md-6"> 
                <label>Mata Kuliah</label>
                <select id="pelajaran" required="" name="ujian_essay_pelajaran" class="form-control">
                  <option value="" hidden="">-- Pilih --</option>
                  <?php foreach ($pelajaran_data as $pelajaran): ?>
                    <option value="<?php echo $pelajaran['pelajaran_id'] ?>"><?php echo $pelajaran['pelajaran_nama'] ?></option>
                  <?php endforeach ?>
                </select>

                <script type="text/javascript">
                  $('#pelajaran').val('<?php echo $data['pelajaran'] ?>').change();
                </script>

              </div>
              <div class="form-group col-md-4">
                <label>Kelas</label>
                <select id="kelas" name="ujian_essay_kelas[]" class="form-control select2" multiple="multiple" data-placeholder="-- Pilih --"
                        style="width: 100%;">
                  <?php foreach ($kelas_data as $kelas): ?>
                    <option value="<?php echo $kelas['kelas_id'] ?>"><?php echo $kelas['kelas_nama'] ?></option>
                  <?php endforeach ?>
                </select>

                <script type="text/javascript">
                  $('#kelas').val([<?php echo implode(',', $data['kelas']) ?>]).change();
                </script>

              </div>

              <div class="form-group col-md-4">
              <label>Tanggal & Jam</label>
              <input required="" type="datetime-local" name="ujian_essay_pelaksanaan" class="form-control"> 
              </div>
              
              <div class="form-group col-md-4">
              <label>Durasi</label>
              <input required="" type="number" name="ujian_essay_durasi" class="form-control"> 
              </div>
              
            </div>

            <div class="form-group">
              <label>Petunjuk Pengerjaan</label>
              <textarea required="" class="form-control" name="ujian_essay_petunjuk"></textarea>
            </div>

            <?php $jum = $data['jumlah']; ?>

            <?php for ($i=1; $i < $jum+1; $i++):?>

              <div class="form-group">

                <div class="col-md-1 col-xs-1" style="width: 0;"><?php echo $i.'.'; ?></div>
                <div class="col-md-11 col-xs-11">
                  <textarea name="soal<?php echo $i ?>" class="form-control" style="height: 120px;"></textarea>

                  <input class="form-control" type="file" name="file<?php echo $i ?>" accept="image/*" multiple="" style="margin-top: 1%;">

                  <input type="hidden" id="file1" name="gambar<?php echo $i; ?>" value="<?php echo $idsoal; ?>_<?php echo $i; ?>">

                </div>

              </div>

              <div class="clearfix"></div>

              <br/>

            <?php endfor ?>

            <button class="btn btn-default" type="submit"><i class="fa fa-check"></i> Simpan</button>
            <a href="<?php echo base_url('ujian_essay') ?>"><button type="button" class="btn btn-default"><i class="fa fa-times"></i> Batal</button></a>

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