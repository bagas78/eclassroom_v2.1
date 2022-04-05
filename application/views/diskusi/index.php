<style type="text/css">
  .btn-delete{
    position: relative; 
    border-radius: 100%; 
    margin-left: -11px; 
    z-index: 1; 
    margin-bottom: -25px; 
  }
</style>

<!-- Main content --> 
    <section class="content">
 
      <!-- Default box --> 
      <div class="box">
        <div class="box-header with-border" style="padding: 0;">

          <h4 style="text-align: center; padding-top: 1%;"><?php echo @$title ?></h4>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div> 
          <br/>

        </div>
        <div class="pre-scrollable box-body" style="background-image: url('<?php echo base_url('assets/gambar/bg_chat.jpg') ?>');">

          <!--personal-->

            <?php foreach ($tanggal as $tgl): ?>

              <center>
                <div class="direct-chat-info">
                  <small style="background: darkgray; color: white;" class="badge direct-chat-timestamp"><?php echo @$tgl['diskusi_tanggal'] ?></small>
                </div>
              </center>
              
              <?php foreach ($text as $key): ?>

                <?php if (@$tgl['diskusi_tanggal'] == @$key['diskusi_tanggal']): ?>

                  <?php if (@$key['user_id'] == @$this->session->userdata('id')): ?>

                    <!-- Message to the right -->
                    <div id="<?php echo @$key['diskusi_id'] ?>" class="direct-chat-msg right">
                      
                      <button onclick="del_chat(<?php echo @$key['diskusi_id'] ?>)" class="btn btn-danger btn-xs btn-delete" type="button"><i class="fa fa-times"></i></button>

                      <!-- me -->
                      <div class="direct-chat-text" style="background: white;">
                        
                        <?php if (@$key['diskusi_file'] != ''): ?>

                          <?php if (@$key['diskusi_file_type'] == 'image'): ?>

                            <a href="<?php echo base_url('assets/diskusi/'.$key['diskusi_file']) ?>" download><img width="100" src="<?php echo base_url('assets/diskusi/'.$key['diskusi_file']) ?>" class="img img-thumbnail"></a>

                          <?php else: ?>
                            
                            <a href="<?php echo base_url('assets/diskusi/'.$key['diskusi_file']) ?>" download><img width="100" src="<?php echo base_url('assets/gambar/file.png') ?>" class="img img-thumbnail"></a>
                          
                          <?php endif ?>
                          
                        <?php endif ?>

                        <div class="clearfix"></div>
                        
                        <?php echo @$key['diskusi_text'] ?>
                        
                        <div class="clearfix"></div>

                        <small style="font-size: 65%;"><?php echo @$key['user_name']; ?> <?php echo @$key['diskusi_waktu'] ?></small>
                      </div>

                    </div>

                    <div class="clearfix"></div>
                  
                  <?php else: ?>

                    <!-- Message. Default to the left -->
                      <div class="direct-chat-msg" style="float: right;">
                       
                        <!-- friend -->
                        <div class="direct-chat-text" style="background: azure;">

                          <?php if (@$key['diskusi_file'] != ''): ?>

                            <?php if (@$key['diskusi_file_type'] == 'image'): ?>

                              <a href="<?php echo base_url('assets/diskusi/'.$key['diskusi_file']) ?>" download><img width="100" src="<?php echo base_url('assets/diskusi/'.$key['diskusi_file']) ?>" class="img img-thumbnail"></a>

                            <?php else: ?>
                              
                              <a href="<?php echo base_url('assets/diskusi/'.$key['diskusi_file']) ?>" download><img width="100" src="<?php echo base_url('assets/gambar/file.png') ?>" class="img img-thumbnail"></a>
                            
                            <?php endif ?>
                            
                          <?php endif ?>

                          <div class="clearfix"></div>

                          <?php echo @$key['diskusi_text'] ?>
                          
                          <div class="clearfix"></div>

                          <small style="font-size: 65%;"><?php echo @$key['user_name']; ?> <?php echo @$key['diskusi_waktu'] ?></small>
                        </div>
                      </div>
                    
                    <div class="clearfix"></div>

                  <?php endif ?>
                  
                <?php endif ?>

              <?php endforeach ?>

            <?php endforeach ?>

            <div id="new-chat"></div>

            </div>

        </div>
               
               
        <div class="box-footer" style="background: white;">
          <form action="<?php echo base_url('chat/send') ?>" method="post" enctype="multipart/form-data">
            <div class="input-group" style="margin-bottom: 1%;">
              <input id="file" type="file" name="file" class="form-control">
            </div>

            <div class="input-group">
              <input id="type" type="hidden" name="type" value="<?php echo @$type ?>">
              <input id="where" type="hidden" name="where" value="<?php echo @$where ?>">
              <input id="kelas" type="hidden" name="kelas" value="<?php echo @$kelas ?>">

              <input id="text" required="" type="text" name="text" placeholder="Type Message ..." class="form-control">
              <span class="input-group-btn">
                <button type="submit" class="btn btn-default btn-flat">Send</button>
              </span>
            </div>
          </form>
        </div>
        
      </div>
      <!-- /.box -->

<button id="modal-click" hidden="" data-target="#modal-view" data-toggle="modal"></button>

<div class="modal fade" id="modal-view">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <div id="modal-show" class="box-body">

          </div>
        </div>
      </div>
    </div>
  </div>

<script>

  //scroll bottom
  function bottom(){
    $(".pre-scrollable").animate({
        scrollTop: $(
          'html, body').get(0).scrollHeight
    });
  }

  bottom();

  //form
  $("form").submit(function( e ) {

    e.preventDefault(); 

    $.ajax({
        url: '<?php echo base_url('diskusi/send') ?>',
        type: 'POST',
        dataType: 'json',
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        timeout: 100000,
            error: function(jqXHR) { 
                if(jqXHR.status==0) {
                    
                    //alert modal
                    alert('Periksa jaringan internet anda');
                }
            }
    })
    .done(function(response) {

      //delete value
      $('#text').val('');
      $('#file').val('');

      if (response == 'large') {

        //gagal upload
        alert('file tidak boleh dari 10 mb / format file tidak di dukung');

      }else{

          var data = JSON.parse(JSON.stringify(response));
          var html = '';

          html += '<div id="'+data['diskusi_id']+'" class="direct-chat-msg right">';
          html += '<button onclick="del_chat('+data['diskusi_id']+')" class="btn btn-danger btn-xs btn-delete" type="button"><i class="fa fa-times"></i></button>';
          html += '<div class="clearfix"></div>';
          html += '<div class="direct-chat-text" style="background: white;">';

          if (data['diskusi_file'] != '') {

            if (data['diskusi_file_type'] == 'image') {

              html += '<a href="<?php echo base_url('assets/diskusi/') ?>'+data['diskusi_file']+'" download><img width="100" src="<?php echo base_url('assets/diskusi/') ?>'+data['diskusi_file']+'" class="img img-thumbnail"></a>';

            }else{

              html += '<a href="<?php echo base_url('assets/diskusi/') ?>'+data['diskusi_file']+'" download><img width="100" src="<?php echo base_url('assets/gambar/file.png') ?>" class="img img-thumbnail"></a>';
            }

          } 

          html += '<div class="clearfix"></div>'+data['diskusi_text'];
          html += '<div class="clearfix"></div>';
          html += '<small style="font-size: 65%;">'+data['user_name']+' '+data['diskusi_waktu']+'</small>';
          html += '</div>';
          html += '</div>';
          html += '<div class="clearfix"></div>';

          $('#new-chat').append(html);

          bottom();
      }

    });
        
  });

  function del_chat(id){
    $.ajax({
      url: '<?php echo base_url('diskusi/delete') ?>',
      type: 'POST',
      dataType: 'json',
      data: {id: id},
    })
    .done(function(data) {
      $('#'+id).remove();    
    });
    
  }

  function newchat(){
    //value
    var where = $('#where').val();
    var type = $('#type').val();

    //new chat
    $.ajax({
      url: '<?php echo base_url('diskusi/newchat') ?>',
      type: 'POST',
      dataType: 'json',
      data: {where: where, type: type},
    })
    .done(function(response) {
      
      var data = JSON.parse(JSON.stringify(response));
      var html = '';

      if (data !== null) {

        html += '<div class="direct-chat-msg" style="float: right;">';
        html += '<div class="direct-chat-text" style="background: azure; text-align: right;">';

        if (data['diskusi_file'] != '') {

          if (data['diskusi_file_type'] == 'image') {

            html += '<a href="<?php echo base_url('assets/diskusi/') ?>'+data['diskusi_file']+'" download><img width="100" src="<?php echo base_url('assets/diskusi/') ?>'+data['diskusi_file']+'" class="img img-thumbnail"></a>';

          }else{

            html += '<a href="<?php echo base_url('assets/diskusi/') ?>'+data['diskusi_file']+'" download><img width="100" src="<?php echo base_url('assets/gambar/file.png') ?>" class="img img-thumbnail"></a>';
          }

        } 

        html += '<div class="clearfix"></div>'+data['diskusi_text'];
        html += '<div class="clearfix"><div/>';
        html += '<small style="font-size: 65%;">'+data['user_name']+' '+data['diskusi_waktu']+'</small>';
        html += '</div>';
        html += '</div>';
        html += '<div class="clearfix"></div>';

        $('#new-chat').append(html);

        bottom();
      }

    });
  
    setTimeout(function() {
      newchat();
    }, 1000);

  }

  newchat();
  

</script>

  