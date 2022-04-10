
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

          <?php if ($open == 1): ?>
            
          <form style="background: ghostwhite;padding: 2%;border-radius: 15px;" method="POST" action="<?php echo base_url('panduan/save') ?>" enctype="multipart/form-data">

            <!--hidden-->
            <input type="hidden" name="for" value="<?php echo @$for ?>">
            <input type="hidden" name="id" value="<?php echo @$data['panduan_id'] ?>">
              
            <div class="form-group">
              <label style="background: darkgray;padding: 0.5%;color: white">Video</label>
              <input required="" id="video" type="text" name="panduan_video" class="form-control" placeholder="example : https://www.youtube.com/watch?v=TZVOzUPsVoI" value="<?= (@$data['panduan_video'])?'https://www.youtube.com/watch?v='.@$data['panduan_video'] :'' ?>">

            </div>
            <div class="form-group">
              <label style="background: darkgray;padding: 0.5%;color: white">File</label>
              <input type="file" name="panduan_file" class="form-control">
            </div>
            <div class="form-group">
              <button class="btn btn-default"><i class="fa fa-check"></i> Simpan</button>
            </div>
            
          </form>

          <div class="clearfix"></div><br/>

          <?php endif ?>

          <?php if (@$data['panduan_video']): ?>

            <iframe style="width: 100%;" height="500" src="https://www.youtube.com/embed/<?php echo @$data['panduan_video'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

          <?php endif ?>

          <?php if (@$data['panduan_file'] != ''): ?>

          <div class="clearfix"></div><br/>
              
          <span style="border-width: 1px;border-style: dashed;padding: 0.2%;"><?php echo $data['panduan_file']; ?></span> 

          <?php if ($open == 1): ?>

            <a href="<?php echo base_url('panduan/delete_file/'.@$data['panduan_file']) ?>" style="color: #dd4b39; font-size: 20px; margin-left: 1%;"><i class="fa fa-times"></i></a>
          
          <?php endif ?>

          <a href="<?php echo base_url('assets/panduan/'.@$data['panduan_file']) ?>" download style="color: #00a65a; font-size: 20px; margin-left: 1%;"><i class="fa fa-download"></i></a>

        <?php endif ?>

        </div>
      </div>