<!-- Main content --> 
<section class="content">

<div class="box">
    <div class="box-body">
     <h4><?php echo $soal[0]['ujian_pilihan_judul'] ?></h4>
    </div>
</div>

<!--soal-->
<?php for ($i = 1; $i < $jumlah+1; $i++): ?>

  <div class="box">
    <div class="box-body"> 

      <?php if (@getimagesize(base_url('assets/img/ujian_pilihan/').$soal[$i]['gambar'.$i].'.jpeg')): ?>
          
          <div class="col-md-3 row">
            <p><img class="img-thumbnail" width="200" src="<?php echo base_url('assets/img/ujian_pilihan/').$soal[$i]['gambar'.$i].'.jpeg' ?>"></p>
          </div>

          <div class="col-md-9 row">

      <?php else: ?>

          <div class="col-md-12 row">

      <?php endif ?>

        <span><p><?php echo $soal[$i]['soal_pertanyaan'.$i] ?></p></span>

        <?php if ($soal[$i]['soal_input'.$i] == 'image'): ?>

                <?php if (@getimagesize(base_url('assets/img/ujian_pilihan/').$soal[0]['ujian_pilihan_id'].'_a_'.$i.'.jpeg')): ?>
                
                    <p><input id="jawaban-A<?php echo $i; ?>" type="radio" name="soal_jawaban<?php echo $i; ?>" value="A">&#160;&#160;&#160;&#160;&#160;&#160;<img class="img-thumbnail" width="100" src="<?php echo base_url('assets/img/ujian_pilihan/').$soal[0]['ujian_pilihan_id'].'_a_'.$i.'.jpeg' ?>"> <span></span></p>

                <?php endif ?>

                <?php if (@getimagesize(base_url('assets/img/ujian_pilihan/').$soal[0]['ujian_pilihan_id'].'_b_'.$i.'.jpeg')): ?>
                
                    <p><input id="jawaban-B<?php echo $i; ?>" type="radio" name="soal_jawaban<?php echo $i; ?>" value="B">&#160;&#160;&#160;&#160;&#160;&#160;<img class="img-thumbnail" width="100" src="<?php echo base_url('assets/img/ujian_pilihan/').$soal[0]['ujian_pilihan_id'].'_b_'.$i.'.jpeg' ?>"> <span></span></p>

                <?php endif ?>

                <?php if (@getimagesize(base_url('assets/img/ujian_pilihan/').$soal[0]['ujian_pilihan_id'].'_c_'.$i.'.jpeg')): ?>
                
                    <p><input id="jawaban-C<?php echo $i; ?>" type="radio" name="soal_jawaban<?php echo $i; ?>" value="C">&#160;&#160;&#160;&#160;&#160;&#160;<img class="img-thumbnail" width="100" src="<?php echo base_url('assets/img/ujian_pilihan/').$soal[0]['ujian_pilihan_id'].'_c_'.$i.'.jpeg' ?>"> <span></span></p>

                <?php endif ?>

                <?php if (@getimagesize(base_url('assets/img/ujian_pilihan/').$soal[0]['ujian_pilihan_id'].'_d_'.$i.'.jpeg')): ?>
                
                    <p><input id="jawaban-D<?php echo $i; ?>" type="radio" name="soal_jawaban<?php echo $i; ?>" value="D">&#160;&#160;&#160;&#160;&#160;&#160;<img class="img-thumbnail" width="100" src="<?php echo base_url('assets/img/ujian_pilihan/').$soal[0]['ujian_pilihan_id'].'_d_'.$i.'.jpeg' ?>"> <span></span></p>

                <?php endif ?>

                <input type="hidden" name="soal_kunci_jawaban<?php echo $i; ?>" value="<?php echo md5($soal[$i]['soal_kunci_jawaban'.$i]) ?>">

            <?php else: ?>

                <p><input id="jawaban-A<?php echo $i; ?>" type="radio" name="soal_jawaban<?php echo $i; ?>" value="A">&#160;&#160;&#160;<?php echo $soal[$i]['a'.$i] ?> <span></span></p>
                <p><input id="jawaban-B<?php echo $i; ?>" type="radio" name="soal_jawaban<?php echo $i; ?>" value="B">&#160;&#160;&#160;<?php echo $soal[$i]['b'.$i] ?> <span></span></p>
                <p><input id="jawaban-C<?php echo $i; ?>" type="radio" name="soal_jawaban<?php echo $i; ?>" value="C">&#160;&#160;&#160;<?php echo $soal[$i]['c'.$i] ?> <span></span></p>
                <p><input id="jawaban-D<?php echo $i; ?>" type="radio" name="soal_jawaban<?php echo $i; ?>" value="D">&#160;&#160;&#160;<?php echo $soal[$i]['d'.$i] ?> <span></span></p>

            <?php endif ?>

        <?php if ($this->session->userdata('level') < 3): ?>
            <p style="background: #f2f2f2; padding: 1%; width: 70px;">Kunci : <?php echo $soal[$i]['soal_kunci_jawaban'.$i] ?></p>
        <?php endif ?>

        <script type="text/javascript">
            $('#jawaban-<?php echo $jawaban[$i - 1].$i; ?>').prop('checked', true);

            <?php if ($jawaban[$i - 1] == $soal[$i]['soal_kunci_jawaban'.$i]): ?>
                $('#jawaban-<?php echo $jawaban[$i - 1].$i; ?>').nextAll('span:first').append('<i class="fa fa-check text-success"></i>');                
            <?php else: ?>
                $('#jawaban-<?php echo $jawaban[$i - 1].$i; ?>').nextAll('span:first').append('<i class="fa fa-times text-danger"></i>');
            <?php endif ?>

        </script>

      </div>

    </div>
  </div>


<!--end soal-->
<?php endfor ?>

<a href="<?php echo base_url('ujian_pilihan/hasil_view') ?>"><button style="background: white;" class="btn btn-default" type="button"></i><i class="fa fa-angle-double-left"></i> Back</button></a>
