
<form action="<?php echo base_url('post/hasil/').$idsoal ?>" method="post" enctype="multipart/form-data">
 
    <!-- Main content --> 
    <section class="content">

      <!-- Default box --> 
      <div class="box"> 
        <div class="box-body"> 

        <div class="col-md-2 row">
         
         <input style="background: white;border-radius: 20px;" readonly="" id="timer" value="" type="text" name="timer" class="form-control">

        </div>

        <div class="clearfix"></div><br/>
        <h4><?php echo $judul ?></h4>

        <!--hidden-->
        <input type="hidden" value="<?php echo $jumlah ?>" name="jumlah" class="form-control">

        <div class="clearfix"></div><br/>

        <div class="col-md-12" style="padding: 2%;border-width: 1px;border-style: ridge;background: floralwhite;">
          <?php echo $petunjuk ?>
        </div>

        </div> 
      </div>

    <!--soal-->
    <?php for ($i = 1; $i < $jumlah+1; $i++): ?>

      <div class="box">
        <div class="box-body">

          <?php if (@getimagesize(base_url('assets/img/post/').$soal[$i]['gambar'.$i].'.jpeg')): ?>
              
              <div class="col-md-3 row">
                <p><img class="img-thumbnail" width="200" src="<?php echo base_url('assets/img/post/').$soal[$i]['gambar'.$i].'.jpeg' ?>"></p>
              </div>

              <div class="col-md-9 row">

          <?php else: ?>

              <div class="col-md-12 row">

          <?php endif ?>

            <span><p><?php echo $soal[$i]['soal_pertanyaan'.$i] ?></p></span>

            <?php if ($soal[$i]['soal_input'.$i] == 'image'): ?>

                <?php if (@getimagesize(base_url('assets/img/post/').$soal[0]['post_id'].'_a_'.$i.'.jpeg')): ?>
                
                    <p><input type="radio" name="soal_jawaban<?php echo $i; ?>" value="A">&#160;&#160;&#160;&#160;&#160;&#160;<img class="img-thumbnail" width="100" src="<?php echo base_url('assets/img/post/').$soal[0]['post_id'].'_a_'.$i.'.jpeg' ?>"></p>

                <?php endif ?>

                <?php if (@getimagesize(base_url('assets/img/post/').$soal[0]['post_id'].'_b_'.$i.'.jpeg')): ?>
                
                    <p><input type="radio" name="soal_jawaban<?php echo $i; ?>" value="B">&#160;&#160;&#160;&#160;&#160;&#160;<img class="img-thumbnail" width="100" src="<?php echo base_url('assets/img/post/').$soal[0]['post_id'].'_b_'.$i.'.jpeg' ?>"></p>

                <?php endif ?>

                <?php if (@getimagesize(base_url('assets/img/post/').$soal[0]['post_id'].'_c_'.$i.'.jpeg')): ?>
                
                    <p><input type="radio" name="soal_jawaban<?php echo $i; ?>" value="C">&#160;&#160;&#160;&#160;&#160;&#160;<img class="img-thumbnail" width="100" src="<?php echo base_url('assets/img/post/').$soal[0]['post_id'].'_c_'.$i.'.jpeg' ?>"></p>

                <?php endif ?>

                <?php if (@getimagesize(base_url('assets/img/post/').$soal[0]['post_id'].'_d_'.$i.'.jpeg')): ?>
                
                    <p><input type="radio" name="soal_jawaban<?php echo $i; ?>" value="D">&#160;&#160;&#160;&#160;&#160;&#160;<img class="img-thumbnail" width="100" src="<?php echo base_url('assets/img/post/').$soal[0]['post_id'].'_d_'.$i.'.jpeg' ?>"></p>

                <?php endif ?>

                <input type="hidden" name="soal_kunci_jawaban<?php echo $i; ?>" value="<?php echo md5($soal[$i]['soal_kunci_jawaban'.$i]) ?>">

            <?php else: ?>
                <p><input type="radio" name="soal_jawaban<?php echo $i; ?>" value="A">&#160;&#160;&#160;<?php echo $soal[$i]['a'.$i] ?></p>
                <p><input type="radio" name="soal_jawaban<?php echo $i; ?>" value="B">&#160;&#160;&#160;<?php echo $soal[$i]['b'.$i] ?></p>
                <p><input type="radio" name="soal_jawaban<?php echo $i; ?>" value="C">&#160;&#160;&#160;<?php echo $soal[$i]['c'.$i] ?></p>
                <p><input type="radio" name="soal_jawaban<?php echo $i; ?>" value="D">&#160;&#160;&#160;<?php echo $soal[$i]['d'.$i] ?></p>
                <input type="hidden" name="soal_kunci_jawaban<?php echo $i; ?>" value="<?php echo md5($soal[$i]['soal_kunci_jawaban'.$i]) ?>">
            <?php endif ?>

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
