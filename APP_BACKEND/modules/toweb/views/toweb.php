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
        <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> แดชบอร์ด</a></li>
        <li class="active"><?=$header?></li>
      </ol>
    </section>
        <style type="text/css">
          .dataTable > thead > tr > th[class*="sort"]:after{
              content: "" !important;
          }
        </style>
    <!-- Main content -->
    <section class="content">
      <div class="row">

        <!-- create staff -->
        <div class="col-md-5">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">สร้างลิ้งค์เว็บไซต์</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?=form_open('','id=create')?>
              <div class="box-body">
                <div class="nav-tabs-custom" style="margin-bottom: 0">
                    <ul class="nav nav-tabs">
                      <li class="active">
                        <a href="#th" data-toggle="tab"><img src="<?=$this->config->item('vendor')?>img/th_fl.jpg" width="25" height="15">&nbsp;&nbsp;&nbsp;เกี่ยวกับลิ้งค์เว็บไซต์</a>
                      </li>
                    </ul>
                    <!-- tab content -->
                    <div class="tab-content">
                      <!-- ภาษาไทย -->
                      <div class="tab-pane active" id="th">
                        <div class="form-horizontal">
                          <div class="form-group">
                             <div class="col-sm-12">
                              <div class="input-group">
                                <span class="input-group-addon">
                                  <i class="fa fa-header"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="หัวเรื่อง" name="title">
                              </div>                              
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-12">
                             <input type="text" class="form-control" placeholder="link" name="link">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                    <div class="col-sm-6">
                      <div class="input-group">
                          <span class="input-group-addon">
                             ลำดับ
                          </span>
                          <input type="number" class="form-control" placeholder="1" name="order_by" value="">
                        </div>
                        <br>
                        <div class="input-group">
                          <span class="input-group-addon" style="border-right: 1px solid #ddd">
                             แสดงผล
                          </span>
                          &nbsp;&nbsp;<input type="radio" name="status" value="1" checked=""> แสดงผล <br>
                          &nbsp;&nbsp;<input type="radio" name="status" value="0"> ไม่แสดงผล
                        </div>
                    </div>
                  </div>
                  </div>
                  
                </div>
                <!-- /.box-body -->
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> บันทึก</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
        </div>

        <!-- staff list -->
        <div class="col-md-7">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">รายการลิ้งค์เว็บไซต์</h3>
            </div>
            <div class="box-body">
              <?=form_open('','id=form_delmulti')?>
                <table id="table" style="width: 100%" class="table table-striped table-bordered dataTable">
                  <thead>
                    <tr>
                      <th style="width: 5%; text-align: center;" id="checkall">#</th>
                      <th style="width: 25% min-width:150px;">เว็บไซต์</th>
                      <th style="width: 12%">ลำดับ</th>
                      <th style="width: 15%">แสดงผล</th>
                      <th style="width: 10%;">จัดการ</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </form>
            </div>
            <div class="box-footer">
              <button class="btn btn-danger" id="delete_multi">ลบที่เลือก</button>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

   <!-- modal area -->
  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">แก้ไขลิ้งค์เว็บไซต์</h4>
        <?=form_open('','id=update')?>
          <input type="hidden" id="inputId" name="id">
          <div class="box-body">
                <div class="nav-tabs-custom" style="margin-bottom: 0">
                    <ul class="nav nav-tabs">
                      <li class="active">
                        <a href="#th_edit" data-toggle="tab"><img src="<?=$this->config->item('vendor')?>img/th_fl.jpg" width="25" height="15">&nbsp;&nbsp;&nbsp;เกี่ยวกับลิ้งค์เว็บไซต์</a>
                      </li>
                      
                    </ul>
                    <!-- tab content -->
                    <div class="tab-content">
                      <!-- ภาษาไทย -->
                      <div class="tab-pane active" id="th_edit">
                        <div class="form-horizontal">
                          <div class="form-group">
                           
                             <div class="col-sm-12">
                              <div class="input-group">
                                <span class="input-group-addon">
                                  <i class="fa fa-header"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="หัวเรื่อง" name="title" id="title">
                              </div>                              
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-12">
                              <input type="text" class="form-control" placeholder="link" name="link" id="link">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
                
                <div class="form-horizontal">
                  <div class="box-body">
                   <div class="form-group">
                    <div class="col-sm-6">
                      <div class="input-group">
                          <span class="input-group-addon">
                             ลำดับ
                          </span>
                          <input type="number" class="form-control" placeholder="1" name="order_by" value="" id="order_by">
                        </div>
                        <br>
                        <div class="input-group">
                          <span class="input-group-addon" style="border-right: 1px solid #ddd">
                             แสดงผล
                          </span>
                          &nbsp;&nbsp;<input type="radio" name="status" value="1" class="check-show"> แสดงผล <br>
                          &nbsp;&nbsp;<input type="radio" name="status" value="0" class="check-show"> ไม่แสดงผล
                        </div>
                    </div>
                  </div>
                  </div>
                 
                </div>
                <!-- /.box-body -->
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> บันทึก</button>
              </div>
              <!-- /.box-footer -->
        </form>  
      </div>
    </div>
    <!-- /.modal-content -->
   </div>
  <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <script type="text/javascript">
      $(function(){
          // data staff list
        var table = $('#table').DataTable( {
          "ajax": "<?=base_url();?>toweb/toweb_list",
           "iDisplayLength" : 50,
           "scrollX": true,
          "columns": [
              { "data": function (data, type, row, meta) {
               
                  return "<input type='checkbox' name='chk_toweb[]' class='btn-dlm' value='"+data.id+"'>";
              }},
              
              { "data": "title" },
              { "data":function(data){
                 return "<input type='text' class='form-control input-sm order_by' value='"+data.order_by+"' style='width:50px'>";
              } },
              { "data":function(data){
                if(data.status!=0){
                  return "<input type='checkbox' class='show_toweb' checked>";
                }else{
                  return "<input type='checkbox' class='show_toweb' >";
                }      
              } },
              {"data": function(data, type, row, meta){

                return   "<div class='btn-group'>"+
                "<a class='btn btn-default btn-sm edit'><i class='fa fa-edit'></i></a>"+
                "<a class='btn btn-danger btn-sm del' ><i class='fa fa-trash'></i></a>"+
                "</div>";
              }}
          ]
        });

        // create toweb------------------------
        $('#create').submit(function(event) {
          var formData = new FormData($('#create')[0]);
          swal({
              title: 'ยืนยัน',
              text: "ยืนยันการเพิ่มข้อมูล?",
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
                    url: '<?=base_url();?>toweb/toweb_create',
                    type: 'POST',
                    cache: false,
                    processData: false,
                    contentType: false,
                    data: formData,
                    success:function(data){
                      console.log(data);
                      if(data.status == 'done'){
                        swal('สำเร็จ', data.info, 'success');
                      }else{
                        swal('เกิดปัญหา', data.info,'error');
                      }
                      $('#create')[0].reset();
                      $('#img-upload').attr('src','<?=$this->config->item('vendor')?>img/no_img.jpg');
                      $("input[name=" + data.token + "]").val(data.hash);
                      table.ajax.reload();
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

        // delete toweb
        $(document).on('click','.del',function(){
          var data = table.row( $(this).parents('tr') ).data();
          swal({
            title: 'ยืนยัน',
            text: "ยืนยันการลบข้อมูล?",
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
                  url: '<?=base_url();?>toweb/toweb_del',
                  type: 'POST',
                  data: {id:data.id,csrf_token_name:$('input[name="csrf_token_name"]').val()},
                  success:function(data){
                    console.log(data);
                    if(data.status == 'done'){
                      swal('สำเร็จ', 'ลบข้อมูลเรียบร้อยแล้ว', 'success');
                    }else{
                      swal('Error', 'Please check data with developer!.','error');
                    }
                    $("input[name=" + data.token + "]").val(data.hash);
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
            swal('Warning','Please choose category to delete','warning');
            return false;
          }

          var form_data = $('#form_delmulti').serialize();
          swal({
            title: 'ยืนยัน',
            text: "ยืนยันการลบข้อมูล?",
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
                  url: '<?=base_url();?>toweb/toweb_delmulti',
                  type: 'POST',
                  data: form_data,
                  success:function(data){
                    console.log(data);
                    if(data.status == 'done'){
                      swal('สำเร็จ', 'ลบข้อมูลเรียบร้อยแล้ว', 'success');
                    }else{
                      swal('เกิดปัญหา', 'Please check data with developer!.','error');
                    }
                    $("input[name=" + data.token + "]").val(data.hash);
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

        // click edit send data to tag html
        $(document).on('click','.edit',function(){
          var data = table.row( $(this).parents('tr')).data();

          $('#inputId').val(data.id);
          $('#title').val(data.title);
          $('#link').val(data.link);
          $('#order_by').val(data.order_by);
          $('.check-show').each(function(index, el) {
            if($(this).val()==data.status){
              $(this).prop('checked', true);
            }
          });
          if(data.img_path!=''){
            $('#img-upload-edit').attr('src','<?=$this->config->item('base')?>'+data.img_path);
          }
          $('#modal-edit').modal('show');
        })

        $('#update').submit(function(event) {
          var formData = new FormData($('#update')[0]);
          swal({
            title: 'ยืนยัน',
            text: "ยืนยันการแก้ไขข้อมูล?",
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
                  url: '<?=base_url();?>toweb/toweb_update',
                  type: 'POST',
                  processData: false,
                  contentType: false,
                  data: formData,
                  success:function(data){
                    console.log(data);
                    if(data.status == 'done'){
                      swal('สำเร็จ', data.info, 'success');
                    }else{
                      swal('เกิดปัญหา', data.info,'error');
                    }
                    $("input[name=" + data.token + "]").val(data.hash);
                    table.ajax.reload();
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

        $(document).on('change', '.order_by', function(event) {
          var data = table.row( $(this).parents('tr') ).data();
          var order_by = $(this).val();
            $.ajax({
              url: '<?=base_url();?>toweb/toweb_order_by',
              type: 'POST',
              data: {data:order_by,id:data.id,csrf_token_name:$('input[name="csrf_token_name"]').val()},
              success:function(data){
                console.log(data);
                if(data.status == 'done'){
                  // swal('สำเร็จ', 'แก้ไขข้อมูลเรียบร้อยแล้ว', 'success');
                   $.growl.notice({ title: "แก้ไขข้อมูล", message: 'แก้ไขข้อมูลเรียบร้อยแล้ว' });
                }else{
                  swal('เกิดปัญหา', 'Please check data with developer!.','error');
                }
                $("input[name=" + data.token + "]").val(data.hash);
                table.ajax.reload();
              }
            })  
            .fail(function (erordata) {
              console.log(erordata);
            })   
        });

        $(document).on('click', '.show_toweb', function(event) {
          var status = 0;
          var data = table.row( $(this).parents('tr') ).data();
          if(!$(this).is(':checked')){
            status = 0;
          }else{
            status = 1;
          }
          // alert(status);
          $.ajax({
            url: '<?=base_url();?>toweb/toweb_status',
            type: 'POST',
            data: {data:status,id:data.id,csrf_token_name:$('input[name="csrf_token_name"]').val()},
            success:function(data){
              console.log(data);
              if(data.status == 'done'){
                  // swal('สำเร็จ', 'แก้ไขข้อมูลเรียบร้อยแล้ว', 'success');
                   $.growl.notice({ title: "แก้ไขข้อมูล", message: 'แก้ไขข้อมูลเรียบร้อยแล้ว' });
                }else{
                  swal('เกิดปัญหา', 'Please check data with developer!.','error');
              }
               $("input[name=" + data.token + "]").val(data.hash);
              table.ajax.reload();
            }
          })  
          .fail(function (erordata) {
            console.log(erordata);
          })   
        });
      })
  </script>