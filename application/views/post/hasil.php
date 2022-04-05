
 
    <!-- Main content -->  
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">

          <?php if ($this->session->userdata('level') < 3): ?>
            <form method="POST" action="">
              <div class="col-md-4 col-xs-4 row">
                <select required="" name="materi" class="form-control">
                  <option value="" hidden="">-- Materi --</option>
                  <?php foreach ($materi_data as $key): ?>
                    <option value="<?php echo $key['post_id'] ?>"><?php echo $key['post_judul'] ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="col-md-3 col-xs-4">
                <select required="" name="kelas" class="form-control">
                  <option value="" hidden="">-- Kelas --</option>
                  <?php foreach ($kelas_data as $key): ?>
                    <option value="<?php echo $key['kelas_id'] ?>"><?php echo $key['kelas_nama'] ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="col-md-1 col-xs-1 row">
                <button class="btn btn-danger" type="submit">Cari</button>
              </div>
            </form>
          <?php endif ?>

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
                  <th>Materi</th>
                  <th>Kelas</th>
                  <th>NIM</th>
                  <th>Nama Mahasiswa</th>
                  <th>Nilai Post Test 1</th> 
                  <th>Nilai Post Test 2</th> 
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($data as $key): ?>
                                  
                  <tr>
                    <td><?php echo $key['post_judul'] ?></td>
                    <td><?php echo $key['kelas_nama'] ?></td>
                    <td><?php echo $key['user_email'] ?></td>
                    <td><?php echo $key['user_name'] ?></td>
                    <td><?php echo $key['post_hasil_nilai_1'] ?></td>
                    <td><?php echo $key['post_hasil_nilai_2'] ?></td>
                    <td style="width: 50px;">
                      <div style="width: 50px;">

                      <a href="<?php echo base_url('post/hasil_detail/').$key['post_hasil_id'].'/'.$key['post_hasil_soal'] ?>"><button class="btn btn-xs btn-default"><i class="fa fa-eye"></i></button></a>

                      <?php if ($this->session->userdata('level') < 3): ?>
                        
                        <button onclick="del('<?php echo base_url() ?>post/hasil_delete/<?php echo $key['post_hasil_id'] ?>')" class="btn btn-xs btn-default"><i class="fa fa-trash"></i></button>

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

      
