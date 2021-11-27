  <link rel="stylesheet" href="<?=base_url()?>asset/plugins/nestable_jquery/css/style.css">

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?=$title?>
        <a href="<?=base_url()?>m_roles/create" class="btn btn-primary btn-sm " id="open-role-create"><i class="fa fa-plus"></i>&nbsp; เพิ่มบทบาท</a>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?=$title?></li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-12">
         
          <div class="box box-info box-solid">
            <div class="box-body">
              <?php echo form_open('','id="form_delmulti"')?>
              <table class="table table-bordered dataTable" id="table" style="width: 100%" >
                <thead>
                  <tr>
                    <th style="width: 10px; text-align: center;" class="no-sort">
                      <input type="checkbox" name="" id="checkall">
                    </th>
                    <th style="width: 50px; min-width: 50px;">บทบาท</th>
                    <th style="width: 30px; min-width: 30px;">Is_admin</th>
                    <th style="width: 30px; min-width: 30px;">สถานะ</th>
                    <th style="width: 300px; min-width: 150px;">สิทธิ์การใช้งาน</th>
                    <th class="no-sort" style="width: 50px; min-width: 50px;">ควบคุม</th>
                  </tr>
                </thead>
              </table>
              <?=form_close()?>
            </div>  
            <div class="box-footer">
              <button class="btn btn-danger" id="delete_multi" btn-permission="delete">ลบที่เลือก</button>
            </div>       
          </div>
        </div>
      </div>
      
    </section>
  </div>
              

<script src="<?=base_url()?>asset/plugins/nestable_jquery/js/jquery.nestable.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    // datatable
    var table = $('#table').DataTable( {
        "ajax": "<?=base_url();?>m_roles/list_role",
        "iDisplayLength" : 50,
        "scrollX": true,
        "columns": [
            { "data": function (data, type, row, meta) {
             return "<input type='checkbox' name='chk_role[]' class='btn-dlm flat-red' value='"+data.id_role+"'>";
            }, "className": 'text-center'},
            
            {"data": function (data, type, row, meta) {
              if(data.nums>0){
                return '<a href="<?=base_url('m_members')?>" class="badge bg-green">'+data.nums+'</a>&nbsp;&nbsp;'+data.name_role;
              }else{
                return '<a href="<?=base_url('m_members')?>" class="badge">'+data.nums+'</a>&nbsp;&nbsp;'+data.name_role;
              }
              
            }},
            {"data": function(data, type, row, meta){
              if(data.is_admin==1){
                return '<label class="badge bg-aqua"><i class="fa fa-user-secret"></i>&nbsp;&nbsp;Admin</label>';
              }else{
                return '<label class="badge"><i class="fa fa-user"></i>&nbsp;&nbsp;User</label>';
              }
            }},
            {"data": function(data, type, row, meta){
              if(data.status=='active'){
                return '<label class="label bg-aqua">Active</label>';
              }else{
                return '<label class="label bg-red">Inactive</label>';
              }
            }},
            { "data": "in_roles" },
            {"data": function(data, type, row, meta){
              return "<a href='<?=base_url()?>m_roles/edit/"+data.id_role+"' class='edit' style='margin-right:5px;'><i class='fa fa-pencil'></i></a>"+
                     "<a class='del'><i class='fa fa-trash'></i></a>";
            }, "className": 'text-center'},
        ],
        "columnDefs": [ {
        "targets": 'no-sort',
        "orderable": false
        } ],
        "order": []
    });
    // check delete all
    $(document).on('click','#checkall',function() {
        if(!$(this).is(':checked')){
          $('.btn-dlm').prop('checked', false);
        }else{
          $('.btn-dlm').prop('checked', true);
        }
    });

    // delete
    $(document).on("click",".del",function() {
       var data = table.row( $(this).parents('tr')).data();
        swal({
          title: 'ยืนยันการลบข้อมูล',
          text: "'"+data.name_role+"'",
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
                type: "POST",
                url: "<?=base_url()?>m_roles/del",
                data: { id : data.id_role ,csrf_token_name:$('input[name="csrf_token_name"]').val()},
                cache : false,
                dataType: 'json',
                success: function(data){
                  if(data.status == 'done'){
                    swal({
                      title: data.info,
                      text: "",
                      type: "success",
                      button: "ยืนยัน",
                      animation: false
                    });
                    table.ajax.reload();
                  }else if(data.status=='exist'){
                    swal({
                      title: data.info,
                      text: "",
                      type: "warning",
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
                  $("input[name=" + data.token + "]").val(data.hash);
                },
                error: function(xhr, status, error) {
                  alert(error);
                },
              })  
              .fail(function (erordata) {
                console.log(erordata);
              })
            })
          },    
        })
    })

    // delete mulit
    $(document).on('click','#delete_multi',function(){

        if(!$('.btn-dlm').is(':checked')){
           swal({
              title: 'กรุณาเลือกข้อมูลที่ต้องการลบ',
              text: "",
              type: "warning",
              button: "ยืนยัน",
              animation: false
          });
          return false;
        }

        var form_data = $('#form_delmulti').serialize();
        swal({
          title: 'ยืนยันการลบบทบาทที่เลือก',
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
                url: '<?=base_url();?>m_roles/delmulti',
                type: 'POST',
                data: form_data,
                dataType: 'json',
                success:function(data){
                  $("input[name=" + data.token + "]").val(data.hash);
                  console.log(data);
                  if(data.status == 'done'){
                    swal({
                      title: data.info,
                      text: data.text,
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
