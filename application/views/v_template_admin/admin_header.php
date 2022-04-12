<!DOCTYPE html>
<html>  
<head> 
  <meta charset="utf-8"> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <title>Collassion Learning - App</title> 
  <link rel="shortcut icon" href="<?php echo base_url() ?>assets/gambar/icon.png" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 --> 
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">  
  <!-- Font Awesome --> 
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->  
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->   
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins 
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/dist/css/skins/_all-skins.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- Data Table -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/dist/css/skins/_all-skins.css">

  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">

  <!--material icon-->
  <link href="<?php echo base_url() ?>adminLTE/dist/css/material/material-icon.css" rel="stylesheet"/>

  <!-- jQuery 3 -->
  <script src="<?php echo base_url() ?>adminLTE/bower_components/jquery/dist/jquery.min.js"></script>


<style type="text/css">
  ::-webkit-scrollbar {
    width: 10px;
    height: 10px;
  }

  ::-webkit-scrollbar-thumb {
    background: rgba(0, 0, 0, 0.2);
  }

  ::-webkit-scrollbar-track {
    background: rgba(0, 0, 0, 0);
  }
 .text-image-border{
    width: 50px;  
    height: 50px;
    background-color: #e1e3e2
 }
 .text-image{
    position: absolute;
    top: 25px;
    left: 40px;
    font-size: 25px;
    transform: translate(-50%, -50%);
 }
  /*timer*/
  .without_ampm::-webkit-datetime-edit-ampm-field {
   display: none;
 }
 input[type=time]::-webkit-clear-button {
   -webkit-appearance: none;
   -moz-appearance: none;
   -o-appearance: none;
   -ms-appearance:none;
   appearance: none;
   margin: -10px; 
 }
 hr{
  margin-bottom: 20px;
  border: 0;
  margin-top: 0;
  border-top: 20px solid #F2F2F2;
 }
 .clock {
    font-size: 18px;
    color: white;
    margin: 0;
    position: absolute;
    top: 50%;
    left: 36vw;
    transform: translateY(-50%);
    background-color: #941b2d;
    padding: 5px 30px 5px 30px;
    border-radius: 50px;
 }
 .title-app{
  float: left;
  line-height: 3.7;
  color: white;
  margin-left: 30px;
 }
 @media (max-width: 767px) {
    .clock {
    left: 35vw;
    }
    .title-app{
      display: none; 
    }
  }

.block{
  margin-top: 1px;
}

</style>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" style="text-align: center;">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <span class="title-app">Collassion Learning - App </span>

      <span class="clock" id="clock"></span>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="<?php echo base_url('chat') ?>" class="dropdown-toggle">
              <i style="padding-top: 5px;" class="material-icons">forum</i>
              <span hidden="" class="label" style="background-color: #545454;" id="notif-header"></span>
            </a>
          </li>
         <li>
            <a href="#" data-toggle="control-sidebar"><i style="padding-top: 5px;" class="material-icons">settings</i></a>
          </li>
          
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">

          <?php if ($this->session->userdata('foto') == ''): ?>
            <img src="<?php echo base_url() ?>assets/gambar/user/no.jpg" class="img-circle" alt="User Image"  style="height: 45px;">
          <?php else: ?>
            <img src="<?php echo base_url() ?>assets/gambar/user/<?php echo $this->session->userdata('foto'); ?>" class="img-circle" alt="User Image"  style="height: 45px;">
          <?php endif ?>
          
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('name'); ?></p>
          <a><i class="fa fa-user text-danger"></i> 
          <?php switch ($this->session->userdata('level')) {
            case 1:
              echo 'Admin';
              break;
            case 2:
              echo 'Dosen';
              break;
            case 3:
              echo 'Mahasiswa';
              break;
          } ?></a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        
        <br/>
          
         <li <?php echo @$dashboard; ?>>
          <a href="<?php echo base_url() ?>dashboard">
            <div class="col-md-1 col-xs-1"><i class='material-icons'>dashboard</i></div> <div class="col-md-5 col-xs-5"><span>Dashboard</span></div>
          </a>
        </li>

        <?php if ($this->session->userdata('level') > 1): ?>

        <li class="treeview <?php echo @$tujuan ?>">
            <a href="#">
              <div class="col-md-1 col-xs-1"><i class="material-icons">assignment_turned_in</i></div> 
              <div class="col-md-5 col-xs-5"><span>Tujuan Pembelajaran</span></div>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" <?php echo @$tujuan_block ?>>
              <li <?php echo @$tujuan_active; ?>>
                <a href="<?php echo base_url('tujuan') ?>">
                  <i class="material-icons">more_horiz</i>
                  <span class="multi-li">Tujuan Pembelajaran</span>
                </a>
              </li>
              <li <?php echo @$peta_active; ?>>
                <a href="<?php echo base_url('peta') ?>">
                  <i class="material-icons">more_horiz</i>
                  <span class="multi-li">Peta Kompetensi</span>
                </a>
              </li>
              <li <?php echo @$rencana_active; ?>>
                <a href="<?php echo base_url('rencana') ?>">
                  <i class="material-icons">more_horiz</i>
                  <span class="multi-li">Rencana Pembelajaran</span> <br/>
                  <span style="margin-left: 45px;">Semester</span>
                </a>
              </li>
            </ul>
          </li>

          <li <?php echo @$collassion; ?>>
            <a href="<?php echo base_url() ?>collassion">
              <div class="col-md-1 col-xs-1"><i class="material-icons">layers</i></div> <div class="col-md-5 col-xs-5"><span>Collassion Learning</span></div>
            </a>
          </li>

        <?php endif ?>

        <?php if ($this->session->userdata('level') == 1): ?>
          
          <li <?php echo @$kelas; ?>>
            <a href="<?php echo base_url() ?>kelas">
              <div class="col-md-1 col-xs-1"><i class="material-icons">view_module</i></div> <div class="col-md-5 col-xs-5"><span>Kelas / Jurusan</span></div>
            </a>
          </li>

          <li <?php echo @$pelajaran; ?>>
            <a href="<?php echo base_url() ?>pelajaran">
              <div class="col-md-1 col-xs-1"><i class="material-icons">menu_book</i></div> <div class="col-md-5 col-xs-5"><span>Mata Kuliah</span></div>
            </a>
          </li>

        <?php endif ?>

        <?php if ($this->session->userdata('level') < 3): ?>

          <li class="treeview <?php echo @$open ?>">
            <a href="#">
              <div class="col-md-1 col-xs-1"><i class="material-icons">people_alt</i></div> 
              <div class="col-md-5 col-xs-5"><span>User Control</span></div>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" <?php echo @$block ?>>

              <?php if ($this->session->userdata('level') == 1): ?>

              <li <?php echo @$admin_active; ?>>
                <a href="<?php echo base_url('admin') ?>">
                  <i class="material-icons">more_horiz</i>
                  <span class="multi-li">Admin</span>
                </a>
              </li>
              <li <?php echo @$guru_active; ?>>
                <a href="<?php echo base_url('guru') ?>">
                  <i class="material-icons">more_horiz</i>
                  <span class="multi-li">Dosen</span>
                </a>
              </li>

              <?php endif ?>
              
              <li <?php echo @$siswa_active; ?>>
                <a href="<?php echo base_url('siswa') ?>">
                  <i class="material-icons">more_horiz</i>
                  <span class="multi-li">Mahasiswa</span>
                </a>
              </li>
            </ul>
          </li>

          <?php endif ?>

        <?php if ($this->session->userdata('level') == 2): ?>

        <li <?php echo @$kelompok; ?>>
          <a href="<?php echo base_url() ?>kelompok">
            <div class="col-md-1 col-xs-1"><i class="material-icons">pages</i></div> <div class="col-md-5 col-xs-5"><span>Kelompok</span></div>
          </a>
        </li>

        <?php endif ?>

        <?php if ($this->session->userdata('level') > 1): ?>

        <li class="treeview <?php echo @$open_diskusi ?>">
          <a href="#">
            <div class="col-md-1 col-xs-1"><i class="material-icons">message</i></div> 
            <div class="col-md-5 col-xs-5"><span>Diskusi</span></div>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" <?php echo @$block_diskusi ?>>
            <li <?php echo @$kelas_diskusi_active; ?>>
              <a href="<?= ($this->session->userdata('level') == 3)? base_url('diskusi/kelas') : base_url('diskusi/kelas_table') ?>">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Kelas</span>
              </a>
            </li>
            <li <?php echo @$materi_diskusi_active; ?>>
              <a href="<?php echo base_url('diskusi/materi'); ?>">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Materi</span>
              </a>
            </li>
            <li <?php echo @$kelompok_diskusi_active; ?>>
              <a href="<?= ($this->session->userdata('level') == 3)? base_url('diskusi/kelompok') : base_url('diskusi/kelompok_table') ?>">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Kelompok</span>
              </a>
            </li>
          </ul>
        </li>

        <?php endif ?>

        <?php if ($this->session->userdata('level') < 3): ?>

        <li <?php echo @$semester; ?>>
          <a href="<?php echo base_url() ?>semester">
            <div class="col-md-1 col-xs-1"><i class="material-icons">developer_board</i></div> <div class="col-md-5 col-xs-5"><span>Semester</span></div>
          </a>
        </li>

        <?php endif ?>

        <?php if ($this->session->userdata('level') > 1): ?>

        <hr>

        <li <?php echo @$materi; ?>>
          <a href="<?php echo base_url() ?>materi">
            <div class="col-md-1 col-xs-1"><i class="material-icons">book</i></div> <div class="col-md-5 col-xs-5"><span>Materi</span></div>
          </a>
        </li>

        <li class="treeview <?php echo @$open_latihan ?>">
          <a href="#">
            <div class="col-md-1 col-xs-1"><i class="material-icons">chrome_reader_mode</i></div> 
            <div class="col-md-5 col-xs-5"><span>Latihan</span></div>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" <?php echo @$block_latihan ?>>
            <li <?php echo @$latihan_active; ?>>
              <a href="<?php echo base_url() ?>latihan">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Latihan</span>
              </a>
            </li>
            <li <?php echo @$latihan_koreksi_active; ?>>
              <a href="<?php echo base_url() ?>latihan/koreksi">
                <i class="material-icons">more_horiz</i>
                <?php if ($this->session->userdata('level') < 3): ?>
                  <span class="multi-li">Koreksi Latihan</span>
                <?php else: ?>
                  <span class="multi-li">Nilai Latihan</span>
                <?php endif ?>                
              </a>
            </li>
          </ul>
        </li>

        <li class="treeview <?php echo @$open_test ?>">
          <a href="#">
            <div class="col-md-1 col-xs-1"><i class="material-icons">note_add</i></div> 
            <div class="col-md-5 col-xs-5"><span>Test</span></div>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" <?php echo @$block_test ?>>
            <li <?php echo @$pre_active; ?>>
              <a href="<?php echo base_url() ?>pre">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Pre Test</span>
              </a>
            </li>
            <li <?php echo @$post_active; ?>>
              <a href="<?php echo base_url() ?>post">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Post Test</span>
              </a>
            </li>
            <li <?php echo @$formative_active; ?>>
              <a href="<?php echo base_url() ?>formative">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Formative Test</span>
              </a>
            </li>
            <li class="treeview <?php echo @$open_test_nilai ?>">
              <a href="#">
                <div class="col-md-1 col-xs-1"><i class="material-icons">more_horiz</i></div> 
                <div class="col-md-5 col-xs-5"><span>Nilai Test</span></div>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu block" <?php echo @$block_test_nilai ?>>
                <li <?php echo @$pre_hasil_active; ?>>
                  <a href="<?php echo base_url() ?>pre/hasil_view">
                    <i class="material-icons">more_horiz</i>
                    <span class="multi-li">Nilai Pre Test</span>
                  </a>
                </li>
                <li <?php echo @$post_hasil_active; ?>>
                  <a href="<?php echo base_url() ?>post/hasil_view">
                    <i class="material-icons">more_horiz</i>
                    <span class="multi-li">Nilai Post Test</span>
                  </a>
                </li>
                <li <?php echo @$formative_hasil_active; ?>>
                  <a href="<?php echo base_url() ?>formative/hasil_view">
                    <i class="material-icons">more_horiz</i>
                    <span class="multi-li">Nilai Formative Test</span>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </li>

        <li class="treeview <?php echo @$open_ujian ?>">
          <a href="#">
            <div class="col-md-1 col-xs-1"><i class="material-icons">list_alt</i></div> 
            <div class="col-md-5 col-xs-5"><span>Ujian</span></div>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" <?php echo @$block_ujian ?>>
            <li <?php echo @$ujian_essay_active; ?>>
              <a href="<?php echo base_url() ?>ujian_essay">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Essay</span>
              </a>
            </li>
            <li <?php echo @$ujian_pilihan_active; ?>>
              <a href="<?php echo base_url() ?>ujian_pilihan">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Pilihan Ganda</span>
              </a>
            </li>
            <li class="treeview <?php echo @$open_ujian_hasil ?>">
              <a href="#">
                <div class="col-md-1 col-xs-1"><i class="material-icons">more_horiz</i></div> 
                <div class="col-md-5 col-xs-5"><span>Nilai Ujian</span></div>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu block" <?php echo @$block_ujian_hasil ?>>
                <li <?php echo @$ujian_essay_hasil_active; ?>>
                  <a href="<?php echo base_url() ?>ujian_essay/koreksi">
                    <i class="material-icons">more_horiz</i>
                    <span class="multi-li">Essay</span>
                  </a>
                </li>
                <li <?php echo @$ujian_pilihan_hasil_active; ?>>
                  <a href="<?php echo base_url() ?>ujian_pilihan/hasil_view">
                    <i class="material-icons">more_horiz</i>
                    <span class="multi-li">Pilihan Ganda</span>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </li>

        <li <?php echo @$rekap; ?>>
          <a href="<?php echo base_url() ?>rekap">
            <div class="col-md-1 col-xs-1"><i class="material-icons">insert_chart</i></div> <div class="col-md-5 col-xs-5"><span>Rekap Nilai</span></div>
          </a>
        </li>

         <li <?php echo @$modul; ?>>
          <a href="<?php echo base_url() ?>modul">
            <div class="col-md-1 col-xs-1"><i class="material-icons">description</i></div> <div class="col-md-5 col-xs-5"><span>Modul</span></div>
          </a>
        </li>

        <li <?php echo @$video; ?>>
          <a href="<?php echo base_url() ?>video">
            <div class="col-md-1 col-xs-1"><i class="material-icons">play_circle_filled</i></div> <div class="col-md-5 col-xs-5"><span>Video</span></div>
          </a>
        </li>

        <?php endif ?>

        <?php if ($this->session->userdata('level') == 1 || $this->session->userdata('level') == 3): ?>

        <li <?php echo @$panduan_mahasiswa; ?>>
          <a href="<?php echo base_url() ?>panduan/mahasiswa">
            <div class="col-md-1 col-xs-1"><i class="material-icons"><?= ($this->session->userdata('level') == 1)?'control_point':'help' ?></i></div> <div class="col-md-5 col-xs-5"><span><?= ($this->session->userdata('level') == 1)?'Panduan Mahasiswa':'Panduan Pengguna' ?></span></div>
          </a>
        </li>

        <?php endif ?>

        <?php if ($this->session->userdata('level') < 3): ?>

        <li <?php echo @$panduan; ?>>
          <a href="<?php echo base_url() ?>panduan">
            <div class="col-md-1 col-xs-1"><i class="material-icons">help</i></div> <div class="col-md-5 col-xs-5"><span>Panduan Pengguna</span></div>
          </a>
        </li>

        <?php endif ?>

        <!-- <li <?php echo @$hiburan; ?>>
          <a href="<?php echo base_url() ?>hiburan">
            <div class="col-md-1 col-xs-1"><i class="material-icons">emoji_emotions</i></div> <div class="col-md-5 col-xs-5"><span>Hiburan</span></div>
          </a>
        </li> -->

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->


<!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
       <ul class="control-sidebar-menu">
          <li>
            <a href="<?php echo base_url() ?>profile">
              <i class="fa fa-sort"></i><span> Profile</span>
            </a>
          </li>

          <li>
            <a href="#" onclick="logout('<?php echo base_url('login/logout') ?>')">
              <i class="fa fa-sort"></i><span> Sign out</span>
            </a>
          </li>
            
        </ul>
      </div>
    </div>
  </aside>
  <!-- /.control-sidebar -->
    

  