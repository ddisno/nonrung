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

			table a{
				color: #337ab7;
				font-weight: bold;
			}
		</style>
		<!-- Content
		============================================= -->


						<div class="bottommargin-slide clearfix">

							<div class="col_full bottommargin" style="margin-bottom: 25px !important;">
								<div class="fslider flex-thumb-grid grid-6" data-animation="fade" data-arrows="true" data-thumbs="false">
									<div class="flexslider">
										<div class="slider-wrap">
											<?php
												foreach ($slide_head as $key) {
													if($this->uri->segment(1)=='th'){
														$header_slide = $key['name_th'];
														$text_slide = $key['text_th'];
													}else{
														$header_slide = $key['name_en'];
														$text_slide = $key['text_en'];
													}
												?>
											<div class="slide" data-thumb="<?=$this->config->item('before_uri').$key['img_path']?>">
												<a href="#">
													<img src="<?=$this->config->item('before_uri').$key['img_path']?>" alt="">
													<div class="overlay">
														<div class="text-overlay">
															<div class="text-overlay-title">
																<h3><?=$header_slide?></h3>
															</div>
															<div class="text-overlay-meta">
																<span><?=$text_slide?></span>
															</div>
														</div>
													</div>
												</a>
											</div>
											<?php
											}
											?>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="bottommargin-header  clearfix">
							<h4>กิจกรรม<a href="<?=base_url()?>gallary" style="float: right">ดูทั้งหมด</a></h4> 
						</div>
					
						<div class="bottommargin-content clearfix">
							<div class="post-grid grid-container post-masonry clearfix" >
							<?php

							foreach ($albums as $album) {
								$no_img = 'asset/backend/img/no_img_sq.jpg';
								$date_create = date_create($album['create_datetime']);
								$date_album = date_format($date_create,'D d F Y H:i:s');

								if($album['img_path_thumb']==''){
									$src = $this->config->item('before_uri').$no_img;
								}else{
									$src = $this->config->item('before_uri').$album['img_path_thumb'];
								}
								

							?>
								<div class="entry " style="margin-bottom: 0">
									<div class="entry-image" style="margin-bottom: 20px;">
										<a href="<?=base_url();?>gallary/pictures/<?=url_title($album['name_album_'.$this->language.'']).'/'.$album['id_album']?>">
											<img class="image_fade" src="<?=$src?>" alt="Standard Post with Image">
										</a>
									</div>
									<div class="entry-title">
										<h2><a href="<?=base_url();?>gallary/pictures/<?=url_title($album['name_album_'.$this->language.'']).'/'.$album['id_album']?>"><?=$album['name_album_'.$this->language.'']?></a></h2>
									</div>
								</div>
							<?php
							}
							?>
							
						</div>
						</div>


						<div class="bottommargin-header  clearfix">
							<h4>ข่าวประชาสัมพันธ์<a href="<?=base_url()?>news" style="float: right">ดูทั้งหมด</a></h4> 
						</div>
					
						<div class="bottommargin-content clearfix">


									<div class="clear"></div>
									<div class="col_half nobottommargin">
										<?php
										foreach ($news_first as $key) {
										?>
											<div class="spost clearfix">

												<div class="entry-image">
													<a href="<?=base_url()?>news/view/<?=url_title($news_last['title']).'/'.$news_last['id']?>">
														<img class="image_fade" src="<?=($news_last['img_path']!='')? $news_last['img_path'] : $this->config->item('vendor').'img/no_img.jpg' ?>" alt="Image">
													</a>
												</div>
												<div class="entry-c">
													<div class="entry-title">
														<h4>
															<a href="<?=base_url()?>news/view/<?=url_title($key['title']).'/'.$key['id']?>">
															<?=$key['title']?>
															</a>
														</h4>
													</div>
													<ul class="entry-meta">
														<li><i class="icon-calendar3"></i><?=date('l dS \o\f F Y H:i:s', strtotime($key['create_datetime']))?></li>
													</ul>
												</div>
											</div>
										<?php
										}
										?>

									</div>

									<div class="col_half nobottommargin col_last">
										<?php
										foreach ($news_second as $key) {
										?>
											<div class="spost clearfix">

												<div class="entry-image">
													<a href="<?=base_url()?>news/view/<?=url_title($news_last['title']).'/'.$news_last['id']?>">
														<img class="image_fade" src="<?=($news_last['img_path']!='')? $news_last['img_path'] : $this->config->item('vendor').'img/no_img.jpg' ?>" alt="Image">
													</a>
												</div>
												<div class="entry-c">
													<div class="entry-title">
														<h4>
															<a href="<?=base_url()?>news/view/<?=url_title($key['title']).'/'.$key['id']?>">
															<?=$key['title']?>
															</a>
														</h4>
													</div>
													<ul class="entry-meta">
														<li><i class="icon-calendar3"></i><?=date('l dS \o\f F Y H:i:s', strtotime($key['create_datetime']))?></li>
													</ul>
												</div>
											</div>
										<?php
										}
										?>
									</div>
						</div>

						<div class="bottommargin-header  clearfix">
							<h4>ข่าวประชาสัมพันธ์ ภายนอกหน่วยงาน<a href="<?=base_url()?>othernews" style="float: right">ดูทั้งหมด</a></h4> 
						</div>
					
						<div class="bottommargin-content clearfix">
							<table class="table table-striped table-bordered dataTable" id="table_othernews" style="width: 100%">
								<thead>
									<tr>
										<th>ลำดับ</th>
										<th style="text-align: center">เรื่อง</th>
										<th style="min-width: 80px;"> วันที่อัพเดท</th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
							</table>
						</div>

						<div class="bottommargin-header  clearfix">
							<h4>ข่าวจัดซื้อจัดจ้าง<a href="<?=base_url()?>purchase" style="float: right">ดูทั้งหมด</a></h4> 
						</div>
					
						<div class="bottommargin-content clearfix">
							<table class="table table-striped table-bordered dataTable" id="table_purchase" style="width: 100%">
								<thead>
									<tr>
										<th>ลำดับ</th>
										<th style="text-align: center">เรื่อง</th>
										<th style="min-width: 80px;"> วันที่อัพเดท</th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
							</table>
						</div>

						<div class="bottommargin-header  clearfix">
							<h4>ข่าวจัดซื้อจัดจ้าง ภายนอกหน่วยงาน<a href="<?=base_url()?>otherpurchase" style="float: right">ดูทั้งหมด</a></h4> 
						</div>
					
						<div class="bottommargin-content clearfix">
							<table class="table table-striped table-bordered dataTable" id="table_otherpurchase" style="width: 100%">
								<thead>
									<tr>
										<th>ลำดับ</th>
										<th style="text-align: center">เรื่อง</th>
										<th style="min-width: 80px;"> วันที่อัพเดท</th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
							</table>
						</div>

					<script>
						$(document).ready(function() {


							$('#table_othernews').dataTable({
						        "ajax": "<?=base_url();?>home/othernews/",
						        "iDisplayLength" : 10,
						        "scrollX": true,
						         
						        "columns": [          
						            { render: function (data, type, row, meta) {
						                return meta.row + meta.settings._iDisplayStart + 1;
						            },sWidth: '30px',"className": "text-center"},
						            { "data":function(data){
										return '<a href="<?=base_url()?>othernews/view/'+remove_spc(data.title)+'/'+data.id+'">'+data.title+'</a>';
						            } },
						            { "data":function(data){
						              if(data.update_datetime!=null){
						                return data.update_datetime;
						              }else{
						                return data.create_datetime;
						              }      
						            },sWidth: '120px' },
						        ],
						    });

							$('#table_purchase').dataTable({
						        "ajax": "<?=base_url();?>home/purchase/",
						        "iDisplayLength" : 10,
						        "scrollX": true,
						        "columns": [          
						            { render: function (data, type, row, meta) {
						                return meta.row + meta.settings._iDisplayStart + 1;
						            },sWidth: '30px',"className": "text-center"},
						            { "data":function(data){
										return '<a href="<?=base_url()?>purchase/view/'+remove_spc(data.title)+'/'+data.id+'">'+data.title+'</a>';
						            } },
						            { "data":function(data){
						              if(data.update_datetime!=null){
						                return data.update_datetime;
						              }else{
						                return data.create_datetime;
						              }      
						            },sWidth: '120px'  },
						        ],
						    });

							$('#table_otherpurchase').dataTable({
						        "ajax": "<?=base_url();?>home/otherpurchase/",
						        "iDisplayLength" : 10,
						        "scrollX": true,
						        "columns": [          
						            { render: function (data, type, row, meta) {
						                return meta.row + meta.settings._iDisplayStart + 1;
						            },sWidth: '30px',"className": "text-center"},
						            { "data":function(data){
										return '<a href="<?=base_url()?>otherpurchase/view/'+remove_spc(data.title)+'/'+data.id+'">'+data.title+'</a>';
						            } },
						            { "data":function(data){
						              if(data.update_datetime!=null){
						                return data.update_datetime;
						              }else{
						                return data.create_datetime;
						              }      
						            },sWidth: '120px'  },
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
					