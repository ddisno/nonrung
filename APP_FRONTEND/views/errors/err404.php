<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

 
		<!-- Page Title
		============================================= -->
		<section id="page-title">

			<div class="container clearfix">
				<h1>Page Not Found</h1>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item"><a href="#">Pages</a></li>
					<li class="breadcrumb-item active" aria-current="page">404</li>
				</ol>
			</div>

		</section><!-- #page-title end -->

		<!-- Content
		============================================= -->
		<section id="content">

			<div class="content-wrap">

				<div class="container clearfix">

					<div class="col_half nobottommargin">
						<div class="error404 center">404</div>
					</div>

					<div class="col_half nobottommargin col_last">

						<div class="heading-block nobottomborder">
							<h4>Ooopps.! The Page you were looking for, couldn't be found.</h4>
							<span>Try searching for the best match or browse the links below:</span>
						</div>

						<div class="col_one_third widget_links topmargin nobottommargin">
							<ul>
								<li><a href="<?=base_url();?>home"><div><?=lang('menu_home')?></div></a></li>
								<li><a href="<?=base_url();?>about"><div><?=lang('menu_about')?></div></a></li>
								<li><a href="<?=base_url();?>products"><div><?=lang('menu_products')?></div></a></li>
							</ul>
						</div>

						<div class="col_one_third widget_links topmargin nobottommargin">
							<ul>
								<li><a href="<?=base_url();?>promotion"><div><?=lang('menu_promotion')?></div></a></li>
								<li><a href="<?=base_url();?>blog"><div><?=lang('menu_news')?></div></a></li>
								<li><a href="<?=base_url();?>career"><div><?=lang('menu_career')?></div></a></li>
							</ul>
						</div>

						<div class="col_one_third widget_links topmargin nobottommargin col_last">
							<ul>
								<li><a href="<?=base_url();?>payment"><div><?=lang('menu_payment')?></div></a></li>
								<li><a href="<?=base_url();?>contact"><div><?=lang('menu_contact')?></div></a></li>
							</ul>
						</div>

					</div>

				</div>

			</div>

		</section><!-- #content end -->
