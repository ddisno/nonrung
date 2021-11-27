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
      <a class="btn btn-success" href="<?=base_url();?>blog/create">เพิ่มข่าวสาร</a>
      <a class="btn btn-primary" href="<?=base_url();?>blog/manage">รายการทั้งหมด</a>
      <div class="row" style="margin-top: 5px;">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">รายการที่ปักหมุด</h3>
            </div>
            <div class="box-body">
              <form id="form_delmulti">
                <table id="table" style="width: 100%" class="table table-striped table-bordered dataTable">
                  <thead>
                    <tr>
                      
                      <th style="width: 10px; text-align: center;" id="checkall">#</th>
                      <th style="max-width: 50px;">รูปภาพ</th>
                      <th>รายการ</th>
                      <th style="width: 150px; max-width: 150px; min-height: 150px;">หมวดหมู่</th>
                      <th style="width: 50px; max-width: 50px; min-height: 50px;">ลำดับ</th>
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
      // data Blog list
      // data Blog list
      var table = $('#table').DataTable( {
        "ajax": "<?=base_url();?>blog/blog_list_stick",
        "iDisplayLength" : 50,
        "scrollX": true,
        "columns": [          
            { "data": function (data, type, row, meta) {
              return '<input type="checkbox" class="btn-dlm" name="chk_blog[]" value="'+data.id_blog+'"> ';
            }},
             { "data":function(data,type,row,meta){
              if(data.img_path!='' ){
                return "<div style='width:100%'><img src='"+data.img_path_thumb+"' style='width:100%; height:auto'></div>"
              }else{
                return "<div style='width:100%'><img src='<?=$this->config->item('vendor')?>img/no_img_sq.jpg' style='width:100%'></div>";
              }
            } },
            { "data": "name_th" },
            { "data": "name_cat_th" },
            { "data": function(data){
              return "<input type='text' class='form-control input-sm order_by' value='"+data.order_by_stick+"' style='width:50px'>";
            } },

            {"data": function(data, type, row, meta){
              return   "<div class='btn-group'>"+
              "<a href='<?=base_url();?>blog/edit/"+remove_spc(data.name_th)+"/"+data.id_blog+" ' class='btn btn-default btn-sm edit'><i class='fa fa-edit'></i></a>"+

              "<a class='btn btn-danger btn-sm del'><i class='fa fa-trash'></i></a>"+
              "</div>";
            }}
        ],
      });

      function remove_spc(string){
        if(string===''){
          return 'null';
        }
        return string.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '').replace(/[_\s]/g, '-')
      }
       // delete Blog
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
                url: '<?=base_url();?>blog/blog_del',
                type: 'POST',
                data: {id_blog:data.id_blog},
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
          swal('Warning','Please choose blog to delete','warning');
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
                url: '<?=base_url();?>blog/blog_delmulti',
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
                url: '<?=base_url();?>blog/blog_order_by_stick',
                type: 'POST',
                data: {data:order_by,id:data.id_blog},
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