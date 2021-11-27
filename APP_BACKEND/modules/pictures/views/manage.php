<link href="<?=$this->config->item('vendor')?>plugins/upload-multiple/jquery.growl.css" rel="stylesheet" type="text/css">
<link href="<?=$this->config->item('vendor')?>plugins/upload-multiple/src/fileup.css" rel="stylesheet" type="text/css">
<style type="text/css">
  @media (min-width: 768px){
    .modal-dialog {
        width: 900px;
        margin: 30px auto;
    }
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
        <li><a href="#"><i class="fa fa-dashboard"></i> อัลบัิ้ม</a></li>
        <li class="active"><?=$header?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="<?=base_url();?>pictures/album" class="btn btn-primary btn-block margin-bottom">จัดการอัลบั้มรูปภาพ</a>

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">โฟลเดอร์ </h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li class="album_menu" data-id=""><a href="#"><i class="fa fa-inbox"></i>ทั้งหมด</a></li>
                <li class="album_menu" data-id="0"><a href="#"><i class="fa fa-inbox"></i>ไม่มีอัลบั้ม</a></li>
                <?php
                  foreach ($albums as $val) {
                    ?>
                    <li class="album_menu" data-id="<?=$val['id_album']?>"><a href="#"><i class="fa fa-inbox"></i><?=$val['name_album_th']?> </a></li>
                    <?php
                  }
                ?>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>

        </div>
        <!-- /.col -->
        <?php echo form_open('','id="form_delmulti"'); ?>
        <?php echo form_close()?>
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">รูปภาพ</h3>

              <div class="box-tools pull-right">
                <!-- <div class="has-feedback">
                  <input type="text" class="form-control input-sm" placeholder="Search Mail">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div> -->
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle" data-toggle="modal" data-target="#modal-add"><i class="fa fa-plus"></i>
                  เพิ่มรูปภาพ
                </button>

                <!-- /.pull-right -->
              </div>
            </div>
            <div class="box-body">
              <div class="callout callout-warning" id="none_img" style="display: none;">
                <h4>ไม่มีรูปภาพ</h4>
              </div>
              <ul class="mailbox-attachments clearfix" id="area_album_pic"style="width: 100% height: auto;">
              </ul>
            </div>
            <div class="overlay" id="overlay" style="display: none;">
              <i class="fa fa-refresh fa-spin"></i>
            </div>

            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle" data-toggle="modal" data-target="#modal-add"><i class="fa fa-plus"></i>
                  เพิ่มรูปภาพ
                </button>
                <!-- /.pull-right -->
              </div>
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    <div>
  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script src="<?=$this->config->item('vendor')?>plugins/upload-multiple/src/fileup.js"></script> 
  <!-- modal -->
  <div class="modal fade" id="modal-add" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Default Modal</h4>
              </div>
              <div class="modal-body">
                <div id="multiple">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="input-group">
                        <span class="input-group-addon">เลือกอัลบั้ม : </span>
                        <select class="form-control" id="change-album">
                          <option value="0">--กรุณาเลือกอัลบั้ม--</option>
                          <?php
                          foreach ($albums as $val) {
                            ?>
                            <option value="<?=$val['id_album']?>"><?=$val['name_album_th']?></option>
                            <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <button type="button" class="btn btn-success fileup-btn" style="margin-bottom: 5px;">
                            เลือกรูปภาพ
                            <input type="file" id="upload-2" multiple accept="image/*" name="image[]">
                        </button>

                        <a class="control-button btn btn-primary" style="display: none;margin-bottom: 5px"
                           href="javascript:$.fileup('upload-2', 'upload', '*')"><i class="fa fa-cloud-upload"></i> อัพโหลดรูปภาพ</a>
                        <a class="control-button btn btn-danger" style="display: none;margin-bottom: 5px;"
                           href="javascript:$.fileup('upload-2', 'remove', '*')"><i class="fa fa-trash"></i></a>
                    </div>
                  </div>
                        
                        
                        
                        <div id="upload-2-dropzone">
                          <div class="queue">
                            <ul class="mailbox-attachments clearfix" id="upload-2-queue" style="width: 100%;min-height: 200px; height: auto;border: 2px dashed grey;">

                            </ul>
                          </div>
                        </div>
                      </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary" id="test">Save changes</button> -->
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
  </div>
<script type="text/javascript">
  var album = 0;
  var album_active = '';
  var num_success = 0;
  var num_fileup = 0;

  fetch_img();

  $('.album_menu').click(function(event) {
   $('.album_menu').removeClass('active');
   $(this).addClass('active');
   var id_album = $(this).attr('data-id');
   album_active = id_album;
   fetch_img(id_album);
  });

  $('#change-album').change(function(event) {
    album = $(this).val();
  });


  $.fileup({
        url: '<?=base_url();?>pictures/pictures_uploads',
        inputID: 'upload-2',
        dropzoneID: 'upload-2-queue',
        queueID: 'upload-2-queue',
        templateFile: '<li id="fileup-[INPUT_ID]-[FILE_NUM]" class="fileup-file [TYPE] fileup-num" style="width: 160px; ">' +
                          '<span class="mailbox-attachment-icon has-img" style="font-size: 0px;height: 100px;position: relative;">' +
                              '<img src="[PREVIEW_SRC]" alt="[NAME]"/ style="width: auto;height: auto;max-width: 100%;max-height: 100%;">' +
                          '</span>' +
                          '<div class="mailbox-attachment-info">' +
                              '<div class="fileup-description mailbox-attachment-name" style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap;">' +
                              '<span class="fileup-name">[NAME]</span><br> (<span class="fileup-size">[SIZE_HUMAN]</span>)' +
                              '</div>' +
                              '<div class="fileup-controls">' +
                                  '<span class="fileup-remove" onclick="$.fileup(\'[INPUT_ID]\', \'remove\', \'[FILE_NUM]\');" title="[REMOVE]"></span>' +
                                  '<span class="fileup-abort" onclick="$.fileup(\'[INPUT_ID]\', \'abort\', \'[FILE_NUM]\');" style="display:none">[ABORT]</span>' +
                              '</div>' +
                              '<div class="fileup-result"></div>' +
                              '<div class="fileup-progress">' +
                                    '<div class="fileup-progress-bar"></div>' +
                              '</div>' +
                          '</div>' +
                          '<div class="fileup-clear"></div>' +
                      '</li>',

                      
        onSelect: function(file) {
          $('#multiple .control-button').show();
        },
        onRemove: function(file, total) {
          if (file === '*' || total === 1) {
            $('#multiple .control-button').hide();
          }
        },
        onBeforeStart: function(file_number, xhr, file) {
            var options = this.fileup.options;
            options.extraFields.id_album = album; // คั้ค่า id_albumให้ไหม่
            options.extraFields.csrf_token_name = $('input[name="csrf_token_name"]').val();
            // $('#overlay').show();
        },
        onSuccess: function(response, file_number, file) {
        $.growl.notice({ title: "เพิ่มรูป ", message: file.name });
          num_success++;
                   
          if(num_success==$('.fileup-num').length){
             num_fileup = 0;
             num_success = 0;
             // $.fileup('upload-2', 'remove', '*')
             if(album==album_active){
              fetch_img(album);
             }else if(album_active==''){
              fetch_img()
             }    
             $('.fileup-file').removeClass('fileup-num');
          }

          // alert($('.fileup-num').length);
          
          
        },
        onError: function(event, file, file_number) {
          $.growl.error({ message: "Upload error!" });
        },
  });

  function fetch_img(id=''){
      var text='';
      $.ajax({
       url: '<?=base_url()?>/pictures/pictures_fetch_list',
       type: 'get',
       data: {id_album:id},
       beforeSend:function(){
        $('#overlay').show();
       },
       success:function(data){
        $.each(JSON.parse(data), function(index, val) {
           text += '<li style="width: 160px;" class="fileup-file img-del hide-'+val.id_img+'" data-id="'+val.id_img+'">' +
                            '<span class="mailbox-attachment-icon has-img" style="font-size: 0px;height: 100px;position: relative;">' +
                                '<img src="<?=$this->config->item('base')?>'+val.img_path_thumb+'" alt="'+val.name_album_th+'" style="width: auto;height: auto;max-width: 100%;max-height: 100%;">' +
                            '</span>' +
                            '<div class="mailbox-attachment-info">' +
                                '<div class="fileup-description mailbox-attachment-name" style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap;">' +
                                '<span class="fileup-name">'+val.name_img+'</span><br> (<span class="fileup-size">'+val.size+'</span>)' +
                                '</div>' +
                                '<div class="fileup-controls">' +
                                    '<span class="fileup-remove"></span>' +
                                '</div>' +
                            '</div>' +
                            '<div class="fileup-clear"></div>' +
                        '</li>'
        });
        $('#area_album_pic').html(text);
        if(text==''){
          $('#none_img').show();
        }else{
          $('#none_img').hide();
        }
        $('#overlay').fadeOut(400, function() {
          $(this).hide();
        });
       }
     })
  }

  // delete album
  $(document).on('click','.img-del',function(){
        var id_img = $(this).attr('data-id');
        swal({
          title: 'ยืนยัน',
          text: "ยืนยันการลบภาพ",
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
                url: '<?=base_url();?>pictures/pictures_del',
                type: 'POST',
                data: {id_img:id_img,csrf_token_name:$('input[name="csrf_token_name"]').val()},
                success:function(data){
                  if(data.status == 'done'){
                    swal('สำเร็จ', 'ลบข้อมูลเรียบร้อยแล้ว', 'success');
                    $('.hide-'+id_img).remove();
                  }else{
                    swal('เกิดปัญหา', 'Please check data with developer!.','error');
                  }
                  $("input[name=" + data.token + "]").val(data.hash);
                }
              })  
              .fail(function (erordata) {
                console.log(erordata);
              })
            })
          },    
        })
  })
</script>
  