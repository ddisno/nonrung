<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?=$this->config->item('vendor')?>/plugins/iCheck/all.css">
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?=$title?>
        <a class="btn btn-primary btn-sm" href="<?=base_url()?>m_menus"><i class="fa fa-arrow-circle-left"></i>&nbsp; กลับหน้าจัดการเมนู</a>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?=$title?></li>
      </ol>
    </section>

    <section class="content">
<?php
      if($this->session->flashdata('message')){
      ?>
        <div class="alert alert-success fade in alert-dismissible">
          <?=$this->session->flashdata('message')?>
        </div>
      <?php
      }elseif($this->session->flashdata('error')){
      ?>
        <div class="alert alert-danger fade in alert-dismissible">
      <?=$this->session->flashdata('error')?>
        </div>
      <?php
      }
      ?>
      <div class="row">
        <?php echo form_open('','id="update"')?>
        <div class="col-lg-6 col-md-12">
          
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">รายละเอียด</h3>
            </div>
            <div class="box-body">
              
              <input type="hidden" name="id_menu" value="<?=$menu['id_menu']?>">
              <div class="form-horizontal">
                  
                  <div class="form-group">
                   <!--  <label for="inputPassword3" class="col-sm-3 control-label">ชื่อ</label> -->

                    <div class="col-sm-12">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-header"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="ชื่อเรียกเมนู" name="label" value="<?=$menu['label']?>">
                      </div>
                      <?=form_error('label','<div class="text-red">', '</div>')?>
                    </div>
                  </div>

                  <div class="form-group">
                   
                    <div class="col-sm-12">
                        
                        <input type="radio" name="type" value="internal" <?=($menu['type']=='internal')?'checked':''?>>
                        ลิ้งภายใน
                        &emsp;
                        
                        <input type="radio" name="type" value="external" <?=($menu['type']=='external')?'checked':''?>>
                        ลิ้งภายนอก

                    </div>
                  </div>

                  <div class="form-group">
                   
                    <div class="col-sm-12">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-gears"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="example: m_members/create" name="link" value="<?=$menu['link']?>">
                      </div>
                      <?=form_error('link','<div class="text-red">', '</div>')?>
                    </div>
                  </div>

                  <div class="form-group">
                   
                    <div class="col-sm-12">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-link"></i>
                        </span>
                        <select class="form-control" name="target">
                          <option value="" <?=($menu['target']=='')?'selected':'';?>>หน้าเดิม</option>
                          <option value="_blank" <?=($menu['target']=='_blank')?'selected':'';?>>หน้าใหม่</option>
                        </select>
                      </div>
                    </div>
                  </div>

                 <div class="form-group">
                    
                    <div class="col-sm-12">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-circle-o"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="example : fa fa-home" name="icon" value="<?=$menu['icon']?>">
                      </div>
                    </div>
                  </div>

              </div>
            </div>    
          </div>
          
        </div>
         <!-- column roles -->
        <div class="col-lg-6 col-md-12">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">บทบาท</h3>
            </div>
            <div class="box-body" style="padding: 0">
              <table class="table" width="100%">
                <tr>
                  <th></th>
                  <th style="text-align: center;">เปิด / ปิด</th>
                </tr>
              <?php
              foreach ($roles as $role) {

                ?>
                <tr>
                  <td>
                    <?=$role->name_role;?>
                  </td>
                  <td style="text-align: center;">
                    <input type="checkbox" name="old_role[]" value="<?=$role->id_role?>"
                      <?=(in_array($role->id_role, $roles_menu)) ? 'checked' : '';?> style="display: none;">
                    <label>

                      <input type="checkbox" name="new_role[]" class="flat-red" value="<?=$role->id_role?>" 
                      <?=(in_array($role->id_role, $roles_menu)) ? 'checked' : '';?>>
                    </label>
                  </td>
                </tr>
                <?php
              }
              ?>
              </table>
            </div>
          </div>
        </div>
        <?=form_close()?>
        <div class="col-lg-6 col-md-12">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">ยืนยันการบันทึกข้อมูล</h3>
            </div>
            <div class="box-body">
              <button type="submit" class="btn btn-primary pull-right btn-block" id="save">
                <span id="after"><i class="fa fa-save"></i> บันทึกข้อมูล</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- iCheck 1.0.1 -->
    <script src="<?=$this->config->item('vendor')?>/plugins/iCheck/icheck.min.js"></script>
    <script type="text/javascript">
      //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
    $('#save').click(function(event) {
      swal({
          title: 'ยืนยันการแก้ไขข้อมูล',
          text : '',
          type: 'info',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'ยกเลิก',
          confirmButtonText: 'ยืนยัน',
          showLoaderOnConfirm: true,
          animation: false,
          preConfirm: function () {
            $('#update').submit();
          },    
        })
      return false;
    });
  </script>