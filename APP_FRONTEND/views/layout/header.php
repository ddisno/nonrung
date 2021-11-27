<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
	<meta name="description" content="<?=$seo['meta_descrip']?>">
  	<meta name="keywords" content="<?=$seo['meta_keyword']?>">
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />
	<link rel="icon" href="<?=$this->config->item('vendor')?>img/favicon.png" type="image/gif" sizes="16x16">
	<!-- Stylesheets
	============================================= -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Raleway:300,400,500,600,700|Crete+Round:400i" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?=$this->config->item('vendor')?>css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="<?=$this->config->item('vendor')?>style.css" type="text/css" />
	<link rel="stylesheet" href="<?=$this->config->item('vendor')?>css/swiper.css" type="text/css" />
	
	<link rel="stylesheet" href="<?=$this->config->item('vendor')?>css/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="<?=$this->config->item('vendor')?>css/animate.css" type="text/css" />
	<link rel="stylesheet" href="<?=$this->config->item('vendor')?>css/magnific-popup.css" type="text/css" />
	<link rel="stylesheet" href="<?=$this->config->item('before_uri')?>asset/backend/plugins/froala/css/froala_style.css" type="text/css" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<link rel="stylesheet" href="<?=$this->config->item('vendor')?>css/responsive.css" type="text/css" />
	<link rel="stylesheet" href="<?=$this->config->item('before_uri')?>asset/backend/plugins/sweetalert2/dist/sweetalert2.min.css">
	<link rel="stylesheet" href="<?=$this->config->item('vendor')?>css/stylesheet.css" type="text/css" />

	<!-- Bootstrap Data Table Plugin -->
	<link rel="stylesheet" href="<?=$this->config->item('vendor')?>css/components/bs-datatable.css" type="text/css" />

	<!-- pnoty -->
	<link href="<?=$this->config->item('vendor')?>pnoty/pnotify.custom.min.css" media="all" rel="stylesheet" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- External JavaScripts
	============================================= -->
	<script src="<?=$this->config->item('vendor')?>js/jquery.js"></script>
	<script src="<?=$this->config->item('vendor')?>js/plugins.js"></script>
	<!-- Bootstrap Data Table Plugin -->
	<script src="<?=$this->config->item('vendor')?>js/components/bs-datatable.js"></script>

	<script src="<?=$this->config->item('vendor')?>pnoty/pnotify.custom.min.js"></script>
	<!-- sweetalert -->
  	<script src="<?=$this->config->item('before_uri')?>asset/backend/plugins/sweetalert2/dist/sweetalert2.min.js"></script>


	<script src="https://maps.google.com/maps/api/js?key=AIzaSyBvN8Hb2NEsZE-u0RNHvVYCUM9jiCuH2vc"></script>
	<script src="<?=$this->config->item('vendor')?>js/jquery.gmap.js"></script>
	<!-- Document Title
	============================================= -->
	<style type="text/css">
		.swal2-popup{
			font-size: 1em;
		}
		#fr-view-custom p,span,h1,h2,h3,h4,h5,h6 {
			margin:0;
			/*color: black;*/
			font-weight: normal;
		}

		#fr-view-custom p{
			margin-bottom: 10px;
		}

		#fr-view-custom h1,h2,h3,h4,h5,h6{
		    margin-top: 20px;
		    margin-bottom: 10px;
		}

		#fr-view-custom h3>span{
			color: black;
		}

		.current{
		    background-color: white !important;
		}

		#primary-menu.style-2 > div > ul > li > a:hover{
			color:white;
		}

		.current > a:hover{
			color: #f99d5a !important;
		}
		/*@media only screen and (max-width: 760px), (max-device-width: 1024px) and (min-device-width: 768px){
		table, thead, tbody, th, td, tr {
		     display: block; 
		     width: 100% !important;
		}}*/
			.content-wrap{
				background-color: #f8f9fa !important;	
			}

			.bottommargin-content, .bottommargin-header{
				background-color: white;
				margin: 10px;
				box-shadow: 1px 1px 1px 1px #ddd;
				padding: 10px;
				margin-bottom: 25px !important;
			}

			.bottommargin-slide{
				margin: 10px;
				padding: 0px;
				margin-bottom: 0px !important;
			}

			.bottommargin-header{
				margin-bottom: 10px !important;
				background-color: #f99d5a;
			}

			.bottommargin-header h4{
				color: white;
			}

			.bottommargin-header a{
				color: white;
			}

			h4{
				margin: 0px !important;
			}

			.content-wrap{
				padding-top: 5px !important;
			}

			@media (max-width: 991.98px){
				#logo{
				     height: auto;
				}
				#before-logo{
					padding-bottom: 0px !important;
				}
				.col-lg-9{
					padding-right: 15px !important;
				}
				.col-lg-3{
					padding-left: 15px !important;
				}
			}

	</style>
	<style type="text/css">
@media (max-width: 1400px){
	#primary-menu ul li a div{
		font-size: 13px !important;
	}
	
}

@media(min-width: 1400px){
	body{
		background-size: 100%
	}
}

@media (max-width: 1200px){
	#primary-menu ul li a div{
		font-size: 12px !important;
	}
}

@media (max-width: 991px){
	#primary-menu ul li a div{
		font-size: 13px !important;
	}
}

@media (max-width: 600px){
	#top-cart{
		display: block !important;
		right: 40px;
	}	
	.bottommargin-header h4{
		font-size: 14px !important;
	}

	.bottommargin-header a{
		font-size: 14px !important;
	}
}

@media (max-width: 400px;){
	
}




#header, #header-wrap, #logo img{
	height: auto !important;
}
#primary-menu ul li > a {
	color: white;
	font-weight: 200 !important;
	font-size: 14px !important;
}
#primary-menu.style-2 {

    border-top: none;
}
.he-text{
	color: white;
}

.he-text span{
	color: white !important;
}

.header-extras li i{
	color: white;
}
.sfHover > a{
	color: white !important;
}
.current >a{
	color: #f99d5a !important;
}
#primary-menu ul ul li:hover > a {
    color: #f99d5a !important;
}

/*.sf-with-ul{
	color: white !important;
}*/



.icon-reorder{
	color: white !important;
}

@media (max-width: 992px){
	#top-cart{
		display: block !important;
		right: 40px;
	}

	#primary-menu ul ul li > a {
		color:white;
	}

	#primary-menu ul ul li:hover >a{
		color:white !important;
		font-weight: normal;
	}

	.sub-2 div:hover {
		color:white !important;
		font-weight: normal;
	}

	.sfHover > a div{
		color: white !important;
		font-weight: normal;
	}

	.sub-3 div:hover {
		color:white !important;
		font-weight: normal;
	}
	#primary-menu > ul > li.sub-menu > a, #primary-menu > .container > ul > li.sub-menu > a {
    background-image: url(<?=$this->config->item('vendor')?>images/icons/submenu-dark.png);
    background-position: right center;
    background-repeat: no-repeat;
}

#primary-menu ul ul > li.sub-menu > a, #primary-menu ul ul > li.sub-menu:hover > a {
    background-image: url(<?=$this->config->item('vendor')?>images/icons/submenu-dark.png);
    background-position: right center;
    background-repeat: no-repeat;
 }
}

@media (max-width: 575.98px)
{
	#top-search a {
	    right: 20px;
	}
}
@media (max-width: 991.98px)
{
	#top-search a {
	    right: 20px;
	}
}

.header-extras li .he-text{
	font-weight: normal;
}

.header-extras li a i:hover{
	color: white;
}
a{
	color: black;
}
a:hover{
	color: #e19d2e;
}

table a{
	color: #337ab7;
	font-weight: bold;
}

/*.slider-arrow-left, .slider-arrow-right, .flex-prev, .flex-next, .slider-arrow-top-sm, .slider-arrow-bottom-sm {
	background-color: white !important;
}*/
</style>
	<script type="text/javascript">
		$(function(){

			if($('#primary-menu ul li').hasClass('current')){
				return false;
			}else{
				// $('#first-menu').addClass('current');
			}
		})


	</script>

	<title><?=$title?></title>
</head>

<body id="body_full" style="background-image: url('<?=$this->config->item('vendor')?>images/customize/background.jpg'); background-attachment: fixed;background-repeat: no-repeat;">
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v3.2&appId=521101338354519&autoLogAppEvents=1"></script>
	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix" style="background-color: transparent;">
				<!-- Header
		============================================= -->
		<header id="header" class="sticky-style-2 " style="background-color:rgb(255,129,45);">
			<img src="<?=$logo?>" style="width: 100%">
			
			<div id="header-wrap">
			<!-- Primary Navigation============================================= -->
				<nav id="primary-menu" class="style-2" style="background-color:rgb(255,129,45);">
					<div class="container clearfix">
						<div id="primary-menu-trigger"><i class="icon-reorder"></i></div>
<?php
	
$menu = new Menu;

?>


						<ul>
							<li class="<?=$menu->active('home')?>" id="first-menu">
								<a  href="<?=base_url();?>home"><div>หน้าแรก</div></a>
							</li>
							<li class="<?=$menu->active('personal')?>">
								<a href="<?=base_url();?>personal"><div>ทำเนียบบุคลากร</div></a>
								<ul>
									<?php
									foreach ($personal as $key) {
										?>
										<li>
											<a href="<?=base_url();?>personal/view/<?=url_title($key['title']).'/'.$key['id']?>" class="sub-2">
												<div><?=$key['title']?></div>
											</a>
										</li>
										<?php
									}
									?>
								</ul>
							</li>
							<li class="<?=$menu->active('information')?>">
								<a href="<?=base_url();?>information"><div>ข้อมูลพื้นฐาน</div></a>
								<ul>
									<?php
									foreach ($information as $key) {
										?>
										<li>
											<a href="<?=base_url();?>information/view/<?=url_title($key['title']).'/'.$key['id']?>" class="sub-2">
												<div><?=$key['title']?></div>
											</a>
										</li>
										<?php
									}
									?>
								</ul>
							</li>
							<li class="<?=$menu->active('law')?>">
								<a href="<?=base_url();?>law"><div>กฏหมายที่น่ารู้</div></a>
								<ul>
									<?php
									foreach ($law as $key) {
										?>
										<li>
											<a href="<?=base_url();?>law/view/<?=url_title($key['title']).'/'.$key['id']?>" class="sub-2">
												<div><?=$key['title']?></div>
											</a>
										</li>
										<?php
									}
									?>
								</ul>
							</li>

							<li class="<?=$menu->active('budget')?>">
								<a href="<?=base_url();?>budget"><div>งบประมาณ</div></a>
								<ul>
									<?php
									foreach ($budget as $key) {
										?>
										<li>
											<a href="<?=base_url();?>budget/view/<?=url_title($key['title']).'/'.$key['id']?>" class="sub-2">
												<div><?=$key['title']?></div>
											</a>
										</li>
										<?php
									}
									?>
								</ul>
							</li>

							<li class="<?=$menu->active('procurement')?>">
								<a href="<?=base_url();?>procurement"><div>งานพัสดุ</div></a>
								<ul>
									<?php
									foreach ($procurement as $key) {
										?>
										<li>
											<a href="<?=base_url();?>procurement/view/<?=url_title($key['title']).'/'.$key['id']?>" class="sub-2">
												<div><?=$key['title']?></div>
											</a>
										</li>
										<?php
									}
									?>
								</ul>
							</li>

							<li class="<?=$menu->active('contact')?>">
								<a href="<?=base_url();?>contact"><div>ติดต่อเรา</div></a>
							</li>
							
						</ul>

						<style type="text/css">
							#top-search a{
								color: white;
							}
							#top-search form input {
								color: white;
								font-size: 22px;
							}
							#top-search form input::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
							  color: white !important;
							  opacity: 1; /* Firefox */
							  font-size: 22px;
							}
						</style>

						<!-- Top Search
						============================================= -->
						<div id="top-search">
							<a href="#" id="top-search-trigger"><i class="icon-search3"></i><i class="icon-line-cross"></i></a>
							<form action="<?=base_url()?>search" method="get">
								<input type="text" name="word" class="form-control" value="" placeholder="ค้นหา..." required>
							</form>
						</div><!-- #top-search end -->

					</div>
				</nav><!-- #primary-menu end -->
			</div>
		</header><!-- #header end -->
			<section id="content">
				<div class="content-wrap" style="padding: 5px">
					<div class="row">
						<div class="col-lg-9 bottommargin clearfix" style="padding-right: 0">
		<script type="text/javascript">

			function remove_spc(string){
		       if(string===''){
		          return 'null';
		       }
		        
		        return string.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '').replace(/[_\s]/g, '-')
		    }


		</script>