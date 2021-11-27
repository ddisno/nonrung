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
        <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> แดชบอร์ด</a></li>
        <li class="active"><?=$header?></li>
      </ol>
    </section>

    <style type="text/css">
      .fr-toolbar {
        border-top: 1px #ddd solid;
      }
    </style>
    <!-- Main content -->
    <section class="content">
      <?=form_open('','id=update')?>
        <div class="row">
          <div class="col-md-12" style="margin-bottom: 5px;">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>
          </div>
          <div class="col-md-4">
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">ทั่วไป</h3>
                <div class="box-tools pull-right">
                  <a  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></a>
                </div>
              </div>
              <div class="box-body">
                <div class="form-horizontal">
                  <div class="form-group">
                    <label class="col-sm-3" style="text-align: right;">ชื่อบริษัท </label>
                    <div class="col-sm-9">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-institution "></i>
                        </span>
                        <input type="text" name="company" class="form-control" value="<?=$data['company']?>">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3" style="text-align: right;">เบอร์โทร</label>
                    <div class="col-sm-9">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-phone"></i>
                        </span>
                        <input type="text" name="tel" class="form-control" value="<?=$data['tel']?>">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3" style="text-align: right;">อีเมล์</label>
                    <div class="col-sm-9">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-envelope"></i>
                        </span>
                        <input type="email" name="email" class="form-control" value="<?=$data['email']?>">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="box box-default ">
              <div class="box-header with-border">
                <h3 class="box-title">ที่อยู่</h3>
                <div class="box-tools pull-right">
                  <a class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></a>
                </div>
              </div>
              <div class="box-body" style="padding: 0">
                <div class="nav-tabs-custom" style="margin-bottom: 0">
                  <ul class="nav nav-tabs">
                    <li class="active" style="display: none;">
                      <a href="#th-ad" data-toggle="tab"><img src="<?=$this->config->item('vendor')?>img/th_fl.jpg" width="25" height="15"> ภาษาไทย</a>
                    </li>
                    <li class="" style="display: none;">
                      <a href="#en-ad" data-toggle="tab"><img src="<?=$this->config->item('vendor')?>img/en_fl.jpg" width="25" height="15"> ภาษาอังกฤษ</a>
                    </li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane active" id="th-ad">
                      <textarea id="about_ad" name="text_ad"><?=$data['text_ad']?></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="box box-default ">
              <div class="box-header with-border">
                <h3 class="box-title">แผนที่</h3>
                <div class="box-tools pull-right">
                  <a class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></a>
                </div>
              </div>
              <div class="box-body">
                  <div class="form-group">
                    <textarea class="form-control" rows="7" name="map"><?=$data['map']?></textarea>
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
  <!-- Include JS files. -->
  <script type="text/javascript" src="<?=$this->config->item('vendor')?>plugins/froala/js/froala_editor.pkgd.min.js"></script>
  <script type="text/javascript">
    $(function(){

        $('#about_ad').froalaEditor({
          heightMin: 150,
          heightMax: 150,
          // Set custom buttons with separator between them.
          toolbarButtons: ['undo', 'redo' , '|', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'outdent', 'indent', 'clearFormatting', 'align'],
          toolbarButtonsMD: ['undo', 'redo' , '|', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'outdent', 'indent', 'clearFormatting', 'align'],
          toolbarButtonsLG: ['undo', 'redo' , '|', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'outdent', 'indent', 'clearFormatting', 'align'],
          toolbarButtonsSM: ['undo', 'redo' , '|', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'outdent', 'indent', 'clearFormatting', 'align'],
          toolbarButtonsXS: ['undo', 'redo' , '|', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'outdent', 'indent', 'clearFormatting', 'align']
        });
       
    })

    // อัพเดตขอ้มูล
    $('#update').submit(function(event) {
      swal({
          title: 'ยืนยัน',
          text: "ยืนยันการแก้ไขข้อมูลบริษัทหรือไม่",
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
                url: '<?=base_url();?>about/update',
                type: 'POST',
                data: $('#update').serialize(),
                success:function(data){
                  console.log(data);
                  if(data == 'success'){
                    swal('สำเร็จ', 'แก้ไขข้อมูลบริษัทเรียบร้อยแล้ว.', 'success');
                  }else{
                    swal('มีปัญหา', 'Please check data with developer!.','error');
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