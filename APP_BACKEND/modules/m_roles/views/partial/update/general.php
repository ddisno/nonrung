<div class="box box-warning">
              <div class="box-header with-border">
                <h3 class="box-title">รายละเอียด</h3>
              </div>
              <div class="box-body">
                 
                <div class="form-horizontal">
                    
                    <div class="form-group">
                     <!--  <label for="inputPassword3" class="col-sm-3 control-label">ชื่อ</label> -->

                      <div class="col-sm-12">
                        <label>ชื่อเรียกบทบาท :</label>
                        <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-user-secret"></i>
                          </span>
                          <input type="text" class="form-control" placeholder="ชื่อเรียกบทบาท" name="name_role" 
                          value="<?=$role['name_role']?>">
                        </div>
                        <?=form_error('name_role','<div class="text-red">', '</div>')?>
                      </div>
                    </div>

                    <div class="form-group">
                     
                      <div class="col-sm-12">
                          
                          <input type="radio" class="flat-red" name="is_admin" value="0" 
                          <?=($role['is_admin']=='0') ? 'checked' : ''; ?>>
                          Users
                          &emsp;
                          
                          <input type="radio" class="minimal-red" name="is_admin" value="1" 
                          <?=($role['is_admin']=='1') ? 'checked' : ''; ?>>
                          Adminstrator

                      </div>
                    </div>

                    <div class="form-group">
                     
                      <div class="col-sm-12">
                        <label>อธิบาย :</label>
                        <textarea class="form-control" rows="7" name="description"><?=$role['description']?></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                     
                      <div class="col-sm-12">
                          
                          <input type="radio" class="flat-red" name="status" value="active" 
                          <?=($role['status']=='active') ? 'checked' : ''; ?>>
                          พร้อมใช้งาน
                          &emsp;
                          
                          <input type="radio" class="minimal-red" name="status" value="inactive" 
                          <?=($role['status']=='inactive') ? 'checked' : ''; ?>>
                          ไม่พร้อมใช้งาน

                      </div>
                    </div>

                </div>
              </div>      
            </div>
