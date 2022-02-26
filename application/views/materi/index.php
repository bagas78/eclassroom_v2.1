
    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">

            <div align="left">
              <a href="<?php echo base_url('materi/insert') ?>"><button class="btn btn-default"><i class="fa fa-plus"></i> Tambah</button></a>
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
                  <th>Judul</th>
                  <th>Pelajaran</th>
                  <th>Kelas</th>
                  <th width="1">Action</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($data as $key): ?>
                                  
                  <tr>
                    <td><?php echo $key['materi_judul'] ?></td>
                    <td><?php echo $key['pelajaran_nama'] ?></td>
                    <td><?php $str = str_replace(['[',']'], '', $key['materi_kelas']); $db = $this->db->query("SELECT kelas_nama FROM t_kelas WHERE kelas_id IN($str)")->result_array(); foreach ($db as $val) {echo '<span class="badge">'.$val['kelas_nama'].'</span> ';} ?></td>
                    <td style="width: 80px;">
                      <div>
                      <a href="<?php echo base_url() ?>materi/view/<?php echo $key['materi_id'] ?>"><button class="btn btn-xs btn-default"><i class="fa fa-eye"></i></button></a>

                      <?php if ($this->session->userdata('level') < 3): ?>
                        
                        <a href="<?php echo base_url('materi/edit/'.$key['materi_id']) ?>"><button class="btn btn-xs btn-default"><i class="fa fa-edit"></i></button></a>
                        <button onclick="del('<?php echo base_url() ?>materi/delete/<?php echo $key['materi_id'] ?>')" class="btn btn-xs btn-default"><i class="fa fa-trash"></i></button>

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