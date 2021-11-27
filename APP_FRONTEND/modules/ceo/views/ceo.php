
		<!-- Page Title
		============================================= -->
		<section id="page-title" class="page-title-mini">

			<div class="container clearfix">
				<h1><?=$header?></h1>
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
							$text = htmlspecialchars_decode($ceo['text_th']);
						}else{
							$text = htmlspecialchars_decode($ceo['text_en']);
						}

						echo $text;
						?>
					</div>

					<div class="clear"></div>

				</div>

			</div>

		</section><!-- #content end -->

	