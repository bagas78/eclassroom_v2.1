
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
         
          <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Judul</th>
                  <th>Mata Kuliah</th>
                  <th width="1">Action</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($data as $key): ?>
                                  
                  <tr>
                    <td><?php echo $key['materi_judul'] ?></td>
                    <td><?php echo $key['pelajaran_nama'] ?></td>
                    <td style="width: 80px;">
                      <div>

                      <?php if ($this->session->userdata('level') == 2): ?>

                       <button onclick="get_kelas(<?php echo $key['materi_id'] ?>)" class="btn btn-xs btn-default"><i class="fa fa-plus"></i></button>

                      <?php else: ?>

                        <a href="<?php echo base_url() ?>diskusi/materi_room/<?php echo $key['materi_id'] ?>"><button class="btn btn-xs btn-default"><i class="fa fa-comments-o"></i></button></a>

                      <?php endif ?>

                      </div>
                    </td>
                  </tr>

                <?php endforeach ?>

                </tfoot>
              </table>

        </div>
      </div>

<button hidden="" id="modal-popup" data-target="#modal" data-toggle="modal"></button>

<div class="modal fade" id="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div id="view-kelas" class="box-body">
          
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function get_kelas(id){
    
    $.ajax({
      url: '<?php echo base_url('diskusi/get_kelas') ?>',
      type: 'POST',
      dataType: 'json',
      data: {id: id},
    })
    .done(function(data) {

      $('#view-kelas').empty();

      var html = '';

      html += '<table class="table table-bordered">';
      html += '<thead>';
      html += '<tr>';
      html += '<td>Kelas</td>';
      html += '<td width="1">Action</td>';
      html += '</tr>';
      html += '</thead>';
      html += '<tbody>';

      $.each(data, function(index) {
          
        html += '<tr>';
        html += '<td>'+data[index].kelas_nama+' ( '+data[index].kelas_kepanjangan+' ) </td>';
        html += '<td>';
        html += '<a href="<?php echo base_url() ?>diskusi/materi_room/'+id+'/'+data[index].kelas_id+'"><button class="btn btn-xs btn-default"><i class="fa fa-comments-o"></i></button></a>';
        html += '</td>';
        html += '</tr>';

      });

      html += '</tbody>';
      html += '</table>';

      $('#view-kelas').append(html);

      $('#modal-popup').click();  

    });
    
  }
</script>