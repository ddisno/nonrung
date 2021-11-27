<link href="<?=$this->config->item('before_uri')?>asset/backend/plugins/froala/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css">
<link href="<?=$this->config->item('before_uri')?>asset/backend/plugins/froala/css/froala_style.min.css" rel="stylesheet" type="text/css">
<?php
	$date_create = date_create($topic['create_datetime']);
	$date_topic = date_format($date_create,'D d F Y H:i:s');
?>
		<!-- Page Title
		============================================= -->
		<section id="page-title">
			<div class="container clearfix">
				<h1 style="margin-bottom: 5px;"><?=$topic['subject']?></h1>
				<h5><b>โดย : </b><?=$topic['fullname']?></h5>
				<ul class="entry-meta clearfix">
					<li><a href="<?=base_url()?>forum"> กลับไปหน้ากระดาน</a></li>
					<li><i class="icon-calendar3"></i> <?=$date_topic?></li>
				</ul><!-- .entry-meta end -->		
			</div>

		</section><!-- #page-title end -->    			
		

		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap" style="padding:10px; padding-top:20px !important;">
			<?=htmlspecialchars_decode($topic['detail'])?>
			<hr>
			</div>
			<div class="content-wrap">

				<div class="container clearfix ">
					<div id="area_comment">
					<?php
					
					foreach ($topic_comments as $val) {
						if($val['role']!=0){
							$color = '#d81b60 !important';
						}else{
							$color = '#065b9d';
						}

						if($val['stick']!=0){
							$img = '<img src="'.$this->config->item('before_uri').'asset/backend/img/push.png" width="25" height="25">&nbsp;';
						}else{
							$img = '';
						}

					?>
					<div id="div-reply-<?=$val['id_comment']?>">
						<div class="card" style="margin-bottom:20px;" >
							<div class="card-header" style="background-color: <?=$color?>;color: white;" ><?=$img?>ความคิดเห็นที่ <?=$val['number']?></div>
							<div class="card-body fr-view">
							<?php
								if($val['reply']!==NULL){
									?>
										<div class="card" style="margin-bottom:20px;">
											<div class="card-header">ความคิดเห็นที่ <?=$val['reply']['number']?> </div>
											<div class="card-body ">
													
												<?=$val['reply']['comment']?>
												<hr>
												<div class="footer" style="width: 100%;">
													<div class="row">
														<div class="col-sm-8">
															<?=($val['reply']['fullname']!='')?$val['reply']['fullname']:'GUEST'.$val['reply']['id_comment']?>
															<br>
															<small>
															<?php
																$post_date = human_to_unix($val['reply']['create_datetime']);
																$verify_date = human_to_unix($val['reply']['verify_datetime']);
																$now = time();
																$units = 2;
																echo 'แสดงความคิดเห็นเมื่อ : '.timespan($post_date, $now, $units).'ที่แล้ว<br>';
																echo 'ถูกตรวจสอบเมื่อ : '.timespan($verify_date, $now, $units).'ที่แล้ว';
															?>
															</small>
														</div>
														<div class="col-sm-4">
															<button data-id="<?=$val['reply']['id_comment']?>" class="card-link reply-create-box button button-3d button-rounded button-yellow button-light button-small" style="float: right;"><i class="fa fa-reply"></i> ตอบกลับ</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									<?php
								}
							?>

							<?=$val['comment']?>
							<hr>
								<div class="footer" style="width: 100%; text-align: left">
									<div class="row">
										<div class="col-sm-8">
											<?=($val['fullname']!='')?$val['fullname']:'GUEST'.$val['id_comment']?>
											<br>
											<small>
											<?php
												$post_date = human_to_unix($val['create_datetime']);
												$verify_date = human_to_unix($val['verify_datetime']);
												$now = time();
												$units = 2;
												echo 'แสดงความคิดเห็นเมื่อ : '.timespan($post_date, $now, $units).'ที่แล้ว<br>';
												echo 'ถูกตรวจสอบเมื่อ : '.timespan($verify_date, $now, $units).'ที่แล้ว';
											?>
											</small>
										</div>
										<div class="col-sm-4">
											<button data-id="<?=$val['id_comment']?>" class="card-link reply-create-box button button-3d button-rounded button-yellow button-light button-small" style="float: right;"><i class="fa fa-reply"></i> ตอบกลับ</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
					
					}
					?>
					<?=$links?>

					</div>
					<hr>
					<!-- Font Awesome -->
  					<link rel="stylesheet" href="<?=$this->config->item('before_uri')?>asset/backend/bower_components/font-awesome/css/font-awesome.min.css">
  					<style type="text/css">
  						.fr-toolbar{
  							border-top: none;
  						}
  						#imageManager-1{
  							display: none;
  						}
  					</style>
  					<form id="post">
						<div class="card" style="margin-bottom:20px;">
							<div class="card-header"><h3><b>แสดงความคิดเห็น</b></h3>
								<hr>
								<div class="form-group row">
									<input type="hidden" name="id_topic" value="<?=$topic['id_topic']?>"> <!-- id_topic -->
									<input type="hidden" name="reply" value="0"> <!-- reply -->
								    <label for="staticName" class="col-sm-2 col-form-label">ชื่อ - นามสกุล</label>
								    <div class="col-sm-4"  style="margin-bottom: 10px">
								    	<?php
								    	if(isset($_POST['checksum'])=='admin'){
								    		?>
								    			
												<input type="text" class="form-control" id="fullname" name="fullname" required value="admin" readonly="">
												<input type="hidden" class="form-control" name="check_admin" value="admin" >
								    		<?php
								    	}else{
								    		?>
								    			<input type="text" class="form-control" id="fullname" name="fullname" required>
								    		<?php
								    	}
								    	?>
								      
								    </div>
								    <label for="istaticEmail" class="col-sm-2 col-form-label">อีเมล์</label>
								    <div class="col-sm-4"  style="margin-bottom: 10px">
								    	<?php
								    	if(isset($_POST['checksum'])=='admin'){
								    		?>
												<input type="email" class="form-control" id="email" placeholder="example@yourmail.com" name="email" value="admin" readonly="">
								    		<?php
								    	}else{
								    		?>
								    			<input type="email" class="form-control" id="email" placeholder="example@yourmail.com" name="email" >
								    		<?php
								    	}
								    	?>
								      
								    </div>
								    <label for="istaticEmail" class="col-sm-2 col-form-label">เบอร์โทร</label>
								    <div class="col-sm-4"  style="margin-bottom: 10px">
								    	<input type="phone" name="phone" class="form-control">
								    </div>
								  </div>
								  <div id="area-reply" style="margin: 10px;"></div>	
							</div>
								<div class="card-body" style="padding: 0">
									
									<textarea id="editor" name="comment"></textarea>
								<div class="footer" style="width: 100%; text-align: right; padding: 10px;">
									<button class="card-link button button-3d button-rounded button-green" id="submit">แสดงความคิดเห็น</button>
								</div>
							</div>
						</div>
					</form>
				</div>

			</div>

		</section><!-- #content end -->

	<script type="text/javascript" src="<?=$this->config->item('before_uri')?>asset/backend/plugins/froala/js/froala_editor.pkgd.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
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
	      	alert('กรุณากรอกข้อมูลที่จะแสดงความคิดเห็น');
	      	return false;
	      }
	      swal({
	          title: 'ยืนยัน',
	          text: "ยืนยันการแสดงความคิดเห็น",
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
	                url: '<?=base_url();?>forum/create_comment',
	                type: 'POST',
	                processData: false,
	                contentType: false,
	                data: formData,
	                success:function(data){
	                  console.log(data);
	                  if(data.status == 'success'){
	                    swal('สำเร็จ', 'แสดงความคิดเห็นเรียบร้อยแล้ว ระบบกำลังตรวจสอบความถูกต้อง และจะแสดงผลเมื่ออนุมัติผ่าน', 'success');
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

	    // $(document).on('click', '.post-reply', function(event) {
	    // 	var id = $(this).attr('data-id');
	    // 	// alert(id);
	    // 	$('.form-reply').trigger('submit');
	    		 
	    // });

	    $(document).on('submit', '.form-reply', function(event) {
	   			var formData = new FormData($('.form-reply')[0]);
	   			console.log(formData);
	    		if($(this).find('.editor').val()==''){
			      	alert('กรุณากรอกข้อมูลที่จะแสดงความคิดเห็น');
			      	return false;
			    }
		      	swal({
		          title: 'ยืนยัน',
		          text: "ยืนยันการแสดงความคิดเห็น",
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
		                url: '<?=base_url();?>forum/create_comment',
		                type: 'POST',
		                processData: false,
		                contentType: false,
		                data: formData,
		                success:function(data){
		                  console.log(data);
		                  if(data.status == 'success'){
		                    swal('สำเร็จ', 'แสดงความคิดเห็นเรียบร้อยแล้ว ระบบกำลังตรวจสอบความถูกต้อง และจะแสดงผลเมื่ออนุมัติผ่าน', 'success');
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
	    })

	    $('.reply-create-box').click(function(event) {
	    	var id = $(this).attr('data-id');
	    	$('html, body').animate({
	            scrollTop : $('#div-reply-'+id).offset().top
	        }, 500);
	     	if($('.reply-'+id).length!=0){
	     		return false;
	     	}

	     	$('.other-reply').remove();

	        var text = '';
	        	text += '<form id="post-reply-'+id+'" class="form-reply">'
		        text += '<div class="card other-reply reply-'+id+'" style="margin-bottom:20px;">';
				text += '<div class="card-header" style="background-color:#EB9C4D;">';
				text += '<div class="form-group row" style="margin:0;">';
				text +=		'<input type="hidden" name="id_topic" value="<?=$topic['id_topic']?>">';
				text +=		'<input type="hidden" name="reply" value="'+id+'">';
				text +=		'<label for="staticName" class="col-sm-2 col-form-label" style="color:white;">ชื่อ - นามสกุล</label>';
				text +=		'<div class="col-sm-4">';
				<?php
					if(isset($_POST['checksum'])=='admin'){
				?>			    			
				text +=	'	<input type="text" class="form-control" id="fullname" name="fullname" required value="admin" readonly="">';
				text +=	'	<input type="hidden" class="form-control" name="check_admin" value="admin" >';
				<?php
					}else{
				?>
				text +=	'<input type="text" class="form-control" id="fullname" name="fullname" required>';
				<?php
					}
				?>
				text +=		'</div>';
				text +=		'<label for="istaticEmail" class="col-sm-2 col-form-label" style="color:white;">อีเมล์</label>';
				text +=		'<div class="col-sm-4">';
				<?php
					if(isset($_POST['checksum'])=='admin'){
				?>	
				text += '<input type="email" class="form-control" id="email" placeholder="example@yourmail.com" name="email" value="admin" readonly="">';
				<?php
					}else{
				?>
				text +=			'<input type="email" class="form-control" id="email" value="" placeholder="example@yourmail.com" name="email" required>';
				<?php
					}
				?>
				
				text +=		'</div>';
				text +=	'</div> </div>';
				text += '<div class="card-body" style="padding: 0">';
				text += '<textarea class="editor" name="comment" id="text-editor-'+id+'"></textarea>'					
				text += '<div class="footer" style="width: 100%; text-align: right; padding:5px;">';
				text += '<button class="close-reply button button-3d button-small button-rounded button-teal"><i class="fa fa-ban"></i> ปิดกล่อง</button>';
				text += '<button class="post-reply button button-3d button-small button-rounded button-green" data-id="'+id+'">แสดงความคิดเห็น</button>';
				text += '</div>';
				text += '</div>';
				text += '</div>';	
				text += '</form>';	
			$('#div-reply-'+id).append(text);

			$('.editor').froalaEditor({

			  	toolbarButtons: ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', '|', 'fontFamily', 'fontSize', 'color', 'inlineClass', 'inlineStyle', 'paragraphStyle', 'lineHeight', '|', 'align', 'formatOL', 'formatUL', 'outdent', 'indent', '-', 'insertLink', 'insertImage', 'embedly','insertTable', '|','paragraphFormat','quote', 'emoticons', 'fontAwesome', 'specialCharacters', 'insertHR', 'selectAll', 'clearFormatting', '|', 'getPDF', 'spellChecker', '|', 'undo', 'redo'],
	            toolbarButtonsXS: ["bold", "italic", "fontFamily", "fontSize", "|", "undo", "redo"],
	            toolbarButtonsSM: ["bold", "italic", "underline", "|", "fontFamily", "fontSize", "insertLink", "insertImage", "table", "|", "undo", "redo"],
	            toolbarButtonsMD: ["bold", "italic", "underline", "fontFamily", "fontSize", "color", "paragraphStyle", "paragraphFormat", "align", "formatOL", "formatUL", "outdent", "indent", "quote", "insertHR", "-", "insertLink", "insertImage","insertTable", "undo", "redo", "clearFormatting"],

		          language: 'ar',
		          heightMin: 200,
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

	   $(document).on('click', '.close-reply', function(event) {
	   		$('.other-reply').remove();
	   });		
	</script>

		
