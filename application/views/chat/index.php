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
          
          <button data-toggle="modal" data-target="#new" class="btn btn-default"><i class="fa fa-plus"></i> New</button>
          <button data-toggle="modal" data-target="#group" class="btn btn-default"><i class="fa fa-group"></i> Group</button>

        </div>
        <div class="box-body">

          <?php foreach ($data as $key): ?>

            <?php if ($key['user_foto'] == null): ?>
              
              <div onclick="room(<?= ($key['chat_type'] == 'personal')? $key['user_id'] : $key['chat_id'].",'".$key['chat_type']."'" ?>)" class="col-md-1 col-xs-3">

                <span hidden="" id="notif<?php echo str_replace(' ', '_', $key['chat_name']) ?>" class="label" style="background-color: #ff9800;margin-left: 30px;margin-top: -5px;"></span>
                
                <div class="text-image-border img-circle">
                  <span class="text-image"><?= ($key['chat_type'] == 'group')? '<i class="fa fa-group"></i>' : substr($key['user_name'], 0, 1); ?></span>
                </div>
              </div>

              <div onclick="room(<?= ($key['chat_type'] == 'personal')? $key['user_id'] : $key['chat_id'].",'".$key['chat_type']."'" ?>)" class="col-md-11 col-xs-9">
                <p class="chat"><?php echo $key['chat_text'] ?></p>
                <small class="badge" style="background: #B9253B;"><?php echo $key['user_name'] ?></small> <small class="badge"><?php echo $key['chat_tanggal'] ?></small>
              </div>

            <?php else: ?>

              <div onclick="room(<?= ($key['chat_type'] == 'personal')? $key['user_id'] : $key['chat_id'].",'".$key['chat_type']."'" ?>)" class="col-md-1 col-xs-3">
                
                <span hidden="" id="notif<?php echo str_replace(' ', '_', $key['chat_name']) ?>" class="label" style="background-color: #ff9800;margin-left: 30px;margin-top: -5px;"></span>

                 <img width="50" height="50" src="<?= ($key['chat_type'] == 'group')? '<i class="fa fa-group"></i>' : base_url('assets/gambar/user/'.$key['user_foto']) ?>" class="img-circle">
              </div>

              <div onclick="room(<?= ($key['chat_type'] == 'personal')? $key['user_id'] : $key['chat_id'].",'".$key['chat_type']."'" ?>)" class="col-md-11 col-xs-9">
                <p class="chat"><?php echo $key['chat_text'] ?></p>
                <small class="badge" style="background: #B9253B;"><?php echo $key['user_name'] ?></small> <small class="badge"><?php echo $key['chat_tanggal'] ?></small>
              </div>
            
            <?php endif ?>

            <div class="clearfix"></div><br/>
            
          <?php endforeach ?>       

      </div>

 <div class="modal fade" id="new">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <div class="box-body" style="padding: 0;">
            
            <div class="nav-tabs-custom" style="margin-bottom: 0;">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#siswa" data-toggle="tab">Mahasiswa</a></li>
                <li><a href="#guru" data-toggle="tab">Dosen</a></li>
              </ul>
              <div class="tab-content" style="margin-top: 20px;">
                <div class="active  tab-pane" id="siswa">

                  <?php foreach ($user_data as $siswa): ?>

                    <?php if ($siswa['user_level'] == 3): ?>

                    <div onclick="room(<?php echo $siswa['user_id'] ?>,'personal')" class="col-md-2 col-xs-3">

                       <?php if ($siswa['user_foto']): ?>

                        <img class="img img-circle" width="50" height="50" src="<?php echo base_url('assets/gambar/user/'.$siswa['user_foto']) ?>">

                       <?php else: ?>

                        <div class="text-image-border img-circle">
                          <span class="text-image"><?php echo substr($siswa['user_name'], 0, 1); ?></span>
                        </div>
                         
                       <?php endif ?>
                     
                     </div>

                     <div onclick="room(<?php echo $siswa['user_id'] ?>,'personal')" class="col-md-10 col-xs-9 row">
                       <span><?php echo $siswa['user_name'] ?></span>
                       <p><small class="badge"><?php echo $siswa['kelas_nama'] ?></small></p>
                     </div>

                     <div class="clearfix"></div><br/>

                    <?php endif ?>
                    
                  <?php endforeach ?>

                </div>
                <div class="tab-pane" id="guru">
                    
                  <?php foreach ($user_data as $guru): ?>

                    <?php if ($guru['user_level'] == 2): ?>

                      <div onclick="room(<?php echo $guru['user_id'] ?>,'personal')" class="col-md-2 col-xs-3">

                       <?php if ($guru['user_foto']): ?>

                        <img class="img img-circle" width="50" height="50" src="<?php echo base_url('assets/gambar/user/'.$guru['user_foto']) ?>">

                       <?php else: ?>

                        <div class="text-image-border img-circle">
                          <span class="text-image"><?php echo substr($guru['user_name'], 0, 1); ?></span>
                        </div>
                         
                       <?php endif ?>
                     
                     </div>

                     <div onclick="room(<?php echo $guru['user_id'] ?>,'group')" class="col-md-10 col-xs-9 row">
                       <span><?php echo $guru['user_name'] ?></span>
                       <p><small class="badge"><?php echo $guru['pelajaran_nama'] ?></small></p>
                     </div>

                     <div class="clearfix"></div><br/>

                    <?php endif ?>
                    
                  <?php endforeach ?>

                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="group">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">

          <form method="POST" action="<?php echo base_url('chat/group') ?>">

          <div class="box-header">
            <div class="form-group">
              <input required="" type="text" name="name" class="form-control" placeholder="Name Group">
            </div>
          </div>
          
          <div class="box-body pre-scrollable">

            <?php foreach ($user_data as $user): ?>

             <div class="col-md-9 col-xs-8 row">

              <div class="pretty p-switch p-fill">
                  <input name="user[]" value="<?php echo $user['user_id'] ?>" type="checkbox" />
                  <div class="state">
                      <label style="font-weight: unset;">&#160;&#160;<?php echo $user['user_name'] ?></label>
                  </div>
              </div>
               <small class="badge"><?= ($user['user_kelas'] == '')? $user['pelajaran_nama'] : $user['kelas_nama'] ?></small>

               <div class="clearfix"></div><br/>

             </div>

            <?php endforeach ?>            

          </div>

          <div class="box-footer">

            <button type="submit" class="btn btn-default">Submit <i class="fa fa-check"></i></button>
            <button type="reset" class="btn btn-default">Reset <i class="fa fa-times"></i></button>
          </div>

          </form>

        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    
    $('.chat').each(function() {

      if (/Mobi/.test(navigator.userAgent)) {
        // mobile
        
        var x = $(this).text().slice(0, 28);

        $(this).text(x+' ...');

      }else{
        //desktop

        var x = $(this).text().slice(0, 150);

        $(this).text(x+' ...');

      }

    });

    function room(id,type){

      if (type == 'group') {
        $(location).attr('href','<?php echo base_url('chat/group/') ?>'+id);
      }else{
        $(location).attr('href','<?php echo base_url('chat/room/') ?>'+id);
      }
      
    } 
    
  </script>