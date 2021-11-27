
<link href="<?=$this->config->item('before_uri')?>asset/backend/plugins/froala/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css">
<link href="<?=$this->config->item('before_uri')?>asset/backend/plugins/froala/css/froala_style.min.css" rel="stylesheet" type="text/css">
		<!-- Page Title
		============================================= -->
		<section id="page-title" style="padding: 30px">

			<div class="container clearfix">
				<h1>กระดานสนทนา / ร้องทุกข์</h1>
				
			</div>

		</section><!-- #page-title end -->

		<!-- Content
		============================================= -->
		<section id="content">

			<div class="content-wrap">

				<div class="container clearfix">

							<table class="table table-bordered " id="table" style="background-color: white; width: 100%">
								<thead  class="thead-light">
									<tr>
										<th style="min-width: 60px;">ลำดับ</th>
										<th style="min-width: 300px;">เรื่อง</th>
										<th style="min-width: 80px;">วันที่</th>
										<th style="min-width: 80px;">โดย</th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
							</table>
						<!-- Pagination
					============================================= -->
					<?=$links?>
					<hr>
					<link rel="stylesheet" href="<?=$this->config->item('before_uri')?>asset/backend/bower_components/font-awesome/css/font-awesome.min.css">
					<form id="post">
						<div class="card" style="margin-bottom:20px;">
							<div class="card-header"><h3><b>โพสต์</b></h3>
								<hr>
								<div class="form-group row">
									<div class="col-sm-12">
										<div class="input-group mb-3">
										  <div class="input-group-prepend">
										    <span class="input-group-text" id="basic-addon1">เรื่อง</span>
										  </div>
										  <input type="text" class="form-control" placeholder="...." aria-label="Username" aria-describedby="basic-addon1" name="subject">
										</div>
									</div>

								    <label for="staticName" class="col-sm-2 col-form-label">ชื่อ - นามสกุล</label>
								    <div class="col-sm-4" style="margin-bottom: 10px">
								      <input type="text" class="form-control" id="fullname" name="fullname" required>
								    </div>

								    <label for="istaticEmail" class="col-sm-2 col-form-label">อีเมล์</label>
								    <div class="col-sm-4" style="margin-bottom: 10px">
								      <input type="email" class="form-control" id="email" value="" placeholder="example@yourmail.com" name="email" >
								    </div>

								    <label for="istaticEmail" class="col-sm-2 col-form-label">เบอร์โทร</label>
								    <div class="col-sm-4" style="margin-bottom: 10px">
								    	<input type="text" name="phone" class="form-control">
								    </div>
								  </div>
								  <div id="area-reply" style="margin: 10px;"></div>	
							</div>
								<div class="card-body" style="padding: 0">
									
									<textarea id="editor" name="detail"></textarea>
								<div class="footer" style="width: 100%; text-align: right; padding: 10px;">
									<button class="card-link button button-3d button-rounded button-green" id="submit">ยืนยันการโพสต์</button>
								</div>
							</div>
						</div>
					</form>
				</div>
				<!----------------->
					
			</div>

		</section><!-- #content end -->
		<script type="text/javascript" src="<?=$this->config->item('before_uri')?>asset/backend/plugins/froala/js/froala_editor.pkgd.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {

				$('#table').dataTable({
			        "ajax": "<?=base_url();?>forum/api_forum_list",
			        "iDisplayLength" : 10,
			        "scrollX": true,
			       "columns": [          
			            { render: function (data, type, row, meta) {
			                return meta.row + meta.settings._iDisplayStart + 1;
			            }},
			            { "data":function(data){
			              var header = ''; 
			              if(data.stick!=0){
			                 header += '<img src="<?=$this->config->item('before_uri')?>asset/backend/img/push.png" width="25" height="25" style="float:left;margin-right:5px;">&nbsp;<a href="<?=base_url();?>forum/view/'+remove_spc(data.subject)+'/'+data.id_topic+'" class="edit">'+data.subject+'</a><br>';
			              }else{
			                header += '<a href="<?=base_url();?>forum/view/'+remove_spc(data.subject)+'/'+data.id_topic+'" class="edit">'+data.subject+'</a><br>';
			              }
			             
			              header += '<small><i class="far fa-comment-dots"></i>&nbsp;'+data.number_total+'&nbsp;&nbsp;</small>';
			              header += '<small style="color:#f39c12;"><i class="far fa-comment-dots"></i>&nbsp;'+data.number_comment+'&nbsp;&nbsp;</small>';
			              header += '<small style="color:#00a65a;"><i class="far fa-comment-dots"></i>&nbsp;'+data.number_verify+'</small>';
			              return header;
			            } },
			            { "data": "create_datetime" },
			            { "data": "fullname" },
			        ],
			     });

				$('#editor').froalaEditor({

			  		toolbarButtons: ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', '|', 'fontFamily', 'fontSize', 'color', 'inlineClass', 'inlineStyle', 'paragraphStyle', 'lineHeight', '|', 'align', 'formatOL', 'formatUL', 'outdent', 'indent', '-', 'insertLink', 'insertImage', 'embedly','insertTable', '|','paragraphFormat','quote', 'emoticons', 'fontAwesome', 'specialCharacters', 'insertHR', 'selectAll', 'clearFormatting', '|', 'getPDF', 'spellChecker', '|', 'undo', 'redo'],
            		toolbarButtonsXS: ["bold", "italic", "fontFamily", "fontSize", "|", "undo", "redo"],
            		toolbarButtonsSM: ["bold", "italic", "underline", "|", "fontFamily", "fontSize", "insertLink", "insertImage", "table", "|", "undo", "redo"],
            		toolbarButtonsMD: ["bold", "italic", "underline", "fontFamily", "fontSize", "color", "paragraphStyle", "paragraphFormat", "align", "formatOL", "formatUL", "outdent", "indent", "quote", "insertHR", "-", "insertLink", "insertImage","insertTable", "undo", "redo", "clearFormatting"],

		          	language: 'ar',
		          	heightMin: 400,
		          	heightMax: 400,
		          	// image
		          	imageUploadURL:"<?=base_url();?>forum/upload",
		          	imageUploadParam:"fileName",
		          	imageManagerLoadMethod:"GET",
		          	imageManagerLoadURL:"<?=base_url();?>forum/select",
		          	imageManagerDeleteURL:"<?=base_url();?>forum/delete",
		          	imageManagerDeleteMethod:"POST",

		          	// fileupload
		          	fileUploadURL: '<?=base_url();?>forum/upload',
		          	fileUploadParam: 'fileName',
		          	fileUploadMethod: 'POST',
		          	fileMaxSize: 20 * 1024 * 1024,
		          	fileAllowedTypes: ['*'],
	        	}).on('froalaEditor.image.uploaded', function (e, editor, response) {
	          		console.log(response);
	        	}).on('froalaEditor.imageManager.beforeDeleteImage', function (e, editor, $img) {
	          		console.log($img);
	        	}).on('froalaEditor.imageManager.imageDeleted', function (e, editor, res) {
	          		console.log(res);
	        	}).on('froalaEditor.video.beforeUpload', function (e, editor, videos) {
	          		console.log("beforeUpload");
	        	}).on('froalaEditor.video.uploaded', function (e, editor, response) {
	          		console.log("uploaded");
	        	}).on('froalaEditor.video.inserted', function (e, editor, $img, response) {
	          		console.log("inserted");
	        	}).on('froalaEditor.video.replaced', function (e, editor, $img, response) {
	          		console.log("replaced");
	        	}).on('froalaEditor.video.error', function (e, editor, error, response) {
	          		console.log("error");
	        	}).on('froalaEditor.file.beforeUpload', function (e, editor, files) {
	          		console.log("beforeUpload");
	        	}).on('froalaEditor.file.uploaded', function (e, editor, response) {
	          		console.log("uploaded");
	        	}).on('froalaEditor.file.inserted', function (e, editor, $file, response) {
	          		console.log("inserted");
	        	}).on('froalaEditor.file.error', function (e, editor, error, response) {
	         		 console.log("error");
	        	});
		});

		$('#post').submit(function(event) {
	      var formData = new FormData($('#post')[0]);
	      if($('#editor').val()==''){
	      	alert('กรุณากรอกข้อมูล');
	      	return false;
	      }
	      swal({
	          title: 'ยืนยัน',
	          text: "ยืนยันการตั้งกระทู้",
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
	                url: '<?=base_url();?>forum/create_topic',
	                type: 'POST',
	                processData: false,
	                contentType: false,
	                data: formData,
	                success:function(data){
	                  console.log(data);
	                  if(data.status == 'success'){
	                    swal('สำเร็จ', 'ระบบกำลังตรวจสอบความถูกต้อง และจะแสดงผลเมื่ออนุมัติผ่าน', 'success');
	                  }else{
	                    swal('เกิดปัญหา', 'Please check data with developer!.','error');
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

	</script>

	