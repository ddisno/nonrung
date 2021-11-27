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
      <div class="row" style="margin-top: 5px;">
        <div class="col-md-12">
          <div class="box box-default">
            <div class="box-body">
              <?=form_open('','id=form_delmulti')?>
                <table id="table" style="width: 100%" class="table table-striped table-bordered dataTable">
                  <thead>
                    <tr>
                      
                      <th style="width: 10px; text-align: center;" id="checkall">#</th>
                      <th>หัวข้อ</th>
                      <th style="width: 150px; max-width: 150px; min-height: 150px;">โดย</th>
                      <th style="width: 50px; max-width: 50px; min-height: 50px; text-align: center;">ลำดับ</th>
                      <th style="width: 50px; max-width: 50px; min-height: 50px; text-align: center;">ปักหมุด</th>
                      <th style="width: 80px; max-width: 80px; min-height: 80px; text-align: center;">อนุมัติ</th>
                      <th style="width: 100px ; max-width: 100px; min-height: 100px ; text-align: center;">จัดการ</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </form>
            </div>
            <div class="box-footer">
              <button class="btn btn-danger" id="delete_multi"><i class="fa fa-trash-o"></i> ลบที่เลือก</button>
            </div>
          </div>
        </div>
      </div>
      <form id="reply" method="post" target="" style="display: none;">
        <input type="text" name="checksum" value="admin">
      </form>
    </section>
    <!-- /.content -->
  </div>

  <style type="text/css">
    .btn>.badge {
      position: absolute;
      top: -3px;
      right: -10px;
      font-size: 10px;
      font-weight: 400;
      z-index: 1;
    }
  </style>
  <!-- /.content-wrapper -->
  <script type="text/javascript">
    $(function(){
      // data Blog list
      // data Blog list
      var table = $('#table').DataTable( {
        "ajax": "<?=base_url();?>forum/forum_list",
        "iDisplayLength" : 50,
        "scrollX": true,
        "columns": [          
            { "data": function (data, type, row, meta) {
              return '<input type="checkbox" class="btn-dlm" name="chk_forum[]" value="'+data.id_topic+'"> ';
            }},
            { "data":function(data){
              var header = ''; 
              if(data.stick!=0){
                 header += '<img src="<?=$this->config->item('vendor')?>img/push.png" width="25" height="25" style="float:left;margin-right:5px;">&nbsp;<a href="<?=base_url();?>forum/view/'+remove_spc(data.subject)+'/'+data.id_topic+'" class="edit">'+data.subject+'</a><br>';
              }else{
                header += '<a href="<?=base_url();?>forum/view/'+remove_spc(data.subject)+'/'+data.id_topic+'" class="edit">'+data.subject+'</a><br>';
              }
             
              header += '<small><i class="fa fa-calendar"></i> &nbsp;'+data.create_datetime+'&emsp;&emsp;</small>&nbsp;';
              header += '<small><i class="fa fa-commenting" ></i>&nbsp;'+data.number_total+'&nbsp;&nbsp;</small>';
              header += '<small style="color:#f39c12;"><i class="fa fa-commenting" ></i>&nbsp;'+data.number_comment+'&nbsp;&nbsp;</small>';
              header += '<small style="color:#00a65a;"><i class="fa fa-commenting" ></i>&nbsp;'+data.number_verify+'</small>';
              return header;
            } },
            { "data": "fullname" },
            { "data":function(data){             
              if(data.stick!=0){
                return "<input type='text' class='form-control order_by' style='width:40px;' value='"+data.order_by+"'><p style='display:none'>1</p>";
              }else{
                return "<input type='text' class='form-control order_by' style='width:40px;' disabled value='"+data.order_by+"'><p style='display:none'>0</p>";
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
                   toggle += '<a class="btn btn-xs '+success+' show_forum " data-check="'+suc_check+'" data-id="1" >อนุมัติ</a>';
                   toggle += '<a class="btn btn-xs '+cancel+'  show_forum " data-check="'+can_check+'" data-id="0" >ไม่อนุมัติ</a>';
                   toggle += '</div>'; 
                   toggle += '<p style="display:none">'+suc_check+'</p>';
                  return toggle;    
            },"className": "text-center" },
            {"data": function(data, type, row, meta){
              var alert;
              if(data.number_comment!=0){
                alert = "<a href='<?=base_url();?>forum/view/"+remove_spc(data.subject)+"/"+data.id_topic+" ' class='btn btn-default btn-sm '><span class='badge bg-yellow'>"+data.number_comment+"</span><i class='fa fa-commenting'></i></i></a>";
              }else{
                alert = "<a href='<?=base_url();?>forum/view/"+remove_spc(data.subject)+"/"+data.id_topic+" ' class='btn btn-default btn-sm'><i class='fa fa-commenting'></i></a>";
              }
              
              return   "<div class='btn-group'>"+
              "<a class='btn btn-default btn-sm reply'><i class='fa fa-reply'></i></a>"+alert+
              "<a class='btn btn-default btn-sm del'><i class='fa fa-trash'></i></a>"+
              "</div>";
            },"className": "text-center"}
        ],
      });

      function remove_spc(string){
        if(string===''){
          return 'null';
        }
        return string.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '').replace(/[_\s]/g, '-')
      }

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
                url: '<?=base_url();?>forum/forum_del',
                type: 'POST',
                data: {id_topic:data.id_topic,csrf_token_name:$('input[name="csrf_token_name"]').val()},
                success:function(data){
                  console.log(data);
                  if(data.status == 'success'){
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
          swal('คำเตือน','กรุณาเลือกเรื่องที่จะลบ','warning');
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
                url: '<?=base_url();?>forum/forum_delmulti',
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

      $(document).on('click', '.reply', function(event) {
        var data = table.row( $(this).parents('tr') ).data();
        $('#reply').attr('target','_blank');
        $('#reply').attr('action', "<?=$this->config->item('base');?>th/forum/view/"+remove_spc(data.subject)+"/"+data.id_topic+" ").submit();
      });

      $(document).on('change', '.order_by', function(event) {
        var data = table.row( $(this).parents('tr') ).data();
        var order_by = $(this).val();

              $.ajax({
                url: '<?=base_url();?>blog/blog_order_by',
                type: 'POST',
                data: {data:order_by,id:data.id_blog,csrf_token_name:$('input[name="csrf_token_name"]').val()},
                success:function(data){
                  console.log(data);
                  if(data.status == 'success'){
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

      $(document).on('click', '.show_forum', function(event) {
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
                  url: '<?=base_url();?>forum/forum_status',
                  type: 'POST',
                  data: {data:status,id:data.id_topic,csrf_token_name:$('input[name="csrf_token_name"]').val()},
                  success:function(data){
                    console.log(data);
                    if(data.status == 'success'){
                      swal('สำเร็จ', ''+text+'เรียบร้อยแล้ว', 'success');
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
          url: '<?=base_url();?>forum/forum_stick',
          type: 'POST',
          data: {data:status,id:data.id_topic,csrf_token_name:$('input[name="csrf_token_name"]').val()},
          success:function(data){
            console.log(data);
            if(data.status == 'success'){
                // swal('สำเร็จ', 'แก้ไขข้อมูลเรียบร้อยแล้ว', 'success');
                 $.growl.notice({ title: "ปักหมุด", message: 'ปักหมุดเรียบร้อยแล้ว' });
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
    })
  </script>