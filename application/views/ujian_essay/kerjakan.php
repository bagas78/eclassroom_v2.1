
    <!-- Main content --> 
    <section class="content">
 
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">

          <div align="left"> 
            <a href="<?php echo base_url('ujian_essay') ?>"><button class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</button></a>
          </div>
 
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div> 
        </div>
        <div class="box-body">
         
          <form method="POST" action="<?php echo base_url('ujian_essay/kerjakan_send') ?>" enctype="multipart/form-data">

            <!--hidden-->
            <input type="hidden" name="id" value="<?php echo $data['ujian_essay_id'] ?>">

            <div class="col-md-2 row">
              <input id="timer" readonly="" type="text" name="timer" class="form-control" style="background: white;border-radius: 20px;">
            </div>

            <div class="clearfix"></div><br/>
            <h4><?php echo $data['ujian_essay_judul'] ?></h4>

            <div class="clearfix"></div><br/>

            <div class="col-md-12" style="padding: 2%;border-width: 1px;border-style: ridge;background: floralwhite;">
              <?php echo $data['ujian_essay_petunjuk'] ?>
            </div>

            <div class="clearfix"></div><br/>

            <?php $jum = $data['ujian_essay_jumlah']; ?>

            <?php for ($i=1; $i < $jum+1; $i++):?>

              <div class="form-group">

                <div class="col-md-1 col-xs-1" style="width: 0;"><?php echo $i.'.'; ?></div>

                <div class="col-md-11 col-xs-11">

                  <?php if (@GetImageSize(base_url('assets/img/ujian_essay/').$data['gambar'.$i].'.jpeg')): ?>

                    <div class="col-md-3 row">
                      <img width="150" src="<?php echo base_url('assets/img/ujian_essay/').$data['gambar'.$i].'.jpeg' ?>">
                    </div>

                  <div class="col-md-9 row">

                  <?php else: ?>

                  <div class="col-md-12 row">

                  <?php endif ?>

                    <span><?php echo $data['soal'.$i] ?></span>
                  </div>

                  <div class="clearfix"></div><br/>

                  <textarea placeholder="Jawab :" name="jawab<?php echo $i ?>" class="form-control" style="height: 120px;"></textarea>

                </div>

              </div>

              <div class="clearfix"></div>

              <br/>

            <?php endfor ?>

            <button class="btn btn-default" type="submit"><i class="fa fa-check"></i> Simpan</button>
            <a href="<?php echo base_url('ujian_essay') ?>"><button type="button" class="btn btn-default"><i class="fa fa-times"></i> Batal</button></a>

          </form>

        </div>
      </div>
      <!-- /.box -->

<?php 
//convert waktu

$timer = $data['ujian_essay_durasi'];

$waktu = $timer * 60 / 60;

if (round($waktu) <= 0) {
  $menit = 0;
  $detik = $timer;
}else{
  $menit = $waktu;
  $detik = 0;
}


?>

<script type="text/javascript">
    $(document).ready(function() {

        var detik   = <?php echo $detik ?>; 
        var menit   = <?php echo $menit ?>;
          
        function hitung() {

            setTimeout(hitung,1000);

            /** Menampilkan Waktu Timer pada Tag #Timer di HTML yang tersedia */
            $('#timer').val(
                menit + ' menit : ' + detik + ' detik'
            );

            /** Melakukan Hitung Mundur dengan Mengurangi variabel detik - 1 */
            detik --;

            if(detik < 0) {
                detik = 59;
                menit --;

                if (menit < 0) {
                  //submit otomatis
                  $('form').trigger('submit');
                }
            } 
        }           
        /** Menjalankan Function Hitung Waktu Mundur */
        hitung();
  }); 
  // ]]>
</script>
