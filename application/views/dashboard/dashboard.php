
 
    <!-- Main content -->  
    <section class="content"> 
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
           <a href="<?php echo base_url() ?>materi">
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
         <a href="<?php echo base_url() ?>ujian">
          <div class="small-box img-thumbnail" style="border-width: 3px; border-color: #ffffff; color: #b9253b;">
            <div class="inner">
              <h3><?php echo $ujian; ?></h3>

              <p>Ujian</p>
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
          <a href="<?php echo base_url() ?>ujian/hasil_view">
            <div class="small-box img-thumbnail" style="border-width: 3px; border-color: #ffffff; color: #b9253b;">
              <div class="inner">
                <h3><?php echo $hasil; ?></h3>

                <p>Hasil Ujian</p>
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
          <a href="<?php echo base_url() ?>video">
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


      <!-- AREA CHART -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">5 top siswa</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              
              <div id="bar-chart" style="height: 300px;"></div>

            </div>
            <!-- /.box-body -->
          </div>

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
     
     /*
     * BAR CHART
     * ---------
     */

    var bar_data = {
      data : [
                <?php foreach ($peringkat as $key): ?>
                ['<?php echo $key['nama'] ?>', <?php echo $key['nilai'] ?>],
                <?php endforeach ?>
             ],
      color: '#afafaf'
    }
    $.plot('#bar-chart', [bar_data], {
      grid  : {
        borderWidth: 1,
        borderColor: '#f3f3f3',
        tickColor  : '#f3f3f3'
      },
      series: {
        bars: {
          show    : true,
          barWidth: 0.5,
          align   : 'center'
        }
      },
      xaxis : {
        mode      : 'categories',
        tickLength: 0
      }
    })
    /* END BAR CHART */

</script>

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
        title: "Apa kamu yakin?",
        text: "Keluar aplikasi ?",
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