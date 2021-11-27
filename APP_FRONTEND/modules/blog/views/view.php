<?php
	if($this->uri->segment(1) == 'th'){
		$name = $blog['name_th'];
		$name_cat = $blog['name_cat_th'];
		$text = $blog['text_th'];
	}else{
		$name = $blog['name_en'];
		$name_cat = $blog['name_cat_en'];
		$text = $blog['text_en'];
	}


	$date_create = date_create($blog['create_datetime']);
	$date_blog = date_format($date_create,'D d F Y H:i:s');
?>


		<!-- Page Title
		============================================= -->
		<section id="page-title">

			<div class="container clearfix">
				<h1 style="margin-bottom: 5px;"><?=$name?></h1>
				<ul class="entry-meta clearfix">
					<li><i class="icon-calendar3"></i> <?=$date_blog?></li>
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

							<!-- Entry Image
							============================================= -->
							<div class="entry-image bottommargin">
								<a href="#"><img src="<?=$blog['img_path']?>" alt="News"></a>
							</div><!-- .entry-image end -->

							<!-- Entry Content
							============================================= -->
							<div class="entry-content notopmargin">
								<div class="fr-view" id="fr-view-custom">
									<?=htmlspecialchars_decode($text)?>
								</div>
								<div class="clear"></div>

							</div>
						</div><!-- .entry end -->

						<h4>Related Posts:</h4>

						<div class="related-posts clearfix">

							<div class="col_half nobottommargin">
								<?php
								$i=0;
								$no_img = 'asset/backend/img/no_img_sq.jpg';
								foreach ($blog['related'] as $related) {
								$i++;

									if($this->uri->segment(1) == 'th'){
										$name = $related['name_th'];
										$para = $related['para_th'];
									}else{
										$name = $related['name_en'];
										$para = $related['para_en'];
									}


									$date_create = date_create($related['create_datetime']);
									$date_blog = date_format($date_create,'D d F Y H:i:s');

								?>

								<div class="mpost clearfix">
									<div class="entry-image">
										<a href="<?=base_url();?>blog/view/<?=url_title($name).'/'.$related['id_blog']?>">
											<img src="<?=($related['img_path']!='')? $related['img_path'] : $this->config->item('before_uri').$no_img ?>" alt="<?=$name?>">
										</a>
									</div>
									<div class="entry-c">
										<div class="entry-title">
											<h4><a href="<?=base_url();?>blog/view/<?=url_title($name).'/'.$related['id_blog']?>"><?=$name?></a></h4>
										</div>
										<ul class="entry-meta clearfix">
											<li><i class="icon-calendar3"></i> <?=$date_blog?></li>
											<li><a href="#"> <?=$name_cat?></a></li>
										</ul>
										<!-- <div class="entry-content"><?=$para?></div> -->
									</div>
								</div>

								<?php
									if($i%2==0){
										?>
										</div>

										<div class="col_half nobottommargin col_last">

										<?php
									}
								}

								?>

							


							</div>

						</div>

					</div>

				</div>

			</div>

		</section><!-- #content end -->
