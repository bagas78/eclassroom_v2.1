<style type="text/css">
  #box{
    width: 100%;
    border-width: 2px;
    border-style: dashed;
    background-color: #f9fafc;
    padding: 1%;
    border-color: #d2d6de;
  }
</style> 


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
          
          <h4><?php echo $data['assigment_judul'] ?></h4>
          <br/>

          <div id="box" class="form-group">
            <span><?php echo $data['assigment_isi'] ?></span>
          </div>

          <?php if ($data['assigment_file'] != ''): ?>

            <div>
              
              <a href="<?php echo base_url('assets/assigment/'.$data['assigment_file']) ?>" download>

              <span style="position: absolute; margin-top: 60px; margin-left: 10px; font-size: 10px;" class="badge">Click download</span>

              <img class="img img-thumbnail" width="100" src="<?php echo base_url('assets/gambar/file.png') ?>">

              </a>

            </div>

          <?php endif ?>

          <div class="clearfix"></div>

          <br/>

          <form method="POST" action="<?php echo base_url('assigment/kerjakan_send') ?>" enctype="multipart/form-data">
            
            <?php if ($data['assigment_jenis'] == 'kelompok'): ?>
              <div class="form-group">
                <select required="" class="form-control" name="kelompok">
                  <option value="" hidden="">-- Pilih Kelompok --</option>
                  <?php foreach ($kelompok_data as $key): ?>
                    <option value="<?php echo $key['kelompok_id'] ?>"><?php echo $key['kelompok_nama'] ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            <?php endif ?>

            <!--hidden-->
            <input type="hidden" name="idsoal" value="<?php echo $data['assigment_id'] ?>">
            <input type="hidden" name="jenis" value="<?php echo $data['assigment_jenis'] ?>">

            <div class="form-group">
              <input required="" class="form-control" type="file" name="file">
              <small class="badge">gif - jpg - png - jpeg - doc - docx - pdf - txt - xlsx - ppt - pptx</small>
            </div>

            <div class="form-group">
              <textarea class="form-control" name="catatan" placeholder="catatan"></textarea>
            </div>

            <br/> 

            <button class="btn btn-default" type="submit"><i class="fa fa-check"></i> Kirim</button>
            <a href="<?php echo base_url('assigment') ?>"><button type="button" class="btn btn-default"><i class="fa fa-times"></i> Batal</button></a>

          </form>

        </div>
      </div>
      <!-- /.box -->