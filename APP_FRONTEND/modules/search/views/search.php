<?php
	$no_img = 'asset/backend/img/no_img_sq.jpg';
?>	
	
		<style type="text/css">
			.content-wrap{
				background-color: #f8f9fa !important;	
			}

			.bottommargin-content, .bottommargin-header{
				background-color: white;
				margin: 10px;
				box-shadow: 1px 1px 1px 1px #ddd;
				padding: 10px;
				margin-bottom: 25px !important;
			}

			.bottommargin-slide{
				margin: 10px;
				padding: 0px;
				margin-bottom: 25px !important;
			}

			.bottommargin-header{
				margin-bottom: 10px !important;
				background-color: rgb(255,129,45);
			}

			.bottommargin-header h4{
				color: white;
			}

			.bottommargin-header a{
				color: white;
			}

			h4{
				margin: 0px !important;
			}
		</style>
		<!-- Content
		============================================= -->
		<!-- Page Title
		============================================= -->
		<section id="page-title" style="padding: 30px">

			<div class="container clearfix">
				<h1>ค้นหา</h1>
				<span>คำค้นหา : <i class="icon-search3"></i> <?=$_GET['word']?></span>
			</div>
			<form id="form-search">
				<input type="hidden" name="word" value="<?=$_GET['word']?>">
			</form>
		</section><!-- #page-title end -->


						<div class="bottommargin-header  clearfix">
							<h4>ข่าวประชาสัมพันธ์<a href="<?=base_url()?>news" style="float: right">ดูทั้งหมด</a></h4> 
						</div>
					
						<div class="bottommargin-content clearfix">
							<table class="table table-striped table-bordered" id="news" style="width: 100%">
								<thead>
									<tr>
										<th style="width: 30px;">ลำดับ</th>
										<th>เรื่อง</th>
										<th style="width: 120px;">วันที่อัพเดท</th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
							</table>
						</div>

						<div class="bottommargin-header  clearfix">
							<h4>ข่าวประชาสัมพันธ์ ภายนอกหน่วยงาน<a href="<?=base_url()?>othernews" style="float: right">ดูทั้งหมด</a></h4> 
						</div>

						<div class="bottommargin-content clearfix">
							<table class="table table-striped table-bordered" id="othernews" style="width: 100%">
								<thead>
									<tr>
										<th style="width: 30px;">ลำดับ</th>
										<th>เรื่อง</th>
										<th style="width: 120px;">วันที่อัพเดท</th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
							</table>
						</div>

						<div class="bottommargin-header  clearfix">
							<h4>ข่าวสารจัดซื้อจัดจ้าง<a href="<?=base_url()?>purchase" style="float: right">ดูทั้งหมด</a></h4> 
						</div>
					
						<div class="bottommargin-content clearfix">
							<table class="table table-striped table-bordered dataTable" id="purchase" style="width: 100%">
								<thead>
									<tr>
										<th style="width: 30px;">ลำดับ</th>
										<th>เรื่อง</th>
										<th style="width: 120px;">วันที่อัพเดท</th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
							</table>
						</div>

						<div class="bottommargin-header  clearfix">
							<h4>ข่าวสารจัดซื้อจัดจ้าง ภายนอกหน่วยงาน<a href="<?=base_url()?>purchase" style="float: right">ดูทั้งหมด</a></h4> 
						</div>
					
						<div class="bottommargin-content clearfix">
							<table class="table table-striped table-bordered dataTable" id="otherpurchase" style="width: 100%">
								<thead>
									<tr>
										<th style="width: 30px;">ลำดับ</th>
										<th>เรื่อง</th>
										<th style="width: 120px;">วันที่อัพเดท</th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
							</table>
						</div>

						<div class="bottommargin-header  clearfix">
							<h4>งบประมาณ<a href="<?=base_url()?>budget" style="float: right">ดูทั้งหมด</a></h4> 
						</div>
					
						<div class="bottommargin-content clearfix">
							<table class="table table-striped table-bordered dataTable" id="budget" style="width: 100%">
								<thead>
									<tr>
										<th style="width: 30px;">ลำดับ</th>
										<th>เรื่อง</th>
										<th style="width: 120px;">วันที่อัพเดท</th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
							</table>
						</div>

						<div class="bottommargin-header  clearfix">
							<h4>งานพัสดุ<a href="<?=base_url()?>procurement" style="float: right">ดูทั้งหมด</a></h4> 
						</div>
					
						<div class="bottommargin-content clearfix">
							<table class="table table-striped table-bordered dataTable" id="procurement" style="width: 100%">
								<thead>
									<tr>
										<th style="width: 30px;">ลำดับ</th>
										<th>เรื่อง</th>
										<th style="width: 120px;">วันที่อัพเดท</th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
							</table>
						</div>

						<div class="bottommargin-header  clearfix">
							<h4>ข้อมูลพื้นฐาน<a href="<?=base_url()?>information" style="float: right">ดูทั้งหมด</a></h4> 
						</div>
					
						<div class="bottommargin-content clearfix">
							<table class="table table-striped table-bordered dataTable" id="information" style="width: 100%">
								<thead>
									<tr>
										<th style="width: 30px;">ลำดับ</th>
										<th>เรื่อง</th>
										<th style="width: 120px;">วันที่อัพเดท</th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
							</table>
						</div>

						<div class="bottommargin-header  clearfix">
							<h4>กฏหมายน่ารู้<a href="<?=base_url()?>law" style="float: right">ดูทั้งหมด</a></h4> 
						</div>
					
						<div class="bottommargin-content clearfix">
							<table class="table table-striped table-bordered dataTable" id="law" style="width: 100%">
								<thead>
									<tr>
										<th style="width: 30px;">ลำดับ</th>
										<th>เรื่อง</th>
										<th style="width: 120px;">วันที่อัพเดท</th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
							</table>
						</div>

						<div class="bottommargin-header  clearfix">
							<h4>กระดานสนธนา<a href="<?=base_url()?>forum" style="float: right">ดูทั้งหมด</a></h4> 
						</div>
					
						<div class="bottommargin-content clearfix">
							<table class="table table-striped table-bordered dataTable" id="table-requests" style="width: 100%">
								<thead>
									<tr>
										<th style="width: 30px;">ลำดับ</th>
										<th>เรื่องร้องทุกข์</th>
										<th>วันที่</th>
										<th>โดย</th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
							</table>
						</div>

		<script type="text/javascript">
			$(document).ready(function() {
				$('#news').dataTable({
			        "ajax": "<?=base_url();?>search/news/?"+$('#form-search').serialize()+"",
			        "iDisplayLength" : 10,
			        "scrollX": true,
			        "columns": [          
			            { render: function (data, type, row, meta) {
			                return meta.row + meta.settings._iDisplayStart + 1;
			            }},
			            { "data":function(data){
							return '<a href="<?=base_url()?>news/view/'+remove_spc(data.title)+'/'+data.id+'">'+data.title+'</a>';
			            } },
			            { "data":function(data){
			              if(data.update_datetime!=null){
			                return data.update_datetime;
			              }else{
			                return data.create_datetime;
			              }      
			            } },
			        ],
			     });

				$('#othernews').dataTable({
			        "ajax": "<?=base_url();?>search/othernews/?"+$('#form-search').serialize()+"",
			        "iDisplayLength" : 10,
			        "scrollX": true,
			        "columns": [          
			            { render: function (data, type, row, meta) {
			                return meta.row + meta.settings._iDisplayStart + 1;
			            }},
			            { "data":function(data){
							return '<a href="<?=base_url()?>othernews/view/'+remove_spc(data.title)+'/'+data.id+'">'+data.title+'</a>';
			            } },
			            { "data":function(data){
			              if(data.update_datetime!=null){
			                return data.update_datetime;
			              }else{
			                return data.create_datetime;
			              }      
			            } },
			        ],
			     });

				$('#purchase').dataTable({
			        "ajax": "<?=base_url();?>search/purchase/?"+$('#form-search').serialize()+"",
			        "iDisplayLength" : 10,
			        "scrollX": true,
			        "columns": [          
			            { render: function (data, type, row, meta) {
			                return meta.row + meta.settings._iDisplayStart + 1;
			            }},
			            { "data":function(data){
							return '<a href="<?=base_url()?>purchase/view/'+remove_spc(data.title)+'/'+data.id+'">'+data.title+'</a>';
			            } },
			            { "data":function(data){
			              if(data.update_datetime!=null){
			                return data.update_datetime;
			              }else{
			                return data.create_datetime;
			              }      
			            } },
			        ],
			     });

				$('#otherpurchase').dataTable({
			        "ajax": "<?=base_url();?>search/otherpurchase/?"+$('#form-search').serialize()+"",
			        "iDisplayLength" : 10,
			        "scrollX": true,
			        "columns": [          
			            { render: function (data, type, row, meta) {
			                return meta.row + meta.settings._iDisplayStart + 1;
			            }},
			            { "data":function(data){
							return '<a href="<?=base_url()?>otherpurchase/view/'+remove_spc(data.title)+'/'+data.id+'">'+data.title+'</a>';
			            } },
			            { "data":function(data){
			              if(data.update_datetime!=null){
			                return data.update_datetime;
			              }else{
			                return data.create_datetime;
			              }      
			            } },
			        ],
			     });

				$('#budget').dataTable({
			        "ajax": "<?=base_url();?>search/budget/?"+$('#form-search').serialize()+"",
			        "iDisplayLength" : 10,
			        "scrollX": true,
			        "columns": [          
			            { render: function (data, type, row, meta) {
			                return meta.row + meta.settings._iDisplayStart + 1;
			            }},
			            { "data":function(data){
							return '<a href="<?=base_url()?>budget/view/'+remove_spc(data.title)+'/'+data.id+'">'+data.title+'</a>';
			            } },
			            { "data":function(data){
			              if(data.update_datetime!=null){
			                return data.update_datetime;
			              }else{
			                return data.create_datetime;
			              }      
			            } },
			        ],
			     });

				$('#information').dataTable({
			        "ajax": "<?=base_url();?>search/information/?"+$('#form-search').serialize()+"",
			        "iDisplayLength" : 10,
			        "scrollX": true,
			        "columns": [          
			            { render: function (data, type, row, meta) {
			                return meta.row + meta.settings._iDisplayStart + 1;
			            }},
			            { "data":function(data){
							return '<a href="<?=base_url()?>information/view/'+remove_spc(data.title)+'/'+data.id+'">'+data.title+'</a>';
			            } },
			            { "data":function(data){
			              if(data.update_datetime!=null){
			                return data.update_datetime;
			              }else{
			                return data.create_datetime;
			              }      
			            } },
			        ],
			     });

				$('#procurement').dataTable({
			        "ajax": "<?=base_url();?>search/procurement/?"+$('#form-search').serialize()+"",
			        "iDisplayLength" : 10,
			        "scrollX": true,
			        "columns": [          
			            { render: function (data, type, row, meta) {
			                return meta.row + meta.settings._iDisplayStart + 1;
			            }},
			            { "data":function(data){
							return '<a href="<?=base_url()?>procurement/view/'+remove_spc(data.title)+'/'+data.id+'">'+data.title+'</a>';
			            } },
			            { "data":function(data){
			              if(data.update_datetime!=null){
			                return data.update_datetime;
			              }else{
			                return data.create_datetime;
			              }      
			            } },
			        ],
			    });

				$('#law').dataTable({
			        "ajax": "<?=base_url();?>search/law/?"+$('#form-search').serialize()+"",
			        "iDisplayLength" : 10,
			        "scrollX": true,
			        "columns": [          
			            { render: function (data, type, row, meta) {
			                return meta.row + meta.settings._iDisplayStart + 1;
			            }},
			            { "data":function(data){
							return '<a href="<?=base_url()?>law/view/'+remove_spc(data.title)+'/'+data.id+'">'+data.title+'</a>';
			            } },
			            { "data":function(data){
			              if(data.update_datetime!=null){
			                return data.update_datetime;
			              }else{
			                return data.create_datetime;
			              }      
			            } },
			        ],
			    });
				$('#table-requests').dataTable({
			        "ajax": "<?=base_url();?>search/requests/?"+$('#form-search').serialize()+"",
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
			});

			function remove_spc(string){
		        if(string===''){
		          return 'null';
		        }
		        return string.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '').replace(/[_\s]/g, '-')
		     }
		</script>
						
					