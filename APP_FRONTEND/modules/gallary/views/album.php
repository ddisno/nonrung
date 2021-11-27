
		<!-- Page Title
		============================================= -->
		<section id="page-title" style="padding: 30px">

			<div class="container clearfix">
				<h1><?=lang('tab_gallary')?></h1>
			</div>

		</section><!-- #page-title end -->

		<!-- Content
		============================================= -->
		<section id="content">

			<div class="content-wrap">

				<div class="container clearfix">

					<!-- Posts
					============================================= -->
						<div class="post-grid grid-container post-masonry clearfix">
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
								<div class="entry clearfix">
									<div class="entry-image">
										<a href="<?=base_url();?>gallary/pictures/<?=url_title($album['name_album_'.$this->language.'']).'/'.$album['id_album']?>">
											<img class="image_fade" src="<?=$src?>" alt="Standard Post with Image">
										</a>
									</div>
									<div class="entry-title">
										<h2><a href="<?=base_url();?>gallary/pictures/<?=url_title($album['name_album_'.$this->language.'']).'/'.$album['id_album']?>"><?=$album['name_album_'.$this->language.'']?></a></h2>
									</div>
									<ul class="entry-meta clearfix">
										<li><i class="icon-calendar3"></i> <?=$date_album?></li>
									</ul>
								</div>
							<?php
							}
							?>
							
						</div>
				</div>

			</div>

		</section><!-- #content end -->

