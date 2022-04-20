
    <!-- Main content --> 
    <section class="content">

      <!-- Default box --> 
      <div class="box"> 
        <div class="box-header with-border"> 
 
            <div align="left">
              <button class="btn btn-default" data-toggle="modal" data-target="#modal-album"><i class="fa fa-plus"></i> Tambah</button>
            </div>

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
                  <th width="1">Foto</th>
                  <th>Nama</th>
                  <th>NIM</th>
                  <th>Kelas</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($data as $key): ?>
                                  
                  <tr>
                    <td><img width="40" class="img-thumbnail" src="<?= (@$key['user_foto']) ? base_url('assets/gambar/user/').$key['user_foto'] : base_url('assets/gambar/user/no.jpg') ?>"></td>
                    <td><?php echo $key['user_name'] ?></td>
                    <td><?php echo $key['user_email'] ?></td>
                    <td><?php echo $key['kelas_nama'] ?></td>
                    <td style="width: 80px;">
                      <div>
                      <button class="btn btn-xs btn-default" data-toggle="modal" data-target="#modal-view<?php echo $key['user_id'] ?>"><i class="fa fa-eye"></i></button>
                      <button class="btn btn-xs btn-default" data-toggle="modal" data-target="#modal-edit<?php echo $key['user_id'] ?>"><i class="fa fa-edit"></i></button>
                      <button onclick="del('<?php echo base_url() ?>siswa/delete/<?php echo $key['user_id'] ?>')" class="btn btn-xs btn-default"><i class="fa fa-trash"></i></button>

                      </div>
                    </td>
                  </tr>

                  <div class="modal fade" id="modal-edit<?php echo $key['user_id'] ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Edit Data</h4>
                        </div>
                        <div class="modal-body">
                          <form role="form" method="post" action="<?php echo base_url() ?>siswa/update/<?php echo $key['user_id'] ?>" enctype="multipart/form-data">
                            <div class="box-body">
                              <div class="form-group">
                                <label>Nama</label>
                                <input required="" type="text" name="name" class="form-control" placeholder="Nama Lengkap" value="<?php echo $key['user_name'] ?>">
                              </div>
                              <div class="form-group">
                                <label>NIM</label>
                                <input required="" type="text" name="email" class="form-control" placeholder="NIM" value="<?php echo $key['user_email'] ?>">
                              </div>
                              <div class="form-group">
                                <label>Kelas</label>
                                <select id="kelas<?php echo $key['user_id'] ?>" required="" class="form-control" name="kelas">
                                  <option hidden="" value="">-- Pilih --</option>
                                  <?php foreach ($kelas_data as $kelas): ?>
                                    <option value="<?php echo @$kelas['kelas_id'] ?>"><?php echo @$kelas['kelas_nama'] ?></option>
                                  <?php endforeach ?>
                                </select>

                                <span hidden="" id="kelas-alert<?php echo $key['user_id']; ?>" class="small text-danger">* Kelas yang di pilih telah di hapus</span>

                                <script type="text/javascript">
                                  var l = $('#kelas<?php echo $key['user_id'] ?>').val('<?php echo $key['user_kelas'] ?>');

                                  if (l.val() != null) {
                                    l.change();
                                  }else{
                                    $('#kelas-alert<?php echo $key['user_id']; ?>').removeAttr('hidden',true);
                                  }
                                </script>
                              </div>
                              <div class="form-group">
                                <label>Email</label>
                                <input required="" type="email" name="email2" class="form-control" placeholder="Email" value="<?php echo $key['user_email_2'] ?>">
                              </div>
                              
                            </div>

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


                  <div class="modal fade" id="modal-view<?php echo $key['user_id'] ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                          <form>
                            <div class="box-body">

                              <center>
                                <img width="150" class="img-thumbnail" src="<?= (@$key['user_foto']) ? base_url('assets/gambar/user/').$key['user_foto'] : base_url('assets/gambar/user/no.jpg') ?>">
                              </center>
                              <br/>

                              <div class="form-group">
                                <label>Nama</label>
                                <input readonly="" type="text" class="form-control" value="<?php echo $key['user_name'] ?>">
                              </div>
                              <div class="form-group">
                                <label>Tempat Tanggal Lahir</label>
                                <input readonly="" type="date" class="form-control" value="<?php echo $key['user_ttl'] ?>">
                              </div>
                              <div class="form-group">
                                <label>No. HP</label>
                                <input readonly="" type="number" class="form-control" value="<?php echo $key['user_nohp'] ?>" placeholder="Belum di isi">
                              </div>
                              <div class="form-group">
                                <label>Email</label>
                                <input readonly="" type="email" class="form-control" value="<?php echo $key['user_email_2'] ?>" placeholder="Belum di isi">
                              </div>
                              <div class="form-group">
                                <label>Alamat</label>
                                <input readonly="" type="text" class="form-control" value="<?php echo $key['user_alamat'] ?>" placeholder="Belum di isi">
                              </div>
                              <div class="form-group">
                                <label>Biodata</label>
                                <textarea readonly="" class="form-control" placeholder="Belum di isi"><?php echo $key['user_biodata'] ?></textarea>
                              </div>
                            </div>

                          </form>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->

                <?php endforeach ?>

                </tfoot>
              </table>

        </div>

        
      </div>
      <!-- /.box -->


  <div class="modal fade" id="modal-album">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data</h4>
              </div>
              <div class="modal-body">
                <form role="form" method="post" action="<?php echo base_url() ?>siswa/add" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                      <label>Nama</label>
                      <input required="" type="text" name="name" class="form-control" placeholder="Nama Lengkap">
                    </div>
                    <div class="form-group">
                      <label>NIM</label>
                      <input required="" type="text" name="email" class="form-control" placeholder="NIM">
                    </div>
                    <div class="form-group">
                      <label>Kelas</label>
                      <select required="" class="form-control" name="kelas">
                        <option hidden="" value="">-- Pilih --</option>
                        <?php foreach ($kelas_data as $key): ?>
                          <option value="<?php echo @$key['kelas_id'] ?>"><?php echo @$key['kelas_nama'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                      <input required="" type="email" name="email2" class="form-control" placeholder="Email">
                    </div>
                  </div>

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


       

  


    
      