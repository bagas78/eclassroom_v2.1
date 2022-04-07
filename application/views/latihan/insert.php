<style type="text/css">
  .custom{
    padding: 1%; 
    border-width: 1px;
    border-style: solid;
    border-color: #d2d6de;
    margin-top: 2%; 
    background: ghostwhite;
    font-size: 12px;
  }
</style>


    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">

          <div align="left"> 
            <a href="<?php echo base_url('latihan') ?>"><button class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</button></a>
          </div>
 
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div> 
        </div>
        <div class="box-body">
         
          <form method="POST" action="<?php echo base_url('latihan/insert') ?>" enctype="multipart/form-data">

            <!--hidden-->
            <input type="hidden" name="latihan_jumlah" value="<?php echo $data['jumlah'] ?>">
            <input type="hidden" name="latihan_id" value="<?php echo $idsoal ?>">
            <input type="hidden" name="latihan_semester" value="<?php echo $data['semester'] ?>">
            <input type="hidden" name="latihan_pertemuan" value="<?php echo $data['pertemuan'] ?>">

            <div class="row">
              <div class="form-group col-md-4">
                <label>Materi</label>
                <input required="" type="text" name="latihan_judul" class="form-control" value="">
              </div>
              <div class="form-group col-md-4"> 
                <label>Mata Kuliah</label>
                <select id="pelajaran" required="" name="latihan_pelajaran" class="form-control">
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
                <select id="kelas" name="latihan_kelas[]" class="form-control select2" multiple="multiple" data-placeholder="-- Pilih --"
                        style="width: 100%;">
                  <?php foreach ($kelas_data as $kelas): ?>
                    <option value="<?php echo $kelas['kelas_id'] ?>"><?php echo $kelas['kelas_nama'] ?></option>
                  <?php endforeach ?>
                </select>

                <script type="text/javascript">
                  $('#kelas').val([<?php echo implode(',', $data['kelas']) ?>]).change();
                </script>

              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-4">
                <label>Tanggal</label>
                <input required="" type="date" name="latihan_tampil" class="form-control">
              </div>
              
              <div class="form-group col-md-4">
                <label>Batas Unggah & Jam</label>
                <input required="" type="datetime-local" name="latihan_batas_unggah" class="form-control">
              </div>

              <div class="form-group col-md-4">
                <label>Jenis</label>
                <select class="form-control" required="" name="latihan_jenis">
                  <option value="" hidden="">-- Pilih --</option>
                  <option value="individu">Individu</option>
                  <option value="kelompok">Kelompok</option>
                </select>
              </div>

            </div>

            <?php $jum = $data['jumlah']; ?>

            <?php for ($i=1; $i < $jum+1; $i++):?>

              <div class="form-group">

                <div class="col-md-1 col-xs-1" style="width: 0;"><?php echo $i.'.'; ?></div>
                <div class="col-md-11 col-xs-11">

                  <textarea name="soal<?php echo $i ?>" class="form-control" style="height: 120px;"></textarea>

                  <div class="col-md-6 col-xs-6">
                    <label class="custom" for="gambar"><i class="fa fa-camera"></i> Upload gambar</label>
                    <input id="gambar" class="form-control" type="file" name="gambar<?php echo $i ?>" accept="image/*" multiple="">

                    <input type="hidden" name="gambar<?php echo $i; ?>" value="<?php echo $idsoal; ?>_<?php echo $i; ?>">
                     
                  </div>
                  <div class="col-md-6 col-xs-6">
                    <label class="custom" for="file"><i class="fa fa-file"></i> Upload file</label>
                    <input id="file" class="form-control" type="file" name="file<?php echo $i ?>" accept=".doc, .docx,.pdf" multiple="">

                  </div>

                </div>

              </div>

              <div class="clearfix"></div>

              <br/>

            <?php endfor ?>

            <button class="btn btn-default" type="submit"><i class="fa fa-check"></i> Simpan</button>
            <a href="<?php echo base_url('materi') ?>"><button type="button" class="btn btn-default"><i class="fa fa-times"></i> Batal</button></a>

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