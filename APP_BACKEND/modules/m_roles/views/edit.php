  <!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?=$this->config->item('vendor')?>/plugins/iCheck/all.css">
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?=$title?>
        <a class="btn btn-primary btn-sm" href="<?=base_url()?>m_roles"><i class="fa fa-arrow-circle-left"></i>&nbsp; รายการบทบาท</a>
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
        <input type="hidden" name="id_role" value="<?=$role['id_role']?>">
        <div class="col-lg-6 col-md-12">
         <div class="row">
           <div class="col-md-12">
            <!-- partial general -->
            <?=$this->load->view('partial/update/general')?>
           </div>
         </div>
          
          
        </div>
        <!-- column roles -->
        <div class="col-lg-6 col-md-12">
          <div class="row">
            <div class="col-md-12">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#permissions" data-toggle="tab"><i class="fa fa-key"></i>&nbsp; สิทธิ์การใช้งาน</a></li>
                  <li><a href="#menus" data-toggle="tab"><i class="fa fa-list"></i>&nbsp;เมนู</a></li>
                </ul>
                <div class="tab-content no-padding">
                  <div class="tab-pane active" id="permissions">
                     <!-- partial mpermissions -->
                      <?=$this->load->view('partial/update/permissions')?>
                  </div>
                  <div class="tab-pane" id="menus">
                     <!-- partial menus -->
                      <?=$this->load->view('partial/update/menus')?>
                  </div>
                </div>
              </div>
            </div>
           
            <div class="col-md-12">
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
          
        </div>
        <?=form_close()?>
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
     //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass   : 'iradio_minimal-red'
    })
    $('#save').click(function(event) {
      swal({
          title: 'ยืนยันการแก้ไขบทบาท',
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