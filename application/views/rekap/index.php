
    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">

          <form method="POST" action="">
            <div class="row">
              <div class="col-md-3 col-xs-3">
                <select id="mahasiswa" required="" name="mahasiswa" class="form-control">
                  <option value="" hidden="">-- Mahasiswa --</option>
                  <?php foreach (@$mahasiswa_data as$key): ?>
                    <option value="<?php echo @$key['user_id'] ?>"><?php echo @$key['user_name'] ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="col-md-3 col-xs-3 row">
                <select id="pelajaran" required="" name="pelajaran" class="form-control">
                  <option value="" hidden="">-- Pelajaran --</option>
                  <?php foreach (@$pelajaran_data as$key): ?>
                    <option value="<?php echo @$key['pelajaran_id'] ?>"><?php echo @$key['pelajaran_nama'] ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="col-md-3 col-xs-3">
                <select id="semester" required="" name="semester" class="form-control">
                  <option value="" hidden="">-- Semester --</option>
                  <?php foreach (@$semester_data as$key): ?>
                    <option value="<?php echo @$key['semester_no'] ?>"><?php echo @$key['semester_no'] ?></option>
                  <?php endforeach ?>
                </select>
              </div> 
              <div class="col-md-1 col-xs-1 row">
                <button class="btn btn-danger" type="submit">Cari</button>
              </div>
            </form>
   
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div> 
          </div>

        </div>
        <div class="box-body"> 

          <table style="width: 50%; background: mintcream;" class="table table-bordered">
            <tr>
              <td>Nama</td>
              <td><?php echo @$nama_info['nama'] ?></td>
            </tr>
            <tr>
              <td>Pelajaran</td>
              <td><?php echo @$pelajaran_info['pelajaran'] ?></td>
            </tr>
            <tr>
              <td>Semester</td>
              <td><?php echo @$semester_info ?></td>
            </tr>
          </table>

          <br/><br/>
          
          <table class="table table-bordered">
            <thead>
              <tr>
                <td colspan="4" style="background: floralwhite;"></td>
                <td align="center" colspan="2" style="background: lemonchiffon;">SUB TOTAL</td>
                <td colspan="2" style="background: floralwhite;"></td>
              </tr>
              <tr>
                <td style="background: bisque;">PERTEMUAN</td>
                <td style="background: bisque;">PRE TEST</td>
                <td style="background: bisque;">POST TEST</td>
                <td style="background: bisque;">LATIHAN</td>
                <td style="background: bisque;">POST TEST</td>
                <td style="background: bisque;">LATIHAN</td>
                <td style="background: bisque;">UAS</td>
                <td style="background: bisque;">TOTAL</td>
              </tr>
            </thead>
            <tbody>
              <?php foreach (@$semester_view as$sem): ?>
                <tr>
                  <td><?php echo @$sem['pertemuan_no'] ?></td>
                  <td id="pre<?php echo @$sem['pertemuan_no'] ?>"></td>
                  <td id="post<?php echo @$sem['pertemuan_no'] ?>"></td>
                  <td id="latihan<?php echo @$sem['pertemuan_no'] ?>"></td>
                  <td id="sub_post<?php echo @$sem['pertemuan_no'] ?>"></td>
                  <td id="sub_latihan<?php echo @$sem['pertemuan_no'] ?>"></td>
                  <td style="background: floralwhite;"></td>
                  <td class="total" id="total<?php echo @$sem['pertemuan_no'] ?>"></td>
                </tr>
              <?php endforeach ?>
            </tbody>
            <tfoot>
              <tr>
                <td style="background: bisque;">UAS ( Pilihan Ganda )</td>
                <td colspan="5" style="background: floralwhite;"></td>
                <td id="uas_pilihan"></td>
                <td class="total" id="uas_pilihan_total"></td>
              </tr>
              <tr>
                <td style="background: bisque;">UAS ( Essay )</td>
                <td colspan="5" style="background: floralwhite;"></td>
                <td id="uas_essay"></td>
                <td class="total" id="uas_essay_total"></td>
              </tr>
              <tr>
                <td colspan="6" style="background: floralwhite;"></td>
                <td style="background: lavender;">NILAI AKHIR</td>
                <td id="nilai_akhir" style="background: crimson;color: white;"></td>
              </tr>
            </tfoot>
          </table>
          
        </div>
      </div>

<script type="text/javascript">
  <?php if (@$this->session->userdata('level') == 2): ?>
    //dosen
    $('#pelajaran').attr('readonly', true);
    $('#pelajaran').val('<?php echo @$this->session->userdata('pelajaran'); ?>').change();

    $('#pelajaran').change(function() {
      $('#pelajaran').val('<?php echo @$this->session->userdata('pelajaran'); ?>').change();
    });
  <?php else: ?>
    //mahasiswa
    $('#mahasiswa').attr('readonly', true);
    $('#mahasiswa').val('<?php echo @$this->session->userdata('id'); ?>').change();

    $('#mahasiswa').change(function() {
      $('#mahasiswa').val('<?php echo @$this->session->userdata('id'); ?>').change();
    });
  <?php endif ?>


  <?php foreach (@$semester_view as$sem): ?>

    //pre, post, latihan
    <?php foreach (@$pre_view as$pre): ?>
      <?php if (@$sem['pertemuan_no'] == @$pre['pre_pertemuan']): ?>
        $('#pre<?php echo @$sem['pertemuan_no'] ?>').text('<?php echo @$pre['pre_hasil_nilai'] ?>');
      <?php endif ?>
    <?php endforeach ?>
    <?php foreach (@$post_view as$post): ?>
      <?php if (@$sem['pertemuan_no'] == @$post['post_pertemuan']): ?>
        $('#post<?php echo @$sem['pertemuan_no'] ?>').text('<?php echo max(@$post['post_hasil_nilai_1'], @$post['post_hasil_nilai_2']); ?>');
      <?php endif ?>
    <?php endforeach ?>
    <?php foreach (@$latihan_view as$latihan): ?>
      <?php if (@$sem['pertemuan_no'] == @$latihan['latihan_pertemuan']): ?>
        $('#latihan<?php echo @$sem['pertemuan_no'] ?>').text('<?php echo @$latihan['latihan_hasil_nilai_total']; ?>');
      <?php endif ?>
    <?php endforeach ?>

    //sub
    <?php 
      @$jum = @$sem['semester_pertemuan'];
      @$a = round(@$jum / 2);
      @$b = @$jum - @$a;
    ?>

    <?php for(@$i=1; @$i <= @$a; @$i++): ?>

      $('#sub_post<?php echo @$i ?>').text($('#post<?php echo @$i ?>').text() * 2);
      $('#sub_latihan<?php echo @$i ?>').text($('#latihan<?php echo @$i ?>').text() * 3);

      //total
      var sub_post = parseInt($('#sub_post<?php echo @$i ?>').text());
      var sub_latihan = parseInt($('#sub_latihan<?php echo @$i ?>').text());
      $('#total<?php echo @$i ?>').text(Math.round((sub_post + sub_latihan) / 100));

      //css
      $('#sub_post<?php echo @$i ?>').css('background', 'yellow');
      $('#sub_latihan<?php echo @$i ?>').css('background', 'greenyellow');

    <?php endfor ?>

    <?php for(@$i=@$a; @$i <= @$jum; @$i++): ?>

      $('#sub_post<?php echo @$i ?>').text($('#post<?php echo @$i ?>').text() * 4);
      $('#sub_latihan<?php echo @$i ?>').text($('#latihan<?php echo @$i ?>').text() * 6);

      //total
      var sub_post = parseInt($('#sub_post<?php echo @$i ?>').text());
      var sub_latihan = parseInt($('#sub_latihan<?php echo @$i ?>').text());
      $('#total<?php echo @$i ?>').text(Math.round((sub_post + sub_latihan) / 100));

      //css
      $('#sub_post<?php echo @$i ?>').css('background', 'gold');
      $('#sub_latihan<?php echo @$i ?>').css('background', 'aquamarine');
      
    <?php endfor ?>

  <?php endforeach ?>

  //uas
  $('#uas_pilihan').text(<?php echo @$ujian_pilihan_view['nilai'] ?>);
  $('#uas_essay').text(<?php echo @$ujian_essay_view['nilai'] ?>);

  //uas total
  var pilihan = parseInt($('#uas_pilihan').text());
  var essay = parseInt($('#uas_essay').text());
  $('#uas_pilihan_total').text((pilihan * 30)/100);
  $('#uas_essay_total').text((essay * 30)/100);

  //nilai akhir
  var sum = 0;
  $('.total').each(function(){
      sum += parseInt($(this).text());

      console.log(sum);
  });

  $('#nilai_akhir').text(sum);
</script>