
    <!-- Main content --> 
    <section class="content"> 
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">

          <div align="left">
              <a href="<?php echo base_url('video') ?>">
                <button class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</button>
              </a>
              <button class="btn btn-default" data-toggle="modal" data-target="#modal-galery"><i class="fa fa-plus"></i> Tambah Video</button>
            </div>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">

          <?php foreach ($data as $key): ?>
              <div class="col-xs-6 col-md-2" style="padding: 0.5%; margin-bottom: 1%;">
                
                <a data-toggle="modal" data-target="#view<?php echo $key['video_id'] ?>">
                  <img style="width: 100%; height: 120px;" src="https://img.youtube.com/vi/<?php echo $key['video_link'] ?>/hqdefault.jpg" data-toggle="tooltip" data-placement="bottom" title="<?php echo $key['video_judul'] ?>">
                </a>

              </div>

                 <!--modal view-->
                <div class="modal fade" id="view<?php echo $key['video_id'] ?>">
                  <div class="modal-dialog" align="center">
                    <div class="modal-content">
                      <div class="modal-body" align="center">
                         
                         <iframe style="width: 100%;" height="315" src="https://www.youtube.com/embed/<?php echo $key['video_link'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                         
                      </div>
                      <div class="modal-footer">
                        <form method="POST" action="<?php echo base_url() ?>video/edit/<?php echo $key['video_id']; ?>/<?php echo $key['video_album'] ?>/<?php echo $title ?>">
                          <div class="form-group">
                            <input class="form-control" placeholder="Video name" type="text" name="video_judul" required="" value="<?php echo $key['video_judul'] ?>">
                          </div>
                          <div class="form-group">                            
                            <input required="" type="text" placeholder="Video link" name="video_link" value="https://www.youtube.com/watch?v=<?php echo $key['video_link'] ?>" class="form-control">
                           </div> 
                        
                          <button class="btn btn-default" type="submit">Save <i class="fa fa-check"></i></button>
                          <a onclick="del('<?php echo base_url('video/delete/'.$key['video_id'].'/'. $key['video_album'].'/'.$title) ?>')"><button class="btn btn-default" type="button">Delete <i class="fa fa-times"></i></button></a>
                         </form>
                      </div>
                    </div>
                  </div>
                 </div>

          <?php endforeach ?>
            </div>

            <div class="box-header with-border">
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                
                <?php for ($i=0; $i < $paging ; $i++): ?>
                  <?php if($row > $limit): ?>
                    <li class="page-item"><a class="page-link" href="<?php echo base_url() ?>galery/index_galery/<?php echo $id; ?>/<?php echo $title; ?>/<?php echo $i; ?>"><?php echo $i+1; ?></a></li>
                  <?php endif ?>
                <?php endfor ?>
                
              </ul>
            </nav>
          </div>

          </div>
          <!-- /.box -->
      </div>


 <div class="modal fade" id="modal-galery">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Tambah video</h4>
          </div>
          <div class="modal-body">
            <form role="form" method="post" action="<?php echo base_url() ?>video/upload/<?php echo $id.'/'.$title; ?>" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label>Video name</label>
                  <input type="text" name="video_name" class="form-control" required="" placeholder="Enter video name">
                </div>
                <div class="form-group">
                  <label>Link youtube</label>
                  <input type="text" name="video_link" class="form-control" placeholder="Enter link youtube" required="">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-default">Submit <i class="fa fa-check"></i></button>
                 <button type="reset" class="btn btn-default">Reset <i class="fa fa-times"></i></button>
              </div>
            </form>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->