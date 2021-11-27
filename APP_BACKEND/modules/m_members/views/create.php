

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <?=$header?>
       <a href="<?=base_url()?>m_members" class="btn btn-primary btn-sm" ><i class="fa fa-arrow-circle-left"></i>&nbsp; กลับไปหน้าจัดการผู้ใช้งาน</a>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url();?>"><i class="fa fa-dashboard"></i> แดชบอร์ด</a></li>
        <li class="active"><?=$header?></li>
      </ol>
    </section>
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
      <div class="row">
        <?php echo form_open('','id="create"'); ?>
        <!-- staff list -->
        <div class="col-md-6">
          <div class="row">
            <!-- ข้อมูลทั่วไปร -->
            <div class="col-md-12">
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">ข้อมูลทั่วไป</h3>
                </div>
                
                <div class="box-body">
                    <div class="form-horizontal">
                      <div class="form-group">
                        <div class="col-sm-12">
                          <label for="inputPassword3">ชื่อ :</label>
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="fa fa-user"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Fisrtname" name="f_name" value="<?=set_value('f_name')?>">
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        
                        <div class="col-sm-12">
                          <label>นามสกุล :</label>
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="fa fa-user"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Lastname" name="l_name" value="<?=set_value('l_name')?>">
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-12">
                          <label>เบอร์โทร :</label>
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="fa fa-phone"></i>
                            </span>
                            <input type="Telephone" class="form-control" placeholder="091-882XXXX" name="phone" value="<?=set_value('phone')?>">
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
                
              </div>
            </div>
            <!-- ข้อมูลการเข้าสู่ระบบ -->
            <div class="col-md-12">
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">ข้อมูลการเข้าสู่ระบบ</h3>
                </div>
                
                <div class="box-body">
                    <div class="form-horizontal">
                      <div class="form-group">
                        

                        <div class="col-sm-12">
                          <label>อีเมล์ :</label>
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="fa fa-envelope"></i>
                            </span>
                            <input type="Email" class="form-control" placeholder="example@yourmail.com" name="email" value="<?=set_value('email')?>">
                          </div>
                          <?=form_error('email','<div class="text-red">', '</div>')?>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12">
                           <label>รหัสผ่าน</label>
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="glyphicon glyphicon-lock"></i>
                            </span>
                            <input type="password" class="form-control" placeholder="Password" name="password" value="<?=set_value('password')?>">
                          </div>
                          <?=form_error('password','<div class="text-red">', '</div>')?>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12">
                          <label>รหัสผ่านอีกครั้ง</label>
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="glyphicon glyphicon-lock"></i>
                            </span>
                            <input type="password" class="form-control" placeholder="Retype password" name="passconf" value="<?=set_value('passconf')?>">
                          </div>
                          <?=form_error('passconf','<div class="text-red">', '</div>')?>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12">
                           <label >สิทธิ์การใช้งาน</label>
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="glyphicon glyphicon-log-in"></i>
                            </span>
                            <select class="form-control"
                                  style="width: 100%;" name="id_role">
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
                      <div class="form-group">
                        <div class="col-sm-12">
                          <label>สถานะ</label>
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="glyphicon glyphicon-log-in"></i>
                            </span>
                            <select class="form-control" name="status">
                              <option value="active">พร้อมใช้งาน</option>
                              <option value="inactive">ไม่พร้อมใช้งาน</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
                
              </div>
            </div>
          </div>
        </div>
         </form>  
         <div class="col-md-6">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">ยืนยันการบันทึกข้อมูล</h3>
                </div> 
                <div class="box-body">
                   <button class="btn btn-block btn-primary" id="save"><i class="fa fa-check"></i>&nbsp; บันทึกข้อมูล</button>
                </div>
              </div>    
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- // -->
  <script type="text/javascript">
    $('#save').click(function(event) {
      swal({
          title: 'ยืนยันการเพิ่มผู้ใช้งาน',
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
            $('#create').submit();
          },    
        })
      return false;
    });
  </script>