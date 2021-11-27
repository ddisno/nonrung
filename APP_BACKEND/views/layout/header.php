
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="cache-control" content="no-cache" />
  <meta http-equiv="Pragma" content="no-cache" />
  <title><?=$title?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="<?=$this->config->item('vendor')?>img/logo.png" type="image/gif" sizes="16x16">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=$this->config->item('vendor')?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=$this->config->item('vendor')?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=$this->config->item('vendor')?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?=$this->config->item('vendor')?>bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=$this->config->item('vendor')?>dist/css/AdminLTE.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?=$this->config->item('vendor')?>bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?=$this->config->item('vendor')?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="<?=$this->config->item('vendor')?>dist/css/skins/_all-skins.min.css">
  <link rel="<?=$this->config->item('vendor')?>bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="<?=$this->config->item('vendor')?>plugins/toast/jquery.toast.css">
  <!-- link style -->
 
  <link rel="stylesheet" href="<?=$this->config->item('vendor')?>plugins/sweetalert2/dist/sweetalert2.min.css">
  <link href="<?=$this->config->item('vendor')?>plugins/upload-multiple/jquery.growl.css" rel="stylesheet" type="text/css">
  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

	<!-- jQuery 3 -->
  <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script> -->
	<script src="<?=$this->config->item('vendor')?>bower_components/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?=$this->config->item('vendor')?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- FastClick -->
	<script src="<?=$this->config->item('vendor')?>bower_components/fastclick/lib/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="<?=$this->config->item('vendor')?>dist/js/adminlte.min.js"></script>
	<!-- Sparkline -->
	<script src="<?=$this->config->item('vendor')?>bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
	<!-- jvectormap  -->
	<script src="<?=$this->config->item('vendor')?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="<?=$this->config->item('vendor')?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<!-- SlimScroll -->
	<script src="<?=$this->config->item('vendor')?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<!-- ChartJS -->
	<script src="<?=$this->config->item('vendor')?>bower_components/chart.js/Chart.js"></script>
	<!-- AdminLTE for demo purposes -->
	<!-- <script src="<?=$this->config->item('vendor')?>dist/js/demo.js"></script> -->
  <!-- script in views -->

  <!-- date-range-picker -->
  <script src="<?=$this->config->item('vendor')?>bower_components/moment/min/moment.min.js"></script>
  <script src="<?=$this->config->item('vendor')?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
  <!-- bootstrap datepicker -->
  <script src="<?=$this->config->item('vendor')?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

  <!-- datatable -->
  <!-- data css -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.dataTables.min.css">
  <!-- data js -->
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
  <!-- alert toast -->
  <script type="text/javascript"  src="<?=$this->config->item('vendor')?>plugins/toast/jquery.toast.js"></script>
  <!-- sweetalert -->
  <script src="<?=$this->config->item('vendor')?>plugins/sweetalert2/dist/sweetalert2.min.js"></script>
  <script src="<?=$this->config->item('vendor')?>plugins/upload-multiple/jquery.growl.js"></script> 

  <style type="text/css">
    a{
      cursor: pointer;
    }
    
    hr{
      border-top: 1px #ddd solid;
    }

    .box{
      border-radius: 0px !important;
    }
  </style>
</head>
 
<body class="hold-transition sidebar-mini <?=($this->session->userdata('id_role')!=1)?'skin-blue':'skin-red'?>  sidebar-mini fixed">

<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="<?=$this->config->item('base')?>" target="_blank" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>NR</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">NONRUNG</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu" style="float: left">
        <ul class="nav navbar-nav">
          <li>
            <a href="<?=$this->config->item('base')?>">กลับไปหน้าแรก</a>
          </li>
        </ul>
      </div>

      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
              <img src="<?=$this->config->item('vendor')?>img/no_img_user.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?=$this->session->userdata('f_name').' '.$this->session->userdata('l_name')?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?=$this->config->item('vendor')?>img/no_img_user.jpg" class="img-circle" alt="User Image">

                <p>
                <?=$this->session->userdata('f_name').' '.$this->session->userdata('l_name')?>
                  <small>Log create. <?=$this->session->userdata('create_datetime')?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?=base_url();?>staff/edit/<?=$this->session->userdata('id_staff')?>" class="btn btn-default btn-flat"><i class="fa fa-edit"></i> แก้ไขโปรไฟล์</a>
                </div>
                <div class="pull-right">
                  <a class="btn btn-default btn-flat" href="<?=base_url();?>logout"><i class="fa fa-sign-out"></i>
                    ออก
                  </a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <?php
          if($this->session->userdata('id_role')==1){
            ?>
            <li>
              <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>
            <?php
          }
          ?>
          
        </ul>
      </div>
      <!-- <?=var_dump($this->session->userdata())?> -->
    </nav>
  </header>
  <!-- Control Sidebar -->

 
  