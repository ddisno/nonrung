<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$title?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=$this->config->item('vendor')?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=$this->config->item('vendor')?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=$this->config->item('vendor')?>dist/css/AdminLTE.min.css">
    <!-- iCheck -->
  <link rel="stylesheet" href="<?=$this->config->item('vendor')?>plugins/iCheck/square/blue.css">
  <!-- Google Font -->
<!--   <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->

  <!-- jQuery 3 -->
  <script src="<?=$this->config->item('vendor')?>bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?=$this->config->item('vendor')?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- iCheck -->
  <script src="<?=$this->config->item('vendor')?>plugins/iCheck/icheck.min.js"></script>
</head>
<body class="hold-transition login-page">

  <div class="login-box">
    <div class="row">
      <div class="col-md-12">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-yellow-active">
                <h3 class="widget-user-username">Meeting Createtive</h3>
                <h5 class="widget-user-desc">Login</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" src="<?=$this->config->item('vendor')?>img/logo.jpg" alt="User Image" style="border:1px solid #ddd">
              </div>

              <div class="body">
                <br>
                <br>
                <div class="login-box-body">
                 <?php echo form_open('','id="login"'); ?>
                      
                      <div class="form-group">
                          <div class="input-group" style="width: 100%">
                              <input type="text" class="form-control" name="email" 
                                     placeholder="email" value="<?php if(set_value('email')!=='')
                                                                        {echo set_value('email');}
                                                                      else{
                                                                        if(get_cookie('email'))
                                                                        {echo get_cookie('email');}
                                                                      }
                                                                ?>">
                              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                              
                            </div>
                            <?=form_error('email','<div class="text-red">', '</div>')?>
                      </div><!-- /.form-group -->
                      <div class="form-group">
                          <div class="input-group" style="width: 100%">

                                <input type="password" class="form-control" name="password" 
                                       placeholder="password" value="<?php if(set_value('password')!=='')
                                                                        {echo set_value('password');}
                                                                      else{
                                                                        if(get_cookie('password'))
                                                                        {echo get_cookie('password');}
                                                                      }
                                                                      ?>">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                
                            </div>
                            <?=form_error('password','<div class="text-red">', '</div>')?>
                      </div><!-- /.form-group -->
                      <div class="row">
                          <div class="col-xs-8">
                            <div class="checkbox icheck">
                              <label>
                                <input type="checkbox" name="remember" 
                                  <?=(get_cookie('remember')?'checked':'')?> 
                                > Remember Me
                              </label>
                            </div>
                          </div>
                          <div class="col-xs-4">
                            <button type="submit" class="btn btn-block btn-warning" id="after_btn">
                              <span>เข้าสู่ระบบ</span>
                            </button>
                          </div>
                          <div class="col-xs-12">
                            <a href="<?=base_url()?>password/forgot">ลืมรหัสผ่าน</a><br>
                            <a href="<?=$this->config->item('base')?>">หน้าแรก</a>
                          </div>
                          <div class="col-xs-12">
                            <?php 
                            if($this->session->flashdata('message')){
                              ?>
                               <div class="alert alert-danger fade in alert-dismissible">
                                <?=$this->session->flashdata('message')?>
                              </div>
                              <?php
                            }
                            ?>
                           
                          </div>
                          <div class="col-xs-12">
                            
                          </div>
                      </div>

                  </form>
                </div>

              </div>

            </div>
            <!-- /.out of the box -->
            <div class="lockscreen-footer text-center">
                Copyright © 2019 <b><a href="https://meeting.com" class="text-black">meeting.co.th</a></b><br>
            </div>
          </div>
    </div>
      
  </div>
<!-- /.login-box -->
</body>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });

  $('#login').submit(function(event) {
    $('#after_btn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');
    $("#after_btn").prop('disabled', true);
  });
</script>
</html>



