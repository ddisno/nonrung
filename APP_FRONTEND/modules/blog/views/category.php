
		<!-- Page Title
		============================================= -->
		<section id="page-title" style="padding: 30px">

			<div class="container clearfix">
				<h1><?=lang('tab_blog')?></h1>
				<span><?=$name_blog['name_cat_'.$this->language.''] ?></span>
			</div>

		</section><!-- #page-title end -->

		<!-- Content
		============================================= -->
		<section id="content">

			<div class="content-wrap">

				<div class="container clearfix">

					<!-- Posts
					============================================= -->
					<div id="posts" class="postcontent nobottommargin clearfix" data-layout="fitRows">
						<div class="post-grid grid-container grid-3 clearfix">
							<?php

							foreach ($blogs as $blog) {
								$date_create = date_create($blog['create_datetime']);
								$date_blog = date_format($date_create,'D d F Y H:i:s');

								$no_img = 'asset/backend/img/no_img_sq.jpg';
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
										<a href="<?=($blog['img_path_thumb']!='')? $blog['img_path_thumb'] : $this->config->item('before_uri').$no_img ?>" data-lightbox="image">
											<img class="image_fade" src="<?=($blog['img_path_thumb']!='')? $blog['img_path_thumb'] : $this->config->item('before_uri').$no_img ?>" alt="Standard Post with Image">
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
					</div><!-- #posts end -->
					
					<!-- Sidebar
					============================================= -->
					<div class="sidebar nobottommargin col_last clearfix">
						<div class="sidebar-widgets-wrap">

							<div class="widget widget_links clearfix">

								<h4><?=lang('category')?></h4>
								<ul>
									<li><a href="<?=base_url()?>blog"><?=lang('cats_all')?></a></li>
									<?php
									foreach ($cats as $cat) {
									if($this->uri->segment(1)=='th'){
											$name = $cat['name_cat_th'];
										}else{
											$name = $cat['name_cat_en'];
										}
										?>
										<li><a href="<?=base_url()?>blog/category/<?=url_title($name).'/'.$cat['id_cat'] ?>"><?=$name?></a></li>
										<?php
									}
									?>
								</ul>

							</div>

						</div>
					</div><!-- .sidebar end -->

				</div>

			</div>

		</section><!-- #content end -->

	