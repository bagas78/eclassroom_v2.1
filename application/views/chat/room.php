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
        <div class="box-header with-border">

          <div class="col-md-1 col-xs-3">

            <?php if ($type == 'personal'): ?>

              <?php if ($data['user_foto']): ?>
              
                <img class="img img-circle" width="50" height="50" src="<?php echo base_url('assets/gambar/user/'.$data['user_foto']) ?>">

              <?php else: ?>

                <div class="text-image-border img-circle">
                  <span class="text-image"><?php echo substr($data['user_name'], 0, 1); ?></span>
                </div>

              <?php endif ?>

              </div>

              <div class="col-md-10 col-xs-8 row">
                <span><?php echo $data['user_name'] ?></span>
                <p><small class="badge"><?= ($data['user_kelas'] == '')? $data['pelajaran_nama']:$data['kelas_nama'] ?></small></p>
              </div>
              
            <?php else: ?>

              <!--group-->

              <div class="text-image-border img-circle">
                <span class="text-image"><i class="fa fa-group"></i></span>
              </div>

              </div>

              <div class="col-md-10 col-xs-8 row">
                <span><?php echo $name ?></span>
                <p><a href="#" onclick="view_user()"><small class="badge"><?php echo $jumlah ?> Anggota</small></a></p>
              </div>

            <?php endif ?>

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
                  <small style="background: darkgray; color: white;" class="badge direct-chat-timestamp"><?php echo $tgl['chat_tanggal'] ?></small>
                </div>
              </center>
              
              <?php foreach ($text as $key): ?>

                <?php if ($tgl['chat_tanggal'] == $key['chat_tanggal']): ?>

                  <?php if ($key['chat_user'] == $this->session->userdata('id')): ?>

                    <!-- Message to the right -->
                    <div id="<?php echo $key['chat_id'] ?>" class="direct-chat-msg right">
                      
                      <button onclick="del_chat(<?php echo $key['chat_id'] ?>)" class="btn btn-danger btn-xs btn-delete" type="button"><i class="fa fa-times"></i></button>

                      <!-- me -->
                      <div class="direct-chat-text" style="background: white;">
                        <?php echo $key['chat_text'] ?>
                        <br/>
                        <small style="font-size: 65%;"><?= ($key['chat_type'] == 'group')? $key['user_name'].' - ' : ''; ?> <?php echo $key['chat_waktu'] ?></small>
                      </div>

                    </div>

                    <div class="clearfix"></div>
                  
                  <?php else: ?>

                    <!-- Message. Default to the left -->
                      <div class="direct-chat-msg" style="float: right;">
                       
                        <!-- friend -->
                        <div class="direct-chat-text" style="background: azure;">
                          <?php echo $key['chat_text'] ?>
                          <br/>
                          <small style="font-size: 65%;"><?= ($key['chat_type'] == 'group')? $key['user_name'].' - ' : ''; ?> <?php echo $key['chat_waktu'] ?></small>
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
          <form action="<?php echo base_url('chat/send') ?>" method="post">
            <div class="input-group">
              <input id="name" type="hidden" name="name" value="<?php echo $name ?>">
              <input id="type" type="hidden" name="type" value="<?php echo $type ?>">
              <input id="target" type="hidden" name="target" value="<?php echo $target; ?>">
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

    //value
    var target = $('#target').val();
    var text = $('#text').val();
    var type = $('#type').val();
    var name = $('#name').val();

    $.ajax({
        url: '<?php echo base_url('chat/send') ?>',
        type: 'POST',
        dataType: 'json',
        timeout: 100000,
            error: function(jqXHR) { 
                if(jqXHR.status==0) {
                    
                    //alert modal
                    alert('Periksa jaringan internet anda');
                }
            },
        data: {
            target: target, text: text, type: type, name: name
        },
    })
    .done(function(response) {
      //delete value
      $('#text').val('');

      var data = JSON.parse(JSON.stringify(response));
      var html = '';

      html += '<div id="'+data['chat_id']+'" class="direct-chat-msg right">';
      html += '<button onclick="del_chat('+data['chat_id']+')" class="btn btn-danger btn-xs btn-delete" type="button"><i class="fa fa-times"></i></button>';
      html += '<div class="direct-chat-text" style="background: white;">'+data['chat_text'];
      html += '<br/>';
      html += '<small style="font-size: 65%;">'+data['chat_waktu']+'</small>';
      html += '</div>';
      html += '</div>';
      html += '<div class="clearfix"></div>';

      $('#new-chat').append(html);

      bottom();

    });
        
  });

  function del_chat(id){
    $.ajax({
      url: '<?php echo base_url('chat/delete') ?>',
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
    var target = $('#target').val();
    var type = $('#type').val();
    var name = $('#name').val();

    //new chat
    $.ajax({
      url: '<?php echo base_url('chat/newchat') ?>',
      type: 'POST',
      dataType: 'json',
      data: {target: target, type: type, name: name},
    })
    .done(function(response) {
      
      var data = JSON.parse(JSON.stringify(response));
      var html = '';

      if (data !== null) {

        html += '<div class="direct-chat-msg" style="float: right;">';
        html += '<div class="direct-chat-text" style="background: azure; text-align: right;">'+data['chat_text'];
        html += '<br/>';
        html += '<small style="font-size: 65%;">'+data['chat_waktu']+'</small>';
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

  function view_user(){

    $.ajax({
      url: '<?php echo base_url('chat/view_user') ?>',
      type: 'POST',
      dataType: 'json',
      data: {target: '<?php echo $target ?>'},
    })
    .done(function(data) {
        
      $('#modal-show').empty();

      var html = '';     

      $.each(data, function(index) {

        //foto null
        if (data[index].user_foto == null) {
          var str = data[index].user_name;
          var a = '<div class="text-image-border img-circle"><span class="text-image">'+str.charAt(0)+'</span></div>';
        }else{
          var a = '<img class="img img-circle" width="50" height="50" src="<?php echo base_url() ?>assets/gambar/user/'+data[index].user_foto+'">';
        }

        //kelas or pelajaran
        if (data[index].user_kelas == null) {
          var b = data[index].pelajaran_nama;
        }else{
          var b = data[index].kelas_nama;
        }

        html += '<div class="col-md-2 col-xs-3">';
        html += a;
        html += '</div>';
        html += '<div class="col-md-10 col-xs-9 row">';
        html += '<span>'+data[index].user_name+'</span>';
        html += '<p><small class="badge">'+b+'</small></p>';
        html += '</div>';
        html += '<div class="clearfix"></div><br/>';

      });

      $('#modal-show').append(html);

      $('#modal-click').click();
      
    });
    

  }
  

</script>

  