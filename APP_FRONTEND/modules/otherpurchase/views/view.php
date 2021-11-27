


		<!-- Page Title
		============================================= -->
		<section id="page-title">

			<div class="container clearfix">
				<h1 style="margin-bottom: 5px;"><?=$otherpurchase['title']?></h1>
				<ul class="entry-meta clearfix">
					<li><a href="<?=base_url()?>otherpurchase">ข่าวสารจัดซื้อจัดจ้าง ภายนอกหน่วยงาน</a> </li>
					<li><i class="icon-calendar3"></i><?=date('l dS \o\f F Y H:i:s', strtotime($otherpurchase['update_datetime']))?></li>
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
									<?=htmlspecialchars_decode($otherpurchase['text'])?>
								</div>
								<div class="clear"></div>

							</div>
						</div><!-- .entry end -->

					</div>

				</div>

			</div>

		</section><!-- #content end -->
