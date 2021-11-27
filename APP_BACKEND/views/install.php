<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$title?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url();?>asset/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url();?>asset/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url();?>asset/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
  <link rel="stylesheet" href="<?=base_url();?>asset/plugins/iCheck/square/blue.css">
  <!-- Google Font -->
<!--   <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->

  <!-- jQuery 3 -->
  <script src="<?=base_url();?>asset/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?=base_url();?>asset/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- iCheck -->
  <script src="<?=base_url();?>asset/plugins/iCheck/icheck.min.js"></script>
</head>
<body class="hold-transition login-page">
  <style type="text/css">
  .register-box {
      width: 360px;
      margin: 3% auto;
  }
  </style>
  <div class="register-box">
    <div class="register-logo">
      <a href="#"><b>Meeting</b> creative</a>
    </div>

    <div class="register-box-body">
      <p class="login-box-msg"><b>สร้างผู้ดูแลระบบขั้นสูง</b>&nbsp;สำหรับพัฒนาโปรเจ็ค</p>
      <!-- <form id="create" method="post"> -->
        <?php echo form_open('','id="create"'); ?>
        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="ชื่อ" name="f_name" required>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="นามสกุล" name="l_name" required>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="tel" class="form-control" placeholder="เบอร์โทรศัพท์" name="tel" required>
          <span class="glyphicon glyphicon-earphone form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="email" class="form-control" placeholder="อีเมล์" name="email" required>
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>

        <div class="social-auth-links text-center">
          <p>- ชื่อผู้ใช้ & รหัสผ่าน -</p>
        </div>
        ชื่อผู้ใช้
        <div class="form-group has-feedback">

          <input type="text" class="form-control" placeholder="username" name="username" required>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
          <span class="help-block" id="alert-username"></span>
        </div>
        รหัสผ่าน
        <div class="form-group has-feedback password">
          <input type="password" class="form-control" placeholder="password" name="password" required id="password" >
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          <span class="help-block" id="alert-password"></span>
        </div>
        ยืนยันรหัสผ่านอีกครั้ง
        <div class="form-group has-feedback password">
          <input type="password" class="form-control" placeholder="retype password" name="passconf" required id="retype_password">
          <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          <span class="help-block"></span>
          <span class="help-block" id="alert-retype_password"></span>
        </div>
        
        <div class="row">
          <div class="col-md-12">
            <div id="respond_server" class="text-danger">
              
            </div>
          </div>
          <div class="col-md-12">
            <button type="submit" class="btn btn-block btn-primary" id="after_btn">
              <span id="after">เริ่มต้น โปรเจ็ค</span>
              <span id="before" style="display: none;"><i class="fa fa-spinner fa-spin"></i></span>
            </button>
            <a href="" class="btn btn-block btn-success" id="success_btn" style="display: none;">สำเร็จ <u>ไปที่โปรเจ็ค</u></a>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.form-box -->
  </div>
<!-- /.register-box -->
</body>
<!-- /.modal -->
 <script type="text/javascript"  src="<?=base_url();?>asset/plugins/toast/jquery.toast.js"></script>
<script type="text/javascript">
	  // create staff------------------------
      $('#create').submit(function(event) {
        // check password ว่าตรงกันหรือ ถ้าไม่ แจ้งเตือนก่อน
        // if($('#password').val()!=$('#retype_password').val()){
        //   $('.password').addClass('has-error');
        //   $('#alert-retype_password').html('รหัสผ่านไม่ตรงกัน');
        // }else{
        //   $('.password').removeClass('has-error');
        //   $('#alert-retype_password').html('');
        // }

        var form_create = $(this).serialize(); //create form
        var text; //กำหนดค่า text ก่อนนำไปใช้งาน
        var heading;
        var icon;
        $.ajax({
          url: '<?=base_url();?>Backdoor/create',
          type: 'POST',
          data: form_create,
          beforeSend:function(){
            //ปิดกล่องทั้งหมด แล้ว โหลด
            $('#before').show();
            $('#after').hide();
            $('.form-control').prop('readonly', true);
          },
          success:function(data){
            if(data.status=='done'){
               //เปิดกล่องทั้งหมด แต่กด submit ไม่ได้แล้ว
              $('#before').hide();
              $('#after').hide();
              $('.form-control').prop('readonly', true);

              $('#after').hide();
              $('#success_btn').show();
              $('#after_btn').remove();
              $('#respond_server').html('');
              heading = 'Success';
              icon = 'success';
              $("input[name=" + data.token + "]").val(data.hash);
            }else{
               //เปิดกล่องทั้งหมด แต่ error ทำให้ต้องกรอกใหม่
              $("input[name=" + data.token + "]").val(data.hash);
              text = data.info;
              
              $('#respond_server').html(text);
              $('#before').hide();
              $('#after').show();
              $('.form-control').prop('readonly', false);

              heading = 'Error';
              icon = 'error';
            }

            // มี toast แจ้งเตือน
            $.toast({
                heading: heading,
                text: '<b>SERVER RESPOND</b> : <br>'+data.info,
                icon: icon,
                position: 'top-right',
                stack: false,
                hideAfter: false
            });
          }
        })  
        .fail(function (erordata) {
          console.log(erordata);
        })
        return false;
      });
      // !-end create staff
</script>