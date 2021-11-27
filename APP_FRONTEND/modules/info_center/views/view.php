<?php
	

	if($this->uri->segment(1) == 'th'){
		$name = $info_centers['name_th'];
		$name_cat = $info_centers['name_cat_th'];
		$text = $info_centers['text_th'];
	}else{
		$name = $info_centers['name_en'];
		$name_cat = $info_centers['name_cat_en'];
		$text = $info_centers['text_en'];
	}


	$date_create = date_create($info_centers['create_datetime']);
	$date_info_centers = date_format($date_create,'D d F Y H:i:s');
?>


		<!-- Page Title
		============================================= -->
		<section id="page-title">

			<div class="container clearfix">
				<h1 style="margin-bottom: 5px;"><?=$name?></h1>
				<ul class="entry-meta clearfix">
					<li><i class="icon-calendar3"></i> <?=$date_info_centers?></li>
					<li><a href="#"> <?=$name_cat?></a></li>
				</ul><!-- .entry-meta end -->			
			</div>

		</section><!-- #page-title end -->

		<!-- Content
		============================================= -->
		<section id="content">

			<div class="content-wrap">

				<div class="container clearfix">

					<div class="single-post nobottommargin">

						<!-- Single Post
						============================================= -->
						<div class="entry clearfix">

							<!-- Entry Content
							============================================= -->
							<div class="entry-content notopmargin">
								<div class="fr-view" id="fr-view-custom">
									<?=htmlspecialchars_decode($text)?>
								</div>
								<div class="clear"></div>

							</div>
						</div><!-- .entry end -->

					</div>

				</div>

			</div>

		</section><!-- #content end -->
