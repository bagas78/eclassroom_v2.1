
 
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
                  <th>Nama Siswa</th>
                  <th>Soal</th>
                  <th>Nilai</th>
                  <th>Tanggal</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($data as $key): ?>
                                  
                  <tr>
                    <td><?php echo $key['user_name'] ?></td>
                    <td><?php echo $key['essay_judul'] ?></td>
                    <td><?php echo $key['essay_hasil_nilai_total'] ?></td>
                    <td><?php echo $key['essay_hasil_tanggal'] ?></td>
                    <td style="width: 50px;">
                      <div style="width: 50px;">

                      <a href="<?php echo base_url('essay/koreksi_detail/').$key['essay_id'] ?>"><button class="btn btn-xs btn-default"><i class="<?=($this->session->userdata('level') < 3)?'fa fa-pencil':'fa fa-eye' ?>"></i></button></a>

                      <?php if ($this->session->userdata('level') < 3): ?>
                        
                        <button onclick="del('<?php echo base_url() ?>essay/koreksi_delete/<?php echo $key['essay_hasil_id'] ?>')" class="btn btn-xs btn-default"><i class="fa fa-trash"></i></button>

                      <?php endif ?>

                      </div>
                    </td>
                  </tr>
                
                <?php endforeach ?>

                </tfoot>
              </table>

        </div>

        
      </div>
      <!-- /.box -->