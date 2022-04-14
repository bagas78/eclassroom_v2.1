
    <!-- Main content --> 
    <section class="content">

      <div class="box">
        <div class="box-body">
         <h4><?php echo $data['latihan_judul'] ?></h4>
        </div>
      </div>

      <!-- Default box -->
      <div class="box">
        
        <div class="box-body">
         
          <form method="POST" action="<?php echo base_url('latihan/kerjakan_send') ?>" enctype="multipart/form-data">

            <!--hidden-->
            <input type="hidden" name="latihan_id" value="<?php echo $data['latihan_id'] ?>">
            <input type="hidden" name="latihan_jumlah" value="<?php echo $data['latihan_jumlah'] ?>">
            <input type="hidden" name="latihan_jenis" value="<?php echo $data['latihan_jenis'] ?>">

            <?php if ($data['latihan_jenis'] == 'kelompok'): ?>
              <div class="form-group col-md-6">
                <label>Kelompok</label>
                <select required="" name="latihan_kelompok" class="form-control">
                  <option value="" hidden="">-- Pilih --</option>
                  <?php foreach ($kelompok_data as $key): ?>
                    <option value="<?php echo $key['kelompok_id'] ?>"><?php echo $key['kelompok_nama'] ?></option>
                  <?php endforeach ?>
                </select>
              </div>

              <div class="clearfix"></div><br/><br/>
            <?php endif ?>

            <?php $jum = $data['latihan_jumlah']; ?>

            <?php for ($i=1; $i < $jum+1; $i++):?>

              <div class="form-group">

                <div class="col-md-1 col-xs-1" style="width: 0;"><?php echo $i.'.'; ?></div>

                <div class="col-md-11 col-xs-11">

                  <?php if (@GetImageSize(base_url('assets/img/latihan/').$data['gambar'.$i].'.jpeg')): ?>

                    <?php $ok = 'ok'.$i; ?>

                    <div class="col-md-3 row">
                      <img width="150" src="<?php echo base_url('assets/img/latihan/').$data['gambar'.$i].'.jpeg' ?>">
                    </div>

                  <?php endif ?>

                  <div <?= (@$ok == 'ok'.$i)?'class="col-md-9 row"':'class="col-md-12 row"' ?>>
                    <span><?php echo $data['soal'.$i] ?></span>
                  </div>

                  <div class="clearfix"></div><br/>

                  <?php if (@$data['file'.$i]): ?>
                      
                    <?php if (file_exists('./assets/img/latihan/'.$data['file'.$i])): ?>
                    
                      <a href="<?php echo base_url('assets/img/latihan/').$data['file'.$i] ?>" download><button type="button" class="btn btn-default btn-sm">Download soal <i class="fa fa-download"></i></button></a>

                      <div class="clearfix"></div><br/>

                    <?php endif ?>

                  <?php endif ?>

                  <textarea placeholder="Jawab :" name="jawab<?php echo $i ?>" class="form-control" style="height: 120px; margin-bottom: 1%;"></textarea>

                  <input class="form-control" type="file" name="file<?php echo $i ?>">

                </div>

              </div>

              <div class="clearfix"></div>

              <br/>

            <?php endfor ?>

            <button class="btn btn-default" type="submit"><i class="fa fa-check"></i> Simpan</button>
            <a href="<?php echo base_url('latihan') ?>"><button type="button" class="btn btn-default"><i class="fa fa-times"></i> Batal</button></a>

          </form>

        </div>
      </div>
      <!-- /.box -->