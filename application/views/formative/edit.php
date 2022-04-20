 
 
    <!-- Main content --> 
    <section class="content">
 
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border"> 
 
            <div align="left" > 
              <a href="<?php echo base_url('formative'); ?>"><button class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</button></a>
            </div>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
         
         <form class="form-row" action="<?php echo base_url('formative/update/').$idsoal ?>" method="post" enctype="multipart/form-data">

          <div class="form-group col-md-6">
              <label>Materi</label>
              <input required="" type="text" name="formative_judul" class="form-control" value="<?php echo $judul ?>"> 
            </div>

           <div class="form-group col-md-6">
             <label>Mata Kuliah</label>
             <select id="pelajaran" name="formative_pelajaran" class="form-control">
                <option value="" hidden="">-- Pilih --</option>
                <?php foreach ($pelajaran_data as $val): ?>
                  <option value="<?php echo $val['pelajaran_id'] ?>"><?php echo $val['pelajaran_nama'] ?></option>
                <?php endforeach ?>
              </select>

              <span hidden="" id="pelajaran-alert" class="small text-danger">* Pelajaran telah di hapus, hubungi admin untuk merubah</span>
              
              <script type="text/javascript">
                $('#pelajaran').val(<?php echo $pelajaran; ?>).change();
              </script>
           </div>

           <div class="form-group col-md-4">
             <label>Kelas</label>
             <select id="kelas" name="formative_kelas[]" class="form-control select2" multiple="multiple" data-placeholder="-- Pilih --"
                      style="width: 100%;">
                <?php foreach ($kelas_data as $val): ?>
                  <option value="<?php echo $val['kelas_id'] ?>"><?php echo $val['kelas_nama'] ?></option>
                <?php endforeach ?>
              </select>
              <script type="text/javascript">
                $('#kelas').val([<?php echo $kelas; ?>]).change();
              </script>
           </div>

           <div class="form-group col-md-4">
              <label>Tanggal & Jam</label>
              <input required="" type="datetime-local" name="formative_pelaksanaan" class="form-control" value="<?php echo str_replace(' ','T',$tanggal) ?>"> 
            </div>
            
            <div class="form-group col-md-4">
              <label>Durasi</label>
              <input required="" type="number" name="formative_durasi" class="form-control" value="<?php echo $durasi?>"> 
            </div>

            <div class="form-group col-md-12">
              <label>Petunjuk Pengerjaan</label>
              <textarea required="" class="form-control" name="formative_petunjuk"><?php echo $petunjuk ?></textarea>
            </div>
           
           <div hidden="" class="form-group col-md-3">
             <label>ID Soal</label>
             <input readonly="" value="<?php echo $idsoal ?>" type="text" name="formative_id" class="form-control">
           </div>

           <div hidden="" class="form-group col-md-3">
             <label>Jumlah Soal</label>
             <input readonly="" value="<?php echo $jumlah ?>" type="number" name="formative_jumlah" class="form-control">
           </div>
           
           <div class="clearfix"></div>

           <!--soal-->
           <?php for ($i = 1; $i < $jumlah+1; $i++): ?> 

             <div class="form-group row">
              <div class="col-xs-12 col-lg-6">
                <div class="col-lg-1">
                  <label><?php echo $i; ?>.</label>
                  <br>
                </div>
                <div class="col-lg-11 form-group">
                  <textarea name="soal_pertanyaan<?php echo $i; ?>" class="form-control textarea" required="" style="margin: 0px; height: 181px;"><?php echo $soal[$i]['soal_pertanyaan'.$i] ?></textarea>
                </div>
                <div class="col-lg-1"></div>

                <div class="col-lg-11 form-group">
                  <input type="file" class="form-control" name="file<?php echo $i; ?>" accept="image/*" multiple="">
                  <input type="hidden" id="file1" name="gambar<?php echo $i; ?>" value="<?php echo $soal[$i]['gambar'.$i] ?>">
                  
                  <?php if (@GetImageSize(base_url('assets/img/formative/').$soal[$i]['gambar'.$i].'.jpeg')): ?>
                    
                    <a href="<?php echo base_url('assets/img/formative/').$soal[$i]['gambar'.$i].'.jpeg' ?>" target="_blank"><button style="margin-top: 1%;" type="button" class="btn btn-default btn-xs"><i class="fa fa-eye"></i> view image</button></a>

                  <?php endif ?>

                </div>

              </div>

                <div class="col-xs-12 col-lg-6">
                  <div class="col-lg-1"><label>A. </label>
                </div>
                <div class="col-lg-11 form-group">
                  <input <?= ($soal[$i]['soal_input'.$i] == 'image')?'type="file"':'type="text"' ?> accept="image/*" class="form-control input<?php echo $i; ?>" name="a<?php echo $i; ?>" value="<?= ($soal[$i]['soal_input'.$i] == 'image')?'':$soal[$i]['a'.$i] ?>">

                  <?php if (@GetImageSize(base_url('assets/img/formative/').$soal[0]['formative_id'].'_a_'.$i.'.jpeg')): ?>
                    
                    <a href="<?php echo base_url('assets/img/formative/').$soal[0]['formative_id'].'_a_'.$i.'.jpeg' ?>" target="_blank"><button style="margin-top: 1%;" type="button" class="btn btn-default btn-xs"><i class="fa fa-eye"></i> view image</button></a>

                  <?php endif ?>

                </div>
                <div class="col-lg-1"><label>B. </label></div>
                <div class="col-lg-11 form-group">
                  <input <?= ($soal[$i]['soal_input'.$i] == 'image')?'type="file"':'type="text"' ?> accept="image/*" class="form-control input<?php echo $i; ?>" name="b<?php echo $i; ?>" value="<?= ($soal[$i]['soal_input'.$i] == 'image')?'':$soal[$i]['b'.$i] ?>">

                  <?php if (@GetImageSize(base_url('assets/img/formative/').$soal[0]['formative_id'].'_b_'.$i.'.jpeg')): ?>
                    
                    <a href="<?php echo base_url('assets/img/formative/').$soal[0]['formative_id'].'_b_'.$i.'.jpeg' ?>" target="_blank"><button style="margin-top: 1%;" type="button" class="btn btn-default btn-xs"><i class="fa fa-eye"></i> view image</button></a>

                  <?php endif ?>

                </div><div class="col-lg-1"><label>C. </label></div>
                <div class="col-lg-11 form-group">
                  <input <?= ($soal[$i]['soal_input'.$i] == 'image')?'type="file"':'type="text"' ?> accept="image/*" class="form-control input<?php echo $i; ?>" name="c<?php echo $i; ?>" value="<?= ($soal[$i]['soal_input'.$i] == 'image')?'':$soal[$i]['c'.$i] ?>">

                  <?php if (@GetImageSize(base_url('assets/img/formative/').$soal[0]['formative_id'].'_c_'.$i.'.jpeg')): ?>
                    
                    <a href="<?php echo base_url('assets/img/formative/').$soal[0]['formative_id'].'_c_'.$i.'.jpeg' ?>" target="_blank"><button style="margin-top: 1%;" type="button" class="btn btn-default btn-xs"><i class="fa fa-eye"></i> view image</button></a>

                  <?php endif ?>

                </div>
                <div class="col-lg-1"><label>D. </label></div>
                <div class="col-lg-11 form-group">
                  <input <?= ($soal[$i]['soal_input'.$i] == 'image')?'type="file"':'type="text"' ?> accept="image/*" class="form-control input<?php echo $i; ?>" name="d<?php echo $i; ?>" value="<?= ($soal[$i]['soal_input'.$i] == 'image')?'':$soal[$i]['d'.$i] ?>">

                  <?php if (@GetImageSize(base_url('assets/img/formative/').$soal[0]['formative_id'].'_d_'.$i.'.jpeg')): ?>
                    
                    <a href="<?php echo base_url('assets/img/formative/').$soal[0]['formative_id'].'_d_'.$i.'.jpeg' ?>" target="_blank"><button style="margin-top: 1%;" type="button" class="btn btn-default btn-xs"><i class="fa fa-eye"></i> view image</button></a>

                  <?php endif ?>

                </div>
              
              <div class="col-lg-1"><label>Kunci</label></div>
              <div class="col-lg-3 form-group">
                <select class="form-control" name="soal_kunci_jawaban<?php echo $i; ?>" required="">
                  <option value="<?php echo $soal[$i]['soal_kunci_jawaban'.$i] ?>" hidden=""><?php echo $soal[$i]['soal_kunci_jawaban'.$i] ?></option>
                  <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>
                  <option value="D">D</option>
                </select>
              </div>

              <div class="col-md-4">
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                  <label class="btn btn-default <?= ($soal[$i]['soal_input'.$i] == 'text')?'active':'' ?>">
                  <input class="switch<?php echo $i; ?>" type="radio" name="soal_input<?php echo $i; ?>" autocomplete="off" <?= ($soal[$i]['soal_input'.$i] == 'text')?'checked=""':'' ?> value="text"> Text
                  </label>
                  <label class="btn btn-default <?= ($soal[$i]['soal_input'.$i] == 'image')?'active':'' ?>">
                  <input class="switch<?php echo $i; ?>" type="radio" name="soal_input<?php echo $i; ?>" autocomplete="off" <?= ($soal[$i]['soal_input'.$i] == 'image')?'checked=""':'' ?> value="image"> 
                    Image
                  </label>
                </div>
              </div>

              <script type="text/javascript">
                $(".switch<?php echo $i; ?>").change(function(){
                  if (this.value == 'text') {
                    $('.input<?php echo $i; ?>').prop("type", "text");
                  } else {
                    $('.input<?php echo $i; ?>').prop("type", "file");
                  }
                });
              </script>

            </div>
          </div>
          <!--end soal-->
        <?php endfor ?>
          <button class="btn btn-default" type="submit"><i class="fa fa-check"></i> Simpan</button>

          <a href="<?php echo base_url().$this->uri->segment(1) ?>"><button type="button" class="btn btn-default"><i class="fa fa-times"></i> Batal</button></a>
         </form>

        </div>

        
      </div>
      <!-- /.box -->

<script type="text/javascript">
  <?php if ($this->session->userdata('level') == 2): ?>
    
    var l = $('#pelajaran').val('<?php echo $this->session->userdata('pelajaran'); ?>');

    $('#pelajaran').attr('readonly', true);

    $('#pelajaran').change(function() {
      l.val('<?php echo $this->session->userdata('pelajaran'); ?>').change();
    }); 

    if (l.val() == null) {
     $('#pelajaran-alert').removeAttr('hidden',true); 
    }

  <?php endif ?>
</script>
