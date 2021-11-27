<div class="box box-info">
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
                          value="<?=set_value('name_role')?>">
                        </div>
                        <?=form_error('name_role','<div class="text-red">', '</div>')?>
                      </div>
                    </div>

                    <div class="form-group">
                     
                      <div class="col-sm-12">
                          
                          <input type="radio" class="flat-red" name="is_admin" value="0" 
                          <?=set_checkbox('is_admin','active',TRUE)?>>
                          Users
                          &emsp;
                          
                          <input type="radio" class="minimal-red" name="is_admin" value="1" 
                          <?=set_checkbox('is_admin','inactive')?>>
                          Adminstrator

                      </div>
                    </div>

                    <div class="form-group">
                     
                      <div class="col-sm-12">
                        <label>อธิบาย :</label>
                        <textarea class="form-control" rows="7" name="description"><?=set_value('description')?></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                     
                      <div class="col-sm-12">
                          
                          <input type="radio" class="flat-red" name="status" value="active" 
                          <?=set_checkbox('status','active',TRUE)?>>
                          พร้อมใช้งาน
                          &emsp;
                          
                          <input type="radio" class="minimal-red" name="status" value="inactive" 
                          <?=set_checkbox('status','inactive')?>>
                          ไม่พร้อมใช้งาน

                      </div>
                    </div>

                </div>
              </div>      
            </div>
