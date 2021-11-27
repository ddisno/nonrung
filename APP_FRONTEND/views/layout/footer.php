<style type="text/css">
	@media (max-width: 767.98px){
		#copyrights .col_half {
			text-align: left!important;
		}
		.bottommargin-header{
			font-size: 12px;
		}
	}
</style>
<!-- Footer
		============================================= -->
		<footer id="footer" class="dark" style="border-top: none">

			<!-- Copyrights
			============================================= -->
			<div id="copyrights" style="background-color: rgb(255,129,45); color: white">

				<div class="container clearfix">

					<div class="col_half">
						Copyrights &copy; 2019 <?=$abouts['company']?> All Rights Reserved by Meeting Creative.<br>
						<div class="fr-view">
							<?=htmlspecialchars_decode($abouts['text_ad_th']) ?>
						</div>
						<div class="copyright-links">
								
							

						</div>
					</div>

					<div class="col_half col_last tright">
						<div class="fright clearfix">
							<?php
							foreach ($icons as $icon) {
								switch ($icon['short_name']) {
									case 'FB':
										$ic = 'facebook';
										break;
									case 'GG':
										$ic = 'gplus';
										break;
									case 'IG':
										$ic = 'instagram';
										break;
									case 'TW':
										$ic = 'twitter';
										break;
									case 'PR':
										$ic = 'pinterest';
										break;
									case 'YT':
										$ic = 'youtube';
										break;
									case 'VO':
										$ic = 'vimeo';
										break;
									case 'GH':
										$ic = 'github';
										break;
									case 'YH':
										$ic = 'yahoo';
										break;
									case 'LK':
										$ic = 'linkedin';
										break;
								}
							?>
								<a target="_blank" href="<?=$icon['link']?>" class="social-icon si-colored si-large si-borderless si-<?=$ic?>">
									<i class="icon-<?=$ic?>"></i>
									<i class="icon-<?=$ic?>"></i>
								</a>
							<?php
							}
							?>
						</div>

						<div class="clear"></div>

						<i class="icon-envelope2"></i> <?=$abouts['email']?> <span class="middot">&middot;</span> <i class="icon-headphones"></i> <?=$abouts['tel']?> 
					</div>

				</div>

			</div><!-- #copyrights end -->

		</footer><!-- #footer end -->

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>


	<!-- Footer Scripts
	============================================= -->
	<script src="<?=$this->config->item('vendor')?>/js/functions.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('.fr-video').find('div').removeClass('fluid-width-video-wrapper');
				$('.fr-video').find('div').css('padding-top', '0');
			});
			
		</script>

</body>
</html>