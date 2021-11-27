
		<!-- Page Title
		============================================= -->
		<section id="page-title" class="page-title-mini">

			<div class="container clearfix">
				<h1><?=lang('tab_about')?></h1>
			</div>

		</section><!-- #page-title end -->

		<!-- Content
		============================================= -->
		
		<section id="content">

			<div class="content-wrap">

				<div class="container clearfix">
					<div class="fr-view" id="fr-view-custom">
						<?php

						if($this->uri->segment(1)=='th'){
							$text = htmlspecialchars_decode($abouts['text_th']);
						}else{
							$text = htmlspecialchars_decode($abouts['text_en']);
						}

						echo $text;
						?>
					</div>
					<div class="clear"></div>

					<div class="promo promo-light bottommargin" style="margin-top: 50px;">
						<h3><?=lang('contacts_call')?> <span><?=$abouts['tel']?> </span> <?=lang('contacts_email')?> <span><?=$abouts['email']?></span></h3>
						<span><?=lang('contacts_support')?></span>
						<a href="<?=base_url();?>contact" class="button button-dark button-xlarge button-rounded"><?=lang('btn_contact')?></a>
					</div>

				</div>

			</div>

		</section><!-- #content end -->

	