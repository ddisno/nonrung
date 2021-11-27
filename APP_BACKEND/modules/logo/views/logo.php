  <style type="text/css">
      .btn-file {
          position: relative;
          overflow: hidden;
      }
      .btn-file input[type=file] {
          float: right;
          position: absolute;
          top: 0;
          right: 0;
          min-width: 100%;
          min-height: 100%;
          font-size: 100px;
          text-align: right;
          filter: alpha(opacity=0);
          opacity: 0;
          outline: none;
          background: white;
          cursor: inherit;
          display: block;
      }

      #img-upload{
          width: 100%;
      }
      #img-upload-edit{
          width: 100%;
      }
  </style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <?=$header?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url();?>"><i class="fa fa-dashboard"></i> แดชบอร์ด</a></li>
        <li class="active"><?=$header?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- /.col left-->
        <div class="col-md-5">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">จัดการโลโก้</h3>
            </div>
            <?=form_open('','id=update')?>
            <div class="box-body">
              
                <div class="row">
                  <div class="col-md-6">
                    <div style="width: 100%; padding-bottom: 10px;">
                      <img id='img-upload' src="<?=$img_path_thumb?>" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="input-group">
                      <input type="text" class="form-control" readonly>
                      <span class="input-group-btn">
                        <span class="btn btn-default btn-file" style="background-color: white !important;">
                          <i class="glyphicon glyphicon-folder-open"></i><input type="file" accept="image/*" id="img" name="image">
                        </span>
                      </span>
                    </div>
                  </div>
                </div> 
              
            </div>
            <div class="box-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> &nbsp;บันทึก</button>
              <a class="btn btn-danger pull-right" id="del">นำภาพออก</a>
            </div>
            </form>
            <!-- /.box-body -->
          <!-- /.box -->
          </div>
          <!-- /.box --> 
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script type="text/javascript">
    $(function(){
      var token_name = $("input[name='csrf_token_name']").val();
      $(document).on('change', '.btn-file :file', function() {
          var input = $(this),
          label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
          input.trigger('fileselect', [label]);
        });

        $('.btn-file :file').on('fileselect', function(event, label) {
        
          var input = $(this).parents('.input-group').find(':text'),
              log = label;
          
          if( input.length ) {
              input.val(log);
          } else {
              if( log ) alert(log);
          }
          
        });
         $("#img").change(function(){
            readURL(this);
        });
        //-----------------------------------------------------------------------image crate----------------------------------------------
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#img-upload').attr('src', e.target.result);
                    $('#img-upload').show();
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#update').submit(function(event) {
          if($('#img').get(0).files.length === 0) {
            swal('คำเตือน','กรุณาเลือกรูปภาพ ','warning');
            return false;
          }
          var formData = new FormData($('#update')[0]);
          swal({
            title: 'ยืนยัน',
            text: "ยืนยันการเปลี่ยนโลโก้",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'ยกเลิก',
            confirmButtonText: 'ยืนยัน',
            showLoaderOnConfirm: true,
            preConfirm: function () {
              return new Promise(function (resolve) {
                $.ajax({
                  url: '<?=base_url();?>logo/update',
                  type: 'POST',
                  processData: false,
                  contentType: false,
                  data: formData,
                  success:function(data){
                    $("input[name=" + data.token + "]").val(data.hash);
                  if(data.status == 'done'){
                    swal({
                      title: data.info,
                      text: "",
                      type: "success",
                      button: "ยืนยัน",
                      animation: false
                    });
                  }else{
                    swal({
                      title: data.info,
                      text: "",
                      type: "Error",
                      button: "ยืนยัน",
                      animation: false
                    });
                  }
                  }
                })  
                .fail(function (erordata) {
                  console.log(erordata);
                })
              })
            },    
          })
          return false;
        });

        $(document).on('click','#del',function(){
          swal({
            title: 'ยืนยัน',
            text: "ยืนยันการนำโลโก้ออกหรือไม่?",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'ยกเลิก',
            confirmButtonText: 'ยืนยัน',
            showLoaderOnConfirm: true,
            preConfirm: function () {
              return new Promise(function (resolve) {
                $.ajax({
                  url: '<?=base_url();?>logo/del',
                  type: 'POST',
                  data: {csrf_token_name:token_name},
                  success:function(data){
                    $("input[name=" + data.token + "]").val(data.hash);
                  if(data.status == 'done'){
                    swal({
                      title: data.info,
                      text: "",
                      type: "success",
                      button: "ยืนยัน",
                      animation: false
                    });
                    $('#update')[0].reset();
                     $('#img-upload').attr('src','<?=$this->config->item('vendor').'img/no_img_sq.jpg'?>')
                  }else{
                    swal({
                      title: data.info,
                      text: "",
                      type: "Error",
                      button: "ยืนยัน",
                      animation: false
                    });
                  }
                  }
                })  
                .fail(function (erordata) {
                  console.log(erordata);
                })
              })
            },    
          })
        })



    })
  </script>