
<form action="<?php echo base_url('ujian/hasil/').$idsoal ?>" method="post" enctype="multipart/form-data">
 
    <!-- Main content --> 
    <section class="content">

      <!-- Default box --> 
      <div class="box">
        <div class="box-body">
         <h3><?php echo $judul ?></h3>
         <input style="width: 140px;border-radius: 50px;" readonly="" id="timer" value="" type="text" name="ujian_timer" class="form-control">
         <input type="hidden" value="<?php echo $jumlah ?>" name="ujian_jumlah" class="form-control">
        </div>
      </div>

    <!--soal-->
    <?php for ($i = 1; $i < $jumlah+1; $i++): ?>

      <div class="box">
        <div class="box-body">

          <?php if (@getimagesize(base_url('assets/img/soal/').$soal[$i]['gambar'.$i].'.jpeg')): ?>
              
              <div class="col-md-3 row">
                <p><img class="img-thumbnail" width="200" src="<?php echo base_url('assets/img/soal/').$soal[$i]['gambar'.$i].'.jpeg' ?>"></p>
              </div>

              <div class="col-md-9 row">

          <?php else: ?>

              <div class="col-md-12 row">

          <?php endif ?>

            <span><p><?php echo $soal[$i]['soal_pertanyaan'.$i] ?></p></span>

            <p><input type="radio" name="soal_jawaban<?php echo $i; ?>" value="A">&#160;&#160;&#160;<?php echo $soal[$i]['a'.$i] ?></p>
            <p><input type="radio" name="soal_jawaban<?php echo $i; ?>" value="B">&#160;&#160;&#160;<?php echo $soal[$i]['b'.$i] ?></p>
            <p><input type="radio" name="soal_jawaban<?php echo $i; ?>" value="C">&#160;&#160;&#160;<?php echo $soal[$i]['c'.$i] ?></p>
            <p><input type="radio" name="soal_jawaban<?php echo $i; ?>" value="D">&#160;&#160;&#160;<?php echo $soal[$i]['d'.$i] ?></p>
            <input type="hidden" name="soal_kunci_jawaban<?php echo $i; ?>" value="<?php echo md5($soal[$i]['soal_kunci_jawaban'.$i]) ?>">

          </div>

        </div>
      </div>


   <!--end soal-->
   <?php endfor ?>

      <button class="btn btn-danger" type="submit"></i> Submit</button>

</form>

<?php 
//convert waktu

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
