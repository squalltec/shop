<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>Product Name - EASY SHOP</title>

    <meta name="keywords" content="" />
    <meta name="description" content="">
    <meta name="author" content="Pro PC Solution">

    <?php include "include/headerscript.php"; ?>
</head>

<body>
    <div class="page-wrapper">
        <?php include "include/menu.php"; ?>


        <!-- Start of Main -->
        <main class="main mb-10 pb-1">
			<?php //print_r($productinfo); ?>
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav container">
                <ul class="breadcrumb bb-no">
                    <li><a href="demo1.html">Home</a></li>
                    <li>Products</li>
                    <li><?php echo $productinfo->product[0]->productname; ?></li>
                </ul>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of Page Content -->
            <div class="page-content">
                <div class="container">
                    <div class="row gutter-lg">
                        <div class="main-content">
                            <div class="product product-single row">
                                <div class="col-md-6 mb-6">
                                    <div class="product-gallery product-gallery-sticky">
                                        <div class="product-single-carousel owl-carousel owl-theme owl-nav-inner row cols-1 gutter-no">
											<?php if(!empty($productinfo->productimages)){ foreach($productinfo->productimages as $productimagelist){ ?>
                                            <figure class="product-image">
                                                <img src="<?php echo base_url().$productimagelist->imagepath; ?>"
                                                    data-zoom-image="<?php echo base_url().$productimagelist->imagepath; ?>"
                                                    alt="<?php echo $productinfo->product[0]->productname; ?>" width="800" height="900">
											</figure>
											<?php }}else{ ?>
											<figure class="product-image">
                                                <img src="<?php echo base_url().'images/no-preview.jpg'; ?>"
                                                    data-zoom-image="<?php echo base_url().'images/no-preview.jpg'; ?>"
                                                    alt="<?php echo $productinfo->product[0]->productname; ?>" width="800" height="900">
											</figure>
											<?php } ?>
                                        </div>
                                        <div class="product-thumbs-wrap">
                                            <div class="product-thumbs row cols-4 gutter-sm">
												<?php $i=0; if(!empty($productinfo->productimages)){ foreach($productinfo->productimages as $productimagelist){ ?>
                                                <div class="product-thumb <?php if($i==0){echo 'active';} ?>">
                                                    <img src="<?php echo base_url().$productimagelist->imagepath; ?>"
                                                        alt="<?php echo $productinfo->product[0]->productname; ?>" width="800" height="900">
												</div>
												<?php $i++;}}else{ ?>
												<div class="product-thumb active">
                                                    <img src="<?php echo base_url().'images/no-preview.jpg'; ?>"
														alt="<?php echo $productinfo->product[0]->productname; ?>" width="800" height="900">	
												</div>
												<?php } ?>
                                            </div>
                                            <button class="thumb-up disabled"><i class="w-icon-angle-left"></i></button>
                                            <button class="thumb-down disabled"><i
                                                    class="w-icon-angle-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 mb-md-6">
                                    <div class="product-details" data-sticky-options="{'minWidth': 767}">
                                        <h2 class="product-title"><?php echo $productinfo->product[0]->productname; ?></h2>
                                        <div class="product-bm-wrapper">
                                            <figure class="brand">
                                                <img src="<?php echo base_url().$productinfo->product[0]->imagepath; ?>" alt="<?php echo $productinfo->product[0]->category; ?>"
                                                    width="102" height="48" />
                                            </figure>
                                            <div class="product-meta">
                                                <div class="product-categories">
                                                    Category:
                                                    <span class="product-category"><a href="#"><?php echo $productinfo->product[0]->category; ?></a></span>
                                                </div>
                                                <div class="product-sku">
                                                    SKU: <span><?php echo $productinfo->product[0]->customcode; ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <hr class="product-divider">
                                        
                                        <?php if($productinfo->product[0]->disprice>0){ ?>
                                        <div class="product-price"><ins class="new-price">Rs <?php echo number_format($productinfo->product[0]->disprice); ?></ins>
                                        <del class="old-price">Rs <?php echo number_format($productinfo->product[0]->price); ?></del>
                                        </div>
                                        <?php }else{ ?>
                                        <div class="product-price"><ins class="new-price">Rs <?php echo number_format($productinfo->product[0]->price); ?></ins></div>
                                        <?php } ?>
                                        
                                        <div class="ratings-container">
                                            <div class="ratings-full">
                                                <span class="ratings" style="width: <?php echo round(($productinfo->productavgrate[0]->avgrating/5)*100) ?>%;"></span>
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                            <a href="#product-tab-reviews" class="rating-reviews scroll-to">(3
                                                Reviews)</a>
                                        </div>

                                        <!-- <div class="product-short-desc">
                                            <?php //echo $productinfo->product[0]->shortdesc; ?>
                                        </div> -->

                                        <hr class="product-divider">

                                        <div class="fix-bottom product-sticky-content sticky-content">
                                            <div class="product-form container">
                                                <?php if($productinfo->product[0]->stock>0){ ?>
                                                <div class="product-qty-form">
                                                    <div class="input-group">
                                                        <input class="quantity form-control" id="qtyvalue" type="number" min="1"
                                                            max="<?php echo $productinfo->product[0]->stock; ?>">
                                                        <button class="quantity-plus w-icon-plus"></button>
                                                        <button class="quantity-minus w-icon-minus"></button>
                                                    </div>
                                                </div>
                                                <button class="btn btn-orange btn-cart buynow mr-1" id="<?php echo $productinfo->product[0]->idtbl_product; ?>">
                                                    <i class="w-icon-wallet"></i>
                                                    <span>Buy Now</span>
                                                </button>
                                                <button class="btn btn-primary btn-cart addtocart" id="<?php echo $productinfo->product[0]->idtbl_product; ?>">
                                                    <i class="w-icon-cart"></i>
                                                    <span>Add to Cart</span>
                                                </button>
                                                <?php }else{ ?>
                                                <h2 class="banner-title"><span class="text-secondary">Out Stock</span></h2>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <div class="social-links-wrapper">
                                            <div class="social-links">
                                                <div class="social-icons social-no-color border-thin">
                                                    <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                                                    <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                                                    <a href="#"
                                                        class="social-icon social-pinterest fab fa-pinterest-p"></a>
                                                    <a href="#" class="social-icon social-whatsapp fab fa-whatsapp"></a>
                                                    <a href="#"
                                                        class="social-icon social-youtube fab fa-linkedin-in"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php //print_r($productinfo) ?>
                            <div class="tab tab-nav-boxed tab-nav-underline product-tabs">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a href="#product-tab-description" class="nav-link active">Description</a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a href="#product-tab-specification" class="nav-link">Specification</a>
                                    </li> -->
                                    <!-- <li class="nav-item">
                                        <a href="#product-tab-vendor" class="nav-link">Vendor Info</a>
                                    </li> -->
                                    <li class="nav-item">
                                        <a href="#product-tab-reviews" class="nav-link">Customer Reviews (<?php echo $productinfo->productavgrate[0]->count; ?>)</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="product-tab-description">
                                        <div class="row mb-4">
                                            <div class="col-md-6 mb-5">
                                                <h4 class="title tab-pane-title font-weight-bold mb-2">Detail</h4>
                                                <?php echo $productinfo->product[0]->desc; ?>
                                            </div>
                                            <div class="col-md-6 mb-5">
                                                <div class="banner banner-video product-video br-xs">
                                                    <figure class="banner-media">
                                                        <?php if(!empty($productinfo->product[0]->videolink)){ ?>
                                                        <div class="embed-responsive embed-responsive-4by3">
                                                            <iframe class="embed-responsive-item" width="610" height="300" src="<?php echo $productinfo->product[0]->videolink; ?>"></iframe>
                                                        </div>
                                                        <?php } ?>
                                                    </figure>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row cols-md-3">
                                            <div class="mb-3">
                                                <h5 class="sub-title font-weight-bold"><span class="mr-3">1.</span>Free
                                                    Shipping &amp; Return</h5>
                                                <p class="detail pl-5">We offer free shipping for products on orders
                                                    above 50$ and offer free delivery for all orders in US.</p>
                                            </div>
                                            <div class="mb-3">
                                                <h5 class="sub-title font-weight-bold"><span>2.</span>Free and Easy
                                                    Returns</h5>
                                                <p class="detail pl-5">We guarantee our products and you could get back
                                                    all of your money anytime you want in 30 days.</p>
                                            </div>
                                            <div class="mb-3">
                                                <h5 class="sub-title font-weight-bold"><span>3.</span>Special Financing
                                                </h5>
                                                <p class="detail pl-5">Get 20%-50% off items over 50$ for a month or
                                                    over 250$ for a year with our special credit card.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="product-tab-reviews">
                                        <div class="row mb-4">
                                            <div class="col-xl-4 col-lg-5 mb-4">
                                                <div class="ratings-wrapper">
                                                    <div class="avg-rating-container">
                                                        <h4 class="avg-mark font-weight-bolder ls-50"><?php echo number_format($productinfo->productavgrate[0]->avgrating, 1); ?></h4>
                                                        <div class="avg-rating">
                                                            <p class="text-dark mb-1">Average Rating</p>
                                                            <div class="ratings-container">
                                                                <div class="ratings-full">
                                                                    <span class="ratings" style="width: <?php echo round(($productinfo->productavgrate[0]->avgrating/5)*100) ?>%;"></span>
                                                                    <span class="tooltiptext tooltip-top"></span>
                                                                </div>
                                                                <a href="#" class="rating-reviews">(<?php echo $productinfo->productavgrate[0]->count; ?> Reviews)</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="ratings-value d-flex align-items-center text-dark ls-25">
                                                        <?php 
                                                            $totalratecount=$productinfo->productavgrate[0]->count;
                                                            $recocount=0;
                                                            foreach($productinfo->productratevice as $rowproductvice){
                                                                if($rowproductvice->rating==4){
                                                                    $recocount=$recocount+$rowproductvice->ratecount;
                                                                }
                                                                else if($rowproductvice->rating==5){
                                                                    $recocount=$recocount+$rowproductvice->ratecount;
                                                                }
                                                            }

                                                            
                                                        ?>
                                                        <span
                                                            class="text-dark font-weight-bold"><?php if($totalratecount>0){echo round(($recocount/$totalratecount)*100);}else{echo '0';} ?>%</span>Recommended<span
                                                            class="count">(<?php echo $recocount.' of '.$totalratecount ?>)</span>
                                                    </div>
                                                    <div class="ratings-list">
                                                        <?php 
                                                        foreach($productinfo->productratevice as $rowproductvice){ 
                                                            if($rowproductvice->rating==5){ 
                                                        ?>
                                                        <div class="ratings-container">
                                                            <div class="ratings-full">
                                                                <span class="ratings" style="width: 100%;"></span>
                                                                <span class="tooltiptext tooltip-top"></span>
                                                            </div>
                                                            <div class="progress-bar progress-bar-sm ">
                                                                <span></span>
                                                            </div>
                                                            <div class="progress-value">
                                                                <mark><?php echo round(($rowproductvice->ratecount/$totalratecount)*100); ?>%</mark>
                                                            </div>
                                                        </div>
                                                        <?php }if($rowproductvice->rating==4){ ?>
                                                        <div class="ratings-container">
                                                            <div class="ratings-full">
                                                                <span class="ratings" style="width: 80%;"></span>
                                                                <span class="tooltiptext tooltip-top"></span>
                                                            </div>
                                                            <div class="progress-bar progress-bar-sm ">
                                                                <span></span>
                                                            </div>
                                                            <div class="progress-value">
                                                                <mark><?php echo round(($rowproductvice->ratecount/$totalratecount)*100); ?>%</mark>
                                                            </div>
                                                        </div>
                                                        <?php }if($rowproductvice->rating==3){ ?>
                                                        <div class="ratings-container">
                                                            <div class="ratings-full">
                                                                <span class="ratings" style="width: 60%;"></span>
                                                                <span class="tooltiptext tooltip-top"></span>
                                                            </div>
                                                            <div class="progress-bar progress-bar-sm ">
                                                                <span></span>
                                                            </div>
                                                            <div class="progress-value">
                                                                <mark><?php echo round(($rowproductvice->ratecount/$totalratecount)*100); ?>%</mark>
                                                            </div>
                                                        </div>
                                                        <?php }if($rowproductvice->rating==2){ ?>
                                                        <div class="ratings-container">
                                                            <div class="ratings-full">
                                                                <span class="ratings" style="width: 40%;"></span>
                                                                <span class="tooltiptext tooltip-top"></span>
                                                            </div>
                                                            <div class="progress-bar progress-bar-sm ">
                                                                <span></span>
                                                            </div>
                                                            <div class="progress-value">
                                                                <mark><?php echo round(($rowproductvice->ratecount/$totalratecount)*100); ?>%</mark>
                                                            </div>
                                                        </div>
                                                        <?php }if($rowproductvice->rating==1){ ?>
                                                        <div class="ratings-container">
                                                            <div class="ratings-full">
                                                                <span class="ratings" style="width: 20%;"></span>
                                                                <span class="tooltiptext tooltip-top"></span>
                                                            </div>
                                                            <div class="progress-bar progress-bar-sm ">
                                                                <span></span>
                                                            </div>
                                                            <div class="progress-value">
                                                                <mark><?php echo round(($rowproductvice->ratecount/$totalratecount)*100); ?>%</mark>
                                                            </div>
                                                        </div>
                                                        <?php }} ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-8 col-lg-7 mb-4">
                                                <div class="review-form-wrapper">
                                                    <h3 class="title tab-pane-title font-weight-bold mb-1">Submit Your
                                                        Review</h3>
                                                    <p class="mb-3">Your email address will not be published. Required
                                                        fields are marked *</p>
                                                    <form action="<?php echo base_url() ?>Shop/Productrating" method="POST" class="review-form">
                                                        <div class="rating-form">
                                                            <label for="rating">Your Rating Of This Product :</label>
                                                            <span class="rating-stars">
                                                                <a class="star-1 clickrate" id="1" href="#">1</a>
                                                                <a class="star-2 clickrate" id="2" href="#">2</a>
                                                                <a class="star-3 clickrate" id="3" href="#">3</a>
                                                                <a class="star-4 clickrate" id="4" href="#">4</a>
                                                                <a class="star-5 clickrate" id="5" href="#">5</a>
                                                            </span>
                                                            <select name="rating" id="rating" required=""
                                                                style="display: none;">
                                                                <option value="">Rate…</option>
                                                                <option value="5">Perfect</option>
                                                                <option value="4">Good</option>
                                                                <option value="3">Average</option>
                                                                <option value="2">Not that bad</option>
                                                                <option value="1">Very poor</option>
                                                            </select>
                                                        </div>
                                                        <textarea cols="30" rows="6"
                                                            placeholder="Write Your Review Here..." class="form-control" name="review"
                                                            id="review"></textarea>
                                                        <div class="row gutter-md">
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control"
                                                                    placeholder="Your Name" id="author" name="author">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control"
                                                                    placeholder="Your Email" id="email_1" name="email_1">
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-dark">Submit
                                                            Review</button>
                                                        <input type="hidden" name="producthideid" id="producthideid" value="<?php echo $productinfo->product[0]->idtbl_product; ?>">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab tab-nav-boxed tab-nav-outline tab-nav-center">
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li class="nav-item">
                                                    <a href="#show-all" class="nav-link active">Show All</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="show-all">
                                                    <ul class="comments list-style-none">
                                                        <?php foreach($productinfo->productrateinfo as $rowproductrateinfo){  ?>
                                                        <li class="comment">
                                                            <div class="comment-body">
                                                                <figure class="comment-avatar">
                                                                    <img src="<?php echo base_url(); ?>images/user.png"
                                                                        alt="Commenter Avatar" width="90" height="90">
                                                                </figure>
                                                                <div class="comment-content">
                                                                    <h4 class="comment-author">
                                                                        <a href="#"><?php echo $rowproductrateinfo->name; ?></a>
                                                                        <span class="comment-date"><?php date("F j, Y at g:i a", strtotime($rowproductrateinfo->insertdatetime)); ?></span>
                                                                    </h4>
                                                                    <div class="ratings-container comment-rating">
                                                                        <div class="ratings-full">
                                                                            <span class="ratings"
                                                                                style="width: <?php echo round(($rowproductrateinfo->rating/5)*100) ?>%;"></span>
                                                                            <span
                                                                                class="tooltiptext tooltip-top"></span>
                                                                        </div>
                                                                    </div>
                                                                    <p><?php echo $rowproductrateinfo->review; ?></p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <section class="related-product-section">
                                <div class="title-link-wrapper mb-4">
                                    <h4 class="title">Related Products</h4>
                                    <a href="#" class="btn btn-dark btn-link btn-slide-right btn-icon-right">More
                                        Products<i class="w-icon-long-arrow-right"></i></a>
                                </div>
                                <div class="owl-carousel owl-theme row cols-lg-3 cols-md-4 cols-sm-3 cols-2"
                                    data-owl-options="{
                                    'nav': false,
                                    'dots': false,
                                    'margin': 20,
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
                                            'items': 3
                                        }
                                    }
								}">
									<?php if(!empty($categoryproduct)){foreach($categoryproduct as $listateproduct){ ?>
                                    <div class="product">
                                        <figure class="product-media">
                                            <a href="<?php echo base_url().'Shop/Product/'.$listateproduct->productid.'/'.str_replace($rejectcontent, $replaceword, $listateproduct->product) ?>">
                                                <img src="<?php echo base_url().$listateproduct->imagepath; ?>" alt="<?php echo $listateproduct->product; ?>"
                                                    width="300" height="338" />
                                            </a>
                                            <div class="product-action-vertical">
                                                <?php if($listateproduct->stock>0){ ?>
												<a href="#" class="btn-product-icon btn-cart w-icon-cart addtocart" id="<?php echo $listateproduct->productid; ?>" title="Add to cart"></a>
												<?php } else{ ?>
												<a href="#" class="btn-product-icon btn-cart w-icon-times-circle" title="Out Stock"></a>
												<?php } ?>
                                            </div>
                                        </figure>
                                        <div class="product-details">
                                            <h4 class="product-name"><a href="<?php echo base_url().'Shop/Product/'.$listateproduct->productid.'/'.str_replace($rejectcontent, $replaceword, $listateproduct->product) ?>"><?php echo $listateproduct->product; ?></a></h4>
                                            <div class="ratings-container">
                                                <div class="ratings-full">
                                                    <span class="ratings" style="width: <?php echo round(($listateproduct->avgrating/5)*100) ?>%;"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                                <a href="#" class="rating-reviews">(<?php echo $listateproduct->ratecount ?> reviews)</a>
                                            </div>
                                            <div class="product-pa-wrapper">
                                                <div class="product-price">
                                                    <?php if($listateproduct->disprice>0){ ?>
                                                    <ins class="new-price">Rs <?php echo number_format($listateproduct->disprice); ?></ins>
                                                    <del class="old-price">Rs <?php echo number_format($listateproduct->price); ?></del>
                                                    <?php }else{ ?>
                                                    <ins class="new-price">Rs <?php echo number_format($listateproduct->price); ?></ins>
                                                    <?php } ?>  
                                                </div>
                                            </div>
                                        </div>
									</div>
									<?php }} ?>
                                </div>
                            </section>
                        </div>
                        <?php //print_r($categoryproductright) ?>
                        <!-- End of Main Content -->
                        <aside class="sidebar product-sidebar sidebar-fixed right-sidebar sticky-sidebar-wrapper">
                            <div class="sidebar-overlay"></div>
                            <a class="sidebar-close" href="#"><i class="close-icon"></i></a>
                            <a href="#" class="sidebar-toggle d-flex d-lg-none"><i class="fas fa-chevron-left"></i></a>
                            <div class="sidebar-content scrollable">
                                <div class="sticky-sidebar">
                                    <div class="widget widget-icon-box mb-6">
                                        <div class="icon-box icon-box-side">
                                            <span class="icon-box-icon text-dark">
                                                <i class="w-icon-truck"></i>
                                            </span>
                                            <div class="icon-box-content">
                                                <h4 class="icon-box-title">Free Shipping & Returns</h4>
                                                <p>Order above 10,000 & 7 days returns</p>
                                            </div>
                                        </div>
                                        <div class="icon-box icon-box-side">
                                            <span class="icon-box-icon text-dark">
                                                <i class="w-icon-bag"></i>
                                            </span>
                                            <div class="icon-box-content">
                                                <h4 class="icon-box-title">Secure Payment</h4>
                                                <p>We ensure secure payment</p>
                                            </div>
                                        </div>
                                        <div class="icon-box icon-box-side">
                                            <span class="icon-box-icon text-dark">
                                                <i class="w-icon-money"></i>
                                            </span>
                                            <div class="icon-box-content">
                                                <h4 class="icon-box-title">Money Back Guarantee</h4>
                                                <p>Any back within 30 days</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End of Widget Icon Box -->
                                    <?php if(!empty($rightbanner->row(0)->imagepath)){ ?>
                                    <a href="<?php echo base_url() ?>Shop/Category/<?php echo $rightbanner->row(0)->tbl_product_category_idtbl_product_category.'/'.str_replace($rejectcontent, $replaceword, $rightbanner->row(0)->category); ?>">
                                    <div class="widget widget-banner mb-9">
                                        <div class="banner banner-fixed br-sm">
                                            <figure>
                                                <img src="<?php echo base_url().$rightbanner->row(0)->imagepath ?>" alt="Banner" width="266"
                                                    height="220" style="background-color: #1D2D44;" />
                                            </figure>
                                            <div class="banner-content">
                                                <div class="banner-price-info font-weight-bolder text-white lh-1 ls-25">
                                                    <?php echo $rightbanner->row(0)->titleone ?><sup class="font-weight-bold">%</sup><sub
                                                        class="font-weight-bold text-uppercase ls-25">Off</sub>
                                                </div>
                                                <h4
                                                    class="banner-subtitle text-white font-weight-bolder text-uppercase mb-0">
                                                    <?php echo $rightbanner->row(0)->titletwo ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                                    <?php } ?>
                                    <!-- End of Widget Banner -->

                                    <div class="widget widget-products">
                                        <div class="title-link-wrapper mb-2">
                                            <h4 class="title title-link font-weight-bold">More Products</h4>
                                        </div>

                                        <div class="owl-carousel owl-theme owl-nav-top" data-owl-options="{
                                            'nav': true,
                                            'dots': false,
                                            'items': 1,
                                            'margin': 20
                                        }">
                                            <div class="widget-col">
												<?php if(!empty($categoryproductright)){foreach(array_slice($categoryproductright, 0, 3) as $listateproduct){ ?>
                                                <div class="product product-widget">
                                                    <figure class="product-media">
                                                        <a href="<?php echo base_url().'Shop/Product/'.$listateproduct->productid.'/'.preg_replace('/[^a-zA-Z0-9-_\.]/','', str_replace($rejectcontent, $replaceword, $listateproduct->product)) ?>">
                                                            <img src="<?php echo base_url().$listateproduct->imagepath; ?>" alt="<?php echo $listateproduct->product; ?>"
                                                                width="100" height="113" />
                                                        </a>
                                                    </figure>
                                                    <div class="product-details">
                                                        <h4 class="product-name">
                                                            <a href="<?php echo base_url().'Shop/Product/'.$listateproduct->productid.'/'.preg_replace('/[^a-zA-Z0-9-_\.]/','', str_replace($rejectcontent, $replaceword, $listateproduct->product)) ?>"><?php echo $listateproduct->product; ?></a>
                                                        </h4>
                                                        <div class="ratings-container">
                                                            <div class="ratings-full">
                                                                <span class="ratings" style="width: <?php echo round(($listateproduct->avgrating/5)*100) ?>%;"></span>
                                                                <span class="tooltiptext tooltip-top"></span>
                                                            </div>
                                                        </div>
                                                        <div class="product-price">
                                                            <?php if($listateproduct->disprice>0){ ?>
                                                            <ins class="new-price">Rs <?php echo number_format($listateproduct->disprice); ?></ins>
                                                            <del class="old-price">Rs <?php echo number_format($listateproduct->price); ?></del>
                                                            <?php }else{ ?>
                                                            <ins class="new-price">Rs <?php echo number_format($listateproduct->price); ?></ins>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
												</div>
												<?php }} ?>
                                            </div>
                                            <div class="widget-col">
                                                <?php if(!empty($categoryproductright)){foreach(array_slice($categoryproductright, 3, 6) as $listateproduct){ ?>
                                                <div class="product product-widget">
                                                    <figure class="product-media">
                                                        <a href="<?php echo base_url().'Shop/Product/'.$listateproduct->productid.'/'.preg_replace('/[^a-zA-Z0-9-_\.]/','', str_replace($rejectcontent, $replaceword, $listateproduct->product)) ?>">
                                                            <img src="<?php echo base_url().$listateproduct->imagepath; ?>" alt="<?php echo $listateproduct->product; ?>"
                                                                width="100" height="113" />
                                                        </a>
                                                    </figure>
                                                    <div class="product-details">
                                                        <h4 class="product-name">
                                                            <a href="<?php echo base_url().'Shop/Product/'.$listateproduct->productid.'/'.preg_replace('/[^a-zA-Z0-9-_\.]/','', str_replace($rejectcontent, $replaceword, $listateproduct->product)) ?>"><?php echo $listateproduct->product; ?></a>
                                                        </h4>
                                                        <div class="ratings-container">
                                                            <div class="ratings-full">
                                                                <span class="ratings" style="width: <?php echo round(($listateproduct->avgrating/5)*100) ?>%;"></span>
                                                                <span class="tooltiptext tooltip-top"></span>
                                                            </div>
                                                        </div>
                                                        <div class="product-price">
                                                            <?php if($listateproduct->disprice>0){ ?>
                                                            <ins class="new-price">Rs <?php echo number_format($listateproduct->disprice); ?></ins>
                                                            <del class="old-price">Rs <?php echo number_format($listateproduct->price); ?></del>
                                                            <?php }else{ ?>
                                                            <ins class="new-price">Rs <?php echo number_format($listateproduct->price); ?></ins>
                                                            <?php } ?>    
                                                        </div>
                                                    </div>
												</div>
												<?php }} ?>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </aside>
                        <!-- End of Sidebar -->
                    </div>
                </div>
            </div>
            <!-- End of Page Content -->
        </main>
        <!-- End of Main -->

        <!-- Root element of PhotoSwipe. Must have class pswp -->
        <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

            <!-- Background of PhotoSwipe. It's a separate element as animating opacity is faster than rgba(). -->
            <div class="pswp__bg"></div>

            <!-- Slides wrapper with overflow:hidden. -->
            <div class="pswp__scroll-wrap">

                <!-- Container that holds slides.
                PhotoSwipe keeps only 3 of them in the DOM to save memory.
                Don't modify these 3 pswp__item elements, data is added later on. -->
                <div class="pswp__container">
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                </div>

                <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
                <div class="pswp__ui pswp__ui--hidden">

                    <div class="pswp__top-bar">

                        <!--  Controls are self-explanatory. Order can be changed. -->

                        <div class="pswp__counter"></div>

                        <button class="pswp__button pswp__button--close" aria-label="Close (Esc)"></button>
                        <button class="pswp__button pswp__button--zoom" aria-label="Zoom in/out"></button>

                        <div class="pswp__preloader">
                            <div class="loading-spin"></div>
                        </div>
                    </div>

                    <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                        <div class="pswp__share-tooltip"></div>
                    </div>

                    <button class="pswp__button--arrow--left" aria-label="Previous (arrow left)"></button>
                    <button class="pswp__button--arrow--right" aria-label="Next (arrow right)"></button>

                    <div class="pswp__caption">
                        <div class="pswp__caption__center"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of PhotoSwipe -->

        <?php include "include/footercontent.php"; ?>
    </div>
    <!-- End of Page Wrapper -->

    <?php include "include/footerscript.php"; ?>

    <script>
		$(document).ready(function(){
			$('.addtocart').click(function(e){
                e.preventDefault();
                var productID = $(this).attr('id'); 
                var qty = $('#qtyvalue').val();

                addtocart(productID, qty);
                setTimeout(function(){ $('.alertclose').click(); }, 3000);
            });
            $('.addtocartother').click(function(e){
                e.preventDefault();
                var productID = $(this).attr('id'); 
                var qty = '1';

                addtocart(productID, qty);
            });
            $('.buynow').click(function(e){
                e.preventDefault();
                var productID = $(this).attr('id'); 
                var qty = $('#qtyvalue').val();

                addtocart(productID, qty);
                
                location.href = '<?php echo base_url() ?>Cart/Buyitnow';
            });
            $('.clickrate').click(function(){
                var value = $(this).attr('id');
                $('#rating').val(value);
            });
		});
	</script>
</body>

</html>