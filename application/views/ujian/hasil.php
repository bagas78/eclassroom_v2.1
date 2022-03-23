
 
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
                  <th>NIM</th>
                  <th>Nama Mahasiswa</th>
                  <th>Kelas</th>
                  <!-- <th>Judul ujian</th> -->
                  <th>Nilai Ujian</th> 
                  <!-- <th>Sisa Waktu</th> -->
                  <!-- <th>Tanggal</th> -->
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($data as $key): ?>
                                  
                  <tr>
                    <td><?php echo $key['user_nim'] ?></td>
                    <td><?php echo $key['user_name'] ?></td>
                    <td><?php echo $key['kelas_nama'] ?></td>
                    <!-- <td><?php echo $key['ujian_judul'] ?></td> -->
                    <td><?php echo $key['hasil_nilai'] ?></td>
                    <!-- <td><?php echo $key['hasil_sisa'] ?></td>
                    <td><?php echo $key['hasil_tanggal'] ?></td> -->
                    <td style="width: 50px;">
                      <div style="width: 50px;">

                      <a href="<?php echo base_url('ujian/hasil_detail/').$key['hasil_id'].'/'.$key['hasil_soal'] ?>"><button class="btn btn-xs btn-default"><i class="fa fa-eye"></i></button></a>

                      <?php if ($this->session->userdata('level') < 3): ?>
                        
                        <button onclick="del('<?php echo base_url() ?>ujian/hasil_delete/<?php echo $key['hasil_id'] ?>')" class="btn btn-xs btn-default"><i class="fa fa-trash"></i></button>

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

      
