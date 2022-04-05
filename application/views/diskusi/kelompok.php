
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
                  <th>Kelompok</th>
                  <th>Kelas</th>
                  <th width="1">Action</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($data as $key): ?>
                                  
                  <tr>
                    <td><?php echo $key['kelompok_nama'] ?></td>
                    <td><?php echo $key['kelas_nama'].' ( '.$key['kelas_kepanjangan'].' ) ' ?></td>
                    <td style="width: 80px;">
                      <div>
                      <a href="<?php echo base_url() ?>diskusi/kelompok/<?php echo $key['kelompok_id'].'/'.$key['kelas_id'] ?>"><button class="btn btn-xs btn-default"><i class="fa fa-comments-o"></i></button></a>

                      </div>
                    </td>
                  </tr>

                <?php endforeach ?>

                </tfoot>
              </table>

        </div>

        
      </div>
      <!-- /.box -->