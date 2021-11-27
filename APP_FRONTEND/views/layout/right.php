</div>

<style type="text/css">
	.bottommargin-content-right{
		margin: 15px;
	}
</style>

<div class="col-lg-3" style="padding-left: 0">
						<div class="row">
							<!--<div class="col-sm-6 col-md-6 col-lg-12">
								<a href="#">
								<div class="widget clearfix" style="padding-left: 10px;">
									<div class="bottommargin bottommargin-content-right  clearfix" 
									style="margin-left: 0;height: auto;margin-bottom: 0 !important;height: auto;max-width: 400px;">
										<img src="<?=$this->config->item('vendor')?>images/customize/president.jpg" style="width: 100%">
									</div>
								</div>
								</a>
							</div>-->
							<div class="col-sm-6 col-md-6 col-lg-12">
								<a href="<?=base_url();?>forum">
								<div class="widget clearfix" style="padding-left: 10px;">
									<div class="bottommargin bottommargin-content-right  clearfix" 
									style="margin-left: 0;height: auto;margin-bottom: 0 !important;height: auto;max-width: 400px;">
										<img src="<?=$this->config->item('vendor')?>images/customize/webboard1.jpg" style="width: 100%">
									</div>
								</div>
								</a>
							</div>
							<div class="col-sm-6 col-md-6 col-lg-12">
								<a href="<?=base_url()?>gallary">
								<div class="widget clearfix" style="padding-left: 10px;">
									<div class="bottommargin bottommargin-content-right  clearfix" 
									style="margin-left: 0;height: auto;margin-bottom: 0 !important;height: auto;max-width: 400px;">
										<img src="<?=$this->config->item('vendor')?>images/customize/gallary.jpg" style="width: 100%">
									</div>
								</div>
								</a>
						
							</div>
							<div class="col-sm-6 col-md-6 col-lg-12">
								<a href="<?=base_url()?>news">
								<div class="widget clearfix" style="margin-top: 10px !important;padding-left: 10px;">
									<div class="bottommargin bottommargin-content-right  clearfix" 
									style="margin-left: 0;height: auto;margin-bottom: 0 !important;height: auto;max-width: 400px;">
										<img src="<?=$this->config->item('vendor')?>images/customize/news.jpg" style="width: 100%">
								
									</div>
								</div>
								</a>
							</div>
							<div class="col-sm-6 col-md-6 col-lg-12">
								<a href="<?=base_url()?>othernews">
								<div class="widget clearfix" style="margin-top: 10px !important;padding-left: 10px;">
									<div class="bottommargin bottommargin-content-right  clearfix" 
									style="margin-left: 0;height: auto;margin-bottom: 0 !important;height: auto;max-width: 400px;">
										<img src="<?=$this->config->item('vendor')?>images/customize/othernews.jpg" style="width: 100%">
								
									</div>
								</div>
								</a>
							</div>
							<div class="col-sm-6 col-md-6 col-lg-12">
								<a href="<?=base_url()?>purchase">
								<div class="widget clearfix" style="margin-top: 10px !important;padding-left: 10px;">
									<div class="bottommargin bottommargin-content-right  clearfix" 
									style="margin-left: 0;height: auto;margin-bottom: 0 !important;height: auto;max-width: 400px;">
										<img src="<?=$this->config->item('vendor')?>images/customize/purchase.jpg" style="width: 100%">
					
									</div>
								</div>
								</a>
							</div>
							<div class="col-sm-6 col-md-6 col-lg-12">
								<a href="<?=base_url()?>otherpurchase">
								<div class="widget clearfix" style="margin-top: 10px !important;padding-left: 10px;">
									<div class="bottommargin bottommargin-content-right  clearfix" 
									style="margin-left: 0;height: auto;margin-bottom: 0 !important;height: auto;max-width: 400px;">
										<img src="<?=$this->config->item('vendor')?>images/customize/otherpurchase.jpg" style="width: 100%">
							
									</div>
								</div>
								</a>
							</div>
							<div class="col-sm-6 col-md-6 col-lg-12">
								<a href="<?=base_url()?>budget">
								<div class="widget clearfix" style="margin-top: 10px !important;padding-left: 10px;">
									<div class="bottommargin bottommargin-content-right  clearfix" 
									style="margin-left: 0;height: auto;margin-bottom: 0 !important;height: auto;max-width: 400px;">
										<img src="<?=$this->config->item('vendor')?>images/customize/budged.jpg" style="width: 100%">
						
									</div>
								</div>
								</a>
							</div>
							<div class="col-sm-6 col-md-6 col-lg-12">
								<a href="<?=base_url()?>procurement">
								<div class="widget clearfix" style="margin-top: 10px !important;padding-left: 10px;">
									<div class="bottommargin bottommargin-content-right  clearfix" 
									style="margin-left: 0;height: auto;margin-bottom: 0 !important;height: auto;max-width: 400px;">
										<img src="<?=$this->config->item('vendor')?>images/customize/procurement.jpg" style="width: 100%">
						
									</div>
								</div>
								</a>
							</div>
							
						</div>

						<div class="widget clearfix" style="margin-top: 20px;">
							<div class="tabs nobottommargin clearfix" id="sidebar-tabs" style="padding-right: 10px; padding-left: 10px;">
								<ul class="tab-nav clearfix">
									<li><a href="#tabs-1">ความรู้เกี่ยวกับ อบต.</a></li>
									<!-- <li><a href="#tabs-2">Recent</a></li>
									<li><a href="#tabs-3"><i class="icon-comments-alt norightmargin"></i></a></li> -->
								</ul>

								<style type="text/css">
									.spost{
										padding-top: 5px;
										margin-top: 5px;
									}
								</style>

								<div class="tab-container">
									<div class="tab-content clearfix" id="tabs-1">
													<div id="popular-post-list-sidebar">
														<?php
														$i==1;
														foreach ($knowledge as $key) {
															# code...
														?>
														<div class="spost clearfix">
															<div class="entry-image" style="width: 10px; height: auto">
															<img class="rounded-circle" src="<?=$this->config->item('vendor')?>img/stick.png" alt="" 
															style="width: 10px; height: auto">
														</div>
															<div class="entry-c">
																<div class="entry-title">
																	<h4><a href="<?=base_url()?>knowledge/view/<?=url_title($key['title']).'/'.$key['id']?>"><?=$key['title']?></a></h4>
																</div>
															</div>
														</div>
														<?php
														$i++;
														}
														if ($i==8) {
															?>
															<div class="spost clearfix">
																<div class="entry-image" style="width: 10px; height: auto">
															</div>
																<div class="entry-c">
																	<div class="entry-title" style="text-align: right">
																		<h4><a href="<?=base_url()?>knowledge">ดูทั้งหมด....</a></h4>
																	</div>
																</div>
															</div>
															<?php
														}
														?>
													</div>
									</div>
									
								</div>
							</div>
						</div>

						<div class="widget clearfix" style="margin-top: 10px !important; padding-left: 10px; margin-bottom: 20px;">
							<div class="row">
								<div class="col-sm-6 col-md-6 col-lg-12">
									<a href="<?=base_url()?>information" target="">
										<div class="bottommargin bottommargin-content-right  clearfix" 
										style="margin-left: 0;height: auto;margin-bottom: 0 !important;height: auto;max-width: 400px;">
											<img src="<?=$this->config->item('vendor')?>images/customize/information.jpg" style="width: 100%">
								
										</div>	
									</a>
								</div>
								
								<div class="col-sm-6 col-md-6 col-lg-12">
									<a href="<?=base_url()?>law" target="">
										<div class="bottommargin bottommargin-content-right  clearfix" 
										style="margin-left: 0;height: auto;margin-bottom: 0 !important;height: auto;max-width: 400px;">
											<img src="<?=$this->config->item('vendor')?>images/customize/law.jpg" style="width: 100%">
									
										</div>	
									</a>
								</div>
								<div class="col-sm-6 col-md-6 col-lg-12">
									<a href="<?=base_url()?>ita" target="">
										<div class="bottommargin bottommargin-content-right  clearfix" 
										style="margin-left: 0;height: auto;margin-bottom: 0 !important;height: auto;max-width: 400px;">
											<img src="<?=$this->config->item('vendor')?>images/customize/ita.jpg" style="width: 100%">
								
										</div>	
									</a>
								</div>
								<div class="col-sm-6 col-md-6 col-lg-12">
									<a href="http://webmail.nonrung.go.th/" target="_blank">
										<div class="bottommargin bottommargin-content-right  clearfix" 
										style="margin-left: 0;height: auto;margin-bottom: 0 !important;height: auto;max-width: 400px;">
											<img src="<?=$this->config->item('vendor')?>images/customize/webmail.jpg" style="width: 100%">
									
										</div>	
									</a>
								</div>

							</div>
						</div>

						<div class="widget clearfix" style="margin-top: 20px;">
							<div class="tabs nobottommargin clearfix" id="sidebar-tabs" style="padding-right: 10px; padding-left: 10px;">
								<ul class="tab-nav clearfix">
									<li><a href="#tabs-1">เว็บไซต์ที่เกี่ยวข้อง</a></li>
									<!-- <li><a href="#tabs-2">Recent</a></li>
									<li><a href="#tabs-3"><i class="icon-comments-alt norightmargin"></i></a></li> -->
								</ul>

								<style type="text/css">
									.spost{
										padding-top: 5px;
										margin-top: 5px;
									}
								</style>

								<div class="tab-container">
									<div class="tab-content" id="tabs-1">
													<div id="popular-post-list-sidebar">
														<?php
														foreach ($toweb as $key) {
															# code...
														?>
														<div class="spost clearfix">
															<div class="entry-c">
																<div class="entry-title">
																	<h4><i class="fa fa-link"></i>&nbsp;&nbsp;&nbsp;<a href="<?=$key['link']?>"><?=$key['title']?></a></h4>
																</div>
															</div>
														</div>
														<?php
														}
														?>
													</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section><!-- #content end -->