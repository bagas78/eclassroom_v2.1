
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
         
          <form method="POST" action="<?php echo base_url('latihan/koreksi_send/'.$id) ?>" enctype="multipart/form-data">
 
            <?php $jum = $data['latihan_jumlah']; ?>

            <?php for ($i=1; $i < $jum+1; $i++):?>

              <div class="form-group">

                <div class="col-md-1 col-xs-1" style="width: 0;"><?php echo $i.'.'; ?></div>

                <div class="col-md-11 col-xs-11">

                  <?php if (@GetImageSize(base_url('assets/img/latihan/').$data['gambar'.$i].'.jpeg')): ?>

                    <div class="col-md-3 row">
                      <img width="150" src="<?php echo base_url('assets/img/latihan/').$data['gambar'.$i].'.jpeg' ?>">
                    </div>

                  <div class="col-md-9 row">

                  <?php else: ?>

                  <div class="col-md-12 row">

                  <?php endif ?>

                  <span><?php echo $data['soal'.$i] ?></span>
                  </div>

                  <div class="clearfix"></div>

                  <?php if (@$data['file'.$i]): ?>
                      
                    <?php if (file_exists('./assets/img/latihan/'.$data['file'.$i])): ?>
                    
                      <a href="<?php echo base_url('assets/img/latihan/').@$data['file'.$i] ?>" download><button style="margin-top: 1%;" type="button" class="btn btn-default btn-xs">Download Pertanyaan <i class="fa fa-download"></i></button></a>

                    <?php endif ?>

                  <?php endif ?>

                  <div class="clearfix"></div><br/>

                  <textarea readonly="" placeholder="Jawab :" class="form-control" style="height: 120px;"><?php echo $jawaban['jawab'.$i] ?></textarea>

                  <?php if (@$jawaban['jawab'.$i.'_file']): ?>
                      
                    <?php if (file_exists('./assets/img/latihan/'.$jawaban['jawab'.$i.'_file'])): ?>
                    
                      <a href="<?php echo base_url('assets/img/latihan/').@$jawaban['jawab'.$i.'_file'] ?>" download><button style="margin-top: 1%;" type="button" class="btn btn-default btn-xs">Download jawaban <i class="fa fa-download"></i></button></a>

                    <?php endif ?>

                  <?php endif ?>

                  <?php if ($this->session->userdata('level') == 2): ?>
                        
                    <div class="clearfix"></div><br/>

                    <div class="form-group">
                      <small>Upload file koreksi</small>
                      <input style="margin-top: 1%;" type="file" name="koreksi<?php echo $i ?>" class="form-control">
                    </div>
                  
                  <?php endif ?>

                  <?php if (@$nilai['koreksi'.$i.'_file'] && file_exists('./assets/img/latihan/'.@$nilai['koreksi'.$i.'_file'])): ?>
                    
                    <?php if ($this->session->userdata('level') == 3): ?>
                      
                    <a href="<?php echo base_url('assets/img/latihan/').@$nilai['koreksi'.$i.'_file'] ?>" download><button style="margin-top: 1%;" type="button" class="btn btn-default btn-xs">Download hasil koreksi <i class="fa fa-download"></i></button></a>

                    <?php endif ?>

                  <?php endif ?>

                  <input type="hidden" name="jumlah" value="<?php echo $jum ?>">
                  <input type="hidden" name="soal" value="<?php echo $soal ?>">

                  <input required="" <?= ($this->session->userdata('level') == 3)?'readonly':'' ?> style="margin-top: 1%;" type="number" name="nilai<?php echo $i ?>" class="form-control" placeholder="Nilai" value="<?php echo @$nilai['nilai'.$i] ?>">

                  <textarea <?= ($this->session->userdata('level') == 3)?'readonly':'' ?> placeholder="Komentar / Saran" style="margin-top: 1%;" class="form-control" name="saran<?php echo $i ?>"><?php echo @$nilai['saran'.$i] ?></textarea>

                </div>

              </div>

              <div class="clearfix"></div>

              <br/>

            <?php endfor ?>

            <?php if ($this->session->userdata('level') < 3): ?>
              <button class="btn btn-default" type="submit"><i class="fa fa-check"></i> Simpan</button>
              <a href="<?php echo base_url('latihan') ?>"><button type="button" class="btn btn-default"><i class="fa fa-times"></i> Batal</button></a>
            <?php endif ?>

          </form>

        </div>
      </div>
      <!-- /.box -->