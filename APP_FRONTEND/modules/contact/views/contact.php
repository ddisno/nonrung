		<!-- Page Title
		============================================= -->
		<section id="page-title" class="page-title-mini">

			<div class="container clearfix">
				<h1><?=lang('tab_contact')?></h1>
			</div>

		</section><!-- #page-title end -->

		<!-- Content
		============================================= -->
		<section id="content">

			<div class="content-wrap">

				<div class="container clearfix">

					<!-- Contact Form
					============================================= -->
					<div class="col_full">

						<div class="fancy-title title-dotted-border" >
						
						</div>

						<div class="contact-widget">

							<div class="contact-form-result"></div>

							<form class="nobottommargin" id="template-contactform" name="template-contactform" action="<?=base_url();?>contact/sendmail" method="post">

								<div class="form-process"></div>

								<div class="col_one_third">
									<label for="template-contactform-name"><?=lang('name')?><small>*</small></label>
									<input type="text" id="template-contactform-name" name="name" value="" class="sm-form-control required" />
								</div>

								<div class="col_one_third">
									<label for="template-contactform-email"><?=lang('email')?><small>*</small></label>
									<input type="email" id="template-contactform-email" name="email" value="" class="required email sm-form-control" />
								</div>

								<div class="col_one_third col_last">
									<label for="template-contactform-phone"><?=lang('tel')?></label>
									<input type="text" id="template-contactform-phone" name="phone" value="" class="sm-form-control" />
								</div>

								<div class="clear"></div>

								<div class="col_full">
									<label for="template-contactform-subject"><?=lang('subject')?> <small>*</small></label>
									<input type="text" id="template-contactform-subject" name="subject" value="" class="required sm-form-control" />
								</div>


								<div class="clear"></div>

								<div class="col_full">
									<label for="template-contactform-message"><?=lang('message')?> <small>*</small></label>
									<textarea class="required sm-form-control" id="template-contactform-message" name="message" rows="6" cols="30"></textarea>
								</div>

								<div class="col_full hidden">
									<input type="text" id="template-contactform-botcheck" name="template-contactform-botcheck" value="" class="sm-form-control" />
								</div>

								<div class="col_full">

									<script src="https://www.google.com/recaptcha/api.js" async defer></script>
									<div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>

								</div>

								<div class="col_full">
									<button name="submit" type="submit" id="submit-button" tabindex="5" value="Submit" class="button button-3d nomargin"><?=lang('btn_contact')?></button>
								</div>

							</form>
						</div>

					</div><!-- Contact Form End -->

					<!-- Google Map
					============================================= -->
					<div class="col_full">

						<section id="google-map" style="height: 410px;">
							<?=htmlspecialchars_decode($gmap['map']) ?>
						</section>

					</div><!-- Google Map End -->

					<div class="clear"></div>

					

				</div>

			</div>

		</section><!-- #content end -->

		<script type="text/javascript">

		</script>
