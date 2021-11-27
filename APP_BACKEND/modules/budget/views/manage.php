<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <?=$header?>
       <a class="btn btn-primary" href="<?=base_url();?>budget/create"><i class="fa fa-plus"></i> เพิ่มงบประมาณ</a>
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
      
      <div class="form-group" style="float: right">
              <form id="daterange">
                <div class="input-group">
                  <button type="button" class="btn btn-default pull-right" id="daterange-btn">
                  <input type="hidden" id="daterange-input" name="daterange-input">
                    <span>
                      <i class="fa fa-calendar"></i> เลือกวันที่
                    </span>
                    <i class="fa fa-caret-down"></i>
                  </button>
                </div>
              </form>
              </div>
              <button class="btn btn-primary pull-right" style="margin-right: 5px;" id="all-daterange">ดูทั้งหมด</button>
      <div class="row" style="margin-top: 5px;">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-body">
              <?=form_open('','id=form_delmulti')?>
                <table id="table" style="width: 100%" class="table table-striped table-bordered dataTable">
                  <thead>
                    <tr>
                      
                      <th style="width: 10px; text-align: center;" id="checkall">#</th>
                      <th>รายการ</th>
                      <th style="width: 50px; max-width: 50px; min-height: 50px;">ลำดับ</th>
                      <th style="width: 50px; max-width: 50px; min-height: 50px; text-align: center;">แสดงผล</th>
                      <th style="width: 60px ; max-width: 60px; min-height: 60px ; text-align: center;">จัดการ</th>
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
  <script type="text/javascript">
    $(function(){
      // data budget list
      // data budget list
      var table = $('#table').DataTable( {
        "ajax": "",
        "iDisplayLength" : 50,
        "scrollX": true,
        "columns": [          
            { "data": function (data, type, row, meta) {
              return '<input type="checkbox" class="btn-dlm" name="chk_budget[]" value="'+data.id+'"> ';
            }},
            { "data": "title" },
            { "data": function(data){
              return "<input type='text' class='form-control input-sm order_by' value='"+data.order_by+"' style='width:50px'>";
            } },
            { "data":function(data){
              if(data.status!=0){
                return "<input type='checkbox' class='show_budget' checked>";
              }else{
                return "<input type='checkbox' class='show_budget' >";
              }      
            } },
            {"data": function(data, type, row, meta){
              return   "<div class='btn-group'>"+
              "<a href='<?=base_url();?>budget/edit/"+data.id+" ' class='btn btn-default btn-sm edit'><i class='fa fa-edit'></i></a>"+

              "<a class='btn btn-danger btn-sm del'><i class='fa fa-trash'></i></a>"+
              "</div>";
            }}
        ],
      });

      start = moment().subtract(29, 'days');
      end   = moment();

      $('#daterange-btn').daterangepicker({
        startDate: start,
        endDate: end,
        ranges   : {
          'วันนี้'       : [moment(), moment()],
          'เมื่อวานนี้'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          '7 วันที่แล้ว' : [moment().subtract(6, 'days'), moment()],
          '30 วันที่แล้ว': [moment().subtract(29, 'days'), moment()],
          'เดือนนี้'  : [moment().startOf('month'), moment().endOf('month')],
          'เดือนที่แล้ว'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        
      }, cb)

      cb();

      function cb(start='', end='') { 

        if(start==''){
          table.ajax.url('<?=base_url();?>budget/budget_list').load();   
          $('#daterange-btn span').html('ทั้งหมด');
        }else{
          $('#daterange-btn span').html(start.format('MMMM DD, YYYY') + ' - ' + end.format('MMMM DD, YYYY'));
          $('#daterange-input').val(start.format('YYYY-MM-DD 00:00:00') + '/' + end.format('YYYY-MM-DD 23:59:59'));
          table.ajax.url('<?=base_url();?>budget/budget_list/?'+$('#daterange').serialize()).load(); 
        }     
      }

      $(document).on('click', '#all-daterange', function(event) {
       // alert('555');
        cb();
      });

      function remove_spc(string){
        if(string===''){
          return 'null';
        }
        return string.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '').replace(/[_\s]/g, '-')
      }
       // delete budget
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
                url: '<?=base_url();?>budget/budget_del',
                type: 'POST',
                data: {id:data.id,csrf_token_name:$('input[name="csrf_token_name"]').val()},
                success:function(data){
                  console.log(data);
                  if(data == 'success'){
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
          swal('Warning','Please choose budget to delete','warning');
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
                url: '<?=base_url();?>budget/budget_delmulti',
                type: 'POST',
                data: form_data,
                success:function(data){
                  console.log(data);
                  if(data == 'success'){
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
                url: '<?=base_url();?>budget/budget_order_by',
                type: 'POST',
                data: {data:order_by,id:data.id,csrf_token_name:$('input[name="csrf_token_name"]').val()},
                success:function(data){
                  console.log(data);
                  if(data == 'success'){
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

      $(document).on('click', '.show_budget', function(event) {
        var status = 0;
        var data = table.row( $(this).parents('tr') ).data();
        if(!$(this).is(':checked')){
          status = 0;
        }else{
          status = 1;
        }

        // alert(status);

        $.ajax({
          url: '<?=base_url();?>budget/budget_status',
          type: 'POST',
          data: {data:status,id:data.id,csrf_token_name:$('input[name="csrf_token_name"]').val()},
          success:function(data){
            console.log(data);
            if(data == 'success'){
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

      $(document).on('click', '.show_stick', function(event) {
        var status = 0;
        var data = table.row( $(this).parents('tr') ).data();
        if(!$(this).is(':checked')){
          status = 0;
        }else{
          status = 1;
        }

        // alert(status);

        $.ajax({
          url: '<?=base_url();?>budget/budget_stick',
          type: 'POST',
          data: {data:status,id:data.id,csrf_token_name:$('input[name="csrf_token_name"]').val()},
          success:function(data){
            console.log(data);
            if(data == 'success'){
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

    })
  </script>