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
        <style type="text/css">
          .dataTable > thead > tr > th[class*="sort"]:after{
              content: "" !important;
          }
        </style>
    <!-- Main content -->
    <section class="content">
      <div class="row">
         <div class="col-md-12" style="margin-bottom: 5px;">
          <a href="<?=base_url()?>pictures/" class="btn btn-success"><i class="fa fa-file-image-o"></i> &nbsp;รูปภาพ</a>
          <input type="hidden" name="" id="id_products" value="">
        </div>
        <!-- create staff -->
        <div class="col-md-5">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">สร้างอัลบั้ม</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?=form_open('','id=create')?>
              <div class="box-body">
                <div class="form-horizontal">

                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-3 control-label">ชื่ออัลบั้ม</label>

                    <div class="col-sm-9">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <img src="<?=$this->config->item('vendor')?>img/th_fl.jpg" width="25" height="15">
                        </span>
                        <input type="text" class="form-control" placeholder="ชื่ออัลบั้มภาษาไทย" name="name_th">
                      </div>
                    </div>
                  </div>

                  <div class="form-group" style="display: none;">
                    <label for="inputPassword3" class="col-sm-3 control-label">album</label>
                    <div class="col-sm-9">
                      <div class="input-group">
                        <span class="input-group-addon">
                           <img src="<?=$this->config->item('vendor')?>img/en_fl.jpg" width="25" height="15">
                        </span>
                        <input type="text" class="form-control" placeholder="album" name="name_en">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> &nbsp;บันทึก</button>
              </div>
              <!-- /.box-footer -->
            <?=form_close()?>
          </div>
        </div>

        <!-- staff list -->
        <div class="col-md-7">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">รายการอัลบั้ม</h3>
            </div>
            <div class="box-body">
              <?=form_open('','id=form_delmulti')?>
                <table id="table" style="width: 100%" class="table table-striped table-bordered dataTable">
                  <thead>
                    <tr>
                      <th style="width: 10px; text-align: center;" id="checkall">#</th>
                      <th>ภาษาไทย</th>
                      <th>ภาษาอังกฤษ</th>
                      <th style="width: 60px; max-width: 60px; min-height: 60px;">ลำดับ</th>
                      <th style="width: 60px; max-width: 60px; min-height: 60px;">แสดงผล</th>
                      <th style="width: 60px;">จัดการ</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              <?=form_close()?>
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
                <h4 class="modal-title">แก้ไขอัลบั้ม</h4>
              </div>
             <?=form_open('','id=update')?>
                <input type="hidden" id="inputId" name="id">
                <div class="modal-body">
                 <div class="form-horizontal">

                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-3 control-label">ชื่ออัลบั้ม</label>

                    <div class="col-sm-9">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <img src="<?=$this->config->item('vendor')?>img/th_fl.jpg" width="25" height="15">
                        </span>
                        <input type="text" class="form-control" placeholder="ชื่ออัลบั้มภาษาไทย" name="name_th" id="inputName_th">
                      </div>
                    </div>
                  </div>

                  <div class="form-group" style="display: none;">
                    <label for="inputPassword3" class="col-sm-3 control-label">album</label>
                    <div class="col-sm-9">
                      <div class="input-group">
                        <span class="input-group-addon">
                           <img src="<?=$this->config->item('vendor')?>img/en_fl.jpg" width="25" height="15">
                        </span>
                        <input type="text" class="form-control" placeholder="album" name="name_en" id="inputName_en">
                      </div>
                    </div>
                  </div>
                </div>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">ยกเลิก</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> &nbsp;บันทึก</button>
              </div>
              <?=form_close()?>
            </div>
            <!-- /.modal-content -->
   </div>
  <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

   <!-- // -->
  <script type="text/javascript">

    $(document).ready(function() {

      // data staff list
      var table = $('#table').DataTable( {
        "ajax": "<?=base_url();?>pictures/album_list",
         "iDisplayLength" : 50,
         "scrollX": true,
        "columns": [
            { "data": function (data, type, row, meta) {
             
                return "<input type='checkbox' name='chk_album[]' class='btn-dlm' value='"+data.id_album+"'>";
            }},
            { "data": "name_album_th" },
            { "data": "name_album_en" },
            { "data":function(data){
               return "<input type='text' class='form-control input-sm order_by' value='"+data.order_by_album+"' style='width:50px'>";
            } },
            { "data":function(data){
              if(data.status_album!=0){
                return "<input type='checkbox' class='album_status' checked>";
              }else{
                return "<input type='checkbox' class='album_status' >";
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
    

      // delete album
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
                url: '<?=base_url();?>pictures/album_del',
                type: 'POST',
                data: {id_album:data.id_album,csrf_token_name:$('input[name="csrf_token_name"]').val()},
                success:function(data){
                  console.log(data);
                  if(data.status == 'done'){
                    swal('สำเร็จ', 'ลบข้อมูลเรียบร้อยแล้ว', 'success');
                  }else if(data.status == 'already'){
                    swal('คำเตือน', 'Can not delete this record. Becuase this record is foreignkey', 'warning');
                  }else{
                    swal('เกิดปัญหา', 'Please check data with developer!.','error');
                  }
                  table.ajax.reload();
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
          swal('Warning','Please choose album to delete','warning');
          return false;
        }

        var form_data = $('#form_delmulti').serialize();
        swal({
          title: 'ยืนยัน',
          text: "ยืนยันการลบข้อมูล",
          type: 'info',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonText: 'ยกเลิก',
          confirmButtonText: 'ยืนยัน',
          showLoaderOnConfirm: true,
          preConfirm: function () {
            return new Promise(function (resolve) {
              $.ajax({
                url: '<?=base_url();?>pictures/album_delmulti',
                type: 'POST',
                data: form_data,
                success:function(data){
                  console.log(data);
                  if(data.status == 'done'){
                    swal('สำเร็จ', 'ลบข้อมูลเรียบร้อยแล้ว', 'success');
                  }else{
                    swal('เกิดปัญหา', 'Please check data with developer!.','error');
                  }
                  table.ajax.reload();
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

      // click edit send data to tag html
      $(document).on('click','.edit',function(){
        var data = table.row( $(this).parents('tr')).data();

        $('#inputId').val(data.id_album);
        $('#inputName_th').val(data.name_album_th);
        $('#inputName_en').val(data.name_album_en);

        $('#modal-edit').modal('show');
      })

      // create staff------------------------
      $('#create').submit(function(event) {
        var form_create = $(this).serialize();
        swal({
          title: 'ยืนยัน',
          text: "ยืนยันการเพิ่มข้อมูล",
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
                url: '<?=base_url();?>pictures/album_create',
                type: 'POST',
                data: form_create,
                success:function(data){
                  console.log(data);
                  if(data.status == 'done'){
                    swal('สำเร็จ', 'เพิ่มข้อมูลเรียบร้อยแล้ว.', 'success');
                    document.getElementById("create").reset();
                  }else{
                    swal('เกิดปัญหา', 'Please check data with developer!.','error');
                  }
                  table.ajax.reload();
                  $("input[name=" + data.token + "]").val(data.hash);
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
      // !-end create staff

      $('#update').submit(function(event) {

        var form_update = $(this).serialize();
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
                url: '<?=base_url();?>pictures/album_edit',
                type: 'POST',
                data: form_update,
                success:function(data){
                  console.log(data);
                  if(data.status == 'done'){
                    swal('สำเร็จ', 'แก้ไขข้อมูลเรียบร้อยแล้ว', 'success');
                  }else{
                    swal('เกิดปัญหา', 'Please check data with developer!.','error');
                  }
                  table.ajax.reload();
                  $("input[name=" + data.token + "]").val(data.hash);
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
                url: '<?=base_url();?>pictures/album_order_by',
                type: 'POST',
                data: {data:order_by,id:data.id_album,csrf_token_name:$('input[name="csrf_token_name"]').val()},
                success:function(data){
                  console.log(data);
                  if(data.status == 'done'){
                    // swal('สำเร็จ', 'แก้ไขข้อมูลเรียบร้อยแล้ว', 'success');
                     $.growl.notice({ title: "แก้ไขข้อมูล", message: 'แก้ไขข้อมูลเรียบร้อยแล้ว' });
                  }else{
                    swal('เกิดปัญหา', 'Please check data with developer!.','error');
                  }
                  table.ajax.reload();
                  $("input[name=" + data.token + "]").val(data.hash);
                }
              })  
              .fail(function (erordata) {
                console.log(erordata);
              })
            
      });

      $(document).on('click', '.album_status', function(event) {
        var status = 0;
        var data = table.row( $(this).parents('tr') ).data();
        if(!$(this).is(':checked')){
          status = 0;
        }else{
          status = 1;
        }

        // alert(status);

        $.ajax({
          url: '<?=base_url();?>pictures/album_status',
          type: 'POST',
          data: {data:status,id:data.id_album,csrf_token_name:$('input[name="csrf_token_name"]').val()},
          success:function(data){
            console.log(data);
            if(data.status == 'done'){
              // swal('สำเร็จ', 'แก้ไขข้อมูลเรียบร้อยแล้ว', 'success');
               $.growl.notice({ title: "แก้ไขข้อมูล", message: 'แก้ไขข้อมูลเรียบร้อยแล้ว' });
            }else{
              swal('เกิดปัญหา', 'Please check data with developer!.','error');
            }
            // table.ajax.reload();
            $("input[name=" + data.token + "]").val(data.hash);
          }

        })  
        .fail(function (erordata) {
          console.log(erordata);
        })   
      });
    // !-end ready
    });
   
  </script>