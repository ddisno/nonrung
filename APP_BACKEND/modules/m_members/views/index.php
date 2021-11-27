  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?=$this->config->item('vendor')?>/plugins/iCheck/all.css">

  <script type="text/javascript">
    var session_id_member = '<?=$this->session->userdata('id_member')?>';
  </script>
  <!-- Select2 -->

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <?=$header?>
        <a href="<?=base_url()?>m_members/create" class="btn btn-primary btn-sm" ><i class="fa fa-user-plus"></i> เพิ่มผู้ใช้งาน</a>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url();?>"><i class="fa fa-dashboard"></i> แดชบอร์ด</a></li>
        <li class="active"><?=$header?></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- staff list -->
        <div class="col-md-12">
          <div class="box box-info box-solid">
            <!-- <div class="box-header with-border">
             
            </div> -->
            <div class="box-body">
               <?php echo form_open('','id="form_delmulti"'); ?>
                <table id="table" style="width: 100%" class="table table-bordered dataTable">
                  <thead>
                    <tr>
                      <th style="width: 10px; text-align: center;" class="no-sort">
                          <input type="checkbox" name="" id="checkall" class="flat-red">
                        </th>
                      <th style="width: 100px; min-width: 100px;">ชื่อ</th>
                      <th style="width: 100px; min-width: 100px;">นามสกุล</th>
                      <th style="width: 100px; min-width: 100px;">อีเมล์</th>
                      <th style="width: 100px; min-width: 100px;">สิทธิ์การใช้งาน</th>
                      <th style="width: 100px; min-width: 100px;">สถานะ</th>
                      <th style="width: 80px; min-width: 80px;" class="no-sort">จัดการ</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </form>
            </div>
            <div class="box-footer">
              <button class="btn btn-danger" id="delete_multi" btn-permission="delete">ลบที่เลือก</button>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- // -->
  <!-- iCheck 1.0.1 -->
  <script src="<?=$this->config->item('vendor')?>/plugins/iCheck/icheck.min.js"></script>
  <script type="text/javascript">
    
    $(document).ready(function() {
          //Initialize Select2 Elements
      var table = $('#table').DataTable( {
        "ajax": "<?=base_url();?>m_members/list_members",
        "iDisplayLength" : 50,
        "scrollX": true,
        "columns": [
            { "data": function (data, type, row, meta) {
              if(data.id_member != session_id_member){
                return "<input type='checkbox' name='chk_m_members[]' class='btn-dlm flat-red' value='"+data.id_member+"'>";
              }else{
                return '';
              }
            }, "className": 'text-center'},
            {
              "className":      'details-control',
              "orderable":      false,
              "data":           "f_name",
              "defaultContent": ''
            },
            { "data": "l_name" },
            { "data": "email" },
            { "data": "name_role" , "className": 'text-center'},
            {"data": function(data, type, row, meta){
              if(data.status=='active'){
                return '<label class="label bg-green">Active</label>';
              }else{
                return '<label class="label bg-red">Inactive</label>';
              }
            }, "className": 'text-center'},
            {"data": function(data, type, row, meta){
              var key_del = 'del';
              if(data.id_member == session_id_member){
                key_del = '';
              }

              return "<a href='<?=base_url()?>m_members/edit/"+data.id_member+"' style='margin-right:5px;'><i class='fa fa-pencil'></i></a>"+
              "<a class='"+key_del+"' ><i class='fa fa-trash'></i></a>";
            }, "className": 'text-center'}
        ],
        "columnDefs": [ {
        "targets": 'no-sort',
        "orderable": false
        } ],
        "order": []
      });
      // delete member
      $(document).on('click','.del',function(){

        var data = table.row( $(this).parents('tr') ).data();
        var token_name = $("input[name='csrf_token_name']").val();
        if(data.id_member == session_id_member){
          swal('คำเตือน', 'ไม่สามารถลบรหัสผ่านของตัวเองได้ ', 'warning');
          return false;
        }

        swal({
          title: 'ยืนยันการลบข้อมูล "'+data.f_name+'"',
          text: "",
          type: 'info',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'ยกเลิก',
          confirmButtonText: 'ยืนยัน',
          showLoaderOnConfirm: true,
         animation: false,
          preConfirm: function () {
            return new Promise(function (resolve) {
              $.ajax({
                url: '<?=base_url();?>m_members/del',
                type: 'POST',
                dataType: 'json',
                data: {id_member:data.id_member,csrf_token_name:token_name},
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
      $(document).on('click','#checkall',function() {
        if(!$(this).is(':checked')){
          $('.btn-dlm').prop('checked', false);

        }else{
          $('.btn-dlm').prop('checked', true);
        }
      });

      // delete mulit
      $(document).on('click','#delete_multi',function(){

        if(!$('.btn-dlm').is(':checked')){
           swal({
              title: 'กรุณาเลือกผู้ใช้งานที่ต้องการลบ',
              text: "",
              type: "warning",
              button: "ยืนยัน",
              animation: false
          });
          return false;
        }

        var form_data = $('#form_delmulti').serialize();
        swal({
          title: 'ยืนยันการลบผู้ใช้งานที่เลือก',
          type: 'info',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'ยกเลิก',
          confirmButtonText: 'ยืนยัน',
          showLoaderOnConfirm: true,
          animation: false,
          preConfirm: function () {
            return new Promise(function (resolve) {
              $.ajax({
                url: '<?=base_url();?>m_members/delmulti',
                type: 'POST',
                data: form_data,
                dataType: 'json',
                success:function(data){
                  $("input[name=" + data.token + "]").val(data.hash);
                  console.log(data);
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
      // !-end ready
    });
  </script>