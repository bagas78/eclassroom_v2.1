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
         
          <h4 align="center"><?php echo $data['assigment_judul'] ?></h4>
          <br/>
          <div style="background: aliceblue;padding: 2%;border-radius: 10px;margin-bottom: 3%;"><?php echo $data['assigment_isi'] ?></div>

          <p><?= ($data['assigment_jenis'] == 'kelompok')?'Di kirim oleh kelompok : '.$data['kelompok_nama'] :'Di kirim oleh : '.$data['user_name'] ?></p>
          <br/>

          <a href="<?php echo base_url('assets/img/assigment/'.$data['assigment_hasil_file']) ?>" download>
          <span style="position: absolute; margin-top: 60px; margin-left: 12px;" class="badge">Click to download file</span>
          <?php if ($data['assigment_hasil_file_type'] == 'image'): ?>
            <img class="img img-thumbnail" width="150" src="<?php echo base_url('assets/img/assigment/'.$data['assigment_hasil_file']) ?>">
          <?php else: ?>
            <img class="img img-thumbnail" width="150" src="<?php echo base_url('assets/gambar/file.png') ?>">
          <?php endif ?>
          </a>

          <div class="clearfix"></div><br/>

          <span><?php echo '" '.$data['assigment_hasil_catatan'].' "' ?></span>

          <div class="clearfix"></div><br/>

          <?php if ($this->session->userdata('level') < 3): ?>

          <form method="POST" action="<?php echo base_url('assigment/koreksi_send/'.$data['assigment_hasil_id']) ?>">
            <div class="form-group">
              <input required="" type="text" name="nilai" class="form-control" placeholder="Masukan Nilai">
            </div>
            <div class="form-group">
              <textarea class="form-control" name="catatan" placeholder="Tambah Catatan"></textarea>
            </div>
              
            <br/>

            <button class="btn btn-default" type="submit"><i class="fa fa-check"></i> Kirim</button>
            <a href="<?php echo base_url('assigment/koreksi') ?>"><button type="button" class="btn btn-default"><i class="fa fa-times"></i> Batal</button></a>

          </form>

          <?php else: ?>

            <div style="    background: aliceblue;padding: 1%;border-radius: 10px;">
              <p>Nilai : <?php echo $data['assigment_hasil_nilai'] ?></p>
              <p>Catatan : <?php echo $data['assigment_hasil_nilai_catatan'] ?></p>
            </div>

          <?php endif ?>

        </div>

        
      </div>
      <!-- /.box -->