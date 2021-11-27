<link href="<?=$this->config->item('vendor')?>plugins/froala/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css">
<link href="<?=$this->config->item('vendor')?>plugins/froala/css/froala_style.min.css" rel="stylesheet" type="text/css">
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <?=$header?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url();?>"><i class="fa fa-dashboard"></i> แดชบอร์ด</a></li>
        <li class=""><a href="<?=base_url();?>blog">ข่าวสาร</a> </li>
        <li class=""><a href="<?=base_url();?>blog/category"><?=$name_cat_th?></a></li>
        <li class="active"><?=$name_th?></li>
      </ol>
    </section>
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
          width: 200px;
      }
      #blah{
          width: 100%;
      }
    </style>
    <!-- Main content -->
    <section class="content">
      <form id="edit">
        <input type="hidden" name="id_blog" value="<?=$id_blog?>">
        <div class="row">
          <div class="col-md-8">
            <div class="box box-primary" style="border-top: 0">
              <div class="box-body" style="padding: 0;">
                <div class="nav-tabs-custom" style="margin-bottom: 0">
                  <ul class="nav nav-tabs">
                    <li class="active">
                      <a href="#th" data-toggle="tab"><img src="<?=$this->config->item('vendor')?>img/th_fl.jpg" width="25" height="15"> ภาษาไทย</a>
                    </li>
                    <li class="" style="display: none;">
                      <a href="#en" data-toggle="tab"><img src="<?=$this->config->item('vendor')?>img/en_fl.jpg" width="25" height="15"> ภาษาอังกฤษ</a>
                    </li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane active" id="th">
                      <div class="form-group" style="margin-bottom: 0">
                        <label for="inputEmail3" class="col-sm-1 control-label" style="padding: 0">หัวเรื่อง</label>
                        <div class="col-sm-11" style="padding: 0">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-header"></i></span>
                            <input type="text" class="form-control" id="name_th" placeholder="Header.." required name="name_th" value="<?=$name_th?>">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>เนื้อหาย่อ</label>
                        <textarea name="para_th" class="form-control" rows="5"><?=$para_th?></textarea>
                      </div>
                      <textarea id="text_th" name="text_th"><?=$text_th?></textarea>
                    </div>
                    <div class="tab-pane" id="en">
                      <div class="form-group" style="margin-bottom: 0">
                        <label for="inputEmail3" class="col-sm-1 control-label" style="padding: 0">หัวเรื่อง</label>
                        <div class="col-sm-11" style="padding: 0">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-header"></i></span>
                            <input type="text" class="form-control" id="name_en" placeholder="Header.." name="name_en" value="<?=$name_en?>">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>เนื้อหาย่อ</label>
                        <textarea name="para_en" class="form-control" rows="5"><?=$para_en?></textarea>
                      </div>
                      <textarea id="text_en" name="text_en"><?=$text_en?></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <button class="btn btn-primary" id="save"><i class="fa fa-save"></i> &nbsp;บันทึก</button>
              </div>
            </div>    
          </div>
          <div class="col-md-4">
            <div class="row">
              <div class="col-md-12">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">รูปภาพหน้าปก</h3>
                    <!-- /.box-tools -->
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body" style="">
                    <div style="width: 100%; padding-bottom: 10px;">
                      <?php
                        if($img_path!=''){
                          $img = $img_path;
                        }else{
                          $img = $this->config->item('vendor').'img/no_img_sq.jpg';
                        }
                      ?>
                        <img id='img-upload' src="<?=$img?>" />
                    </div>
                    <div class="input-group">
                      <input type="text" class="form-control" readonly>
                      <span class="input-group-btn">
                        <span class="btn btn-default btn-file" style="background-color: white !important;">
                          <i class="glyphicon glyphicon-folder-open"></i><input type="file" accept="image/*" id="imgInp" name="image">
                        </span>
                      </span>
                    </div>
                  </div>
                  <hr style="margin-top: 2px !important; margin-bottom: 2px !important">
                  <div class="box-body" style="">
                    <div class="form-group">
                      <label>เลือกหมวดหมู่</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-object-group"></i></span>
                        <select class="form-control" id="category" name="category">
                          <?php
                            foreach ($cats as $cat) {
                          ?>
                              <option value="<?=$cat['id_cat']?>" <?=($cat['id_cat']==$id_cat)?'selected': ''; ?> ><?=$cat['name_cat_th']?></option>
                          <?php
                            }
                          ?>
                          
                        </select>
                      </div>
                    </div>
                  </div>
                  <!-- /.box-body -->
                  <!-- <div class="box-footer">
                    <a href="<?=base_url();?>blog/category" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;จัดการหมวดหมู่</a>
                  </div> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script type="text/javascript" src="<?=$this->config->item('vendor')?>plugins/froala/js/froala_editor.pkgd.min.js"></script>
  <script type="text/javascript">
    $(function(){
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

        $("#imgInp").change(function(){
            readURL(this);
        });


        $('#text_th').froalaEditor({
          language: 'ar',
          heightMin: 400,
          heightMax: 400,
          // image
          imageUploadURL:"<?=base_url();?>blog/upload",
          imageUploadParam:"fileName",
          imageManagerLoadMethod:"GET",
          imageManagerLoadURL:"<?=base_url();?>blog/select",
          imageManagerDeleteURL:"<?=base_url();?>blog/delete",
          imageManagerDeleteMethod:"POST",
          // video
          videoUploadURL: '<?=base_url();?>blog/upload',
          videoUploadParam: 'fileName',
          videoUploadMethod: 'POST',
          videoMaxSize: 50 * 1024 * 1024,
          videoAllowedTypes: ['mp4', 'webm', 'jpg', 'ogg'],
          // fileupload
          fileUploadURL: '<?=base_url();?>blog/upload',
          fileUploadParam: 'fileName',
          fileUploadMethod: 'POST',
          fileMaxSize: 20 * 1024 * 1024,
          fileAllowedTypes: ['*'],
        }).on('froalaEditor.image.uploaded', function (e, editor, response) {
          console.log(response);
        }).on('froalaEditor.imageManager.beforeDeleteImage', function (e, editor, $img) {
          console.log($img);
        }).on('froalaEditor.imageManager.imageDeleted', function (e, editor, res) {
          console.log(res);
        }).on('froalaEditor.video.beforeUpload', function (e, editor, videos) {
          console.log("beforeUpload");
        }).on('froalaEditor.video.uploaded', function (e, editor, response) {
          console.log("uploaded");
        }).on('froalaEditor.video.inserted', function (e, editor, $img, response) {
          console.log("inserted");
        }).on('froalaEditor.video.replaced', function (e, editor, $img, response) {
          console.log("replaced");
        }).on('froalaEditor.video.error', function (e, editor, error, response) {
          console.log("error");
        }).on('froalaEditor.file.beforeUpload', function (e, editor, files) {
          console.log("beforeUpload");
        }).on('froalaEditor.file.uploaded', function (e, editor, response) {
          console.log("uploaded");
        }).on('froalaEditor.file.inserted', function (e, editor, $file, response) {
          console.log("inserted");
        }).on('froalaEditor.file.error', function (e, editor, error, response) {
          console.log("error");
        });
        $('#text_en').froalaEditor({
          language: 'ar',
          heightMin: 400,
          heightMax: 400,
          // image
          imageUploadURL:"<?=base_url();?>blog/upload",
          imageUploadParam:"fileName",
          imageManagerLoadMethod:"GET",
          imageManagerLoadURL:"<?=base_url();?>blog/select",
          imageManagerDeleteURL:"<?=base_url();?>blog/delete",
          imageManagerDeleteMethod:"POST",
          // video
          videoUploadURL: '<?=base_url();?>blog/upload',
          videoUploadParam: 'fileName',
          videoUploadMethod: 'POST',
          videoMaxSize: 50 * 1024 * 1024,
          videoAllowedTypes: ['mp4', 'webm', 'jpg', 'ogg'],
          // fileupload
          fileUploadURL: '<?=base_url();?>blog/upload',
          fileUploadParam: 'fileName',
          fileUploadMethod: 'POST',
          fileMaxSize: 20 * 1024 * 1024,
          fileAllowedTypes: ['*'],
        }).on('froalaEditor.image.uploaded', function (e, editor, response) {
          console.log(response);
        }).on('froalaEditor.imageManager.beforeDeleteImage', function (e, editor, $img) {
          console.log($img);
        }).on('froalaEditor.imageManager.imageDeleted', function (e, editor, res) {
          console.log(res);
        }).on('froalaEditor.video.beforeUpload', function (e, editor, videos) {
          console.log("beforeUpload");
        }).on('froalaEditor.video.uploaded', function (e, editor, response) {
          console.log("uploaded");
        }).on('froalaEditor.video.inserted', function (e, editor, $img, response) {
          console.log("inserted");
        }).on('froalaEditor.video.replaced', function (e, editor, $img, response) {
          console.log("replaced");
        }).on('froalaEditor.video.error', function (e, editor, error, response) {
          console.log("error");
        }).on('froalaEditor.file.beforeUpload', function (e, editor, files) {
          console.log("beforeUpload");
        }).on('froalaEditor.file.uploaded', function (e, editor, response) {
          console.log("uploaded");
        }).on('froalaEditor.file.inserted', function (e, editor, $file, response) {
          console.log("inserted");
        }).on('froalaEditor.file.error', function (e, editor, error, response) {
          console.log("error");
        });
    })

    $('#edit').submit(function(event) {
      var formData = new FormData($('#edit')[0]);
      if($('#category').val()==undefined){
        swal('Warning', 'Create category before add blog record.', 'warning');
        return false;
      }
      swal({
          title: 'ยืนยัน',
          text: "ยืนยันการแก้ไขข้อมูล",
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
                url: '<?=base_url();?>blog/blog_edit',
                type: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                success:function(data){
                  console.log(data);
                  if(data == 'success'){
                    swal('สำเร็จ', 'แก้ไขข้อมูลเรียบร้อยแล้ว', 'success');
                  }else{
                    swal('เกิดปัญหา', 'Please check data with developer!.','error');
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


  </script>