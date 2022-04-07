
 
    <!-- Main content -->  
    <section class="content"> 
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
           <a href="<?= ($this->session->userdata('level') == 1)? '#': base_url('materi') ?>">
            <div class="small-box img-thumbnail" style="border-width: 3px; border-color: #ffffff; color: #b9253b;">
              <div class="inner">
                <h3><?php echo $materi ?></h3>
 
                <p>Materi</p> 
              </div>
              <div class="icon"> 
                <i style="font-size: inherit;" class="material-icons">book</i>
              </div>
            </div>
          </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
         <a href="<?= ($this->session->userdata('level') == 1)? '#': base_url('latihan') ?>">
          <div class="small-box img-thumbnail" style="border-width: 3px; border-color: #ffffff; color: #b9253b;">
            <div class="inner">
              <h3><?php echo $latihan; ?></h3>

              <p>Latihan</p>
            </div>
            <div class="icon">
              <i style="font-size: inherit;" class="material-icons">list_alt</i>
            </div>
          </div>
        </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <a href="<?= ($this->session->userdata('level') == 1)? '#': base_url('modul') ?>">
            <div class="small-box img-thumbnail" style="border-width: 3px; border-color: #ffffff; color: #b9253b;">
              <div class="inner">
                <h3><?php echo $modul; ?></h3>

                <p>Modul</p>
              </div>
              <div class="icon">
                <i style="font-size: inherit;" class="material-icons">library_books</i>
              </div>
            </div>
          </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <a href="<?= ($this->session->userdata('level') == 1)? '#': base_url('video') ?>">
            <div class="small-box img-thumbnail" style="border-width: 3px; border-color: #ffffff; color: #b9253b;">
              <div class="inner">
                <h3><?php echo $video; ?></h3>

                <p>Video</p>
              </div>
              <div class="icon">
                <i style="font-size: inherit;" class="material-icons">play_circle_filled</i>
              </div>
            </div>
          </div>
        </a>
        <!-- ./col -->
      </div>

        <div class="box">
          <div class="box-header with-border">

            <?php if ($this->session->userdata('level') < 3): ?>
              <div align="left">
                <button data-toggle="modal" data-target="#edit" class="btn btn-default"><i class="fa fa-edit"></i> Edit</button>
              </div> 
            <?php endif ?>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            
            <div class="col-md-12" style="background: ghostwhite; padding: 2%;">
              <table class="table table-bordered">
                <tr>
                  <td>Nama Mata Kuliah</td>
                  <td> : </td>
                  <td><?php echo @$info['informasi_mata_kuliah'] ?></td>
                </tr>
                <tr>
                  <td>Jumlah SKS</td>
                  <td> : </td>
                  <td><?php echo @$info['informasi_sks'] ?></td>
                </tr>
                <tr>
                  <td>Deskripsi</td>
                  <td> : </td>
                  <td><?php echo @$info['informasi_deskripsi'] ?></td>
                </tr>
                <tr>
                  <td>Relevansi</td>
                  <td> : </td>
                  <td><?php echo @$info['informasi_relevansi'] ?></td>
                </tr>
              </table>
            </div>

          </div>
          <!-- /.box-body -->
        </div>

<div class="modal fade" id="edit">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Informasi Dashboard</h4>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="<?php echo base_url() ?>dashboard/edit" enctype="multipart/form-data">
            <div class="box-body">
              <div class="form-group">
                <label>Nama Mata Kuliah</label>
                <input required="" type="text" name="informasi_mata_kuliah" class="form-control" value="<?php echo @$info['informasi_mata_kuliah'] ?>">
              </div>
              <div class="form-group">
                <label>Jumlah SKS</label>
                <input required="" type="text" name="informasi_sks" class="form-control" value="<?php echo @$info['informasi_sks'] ?>">
              </div>
              <div class="form-group">
                <label>Deskripsi</label>
                <textarea required="" name="informasi_deskripsi" class="form-control"><?php echo @$info['informasi_deskripsi'] ?></textarea>
              </div>
              <div class="form-group">
                <label>Relevansi</label>
                <textarea required="" name="informasi_relevansi" class="form-control"><?php echo @$info['informasi_relevansi'] ?></textarea>
              </div>
            </div>
            <!-- /.box-body -->

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

          <!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url() ?>adminLTE/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo base_url() ?>adminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url() ?>adminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url() ?>adminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url() ?>adminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>adminLTE/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url() ?>adminLTE/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() ?>adminLTE/dist/js/demo.js"></script>

<script src="<?php echo base_url() ?>adminLTE/bower_components/jquery/dist/jquery.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/chart/Chart.js"></script>

<!-- DataTables -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>adminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- FLOT CHARTS -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/Flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/Flot/jquery.flot.resize.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/Flot/jquery.flot.pie.js"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/Flot/jquery.flot.categories.js"></script>
<!-- Page script -->

<!-- Select2 -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/select2/dist/js/select2.full.min.js"></script>

<script src="<?php echo base_url() ?>adminLTE/bower_components/ckeditor/ckeditor.js"></script>

<script src="<?php echo base_url('assets/') ?>sweetalert/sweet-alert.js"></script>

<script type="text/javascript">
    //swal("Demo aplikasi tidak bisa untuk INSERT, UPDATE, DELETE", "", "warning");

    function showTime() {
        var a_p = "";
        var today = new Date();
        var curr_hour = today.getHours();
        var curr_minute = today.getMinutes();
        var curr_second = today.getSeconds();
        
        if (curr_hour == 0) {
            curr_hour = 24;
        }
        if (curr_hour > 24) {
            curr_hour = curr_hour - 24;
        }
        curr_hour = checkTime(curr_hour);
        curr_minute = checkTime(curr_minute);
        curr_second = checkTime(curr_second);
     document.getElementById('clock').innerHTML=curr_hour + ":" + curr_minute;
        
        } 
 
    function checkTime(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }
    setInterval(showTime, 500);


  //alert
  <?php if($this->session->flashdata('success')): ?>
    swal("Sukses", "<?php echo $this->session->flashdata('success');?>", "success");
    $('.swal-footer').remove();
  <?php endif ?>

  <?php if($this->session->flashdata('gagal')): ?>
    swal("Gagal", "<?php echo $this->session->flashdata('gagal'); ?>", "warning");
    $('.swal-footer').remove();
  <?php endif ?>


  //logout
  function logout(url){
      swal({
        title: "Yakin akan keluar",
        text: "dari aplikasi ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
    
          $(location).attr('href',url);
          
        }
      });
    }

  //notif
function notif(){
    
    $.ajax({
      url: '<?php echo base_url('chat/notif') ?>',
      type: 'POST',
      dataType: 'json',
      data: {id: '<?php echo $this->session->userdata('id'); ?>'},
    })
    .done(function(data) {
    
      var sum = 0;

      $.each(data, function(index) {

        var name = data[index].chat_name.replace(" ", "_");

         $('#notif'+name).removeAttr('hidden',true);
         $('#notif'+name).text(data[index].not_open);

         sum += parseInt(data[index].not_open);
      });

      if (sum > 0) {
        //notif header
        $('#notif-header').removeAttr('hidden',true);
        $('#notif-header').text(sum);
      }

    });
  
    setTimeout(function() {
      notif();
    }, 1000);

  }

  notif();
  
</script>