
		<!-- Page Title
		============================================= -->
		<section id="page-title" class="page-title-mini">

			<div class="container clearfix">
				<h1><?=lang('tab_blog')?></h1>
			</div>

		</section><!-- #page-title end -->

		<!-- Content
		============================================= -->
		<section id="content">

			<div class="content-wrap">

				<div class="container clearfix">

					<!-- Posts
					============================================= -->
						<div id="post" class="post-grid grid-container grid-3 clearfix">
							<?php

							foreach ($blogs as $blog) {
								$date_create = date_create($blog['create_datetime']);
								$date_blog = date_format($date_create,'D d F Y H:i:s');

								if($this->uri->segment(1)=='th'){
									$name = $blog['name_th'];
									$name_cat = $blog['name_cat_th'];
									$para  = $blog['para_th'];
								}else{
									$name = $blog['name_en'];
									$name_cat = $blog['name_cat_en'];
									$para  = $blog['para_en'];
								}
							?>
								<div class="entry clearfix">
									<div class="entry-image">
										<a href="<?=$blog['img_path']?>" data-lightbox="image">
											<img class="image_fade" src="<?=$blog['img_path_thumb']?>" alt="Standard Post with Image">
										</a>
									</div>
									<div class="entry-title">
										<h2><a href="<?=base_url();?>blog/view/<?=url_title($name).'/'.$blog['id_blog']?>"><?=$name?></a></h2>
									</div>
									<ul class="entry-meta clearfix">
										<li><i class="icon-calendar3"></i> <?=$date_blog?></li>
										<li><a href="#"><?=$name_cat?></a></li>
									</ul>
									<div class="entry-content">
										<?=$para?>
										<a href="<?=base_url();?>blog/view/<?=url_title($name).'/'.$blog['id_blog']?>"class="more-link"><?=lang('readmore')?></a>
									</div>
								</div>
							<?php
							}
							?>
							
						</div>
						<!-- Pagination
					============================================= -->
					<?=$links?>

				</div>

			</div>

		</section><!-- #content end -->

	