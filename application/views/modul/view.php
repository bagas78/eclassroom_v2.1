
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
          
          <h3><?php echo $data['modul_judul']; ?></h3>

          <span><?php echo $data['modul_isi']; ?></span>

          <br/>

          <?php if ($data['modul_file'] != ''): ?>

            <div style="background: #3c8dbc0d;padding: 2%;">
              
              <a href="<?php echo base_url('assets/modul/'.$data['modul_file']) ?>" download>

              <span style="position: absolute; margin-top: 60px; margin-left: 12px;" class="badge">Click to download file</span>

              <img class="img img-thumbnail" width="150" src="<?php echo base_url('assets/gambar/file.png') ?>">

              </a>

            </div>

          <?php endif ?>

        </div>
      </div>
      <!-- /.box -->