  <link rel="stylesheet" href="<?=$this->config->item('vendor')?>plugins/nestable_jquery/css/style.css">

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?=$title?>
        <a class="btn btn-primary btn-sm" href="<?=base_url()?>m_menus/create"><i class="fa fa-plus"></i>&nbsp; เพิ่มเมนู</a>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?=$title?></li>
      </ol>
    </section>

    <section class="content">
      <?php echo form_open('','id="form_delmulti"'); ?>
      <?php echo form_close()?>
      <div class="row">
        <div class="col-lg-7 col-md-12">
          <div class="box box-info box-solid">   
            <div class="box-body">
              <menu id="nestable-menu" class="pull-right">
                  <button type="button" data-action="expand-all" class="btn btn-default btn-sm">Expand All</button>
                  <button type="button" data-action="collapse-all" class="btn btn-default btn-sm">Collapse All</button>
              </menu>
              <div class="cf nestable-lists">
                <div class="dd" id="nestable">

                </div>
              </div>
              <input type="hidden" id="nestable-output">
              
            </div>         
          </div>
        </div>
        <div class="col-lg-5 col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">บทบาท</h3>
            </div>   
            <div class="box-body">
              <div class="form-group">
               
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-user-secret"></i>
                    </span>
                    <select class="form-control"
                            style="width: 100%;" id="roles">
                            <option value="">-- ทั้งหมด --</option>
                      <?php
                      foreach ($roles as $role) {
                      ?>
                        <option value="<?=$role['id_role']?>"><?=$role['name_role']?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
              </div>
          </div>
        </div>
      </div> 
    </section>
  </div>

<script src="<?=$this->config->item('vendor')?>plugins/nestable_jquery/js/jquery.nestable.js"></script>

<script type="text/javascript">
  $(document).ready(function() {

    function nestable_start(){
      var updateOutput = function(e){
        var list   = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
      };

      // activate Nestable for list 1
      $('#nestable').nestable({
          group: 1
      })
      .on('change', updateOutput);

      // output initial serialised data
      updateOutput($('#nestable').data('output', $('#nestable-output')));

      $('#nestable-menu').on('click', function(e){
          var target = $(e.target),
              action = target.data('action');
          if (action === 'expand-all') {
              $('.dd').nestable('expandAll');
          }
          if (action === 'collapse-all') {
              $('.dd').nestable('collapseAll');
          }
      });
    }
    function fetch_nestable($id=''){
      $.ajax({
        url: '<?=base_url()?>m_menus/list_menus',
        type: 'get',
        data: {id: $id},
      })
      .done(function(data) {
        $('#nestable').html(data);
        nestable_start();
      })
    }

    fetch_nestable();


    $('.dd').on('change', function() {
      nestable_start();
      var dataString = { 
        data : $("#nestable-output").val(),
      };
      console.log(dataString);
      $.ajax({
        type: "get",
        url: '<?=base_url()?>m_menus/sort_menus',
        data: dataString,
        cache : false,
        success: function(data){
          $.toast({
              heading: 'สำเร็จ',
              text: 'จัดเรียงเมนูเรียบร้อยแล้ว',
              icon: 'success',
              position: 'top-right',
              stack: false
          })
        } ,error: function(xhr, status, error) {
          alert(error);
        },
      });
    });
    $(document).on('change', '#roles', function(event) {
      var id = $(this).val();
      fetch_nestable(id);
    });
    // delete modules
    $(document).on("click",".del-button",function() {
        var id = $(this).attr('id');
        var name = $(this).attr('data-name');
        swal({
          title: 'ยืนยันการลบข้อมูล',
          text: '"'+name+'"',
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
                url: "<?=base_url()?>m_menus/del",
                data: { id : id ,csrf_token_name:$('input[name="csrf_token_name"]').val()},
                cache : false,
                success: function(data){
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
                  $("input[name=" + data.token + "]").val(data.hash);
                  $("li[data-id='" + id +"']").remove();
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
  });
</script>
