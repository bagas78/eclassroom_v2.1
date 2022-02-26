
    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">

          <div align="left"> 
            <a href="<?php echo base_url('essay') ?>"><button class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</button></a>
          </div>
 
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div> 
        </div>
        <div class="box-body">
         
          <form method="POST" action="<?php echo base_url('essay/kerjakan_send') ?>" enctype="multipart/form-data">

            <!--hidden-->
            <input type="hidden" name="essay_id" value="<?php echo $data['essay_id'] ?>">

            <div align="center" class="form-group">
              <h4><?php echo $data['essay_judul'] ?></h4>
            </div>

            <br/>

            <?php $jum = $data['essay_jumlah']; ?>

            <?php for ($i=1; $i < $jum+1; $i++):?>

              <div class="form-group">

                <div class="col-md-1 col-xs-1" style="width: 0;"><?php echo $i.'.'; ?></div>

                <div class="col-md-11 col-xs-11">

                  <?php if (@GetImageSize(base_url('assets/img/essay/').$data['gambar'.$i].'.jpeg')): ?>

                    <div class="col-md-3 row">
                      <img width="150" src="<?php echo base_url('assets/img/essay/').$data['gambar'.$i].'.jpeg' ?>">
                    </div>

                  <div class="col-md-9 row">

                  <?php else: ?>

                  <div class="col-md-12 row">

                  <?php endif ?>

                    <span><?php echo $data['soal'.$i] ?></span>
                  </div>

                  <div class="clearfix"></div><br/>

                  <textarea placeholder="Jawab :" name="jawab<?php echo $i ?>" class="form-control" style="height: 120px;"></textarea>

                </div>

              </div>

              <div class="clearfix"></div>

              <br/>

            <?php endfor ?>

            <button class="btn btn-default" type="submit"><i class="fa fa-check"></i> Simpan</button>
            <a href="<?php echo base_url('essay') ?>"><button type="button" class="btn btn-default"><i class="fa fa-times"></i> Batal</button></a>

          </form>

        </div>
      </div>
      <!-- /.box -->