<!-- Page Title
		============================================= -->
		<section id="page-title" style="padding: 30px">

			<div class="container clearfix">
				<h1><?=lang('tab_gallary')?></h1>
				<ul class="entry-meta clearfix">
					<li><a href="<?=base_url()?>gallary">อัลบั้มภาพทั้งหมด</a> </li>
					<li><i></i><?=$name_album['name_album_'.$this->language.''] ?></li>
				</ul>
			</div>

		</section><!-- #page-title end -->
<div class="container">
	<div class="col_full clearfix">
						<div class="masonry-thumbs grid-4"  data-lightbox="gallery" style="margin-right: -1px; position: relative; height: 855.75px;">
							<?php
							foreach ($gallary as $pic) {

									$src       = $this->config->item('before_uri').$pic['img_path'];
									$src_thumb = $this->config->item('before_uri').$pic['img_path_thumb'];
							?>
							<a href="<?=$src?>" data-lightbox="gallery-item" style="width: 380px; position: absolute; left: 0px; top: 0px;">
								<img class="image_fade" src="<?=$src_thumb?>" alt="<?=$pic['name_img']?>">
							</a>
							<?php
							}
							?>
							
						</div>

					</div>
</div>
