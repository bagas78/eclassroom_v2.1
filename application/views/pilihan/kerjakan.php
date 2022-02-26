
<form action="<?php echo base_url('pilihan/hasil/').$idsoal ?>" method="post" enctype="multipart/form-data">
 
    <!-- Main content --> 
    <section class="content">

      <!-- Default box --> 
      <div class="box">
        <div class="box-body">
         <h3><?php echo $judul ?></h3>
         <input type="hidden" value="<?php echo $jumlah ?>" name="pilihan_jumlah" class="form-control">
        </div>
      </div>

    <!--soal-->
    <?php for ($i = 1; $i < $jumlah+1; $i++): ?>


      <div id="append-suffle">

      <div class="box suffle">

        <div class="box-body">

          <?php if (@getimagesize(base_url('assets/img/pilihan/').$soal[$i]['gambar'.$i].'.jpeg')): ?>
              
              <div class="col-md-3 row">
                <p><img class="img-thumbnail" width="200" src="<?php echo base_url('assets/img/pilihan/').$soal[$i]['gambar'.$i].'.jpeg' ?>"></p>
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

      </div>


   <!--end soal-->
   <?php endfor ?>

      <button class="btn btn-danger" type="submit"></i> Submit</button>

</form>

<!-- suffle / acak -->
<script src="<?php echo base_url('assets/js/jquery.scramble.js') ?>"></script>

<script type="text/javascript">
  <?php if (@$acak == 'ya'): ?>
    var el = $('.suffle').scramble();
    $('#append-suffle').empty().append(el);
  <?php endif ?>
</script>