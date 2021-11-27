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
        <li class=""><a href="<?=base_url();?>forum">เรื่องร้องทุกข์</a> </li>
        <li class="active"><?=$data['subject']?></li>
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
        <input type="hidden" name="id_topic" value="<?=$data['id_topic']?>">
        <div class="row">
          <div class="col-md-12 ">
            <div class="box box-primary" style="border-top: 0">
              <div class="box-body" style="padding: 0;">
                <div class="nav-tabs-custom" style="margin-bottom: 0">
                  <ul class="nav nav-tabs">
                    <li class="active">
                      <a href="#th" data-toggle="tab"><img src="<?=$this->config->item('vendor')?>img/th_fl.jpg" width="25" height="15"> ภาษาไทย</a>
                    </li>
                  </ul>
                  <div class="tab-content">
                      <div class="form-group">

                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-header"></i></span>
                              <input type="text" class="form-control" id="name_th" placeholder="หัวข้อเรื่องร้องทุกข์" required name="name_th" value="<?=$data['subject']?>" disabled>
                            </div>
                          
                      </div>
                       <div class="form-group">
                        <?=htmlspecialchars_decode($data['detail'])?>
                      </div>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <div class="form-group">
                  <?=$data['fullname']?></br>
                  อีเมล์ : <?=$data['email']?></br>
                  เบอร์โทร : <?=$data['phone']?></br>
                  <b>ตั้งคำถามเมื่อ : </b> <?=$data['create_datetime']?>
                </div>
              </div>
            </div>    
          </div>
          <div class="col-md-12 ">
            <div class="box box-primary">
              <div class="box-body">
                <?=form_open('','id=form_delmulti')?>
                <table class="table table-bordered" style="width: 100%" id="table-comment">
                  <thead class="thead-light">
                    <tr>
                      <th style="width: 10px; text-align: center;" id="checkall">#</th>
                      <th>ลำดับ</th>
                      <th>เนื้อหา</th>
                      <th>โดย</th>
                      <th style="width: 60px; max-width: 60px; min-height: 60px; text-align: center;">ลำดับ</th>
                      <th style="width: 60px; max-width: 60px; min-height: 60px; text-align: center;">ปักหมุด</th>
                      <th style="width: 80px; max-width: 80px; min-height: 80px; text-align: center;">อนุมัติ</th>
                      <th>ลบ</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                </table>
                </form>
              </div>
              <div class="footer">
                <div class="box-footer">
                  <button class="btn btn-danger" id="delete_multi"><i class="fa fa-trash-o"></i> ลบที่เลือก</button>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <div class="modal fade " id="modal-default" >
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">โดย : <font id="fullname"></font></h4>
                <b>เบอร์โทร : </b><font id="phone-comment"></font><br>
                <b>เมื่อ : </b><font id="create_datetime"></font>               
              </div>
              <div class="modal-body">
                <div class="fr-view">
                  <div id="area-comment"></div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">ปิด</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
  </div>
  <style type="text/css">
    .text-overflow {
      white-space: nowrap; 
      width: 500px; 
      height: 30px;
      overflow: hidden;
      text-overflow: ellipsis; 
    }
    .text-overflow >p>img{
      display: none;
    }
    .view-detail{
      color: black;
      cursor: pointer;
    }
  </style>
 
  <!-- /.content-wrapper -->
  <script type="text/javascript" src="<?=$this->config->item('vendor')?>plugins/froala/js/froala_editor.pkgd.min.js"></script>
  <script type="text/javascript">
     $(function(){
      var table = $('#table-comment').DataTable( {
        "ajax": "<?=base_url();?>forum/comment_list/<?=$data['id_topic']?>",
        "iDisplayLength" : 10,
        "scrollX": true,
        "columns": [     
            { "data": function (data, type, row, meta) {
              return '<input type="checkbox" class="btn-dlm" name="chk_comment[]" value="'+data.id_comment+'"> ';
            }},     
            { "data":function(data){
              if (data.number!=0) {
                return data.number;
              }else{
                return '<label class="label pull-right bg-yellow">รออนุมัติ</labe>';
              }
            },"className": "text-center" },
            { "data":function(data){
              var detail = ''; 
              detail += '<div class="fr-view">';
              if (data.stick!=0) {
                if(data.reply!=0){
                  detail += '<a class="view-detail"><label class="label" style="color:grey"><i class="fa fa-reply"></i>&nbsp;คอมเม้นตอนกลับ</label><img src="<?=$this->config->item('vendor')?>img/push.png" width="25" height="25" style="float:left;margin-right:5px;"><div class="text-overflow">'+data.comment+'</div></a>';
                }else{
                  detail += '<a class="view-detail"><img src="<?=$this->config->item('vendor')?>img/push.png" width="25" height="25" style="float:left;margin-right:5px;"><div class="text-overflow">'+data.comment+'</div></a>';
                }
                
              }else{
                if(data.reply!=0){
                  detail += '<a class="view-detail"><label class="label" style="color:grey"><i class="fa fa-reply"></i>&nbsp;คอมเม้นตอนกลับ</label><div class="text-overflow">'+data.comment+'</div></a>';
                }else{
                   detail += '<a class="view-detail"><div class="text-overflow">'+data.comment+'</div></a>';
                }
              }
              detail += '</div>';
              return detail;
            } },
            { "data": "fullname" },
            { "data":function(data){             
              if(data.stick!=0){
                return "<input type='text' class='form-control order_by' style='width:40px;' value='"+data.order_by+"'>";
              }else{
                return "<input type='text' class='form-control order_by' style='width:40px;' disabled value='"+data.order_by+"'>";
              }      
            } ,"className": "text-center"},
             { "data":function(data){             
              if(data.stick!=0){
                return "<input type='checkbox' class='show_stick' checked><p style='display:none'>1</p>";
              }else{
                return "<input type='checkbox' class='show_stick' ><p style='display:none'>0</p>";
              }      
            } ,"className": "text-center"},
            { "data":function(data){
              if(data.status!=0){
                var success = 'btn-success';
                var cancel  = 'btn-default';
                var suc_check = 1;
                var can_check = 0;
              }else{
                var success = 'btn-default';
                var cancel  = 'btn-warning';
                var suc_check = 0;
                var can_check = 1;
              }
               var toggle =  '<div class="btn-group btn-toggle">'; 
                   toggle += '<a class="btn btn-xs '+success+' show_comment " data-check="'+suc_check+'" data-id="1" >อนุมัติ</a>';
                   toggle += '<a class="btn btn-xs '+cancel+'  show_comment " data-check="'+can_check+'" data-id="0" >ไม่อนุมัติ</a>';
                   toggle += '</div>'; 
                   toggle += '<p style="display:none">'+suc_check+'</p>';
                  return toggle;    
            },"className": "text-center" },
            
           
            {"data": function(data, type, row, meta){              
              return "<a class='btn btn-default btn-sm del'><i class='fa fa-trash'></i></a>";
            },"className": "text-center"}
        ],
        "order": []
      });

       // delete forum
      $(document).on('click','.del',function(){
        var data = table.row( $(this).parents('tr') ).data();
        swal({
          title: 'ยืนยัน',
          text: "ยืนยันการลบข้อมูล",
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
                url: '<?=base_url();?>forum/comment_del',
                type: 'POST',
                data: {id_comment:data.id_comment,csrf_token_name:$('input[name="csrf_token_name"]').val()},
                success:function(data){
                  console.log(data);
                  if(data.status == 'success'){
                    swal('สำเร็จ', 'ลบข้อมูลเรียบร้อยแล้ว', 'success');
                  }else{
                    swal('เกิดปัญหา', 'Please check data with developer!.','error');
                  }
                  table.ajax.reload();
                }
              })  
              .fail(function (erordata) {
                console.log(erordata);
              })
            })
          },    
        })
      })

      $(document).on('click', '.view-detail', function(event) {
        var data = table.row( $(this).parents('tr') ).data();
        /* Act on the event */
        $('#create_datetime').html(data.create_datetime);
        $('#area-comment').html(data.comment);
        $('#phone-comment').html(data.phone);
        $('#fullname').html(data.fullname);
        $('#modal-default').modal('show');
      });

      // check delete all
      $('#checkall').click(function(event) {
        if($('.btn-dlm').is(':checked')){
          $('.btn-dlm').prop('checked', false);
        }else{
          $('.btn-dlm').prop('checked', true);
        }
      });

       // delete mulit
      $(document).on('click','#delete_multi',function(){

        if(!$('.btn-dlm').is(':checked')){
          swal('คำเตือน','กรุณาเลือกคอมเม้นที่จะลบ','warning');
          return false;
        }

        var form_data = $('#form_delmulti').serialize();
        swal({
          title: 'ยืนยัน',
          text: "ยืนยันการลบข้อมูล",
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
                url: '<?=base_url();?>forum/comment_delmulti',
                type: 'POST',
                data: form_data,
                success:function(data){
                  console.log(data);
                  if(data.status == 'success'){
                    swal('สำเร็จ', 'ลบข้อมูลเรียบร้อยแล้ว', 'success');
                  }else{
                    swal('เกิดปัญหา', 'Please check data with developer!.','error');
                  }
                  table.ajax.reload();
                }
              })  
              .fail(function (erordata) {
                console.log(erordata);
              })
            })
          },    
        })
      })

      $(document).on('change', '.order_by', function(event) {
        var data = table.row( $(this).parents('tr') ).data();
        var order_by = $(this).val();

              $.ajax({
                url: '<?=base_url();?>forum/comment_order_by',
                type: 'POST',
                data: {data:order_by,id_comment:data.id_comment,id_topic:data.id_topic,csrf_token_name:$('input[name="csrf_token_name"]').val()},
                success:function(data){
                  console.log(data);
                  if(data.status == 'success'){
                    // swal('สำเร็จ', 'แก้ไขข้อมูลเรียบร้อยแล้ว', 'success');
                     $.growl.notice({ title: "แก้ไขข้อมูล", message: 'แก้ไขข้อมูลเรียบร้อยแล้ว' });
                  }else{
                    swal('เกิดปัญหา', 'Please check data with developer!.','error');
                  }
                  table.ajax.reload();
                }
              })  
              .fail(function (erordata) {
                console.log(erordata);
              })   
      });

      $(document).on('click', '.show_comment', function(event) {
        var data = table.row( $(this).parents('tr') ).data();
        var status = $(this).attr('data-id');

        if($(this).attr('data-check')==1){
          $.growl.warning({ title: "คำเตือน", message: 'ไม่สามารถเปลี่ยนสถานะได้' });
          return false;
        }
        if(status=='1'){
          var text = 'ยืนยันการอนุมัติ';
        }else{
          var text = 'ยืนยันการยกเลิกอนุมัติ';
        }        
          swal({
            title: 'ยืนยัน',
            text: text,
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
                  url: '<?=base_url();?>forum/comment_status',
                  type: 'POST',
                  data: {data:status,id:data.id_comment,id_topic:data.id_topic,csrf_token_name:$('input[name="csrf_token_name"]').val()},
                  success:function(data){
                    console.log(data);
                    if(data == 'success'){
                      swal('สำเร็จ', ''+text+'เรียบร้อยแล้ว', 'success');
                    }else{
                      swal('เกิดปัญหา', 'Please check data with developer!.','error');
                    }
                    table.ajax.reload();
                  }
                })  
                .fail(function (erordata) {
                  console.log(erordata);
                })
              })
            },    
          })
      });

      $(document).on('click', '.show_stick', function(event) {  
          var status = 0;
          var data = table.row( $(this).parents('tr') ).data();
          if(!$(this).is(':checked')){
            status = 0;
          }else{
            status = 1;
          }
          $.ajax({
            url: '<?=base_url();?>forum/comment_stick',
            type: 'POST',
            data: {data:status,id:data.id_comment,csrf_token_name:$('input[name="csrf_token_name"]').val()},
            success:function(data){
              console.log(data);
              if(data.status == 'success'){
                  // swal('สำเร็จ', 'แก้ไขข้อมูลเรียบร้อยแล้ว', 'success');
                   $.growl.notice({ title: "ปักหมุด", message: 'ปักหมุดเรียบร้อยแล้ว' });
                }else{
                  swal('เกิดปัญหา', 'Please check data with developer!.','error');
              }
              table.ajax.reload();
            }
          })  
          .fail(function (erordata) {
            console.log(erordata);
          })   
        })
    })
  </script>