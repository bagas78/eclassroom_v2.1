<!DOCTYPE html>
<html>
<head> 
  <meta charset="utf-8"> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E-Classroom</title> 
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
 @media (max-width: 767px) {
    .clock {
    left: 35vw;
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
              echo 'Guru';
              break;
            case 3:
              echo 'Siswa';
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

        <?php if ($this->session->userdata('level') == 1): ?>
          
          <li <?php echo @$kelas; ?>>
            <a href="<?php echo base_url() ?>kelas">
              <div class="col-md-1 col-xs-1"><i class="material-icons">view_module</i></div> <div class="col-md-5 col-xs-5"><span>Kelas / Jurusan</span></div>
            </a>
          </li>

          <li <?php echo @$pelajaran; ?>>
            <a href="<?php echo base_url() ?>pelajaran">
              <div class="col-md-1 col-xs-1"><i class="material-icons">menu_book</i></div> <div class="col-md-5 col-xs-5"><span>Pelajaran</span></div>
            </a>
          </li>

          <li class="treeview <?php echo @$open ?>">
            <a href="#">
              <div class="col-md-1 col-xs-1"><i class="material-icons">people_alt</i></div> 
              <div class="col-md-5 col-xs-5"><span>User Control</span></div>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" <?php echo @$block ?>>
              <li <?php echo @$admin_active; ?>>
                <a href="<?php echo base_url('admin') ?>">
                  <i class="material-icons">more_horiz</i>
                  <span class="multi-li">Admin</span>
                </a>
              </li>
              <li <?php echo @$guru_active; ?>>
                <a href="<?php echo base_url('guru') ?>">
                  <i class="material-icons">more_horiz</i>
                  <span class="multi-li">Guru</span>
                </a>
              </li>
              <li <?php echo @$siswa_active; ?>>
                <a href="<?php echo base_url('siswa') ?>">
                  <i class="material-icons">more_horiz</i>
                  <span class="multi-li">Siswa</span>
                </a>
              </li>
            </ul>
          </li>

        <?php endif ?>

        <?php if ($this->session->userdata('level') < 3): ?>

        <li <?php echo @$kelompok; ?>>
          <a href="<?php echo base_url() ?>kelompok">
            <div class="col-md-1 col-xs-1"><i class="material-icons">view_agenda</i></div> <div class="col-md-5 col-xs-5"><span>Kelompok</span></div>
          </a>
        </li>

        <?php endif ?>

        <?php if ($this->session->userdata('level') == 3): ?>
        
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
              <a href="<?php echo base_url('diskusi/kelas') ?>">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Kelas</span>
              </a>
            </li>
            <li <?php echo @$materi_diskusi_active; ?>>
              <a href="<?php echo base_url('diskusi/materi') ?>">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Materi</span>
              </a>
            </li>
            <li <?php echo @$kelompok_diskusi_active; ?>>
              <a href="<?php echo base_url('diskusi/kelompok') ?>">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Kelompok</span>
              </a>
            </li>
          </ul>
        </li>

        <?php endif ?>

        <hr>

        <li <?php echo @$materi; ?>>
          <a href="<?php echo base_url() ?>materi">
            <div class="col-md-1 col-xs-1"><i class="material-icons">book</i></div> <div class="col-md-5 col-xs-5"><span>Materi</span></div>
          </a>
        </li>

        <li class="treeview <?php echo @$open_tugas ?>">
          <a href="#">
            <div class="col-md-1 col-xs-1"><i class="material-icons">chrome_reader_mode</i></div> 
            <div class="col-md-5 col-xs-5"><span>Tugas</span></div>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" <?php echo @$block_tugas ?>>
            <li <?php echo @$tugas_assigment_active; ?>>
              <a href="<?php echo base_url() ?>assigment">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Assigment</span>
              </a>
            </li>
            <li <?php echo @$tugas_essay_active; ?>>
              <a href="<?php echo base_url() ?>essay">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Essay</span>
              </a>
            </li>
            <li <?php echo @$tugas_pilihan_active; ?>>
              <a href="<?php echo base_url() ?>pilihan">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Pilihan Ganda</span>
              </a>
            </li>
          </ul>
        </li>

        <li class="treeview <?php echo @$open_koreksi_tugas ?>">
          <a href="#">
            <div class="col-md-1 col-xs-1"><i class="material-icons">border_color</i></div> 
            <div class="col-md-5 col-xs-5"><span><?=($this->session->userdata('level') < 3)?'Koreksi Tugas':'Hasil Tugas' ?></span></div>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" <?php echo @$block_koreksi_tugas ?>>
            <li <?php echo @$tugas_koreksi_assigment_active; ?>>
              <a href="<?php echo base_url() ?>assigment/koreksi">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Assigment</span>
              </a>
            </li>
            <li <?php echo @$tugas_koreksi_essay_active; ?>>
              <a href="<?php echo base_url() ?>essay/koreksi">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Essay</span>
              </a>
            </li>
            <li <?php echo @$tugas_koreksi_pilihan_active; ?>>
              <a href="<?php echo base_url() ?>pilihan/koreksi">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Pilihan Ganda</span>
              </a>
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
            <li <?php echo @$ujian_soal_active; ?>>
              <a href="<?php echo base_url() ?>ujian">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Soal Ujian</span>
              </a>
            </li>
            <li <?php echo @$ujian_koreksi_active; ?>>
              <a href="<?php echo base_url() ?>ujian/hasil_view">
                <i class="material-icons">more_horiz</i>
                <span class="multi-li">Koreksi</span>
              </a>
            </li>
          </ul>
        </li>

        <hr>

        <li <?php echo @$video; ?>>
          <a href="<?php echo base_url() ?>video">
            <div class="col-md-1 col-xs-1"><i class="material-icons">play_circle_filled</i></div> <div class="col-md-5 col-xs-5"><span>Video</span></div>
          </a>
        </li>

        <li <?php echo @$hiburan; ?>>
          <a href="<?php echo base_url() ?>hiburan">
            <div class="col-md-1 col-xs-1"><i class="material-icons">emoji_emotions</i></div> <div class="col-md-5 col-xs-5"><span>Hiburan</span></div>
          </a>
        </li>

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
    

  