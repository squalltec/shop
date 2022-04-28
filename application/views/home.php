<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

	<title>Home - EASY SHOP</title>

	<meta name="keywords" content="" />
    <meta name="description" content="">
    <meta name="author" content="Pro PC Solution">

	<?php include "include/headerscript.php"; ?>

</head>

<body class="home">
	<div class="page-wrapper">
		<?php include "include/menu.php"; ?>

		<!-- Start of Main-->
		<main class="main">
			<section class="intro-section">
				<div class="owl-carousel owl-theme owl-nav-inner owl-dot-inner owl-nav-lg animation-slider gutter-no row cols-1"
					data-owl-options="{
                    'nav': false,
                    'dots': true,
                    'items': 1,
                    'responsive': {
                        '1600': {
                            'nav': true,
                            'dots': false,
							'loop':true,
							'autoplay':true,
    						'autoplayTimeout':5000
                        }   
                    }
                }">
					<?php 
					if(count($mainslider->result())>0){
						$i=1;
						foreach($mainslider->result() as $rowmainslider){
							if ($i % 2 == 0) {
					?>
					<div class="banner banner-fixed intro-slide intro-slide2"
                        style="background-image: url(<?php echo base_url().$rowmainslider->imagepath; ?>); background-color: #ebeef2;">
                        <div class="container">
                            <!-- <figure class="slide-image skrollable slide-animate" data-animation-options="{
                                'name': 'fadeInUpShorter',
                                'duration': '1s'
                            }">
                                <img src="assets/images/demos/demo1/sliders/men.png" alt="Banner"
                                    data-bottom-top="transform: translateX(10vh);"
                                    data-top-bottom="transform: translateX(-10vh);" width="480" height="633">
                            </figure> -->
                            <div class="banner-content d-inline-block y-50">
                                <h5 class="banner-subtitle font-weight-normal text-default ls-50 slide-animate"
                                    data-animation-options="{
                                    'name': 'fadeInUpShorter',
                                    'duration': '1s',
                                    'delay': '.2s'
                                }">
                                    <?php echo $rowmainslider->titleone; ?>
                                </h5>
                                <h3 class="banner-title font-weight-bolder text-dark mb-0 ls-25 slide-animate"
                                    data-animation-options="{
                                    'name': 'fadeInUpShorter',
                                    'duration': '1s',
                                    'delay': '.4s'
                                }">
                                    <?php echo $rowmainslider->titletwo; ?>
                                </h3>
                                <p class="font-weight-normal text-default slide-animate" data-animation-options="{
                                    'name': 'fadeInUpShorter',
                                    'duration': '1s',
                                    'delay': '.8s'
                                }">
                                    <span class="font-weight-bolder text-secondary"><?php echo $rowmainslider->titlethree; ?></span>
                                </p>
                                <a href="<?php echo base_url() ?>Shop/Category/<?php echo $rowmainslider->tbl_product_category_idtbl_product_category.'/'.str_replace($rejectcontent, $replaceword, $rowmainslider->category); ?>"
                                    class="btn btn-dark btn-outline btn-rounded btn-icon-right slide-animate"
                                    data-animation-options="{
                                    'name': 'fadeInUpShorter',
                                    'duration': '1s',
                                    'delay': '1s'
                                }">
                                    SHOP NOW<i class="w-icon-long-arrow-right"></i>
                                </a>
                            </div>
                            <!-- End of .banner-content -->
                        </div>
                        <!-- End of .container -->
                    </div>
					<?php }else{ ?>
					<div class="banner banner-fixed intro-slide intro-slide<?php echo $i; ?>"
						style="background-image: url(<?php echo base_url().$rowmainslider->imagepath; ?>); background-color: #ebeef2;">
						<div class="container">
							<!-- <figure class="slide-image skrollable slide-animate">
								<img src="<?php //echo base_url() ?>images/demos/demo1/sliders/shoes.png" alt="Banner"
									data-bottom-top="transform: translateY(10vh);"
									data-top-bottom="transform: translateY(-10vh);" width="474" height="397">
							</figure> -->
							<div class="banner-content y-50 text-right">
								<h5 class="banner-subtitle font-weight-normal text-default ls-50 lh-1 mb-2 slide-animate"
									data-animation-options="{
                                    'name': 'fadeInRightShorter',
                                    'duration': '1s',
                                    'delay': '.2s'
                                }">
								<?php //$titleone=$rowmainslider->titleone; $explodeone=explode(' ', $titleone); echo $explodeone[0]; ?>
									 <!-- <span class="p-relative d-inline-block">test</span> -->
									 <?php echo $rowmainslider->titleone; ?>
								</h5>
								<h3 class="banner-title font-weight-bolder ls-25 lh-1 slide-animate"
									data-animation-options="{
                                    'name': 'fadeInRightShorter',
                                    'duration': '1s',
                                    'delay': '.4s'
                                }">
									<?php echo $rowmainslider->titletwo; ?>
								</h3>
								<p class="font-weight-normal text-default slide-animate" data-animation-options="{
                                    'name': 'fadeInRightShorter',
                                    'duration': '1s',
                                    'delay': '.6s'
                                }">
									<!-- Sale up to <span class="font-weight-bolder text-secondary">30% OFF</span> -->
									<span class="font-weight-bolder text-secondary"><?php echo $rowmainslider->titlethree; ?></span>
								</p>

								<a href="<?php echo base_url() ?>Shop/Category/<?php echo $rowmainslider->tbl_product_category_idtbl_product_category.'/'.str_replace($rejectcontent, $replaceword, $rowmainslider->category); ?>"
									class="btn btn-dark btn-outline btn-rounded btn-icon-right slide-animate"
									data-animation-options="{
                                    'name': 'fadeInRightShorter',
                                    'duration': '1s',
                                    'delay': '.8s'
                                }">SHOP NOW<i class="w-icon-long-arrow-right"></i></a>

							</div>
							<!-- End of .banner-content -->
						</div>
						<!-- End of .container -->
					</div>
					<?php }$i++;}} ?>
					<!-- End of .intro-slide1 -->
				</div>
				<!-- End of .owl-carousel -->
			</section>
			<!-- End of .intro-section -->

			<div class="container">
				<div class="owl-carousel owl-theme row cols-md-4 cols-sm-3 cols-1icon-box-wrapper appear-animate br-sm mt-6 mb-6"
					data-owl-options="{
                    'nav': false,
                    'dots': false,
                    'loop': false,
                    'responsive': {
                        '0': {
                            'items': 1
                        },
                        '576': {
                            'items': 2
                        },
                        '768': {
                            'items': 3
                        },
                        '992': {
                            'items': 3
                        },
                        '1200': {
                            'items': 4
                        }
                    }
                }">
					<div class="icon-box icon-box-side icon-box-primary">
						<span class="icon-box-icon icon-shipping">
							<i class="w-icon-truck"></i>
						</span>
						<div class="icon-box-content">
							<h4 class="icon-box-title font-weight-bold mb-1">Free Shipping & Returns</h4>
							<p class="text-default">Order above 10,000 & 7 days returns</p>
						</div>
					</div>
					<div class="icon-box icon-box-side icon-box-primary">
						<span class="icon-box-icon icon-payment">
							<i class="w-icon-bag"></i>
						</span>
						<div class="icon-box-content">
							<h4 class="icon-box-title font-weight-bold mb-1">Secure Payment</h4>
							<p class="text-default">We ensure secure payment</p>
						</div>
					</div>
					<div class="icon-box icon-box-side icon-box-primary icon-box-money">
						<span class="icon-box-icon icon-money">
							<i class="w-icon-money"></i>
						</span>
						<div class="icon-box-content">
							<h4 class="icon-box-title font-weight-bold mb-1">Money Back Guarantee</h4>
							<p class="text-default">For selected products with T & C</p>
						</div>
					</div>
					<div class="icon-box icon-box-side icon-box-primary icon-box-chat">
						<span class="icon-box-icon icon-chat">
							<i class="w-icon-chat"></i>
						</span>
						<div class="icon-box-content">
							<h4 class="icon-box-title font-weight-bold mb-1">Customer Support</h4>
							<p class="text-default">Call or email us 24/7</p>
						</div>
					</div>
				</div>
				<!-- End of Iocn Box Wrapper -->

				<div class="row category-banner-wrapper appear-animate pt-6 pb-8">
					<?php 
					if(count($topofferbanner->result())>0){
						foreach($topofferbanner->result() as $rowtopoffer){
					?>
					<div class="col-md-6 mb-4">
						<a href="<?php echo base_url() ?>Shop/Category/<?php echo $rowtopoffer->tbl_product_category_idtbl_product_category.'/'.str_replace($rejectcontent, $replaceword, $rowtopoffer->category); ?>">
						<div class="banner banner-fixed br-xs">
							<figure>
								<img src="<?php echo base_url().$rowtopoffer->imagepath ?>" alt="Category Banner"
									width="610" height="160" style="background-color: #ecedec;" />
							</figure>
							<div class="banner-content y-50 mt-0">
								<h5 class="banner-subtitle font-weight-normal text-dark"> 
								<span class="text-secondary font-weight-bolder text-uppercase ls-25"><?php echo $rowtopoffer->titleone ?></span>
								</h5>
								<h3 class="banner-title text-uppercase"><?php echo $rowtopoffer->titletwo ?><br><span
										class="font-weight-normaltext-capitalize"><?php echo $rowtopoffer->titlethree ?></span>
								</h3>
								<div class="banner-price-info font-weight-normal">
								<span class="text-secondary font-weight-bolder"><?php echo $rowtopoffer->titlefour ?></span>
								</div>
							</div>
						</div>
						</a>
					</div>
					<?php }} ?>
				</div>
				<!-- End of Category Banner Wrapper -->				
			</div>

			<div class="container">
				<h2 class="title justify-content-center ls-normal mb-4 mt-10 pt-1 appear-animate">Flash Sale
				</h2>
				<div class="tab tab-nav-boxed tab-nav-outline appear-animate">
					<ul class="nav nav-tabs justify-content-center" role="tablist">
						<li class="nav-item mr-2 mb-2">
							<a class="nav-link active br-sm font-size-md ls-normal" href="#tab1-1">New arrivals</a>
						</li>
						<li class="nav-item mr-2 mb-2">
							<a class="nav-link br-sm font-size-md ls-normal" href="#tab1-2">Best seller</a>
						</li>
						<li class="nav-item mr-2 mb-2">
							<a class="nav-link br-sm font-size-md ls-normal" href="#tab1-3">Discounted</a>
						</li>
						<li class="nav-item mr-0 mb-2">
							<a class="nav-link br-sm font-size-md ls-normal" href="#tab1-4">Featured</a>
						</li>
					</ul>
				</div>
				<!-- End of Tab -->
				<div class="tab-content product-wrapper appear-animate">
					<div class="tab-pane active pt-4" id="tab1-1">
						<?php //print_r($newarrivalproduct); ?>
						<div class="row cols-xl-5 cols-md-4 cols-sm-3 cols-2">
							<?php foreach($newarrivalproduct as $rownewarrival){ ?>
							<div class="product-wrap">
								<div class="product text-center">
									<figure class="product-media">
										<a href="<?php echo base_url().'Shop/Product/'.$rownewarrival->productid.'/'.preg_replace('/[^a-zA-Z0-9-_\.]/','', str_replace($rejectcontent, $replaceword, $rownewarrival->product)) ?>">
											<img src="<?php echo base_url().$rownewarrival->imagepath ?>" alt="<?php echo $rownewarrival->product; ?>"
												width="300" height="338" />
											<img src="<?php echo base_url().$rownewarrival->imagepath ?>" alt="<?php echo $rownewarrival->product; ?>"
												width="300" height="338" />
										</a>
										<div class="product-action-vertical">
											<?php if($rownewarrival->stock>0){ ?>
											<a href="#" class="btn-product-icon btn-cart w-icon-cart addtocart" id="<?php echo $rownewarrival->productid; ?>" title="Add to cart"></a>
											<?php } else{ ?>
											<a href="#" class="btn-product-icon btn-cart w-icon-times-circle" title="Out Stock"></a>
											<?php } ?>
										</div>
									</figure>
									<div class="product-details">
										<h4 class="product-name"><a href="<?php echo base_url().'Shop/Product/'.$rownewarrival->productid.'/'.preg_replace('/[^a-zA-Z0-9-_\.]/','', str_replace($rejectcontent, $replaceword, $rownewarrival->product)) ?>"><?php echo $rownewarrival->product; ?></a></h4>
										<div class="ratings-container">
											<div class="ratings-full">
												<span class="ratings" style="width: <?php echo round(($rownewarrival->avgrating/5)*100) ?>%;"></span>
												<span class="tooltiptext tooltip-top"></span>
											</div>
											<a href="#" class="rating-reviews">(<?php echo $rownewarrival->ratecount ?> Reviews)</a>
										</div>
										<div class="product-price">
											<?php if($rownewarrival->disprice>0){ ?>
											<ins class="new-price">Rs <?php echo number_format($rownewarrival->disprice); ?></ins>
											<del class="old-price">Rs <?php echo number_format($rownewarrival->price); ?></del>
											<?php }else{ ?>
											<ins class="new-price">Rs <?php echo number_format($rownewarrival->price); ?></ins>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
					<!-- End of Tab Pane -->
					<div class="tab-pane pt-4" id="tab1-2">
						<div class="row cols-xl-5 cols-md-4 cols-sm-3 cols-2">
							<?php foreach($bestsaleproduct as $rowbestsale){ ?>
							<div class="product-wrap">
								<div class="product text-center">
									<figure class="product-media">
										<a href="<?php echo base_url().'Shop/Product/'.$rowbestsale->productid.'/'.preg_replace('/[^a-zA-Z0-9-_\.]/','', str_replace($rejectcontent, $replaceword, $rowbestsale->product)) ?>">
											<img src="<?php echo base_url().$rowbestsale->imagepath ?>" alt="<?php echo $rowbestsale->product; ?>"
												width="300" height="338" />
											<img src="<?php echo base_url().$rowbestsale->imagepath ?>" alt="<?php echo $rowbestsale->product; ?>"
												width="300" height="338" />
										</a>
										<div class="product-action-vertical">
											<?php if($rowbestsale->stock>0){ ?>
											<a href="#" class="btn-product-icon btn-cart w-icon-cart addtocart" id="<?php echo $rowbestsale->productid; ?>" title="Add to cart"></a>
											<?php } else{ ?>
											<a href="#" class="btn-product-icon btn-cart w-icon-times-circle" title="Out Stock"></a>
											<?php } ?>
										</div>
									</figure>
									<div class="product-details">
										<h4 class="product-name"><a href="<?php echo base_url().'Shop/Product/'.$rowbestsale->productid.'/'.preg_replace('/[^a-zA-Z0-9-_\.]/','', str_replace($rejectcontent, $replaceword, $rowbestsale->product)) ?>"><?php echo $rowbestsale->product; ?></a></h4>
										<div class="ratings-container">
											<div class="ratings-full">
												<span class="ratings" style="width: <?php echo round(($rowbestsale->avgrating/5)*100) ?>%;"></span>
												<span class="tooltiptext tooltip-top"></span>
											</div>
											<a href="#" class="rating-reviews">(<?php echo $rowbestsale->ratecount ?> Reviews)</a>
										</div>
										<div class="product-price">
											<?php if($rowbestsale->disprice>0){ ?>
											<ins class="new-price">Rs <?php echo number_format($rowbestsale->disprice); ?></ins>
											<del class="old-price">Rs <?php echo number_format($rowbestsale->price); ?></del>
											<?php }else{ ?>
											<ins class="new-price">Rs <?php echo number_format($rowbestsale->price); ?></ins>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
					<!-- End of Tab Pane -->
					<div class="tab-pane pt-4" id="tab1-3">
						<div class="row cols-xl-5 cols-md-4 cols-sm-3 cols-2">
							<?php foreach($discountedproduct as $rowdiscounted){ ?>
							<div class="product-wrap">
								<div class="product text-center">
									<figure class="product-media">
										<a href="<?php echo base_url().'Shop/Product/'.$rowdiscounted->productid.'/'.preg_replace('/[^a-zA-Z0-9-_\.]/','', str_replace($rejectcontent, $replaceword, $rowdiscounted->product)) ?>">
											<img src="<?php echo base_url().$rowdiscounted->imagepath ?>" alt="<?php echo $rowdiscounted->product; ?>"
												width="300" height="338" />
											<img src="<?php echo base_url().$rowdiscounted->imagepath ?>" alt="<?php echo $rowdiscounted->product; ?>"
												width="300" height="338" />
										</a>
										<div class="product-action-vertical">
											<?php if($rowdiscounted->stock>0){ ?>
											<a href="#" class="btn-product-icon btn-cart w-icon-cart addtocart" id="<?php echo $rowdiscounted->productid; ?>" title="Add to cart"></a>
											<?php } else{ ?>
											<a href="#" class="btn-product-icon btn-cart w-icon-times-circle" title="Out Stock"></a>
											<?php } ?>
										</div>
										<div class="product-label-group">
                                            <label class="product-label label-discount"><?php echo $rowdiscounted->discount ?>% Off</label>
                                        </div>
									</figure>
									<div class="product-details">
										<h4 class="product-name"><a href="<?php echo base_url().'Shop/Product/'.$rowdiscounted->productid.'/'.preg_replace('/[^a-zA-Z0-9-_\.]/','', str_replace($rejectcontent, $replaceword, $rowdiscounted->product)) ?>"><?php echo $rowdiscounted->product; ?></a></h4>
										<div class="ratings-container">
											<div class="ratings-full">
												<span class="ratings" style="width: <?php echo round(($rowdiscounted->avgrating/5)*100) ?>%;"></span>
												<span class="tooltiptext tooltip-top"></span>
											</div>
											<a href="#" class="rating-reviews">(<?php echo $rowdiscounted->ratecount ?> Reviews)</a>
										</div>
										<div class="product-price">
											<?php if($rowdiscounted->disprice>0){ ?>
											<ins class="new-price">Rs <?php echo number_format($rowdiscounted->disprice); ?></ins>
											<del class="old-price">Rs <?php echo number_format($rowdiscounted->price); ?></del>
											<?php }else{ ?>
											<ins class="new-price">Rs <?php echo number_format($rowdiscounted->price); ?></ins>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
					<!-- End of Tab Pane -->
					<div class="tab-pane pt-4" id="tab1-4">
						<div class="row cols-xl-5 cols-md-4 cols-sm-3 cols-2">
							<?php foreach($featuredproduct as $rowfeatured){ ?>
							<div class="product-wrap">
								<div class="product text-center">
									<figure class="product-media">
										<a href="<?php echo base_url().'Shop/Product/'.$rowfeatured->productid.'/'.preg_replace('/[^a-zA-Z0-9-_\.]/','', str_replace($rejectcontent, $replaceword, $rowfeatured->product)) ?>">
											<img src="<?php echo base_url().$rowfeatured->imagepath ?>" alt="<?php echo $rowfeatured->product; ?>"
												width="300" height="338" />
											<img src="<?php echo base_url().$rowfeatured->imagepath ?>" alt="<?php echo $rowfeatured->product; ?>"
												width="300" height="338" />
										</a>
										<div class="product-action-vertical">
											<?php if($rowfeatured->stock>0){ ?>
											<a href="#" class="btn-product-icon btn-cart w-icon-cart addtocart" id="<?php echo $rowfeatured->productid; ?>" title="Add to cart"></a>
											<?php } else{ ?>
											<a href="#" class="btn-product-icon btn-cart w-icon-times-circle" title="Out Stock"></a>
											<?php } ?>
										</div>
									</figure>
									<div class="product-details">
										<h4 class="product-name"><a href="<?php echo base_url().'Shop/Product/'.$rowfeatured->productid.'/'.preg_replace('/[^a-zA-Z0-9-_\.]/','', str_replace($rejectcontent, $replaceword, $rowfeatured->product)) ?>"><?php echo $rowfeatured->product; ?></a></h4>
										<div class="ratings-container">
											<div class="ratings-full">
												<span class="ratings" style="width: <?php echo round(($rowfeatured->avgrating/5)*100) ?>%;"></span>
												<span class="tooltiptext tooltip-top"></span>
											</div>
											<a href="#" class="rating-reviews">(<?php echo $rowfeatured->ratecount ?> Reviews)</a>
										</div>
										<div class="product-price">
											<?php if($rowfeatured->disprice>0){ ?>
											<ins class="new-price">Rs <?php echo number_format($rowfeatured->disprice); ?></ins>
											<del class="old-price">Rs <?php echo number_format($rowfeatured->price); ?></del>
											<?php }else{ ?>
											<ins class="new-price">Rs <?php echo number_format($rowfeatured->price); ?></ins>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
					<!-- End of Tab Pane -->
				</div>
				<!-- End of Tab Content -->

				<div class="row category-cosmetic-lifestyle appear-animate mb-5">
					<?php 
					if(count($middleofferbanner->result())>0){
						foreach($middleofferbanner->result() as $rowmiddleoffer){
					?>
					<div class="col-md-6 mb-4">
						<a href="<?php echo base_url() ?>Shop/Category/<?php echo $rowmiddleoffer->tbl_product_category_idtbl_product_category.'/'.str_replace($rejectcontent, $replaceword, $rowmiddleoffer->category); ?>">
						<div class="banner banner-fixed category-banner-1 br-xs">
							<figure>
								<img src="<?php echo base_url().$rowmiddleoffer->imagepath ?>" alt="Category Banner"
									width="610" height="200" style="background-color: #3B4B48;" />
							</figure>
							<div class="banner-content y-50 pt-1">
								<h5 class="banner-subtitle font-weight-bold text-uppercase"><?php echo $rowmiddleoffer->titleone ?></h5>
								<h3 class="banner-title font-weight-bolder text-capitalize text-white"><?php echo $rowmiddleoffer->titletwo ?></h3>
								<a href="shop-banner-sidebar.html"
									class="btn btn-white btn-link btn-underline btn-icon-right">Shop Now<i
										class="w-icon-long-arrow-right"></i></a>
							</div>
						</div>
						</a>
					</div>
					<?php }} ?>
				</div>
				<!-- End of Category Cosmetic Lifestyle -->
				<?php 
				// print_r($offercategoryproducts); 
				foreach(array_slice($offercategoryproducts, 0, 1) as $rowoffercategoryproducts){				
				?>
				<div class="product-wrapper-1 appear-animate mb-5">
					<div class="title-link-wrapper pb-1 mb-4">
						<h2 class="title ls-normal mb-0"><?php echo $rowoffercategoryproducts->category ?></h2>
						<a href="<?php echo base_url() ?>Shop/Category/<?php echo $rowoffercategoryproducts->categoryid.'/'.str_replace($rejectcontent, $replaceword, $rowoffercategoryproducts->category); ?>" class="font-size-normal font-weight-bold ls-25 mb-0">More
							Products<i class="w-icon-long-arrow-right"></i></a>
					</div>
					<div class="row">
						<div class="col-lg-3 col-sm-4 mb-4">
							<div class="banner h-100 br-sm" style="background-image: url(<?php echo base_url().$rowoffercategoryproducts->categoryimage ?>); 
                                background-color: #ebeced;">
								<div class="banner-content content-top">
									<h5 class="banner-subtitle font-weight-normal mb-2"><?php echo $rowoffercategoryproducts->titleone ?></h5>
									<hr class="banner-divider bg-dark mb-2">
									<h3 class="banner-title font-weight-bolder ls-25 text-uppercase">
										<?php echo $rowoffercategoryproducts->titletwo ?><br> <span
											class="font-weight-normal text-capitalize"><?php echo $rowoffercategoryproducts->titlethree ?></span>
									</h3>
									<a href="<?php echo base_url() ?>Shop/Category/<?php echo $rowoffercategoryproducts->categoryid.'/'.str_replace($rejectcontent, $replaceword, $rowoffercategoryproducts->category); ?>"
										class="btn btn-dark btn-outline btn-rounded btn-sm">shop Now</a>
								</div>
							</div>
						</div>
						<!-- End of Banner -->
						<div class="col-lg-9 col-sm-8">
							<div class="owl-carousel owl-theme row cols-xl-4 cols-lg-3 cols-2" data-owl-options="{
                                'nav': false,
                                'dots': true,
                                'margin': 20,
                                'responsive': {
                                    '0': {
                                        'items': 2
                                    },
                                    '576': {
                                        'items': 2
                                    },
                                    '992': {
                                        'items': 3
                                    },
                                    '1200': {
                                        'items': 4
                                    }
                                }
                            }">
								<?php 
								if(!empty($rowoffercategoryproducts->prodcutlist)){ 
									$productarray=$rowoffercategoryproducts->prodcutlist;
									$j=0;
									for($i=0; 4>$i; $i++){ 
										if($j<count($productarray)){
											?>
								<div class="product-col">
									<div class="product-wrap product text-center">
										<figure class="product-media">
											<a href="<?php echo base_url().'Shop/Product/'.$productarray[$j]->productid.'/'.preg_replace('/[^a-zA-Z0-9-_\.]/','', str_replace($rejectcontent, $replaceword, $productarray[$j]->product)) ?>">
												<img src="<?php echo base_url().$productarray[$j]->imagepath; ?>" alt="<?php echo $productarray[$j]->product; ?>"
													width="216" height="243" />
											</a>
											<div class="product-action-vertical">
												<?php if($productarray[$j]->stock>0){ ?>
												<a href="#" class="btn-product-icon btn-cart w-icon-cart addtocart" id="<?php echo $productarray[$j]->productid; ?>" title="Add to cart"></a>
												<?php } else{ ?>
												<a href="#" class="btn-product-icon btn-cart w-icon-times-circle" title="Out Stock"></a>
												<?php } ?>
											</div>
										</figure>
										<div class="product-details">
											<h4 class="product-name"><a href="<?php echo base_url().'Shop/Product/'.$productarray[$j]->productid.'/'.preg_replace('/[^a-zA-Z0-9-_\.]/','', str_replace($rejectcontent, $replaceword, $productarray[$j]->product)) ?>"><?php echo $productarray[$j]->product; ?></a>
											</h4>
											<div class="ratings-container">
												<div class="ratings-full">
													<span class="ratings" style="width: <?php echo round(($productarray[$j]->avgrating/5)*100) ?>%;"></span>
													<span class="tooltiptext tooltip-top"></span>
												</div>
												<a href="#" class="rating-reviews">(<?php echo $productarray[$j]->ratecount ?> reviews)</a>
											</div>
											<div class="product-price">
												<?php if($productarray[$j]->disprice>0){ ?>
												<ins class="new-price">Rs <?php echo number_format($productarray[$j]->disprice); ?></ins>
												<del class="old-price">Rs <?php echo number_format($productarray[$j]->price); ?></del>
												<?php }else{ ?>
												<ins class="new-price">Rs <?php echo number_format($productarray[$j]->price); ?></ins>
												<?php } ?>
											</div>
										</div>
									</div>
									<?php } $j++; if($j<count($productarray)){ ?>
									<div class="product-wrap product text-center">
										<figure class="product-media">
											<a href="<?php echo base_url().'Shop/Product/'.$productarray[$j]->productid.'/'.preg_replace('/[^a-zA-Z0-9-_\.]/','', str_replace($rejectcontent, $replaceword, $productarray[$j]->product)) ?>">
												<img src="<?php echo base_url().$productarray[$j]->imagepath; ?>" alt="<?php echo $productarray[$j]->product; ?>"
													width="216" height="243" />
											</a>
											<div class="product-action-vertical">
												<?php if($productarray[$j]->stock>0){ ?>
												<a href="#" class="btn-product-icon btn-cart w-icon-cart addtocart" id="<?php echo $productarray[$j]->productid; ?>" title="Add to cart"></a>
												<?php } else{ ?>
												<a href="#" class="btn-product-icon btn-cart w-icon-times-circle" title="Out Stock"></a>
												<?php } ?>
											</div>
										</figure>
										<div class="product-details">
											<h4 class="product-name"><a href="<?php echo base_url().'Shop/Product/'.$productarray[$j]->productid.'/'.preg_replace('/[^a-zA-Z0-9-_\.]/','', str_replace($rejectcontent, $replaceword, $productarray[$j]->product)) ?>"><?php echo $productarray[$j]->product; ?></a>
											</h4>
											<div class="ratings-container">
												<div class="ratings-full">
													<span class="ratings" style="width: <?php echo round(($productarray[$j]->avgrating/5)*100) ?>%;"></span>
													<span class="tooltiptext tooltip-top"></span>
												</div>
												<a href="#" class="rating-reviews">(<?php echo $productarray[$j]->ratecount ?> reviews)</a>
											</div>
											<div class="product-price">
												<?php if($productarray[$j]->disprice>0){ ?>
												<ins class="new-price">Rs <?php echo number_format($productarray[$j]->disprice); ?></ins>
												<del class="old-price">Rs <?php echo number_format($productarray[$j]->price); ?></del>
												<?php }else{ ?>
												<ins class="new-price">Rs <?php echo number_format($productarray[$j]->price); ?></ins>
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
								<?php $j++;}}} ?>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
				<!-- End of Product Wrapper 1 -->
				<?php if(!empty($bottomofferbanner->row(0)->imagepath)){ ?>
				<div class="banner banner-fashion appear-animate br-sm mb-9" style="background-image: url(<?php echo base_url().$bottomofferbanner->row(0)->imagepath ?>);
                    background-color: #383839;">
					<div class="banner-content align-items-center">
						<div class="content-left d-flex align-items-center mb-3">
							<div class="banner-price-info font-weight-bolder text-secondary text-uppercase lh-1 ls-25">
								<?php echo $bottomofferbanner->row(0)->titleone ?>
								<sup class="font-weight-bold">%</sup><sub class="font-weight-bold ls-25">Off</sub>
							</div>
							<hr class="banner-divider bg-white mt-0 mb-0 mr-8">
						</div>
						<div class="content-right d-flex align-items-center flex-1 flex-wrap">
							<div class="banner-info mb-0 mr-auto pr-4 mb-3">
								<h3 class="banner-title text-white font-weight-bolder text-uppercase ls-25"><?php echo $bottomofferbanner->row(0)->titletwo ?></h3>
								<p class="text-white mb-0"><?php echo $bottomofferbanner->row(0)->titlethree ?>
									<!-- <span class="text-dark bg-white font-weight-bold ls-50 pl-1 pr-1 d-inline-block">Black <strong>12345</strong></span> to get best offer.</p> -->
							</div>
							<a href="<?php echo base_url() ?>Shop/Category/<?php echo $bottomofferbanner->row(0)->tbl_product_category_idtbl_product_category.'/'.str_replace($rejectcontent, $replaceword, $bottomofferbanner->row(0)->category); ?>"
								class="btn btn-white btn-outline btn-rounded btn-icon-right mb-3">Shop Now<i
									class="w-icon-long-arrow-right"></i></a>
						</div>
					</div>
				</div>
				<?php } ?>
				<!-- End of Banner Fashion -->
				<?php foreach(array_slice($offercategoryproducts, 1, 2) as $rowoffercategoryproducts){ ?>
				<div class="product-wrapper-1 appear-animate mb-7">
					<div class="title-link-wrapper pb-1 mb-4">
						<h2 class="title ls-normal mb-0"><?php echo $rowoffercategoryproducts->category ?></h2>
						<a href="<?php echo base_url() ?>Shop/Category/<?php echo $rowoffercategoryproducts->categoryid.'/'.str_replace($rejectcontent, $replaceword, $rowoffercategoryproducts->category); ?>" class="font-size-normal font-weight-bold ls-25 mb-0">More
							Products<i class="w-icon-long-arrow-right"></i></a>
					</div>
					<div class="row">
						<div class="col-lg-3 col-sm-4 mb-4">
							<div class="banner h-100 br-sm" style="background-image: url(<?php echo base_url().$rowoffercategoryproducts->categoryimage ?>); 
                            background-color: #EAEFF3;">
								<div class="banner-content content-top">
									<h5 class="banner-subtitle font-weight-normal mb-2"><?php echo $rowoffercategoryproducts->titleone ?></h5>
									<hr class="banner-divider bg-dark mb-2">
									<h3 class="banner-title font-weight-bolder text-uppercase ls-25">
										<?php echo $rowoffercategoryproducts->titletwo ?> <br> <span class="font-weight-normal text-capitalize"><?php echo $rowoffercategoryproducts->titlethree ?></span>
									</h3>
									<a href="<?php echo base_url() ?>Shop/Category/<?php echo $rowoffercategoryproducts->categoryid.'/'.str_replace($rejectcontent, $replaceword, $rowoffercategoryproducts->category); ?>"
										class="btn btn-dark btn-outline btn-rounded btn-sm">shop now</a>
								</div>
							</div>
						</div>
						<!-- End of Banner -->
						<div class="col-lg-9 col-sm-8">
							<div class="owl-carousel owl-theme row cols-xl-4 cols-lg-3 cols-2" data-owl-options="{
                                'nav': false,
                                'dots': true,
                                'margin': 20,
                                'responsive': {
                                    '0': {
                                        'items': 2
                                    },
                                    '576': {
                                        'items': 2
                                    },
                                    '992': {
                                        'items': 3
                                    },
                                    '1200': {
                                        'items': 4
                                    }
                                }
                            }">
								<?php 
								if(!empty($rowoffercategoryproducts->prodcutlist)){ 
									$productarray=$rowoffercategoryproducts->prodcutlist;
									$j=0;
									for($i=0; 4>$i; $i++){ 
										if($j<count($productarray)){
								?>
								<div class="product-col">
									<div class="product-wrap product text-center">
										<figure class="product-media">
											<a href="<?php echo base_url().'Shop/Product/'.$productarray[$j]->productid.'/'.preg_replace('/[^a-zA-Z0-9-_\.]/','', str_replace($rejectcontent, $replaceword, $productarray[$j]->product)) ?>">
												<img src="<?php echo base_url().$productarray[$j]->imagepath; ?>" alt="<?php echo $productarray[$j]->product; ?>"
													width="216" height="243" />
											</a>
											<div class="product-action-vertical">
												<?php if($productarray[$j]->stock>0){ ?>
												<a href="#" class="btn-product-icon btn-cart w-icon-cart addtocart" id="<?php echo $productarray[$j]->productid; ?>" title="Add to cart"></a>
												<?php } else{ ?>
												<a href="#" class="btn-product-icon btn-cart w-icon-times-circle" title="Out Stock"></a>
												<?php } ?>
											</div>
										</figure>
										<div class="product-details">
											<h4 class="product-name"><a href="<?php echo base_url().'Shop/Product/'.$productarray[$j]->productid.'/'.preg_replace('/[^a-zA-Z0-9-_\.]/','', str_replace($rejectcontent, $replaceword, $productarray[$j]->product)) ?>"><?php echo $productarray[$j]->product; ?></a>
											</h4>
											<div class="ratings-container">
												<div class="ratings-full">
													<span class="ratings" style="width: <?php echo round(($productarray[$j]->avgrating/5)*100) ?>%;"></span>
													<span class="tooltiptext tooltip-top"></span>
												</div>
												<a href="#" class="rating-reviews">(<?php echo $productarray[$j]->ratecount ?> reviews)</a>
											</div>
											<div class="product-price">
												<?php if($productarray[$j]->disprice>0){ ?>
												<ins class="new-price">Rs <?php echo number_format($productarray[$j]->disprice); ?></ins>
												<del class="old-price">Rs <?php echo number_format($productarray[$j]->price); ?></del>
												<?php }else{ ?>
												<ins class="new-price">Rs <?php echo number_format($productarray[$j]->price); ?></ins>
												<?php } ?>
											</div>
										</div>
									</div>
									<?php } $j++; if($j<count($productarray)){ ?>
									<div class="product-wrap product text-center">
										<figure class="product-media">
											<a href="<?php echo base_url().'Shop/Product/'.$productarray[$j]->productid.'/'.preg_replace('/[^a-zA-Z0-9-_\.]/','', str_replace($rejectcontent, $replaceword, $productarray[$j]->product)) ?>">
												<img src="<?php echo base_url().$productarray[$j]->imagepath; ?>" alt="<?php echo $productarray[$j]->product; ?>"
													width="216" height="243" />
											</a>
											<div class="product-action-vertical">
												<?php if($productarray[$j]->stock>0){ ?>
												<a href="#" class="btn-product-icon btn-cart w-icon-cart addtocart" id="<?php echo $productarray[$j]->productid; ?>" title="Add to cart"></a>
												<?php } else{ ?>
												<a href="#" class="btn-product-icon btn-cart w-icon-times-circle" title="Out Stock"></a>
												<?php } ?>
											</div>
										</figure>
										<div class="product-details">
											<h4 class="product-name"><a href="<?php echo base_url().'Shop/Product/'.$productarray[$j]->productid.'/'.preg_replace('/[^a-zA-Z0-9-_\.]/','', str_replace($rejectcontent, $replaceword, $productarray[$j]->product)) ?>"><?php echo $productarray[$j]->product; ?></a>
											</h4>
											<div class="ratings-container">
												<div class="ratings-full">
													<span class="ratings" style="width: <?php echo round(($productarray[$j]->avgrating/5)*100) ?>%;"></span>
													<span class="tooltiptext tooltip-top"></span>
												</div>
												<a href="#" class="rating-reviews">(<?php echo $productarray[$j]->ratecount ?> reviews)</a>
											</div>
											<div class="product-price">
												<?php if($productarray[$j]->disprice>0){ ?>
												<ins class="new-price">Rs <?php echo number_format($productarray[$j]->disprice); ?></ins>
												<del class="old-price">Rs <?php echo number_format($productarray[$j]->price); ?></del>
												<?php }else{ ?>
												<ins class="new-price">Rs <?php echo number_format($productarray[$j]->price); ?></ins>
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
								<?php $j++;}}} ?>
							</div>
							<!-- End of Produts -->
						</div>
					</div>
				</div>
				<?php } ?>
				<!-- End of Product Wrapper 1 -->

				<h2 class="title title-underline mb-4 ls-normal appear-animate">Product Category</h2>
				<div class="owl-carousel owl-theme brands-wrapper mb-9 row gutter-no cols-xl-6 cols-lg-5 cols-md-4 cols-sm-3 cols-2 appear-animate"
					data-owl-options="{
                    'nav': false,
                    'dots': false,
                    'margin': 0,
                    'responsive': {
                        '0': {
                            'items': 2
                        },
                        '576': {
                            'items': 3
                        },
                        '768': {
                            'items': 4
                        },
                        '992': {
                            'items': 5
                        },
                        '1200': {
                            'items': 7
                        }
                    }
				}">
					<?php 
					$arraylist=$productcategorylist->result();
					$j=0;
					for($i=0; 7>$i; $i++){ 
					?>
					<div class="brand-col">
						<?php 
						$rejectcontent=[" ", "(", ")", "&"]; 
						$replaceword=["", "", "", ""];
						?>
						<a href="<?php echo base_url() ?>Shop/Category/<?php echo $arraylist[$j]->idtbl_product_category.'/'.str_replace($rejectcontent, $replaceword, $arraylist[$j]->category); ?>">
						<figure class="brand-wrapper text-center pb-1">
							<img src="<?php if(!empty($arraylist[$j]->imagepath)){echo base_url().$arraylist[$j]->imagepath;}else{echo base_url().'images/No-Image.png';} ?>" alt="Brand" width="410" height="186" />
							<hr class="mb-0">
							<small class="text-decoration-none text-dark"><?php echo $arraylist[$j]->category ?></small>
						</figure>
						</a>
						<?php $j++ ?>
						<a href="<?php echo base_url() ?>Shop/Category/<?php echo $arraylist[$j]->idtbl_product_category.'/'.str_replace($rejectcontent, $replaceword, $arraylist[$j]->category); ?>">
						<figure class="brand-wrapper text-center pb-1">
							<img src="<?php if(!empty($arraylist[$j]->imagepath)){echo base_url().$arraylist[$j]->imagepath;}else{echo base_url().'images/No-Image.png';} ?>" alt="Brand" width="410" height="186" />
							<hr class="mb-0">
							<small class="text-decoration-none text-dark"><?php echo $arraylist[$j]->category ?></small>
						</figure>
						</a>
						<?php $j++ ?>
					</div>
					<?php } ?>
				</div>
				<!-- End of Brands Wrapper -->
			</div>
			<!--End of Catainer -->
		</main>
		<!-- End of Main -->

		<?php include "include/footercontent.php"; ?>
	</div>
	<!-- End of Page-wrapper-->

	<?php include "include/footerscript.php"; ?>

	<script>
		$(document).ready(function(){
			$('.addtocart').click(function(e){
                e.preventDefault();
                var productID = $(this).attr('id'); 
                var qty = '1';

                addtocart(productID, qty);
            });
		});
	</script>
</body>

</html>