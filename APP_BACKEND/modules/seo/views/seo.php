<link href="<?=$this->config->item('vendor')?>plugins/froala/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css">
<link href="<?=$this->config->item('vendor')?>plugins/froala/css/froala_style.min.css" rel="stylesheet" type="text/css">
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <?=$title?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> แดชบอร์ด</a></li>
        <li class="active"><?=$title?></li>
      </ol>
    </section>

    <style type="text/css">
      .fr-toolbar {
        border-top: 1px #ddd solid;
      }
    </style>
    <!-- Main content -->
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
      <?php echo form_open('','id="update"'); ?>
        <div class="row">
          <div class="col-md-8">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">จัดการ SEO <small>(Search Engine)</small></h3>
              </div>
              <div class="box-body">
                <div class="form-horizontal">
                  <div class="form-group">
                    <label class="col-sm-4" style="text-align: right;">
                      Meta Keyword <a href="#" data-toggle="modal" data-target="#keyword"><i class="fa fa-question-circle"></i></a><br>
                      
                    </label>
                    <div class="col-sm-8">
                      <textarea class="form-control" rows="5" name="keyword"><?=$data['meta_keyword']?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4" style="text-align: right;">
                      Meta Description <a href="#" data-toggle="modal" data-target="#descrip"><i class="fa fa-question-circle"></i></a><br>
                      
                    </label>
                    <div class="col-sm-8">
                      <textarea class="form-control" rows="5" name="descrip"><?=$data['meta_descrip']?></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <button class="btn btn-primary" type="button" id="save"><i class="fa fa-save"></i> &nbsp;บันทึก</button>
              </div> 
            </div>
          </div>
        </div>
      </form>
    </section>
    <div class="modal fade in" id="keyword" >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Meta keyword</h4>
          </div>
          <div class="modal-body">
          <p>คำ หรือข้อความ สั้น ๆ ที่เกี่ยวข้องกับเนื้อหาในหน้าเว็บไซต์ โดยเป็นคำที่คาดว่าผู้เข้าชมเว็บไซต์จะใช้ในการค้นหาผ่าน Search Engine คุณสามารถเพิ่ม Keyword ได้มากกว่า 1 คำ โดยแต่ละคำต้องขั้นด้วยเครื่องหมาย คอมม่า (,)</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <div class="modal fade in" id="descrip">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Meta keyword</h4>
          </div>
          <div class="modal-body">
            <p>คำอธิบายรายละเอียดโดยย่อของเนื้อหาที่อยู่ในหน้าเว็บเพจ ว่าเนื้อหานั้นเกี่ยวข้องกับเรื่องใด เป็นข้อความสั้น ไม่ควรเกิน 255 ตัวอักษร ข้อความ Description ควรเป็นข้อความที่ดึงจุดเด่นของเนื้อหาขึ้นมา เนื่องจากข้อความส่วนนี้จะแสดงผล เมื่อมีการค้นหาข้อมูลจาก Search Engine และข้อมูลหน้าเว็บเพจนั้นมีการแสดงที่เว็บ Search Enging ข้อความ Description ก็จะแสดงผลใต้ชื่อเว็บไซต์ </p>
              </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Include JS files. -->
  <script type="text/javascript" src="<?=$this->config->item('vendor')?>plugins/froala/js/froala_editor.pkgd.min.js"></script>
  <script type="text/javascript">
    $('#save').click(function(event) {
      swal({
          title: 'ยืนยันการแก้ไข SEO',
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