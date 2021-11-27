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

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-7">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">จัดการส่วนเชื่อมโยง</h3>
            </div>
            <style type="text/css">
              .custom-addon{
                padding: 0 !important;
                border-top: none;
                border-left: none;
                border-bottom: none;
              }
              .btn-social-icon{
                border-radius: 0;
              }
            </style>
            <!-- /.box-header -->
            <?=form_open('','id=update')?>
            <div class="box-body">
              <!-- facebook -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon custom-addon">
                    <a class="btn btn-social-icon btn-facebook">
                      <i class="fa fa-facebook"></i>
                    </a>
                  </span>
                  <input type="text" name="fb" class="form-control" value="<?=$data[0]['link']?>">
                  <span class="input-group-addon">แสดงผล</span>
                  <span class="input-group-addon">
                    <input type="checkbox" 
                          class="show_link" 
                          value="<?=$data[0]['id_link']?>"  
                          name="fb_show" <?=($data[0]['status']==1) ? 'checked' : '';?>>
                  </span>
                </div>
              </div>
              <!--  -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon custom-addon">
                    <a class="btn btn-social-icon btn-google">
                      <i class="fa fa-google-plus"></i>
                    </a>
                  </span>
                  <input type="text" name="gg" class="form-control" value="<?=$data[1]['link']?>">
                  <span class="input-group-addon">แสดงผล</span>
                  <span class="input-group-addon">
                    <input type="checkbox" 
                          class="show_link" 
                          value="<?=$data[1]['id_link']?>"  
                          name="gg_show" <?=($data[1]['status']==1) ? 'checked' : '';?>>
                  </span>
                </div>
              </div>
              <!--  -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon custom-addon">
                    <a class="btn btn-social-icon btn-instagram">
                      <i class="fa fa-instagram"></i>
                    </a>
                  </span>
                  <input type="text" name="ig" class="form-control" value="<?=$data[2]['link']?>">
                  <span class="input-group-addon">แสดงผล</span>
                  <span class="input-group-addon">
                    <input type="checkbox" 
                          class="show_link" 
                          value="<?=$data[2]['id_link']?>"  
                          name="ig_show" <?=($data[2]['status']==1) ? 'checked' : '';?>>
                  </span>
                </div>
              </div>
              <!--  -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon custom-addon">
                    <a class="btn btn-social-icon btn-twitter">
                      <i class="fa fa-twitter"></i>
                    </a>
                  </span>
                  <input type="text" name="tw" class="form-control" value="<?=$data[3]['link']?>">
                  <span class="input-group-addon">แสดงผล</span>
                  <span class="input-group-addon">
                    <input type="checkbox" 
                          class="show_link" 
                          value="<?=$data[3]['id_link']?>"  
                          name="tw_show" <?=($data[3]['status']==1) ? 'checked' : '';?>>
                  </span>
                </div>
              </div>
              <!--  -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon custom-addon">
                    <a class="btn btn-social-icon btn-google">
                      <i class="fa fa-pinterest"></i>
                    </a>
                  </span>
                  <input type="text" name="pr" class="form-control" value="<?=$data[4]['link']?>"> 
                  <span class="input-group-addon">แสดงผล</span>
                  <span class="input-group-addon">
                    <input type="checkbox" 
                          class="show_link" 
                          value="<?=$data[4]['id_link']?>" 
                          name="pr_show" <?=($data[4]['status']==1) ? 'checked' : '';?>>
                  </span>
                </div>
              </div>
              <!--  -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon custom-addon">
                    <a class="btn btn-social-icon btn-google">
                      <i class="fa fa-youtube-square"></i>
                    </a>
                  </span>
                  <input type="text" name="yt" class="form-control" value="<?=$data[5]['link']?>">
                  <span class="input-group-addon">แสดงผล</span>
                  <span class="input-group-addon">
                    <input type="checkbox" 
                          class="show_link" 
                          value="<?=$data[5]['id_link']?>" 
                          name="yt_show" <?=($data[5]['status']==1) ? 'checked' : '';?>>
                  </span> 
                </div>
              </div>
              <!--  -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon custom-addon">
                    <a class="btn btn-social-icon btn-twitter">
                      <i class="fa fa-vimeo-square"></i>
                    </a>
                  </span>
                  <input type="text" name="vo" class="form-control" value="<?=$data[6]['link']?>">
                  <span class="input-group-addon">แสดงผล</span>
                  <span class="input-group-addon">
                    <input type="checkbox" 
                          class="show_link" 
                          value="<?=$data[6]['id_link']?>" 
                          name="vo_show" <?=($data[6]['status']==1) ? 'checked' : '';?>>
                  </span> 
                </div>
              </div>
              <!--  -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon custom-addon">
                    <a class="btn btn-social-icon btn-github">
                      <i class="fa fa-github"></i>
                    </a>
                  </span>
                  <input type="text" name="gh" class="form-control" value="<?=$data[7]['link']?>">
                  <span class="input-group-addon">แสดงผล</span>
                  <span class="input-group-addon">
                    <input type="checkbox" 
                          class="show_link" 
                          value="<?=$data[7]['id_link']?>" 
                          name="gh_show" <?=($data[7]['status']==1) ? 'checked' : '';?>>
                  </span>
                </div>
              </div>
              <!--  -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon custom-addon">
                    <a class="btn btn-social-icon btn-flickr">
                      <i class="fa fa-y-combinator"></i>
                    </a>
                  </span>
                  <input type="text" name="yh" class="form-control" value="<?=$data[8]['link']?>">
                  <span class="input-group-addon">แสดงผล</span>
                  <span class="input-group-addon">
                    <input type="checkbox" 
                          class="show_link" 
                          value="<?=$data[8]['id_link']?>" 
                          name="yh_show" <?=($data[8]['status']==1) ? 'checked' : '';?>>
                  </span>
                </div>
              </div>
              <!--  -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon custom-addon">
                    <a class="btn btn-social-icon btn-linkedin">
                      <i class="fa fa-linkedin"></i>
                    </a>
                  </span>
                  <input type="text" name="lk" class="form-control" value="<?=$data[9]['link']?>">
                  <span class="input-group-addon">แสดงผล</span>
                  <span class="input-group-addon">
                    <input type="checkbox" 
                           class="show_link" 
                           value="<?=$data[9]['id_link']?>" 
                           name="lk_show" <?=($data[9]['status']==1) ? 'checked' : '';?>>
                  </span>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp; บันทึก</button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script type="text/javascript">
    $(function(){
      var token_name = $("input[name='csrf_token_name']").val();
      $('#update').submit(function(event) {
          var formData = new FormData($('#update')[0]);
          swal({
            title: 'ยืนยัน',
            text: "ยืนยันการแก้ไขข้อมูล",
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
                  url: '<?=base_url();?>link/update',
                  type: 'POST',
                  processData: false,
                  contentType: false,
                  data: formData,
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
                  }
                })  
                .fail(function (erordata) {
                  console.log(erordata);
                })
              })
            },    
          })
          return false;
        });
        $(document).on('click', '.show_link', function(event) {
            var status = 0;
            var id_link = $(this).val();
            if(!$(this).is(':checked')){
              status = 0;
            }else{
              status = 1;
            }
            // alert(status);
            $.ajax({
              url: '<?=base_url();?>link/status',
              type: 'POST',
              data: {status:status,id:id_link,csrf_token_name:token_name},
              success:function(data){
                 $("input[name=" + data.token + "]").val(data.hash);
                    if(data.status == 'done'){
                       $.growl.notice({ title: "แก้ไขข้อมูล", message: 'แก้ไขข้อมูลเรียบร้อยแล้ว' });
                    }else{
                      swal({
                        title: data.info,
                        text: "",
                        type: "Error",
                        button: "ยืนยัน",
                        animation: false
                      });
                    }
              }
            })  
            .fail(function (erordata) {
              console.log(erordata);
            })   
          });
    })
  </script>