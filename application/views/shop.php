<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>Shop - EASY SHOP</title>

    <meta name="keywords" content="" />
    <meta name="description" content="">
    <meta name="author" content="Pro PC Solution">

    <?php include "include/headerscript.php"; ?>
</head>

<body>
    <div class="page-wrapper">
        <?php include "include/menu.php"; ?>

        <!-- Start of Main -->
        <main class="main">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb bb-no">
                        <li><a href="demo1.html">Home</a></li>
                        <li><a href="#">Shop</a></li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of Page Content -->
            <div class="page-content">
                <div class="container">
                    <!-- Start of Shop Banner -->
                    <?php if(!empty($shoptopbanner->row(0)->imagepath)){ ?>
                    <div class="shop-default-banner banner d-flex align-items-center mb-5 br-xs"
                        style="background-image: url(<?php echo base_url().$shoptopbanner->row(0)->imagepath ?>); background-color: #FFC74E;">
                        <div class="banner-content">
                            <h4 class="banner-subtitle font-weight-bold"><?php echo $shoptopbanner->row(0)->titleone ?></h4>
                            <h3 class="banner-title text-white text-uppercase font-weight-bolder ls-normal"><?php echo $shoptopbanner->row(0)->titletwo ?></h3>
                            <a href="<?php echo base_url() ?>Shop/Category/<?php echo $shoptopbanner->row(0)->tbl_product_category_idtbl_product_category.'/'.str_replace($rejectcontent, $replaceword, $shoptopbanner->row(0)->category); ?>" class="btn btn-dark btn-rounded btn-icon-right">Discover
                                Now<i class="w-icon-long-arrow-right"></i></a>
                        </div>
                    </div>
                    <?php } ?>
                    <!-- End of Shop Banner -->

                    <!-- Start of Shop Content -->
                    <div class="shop-content row gutter-lg mb-10">
                        <!-- Start of Sidebar, Shop Sidebar -->
                        <aside class="sidebar shop-sidebar sticky-sidebar-wrapper sidebar-fixed">
                            <!-- Start of Sidebar Overlay -->
                            <div class="sidebar-overlay"></div>
                            <a class="sidebar-close" href="#"><i class="close-icon"></i></a>

                            <!-- Start of Sidebar Content -->
                            <div class="sidebar-content scrollable">
                                <!-- Start of Sticky Sidebar -->
                                <div class="sticky-sidebar">
                                    <div class="filter-actions">
                                        <label>Filter :</label>
                                        <a href="#" class="btn btn-dark btn-link filter-clean">Clean All</a>
                                    </div>
                                    <!-- Start of Collapsible widget -->
                                    <div class="widget widget-collapsible">
                                        <h3 class="widget-title"><span>All Categories</span></h3>
                                        <ul class="widget-body filter-items search-ul">
                                            <?php foreach($leftcategory->result() as $rowleftcategory){ ?>
                                            <li><a href="<?php echo base_url() ?>Shop/Category/<?php echo $rowleftcategory->idtbl_product_category.'/'.str_replace($rejectcontent, $replaceword, $rowleftcategory->category); ?>"><?php echo $rowleftcategory->category ?></a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <!-- End of Collapsible Widget -->

                                    <!-- Start of Collapsible Widget -->
                                    <!-- <div class="widget widget-collapsible">
                                        <h3 class="widget-title"><span>Price</span></h3>
                                        <div class="widget-body">
                                            <ul class="filter-items search-ul">
                                                <li><a href="#">$0.00 - $100.00</a></li>
                                                <li><a href="#">$100.00 - $200.00</a></li>
                                                <li><a href="#">$200.00 - $300.00</a></li>
                                                <li><a href="#">$300.00 - $500.00</a></li>
                                                <li><a href="#">$500.00+</a></li>
                                            </ul>
                                            <form class="price-range">
                                                <input type="number" name="min_price" class="min_price text-center"
                                                    placeholder="$min"><span class="delimiter">-</span><input
                                                    type="number" name="max_price" class="max_price text-center"
                                                    placeholder="$max"><a href="#"
                                                    class="btn btn-primary btn-rounded">Go</a>
                                            </form>
                                        </div>
                                    </div> -->
                                    <!-- End of Collapsible Widget -->

                                    <!-- Start of Collapsible Widget -->
                                    <!-- <div class="widget widget-collapsible">
                                        <h3 class="widget-title"><span>Size</span></h3>
                                        <ul class="widget-body filter-items item-check mt-1">
                                            <li><a href="#">Extra Large</a></li>
                                            <li><a href="#">Large</a></li>
                                            <li><a href="#">Medium</a></li>
                                            <li><a href="#">Small</a></li>
                                        </ul>
                                    </div> -->
                                    <!-- End of Collapsible Widget -->

                                    <!-- Start of Collapsible Widget -->
                                    <!-- <div class="widget widget-collapsible">
                                        <h3 class="widget-title"><span>Brand</span></h3>
                                        <ul class="widget-body filter-items item-check mt-1">
                                            <li><a href="#">Elegant Auto Group</a></li>
                                            <li><a href="#">Green Grass</a></li>
                                            <li><a href="#">Node Js</a></li>
                                            <li><a href="#">NS8</a></li>
                                            <li><a href="#">Red</a></li>
                                            <li><a href="#">Skysuite Tech</a></li>
                                            <li><a href="#">Sterling</a></li>
                                        </ul>
                                    </div> -->
                                    <!-- End of Collapsible Widget -->

                                    <!-- Start of Collapsible Widget -->
                                    <!-- <div class="widget widget-collapsible">
                                        <h3 class="widget-title"><span>Color</span></h3>
                                        <ul class="widget-body filter-items item-check mt-1">
                                            <li><a href="#">Black</a></li>
                                            <li><a href="#">Blue</a></li>
                                            <li><a href="#">Brown</a></li>
                                            <li><a href="#">Green</a></li>
                                            <li><a href="#">Grey</a></li>
                                            <li><a href="#">Orange</a></li>
                                            <li><a href="#">Yellow</a></li>
                                        </ul>
                                    </div> -->
                                    <!-- End of Collapsible Widget -->
                                </div>
                                <!-- End of Sidebar Content -->
                            </div>
                            <!-- End of Sidebar Content -->
                        </aside>
                        <!-- End of Shop Sidebar -->

                        <!-- Start of Shop Main Content -->
                        <div class="main-content">
                            <nav class="toolbox sticky-toolbox sticky-content fix-top">
                                <div class="toolbox-left">
                                    <a href="#" class="btn btn-primary btn-outline btn-rounded left-sidebar-toggle 
                                        btn-icon-left d-block d-lg-none"><i
                                            class="w-icon-category"></i><span>Filters</span></a>
                                    <div class="toolbox-item toolbox-sort select-box text-dark">
                                        <label>Sort By :</label>
                                        <select name="orderby" class="form-control">
                                            <option value="default" selected="selected">Default sorting</option>
                                            <option value="price-low">Sort by pric: low to high</option>
                                            <option value="price-high">Sort by price: high to low</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="toolbox-right">
                                    <div class="toolbox-item toolbox-show select-box">
                                        <select name="count" class="form-control">
                                            <option value="12" selected="selected">Show 12</option>
                                        </select>
                                    </div>
                                    <div class="toolbox-item toolbox-layout">
                                        <a href="#" class="icon-mode-grid btn-layout active">
                                            <i class="w-icon-grid"></i>
                                        </a>
                                        <!-- <a href="shop-list.html" class="icon-mode-list btn-layout">
                                            <i class="w-icon-list"></i>
                                        </a> -->
                                    </div>
                                </div>
                            </nav>
                            <div class="product-wrapper row cols-lg-4 cols-md-3 cols-sm-2 cols-2">
                                <?php foreach($loadproduct as $rowproductlist){ ?>
                                <div class="product-wrap">
                                    <div class="product text-center">
                                        <figure class="product-media">
                                            <a href="<?php echo base_url().'Shop/Product/'.$rowproductlist->productid.'/'.preg_replace('/[^a-zA-Z0-9-_\.]/','', str_replace($rejectcontent, $replaceword, $rowproductlist->product)) ?>">
                                                <img src="<?php echo base_url().$rowproductlist->imagepath ?>" alt="<?php echo $rowproductlist->product ?>" width="300"
                                                    height="338" />
                                            </a>
                                            <div class="product-action-vertical">
                                                <?php if($rowproductlist->stock>0){ ?>
												<a href="#" class="btn-product-icon btn-cart w-icon-cart addtocart" id="<?php echo $rowproductlist->productid; ?>" title="Add to cart"></a>
												<?php } else{ ?>
												<a href="#" class="btn-product-icon btn-cart w-icon-times-circle" title="Out Stock"></a>
												<?php } ?>
                                            </div>
                                        </figure>
                                        <div class="product-details">
                                            <div class="product-cat">
                                                <a href="#"><?php echo $rowproductlist->category ?></a>
                                            </div>
                                            <h3 class="product-name">
                                                <a href="<?php echo base_url().'Shop/Product/'.$rowproductlist->productid.'/'.preg_replace('/[^a-zA-Z0-9-_\.]/','', str_replace($rejectcontent, $replaceword, $rowproductlist->product)) ?>"><?php echo $rowproductlist->product ?></a>
                                            </h3>
                                            <div class="ratings-container">
                                                <div class="ratings-full">
                                                    <span class="ratings" style="width: <?php echo round(($rowproductlist->avgrating/5)*100) ?>%;"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                                <a href="#" class="rating-reviews">(<?php echo $rowproductlist->ratecount ?> reviews)</a>
                                            </div>
                                            <div class="product-pa-wrapper">
                                                <div class="product-price">
                                                    <?php if($rowproductlist->disprice>0){ ?>
                                                    <ins class="new-price">Rs <?php echo number_format($rowproductlist->disprice); ?></ins>
                                                    <del class="old-price">Rs <?php echo number_format($rowproductlist->price); ?></del>
                                                    <?php }else{ ?>
                                                    <ins class="new-price">Rs <?php echo number_format($rowproductlist->price); ?></ins>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>

                            <?php echo $pagination; ?>
                        </div>
                        <!-- End of Shop Main Content -->
                    </div>
                    <!-- End of Shop Content -->
                </div>
            </div>
            <!-- End of Page Content -->
        </main>
        <!-- End of Main -->

        <?php include "include/footercontent.php"; ?>
    </div>
    <!-- End of Page Wrapper -->

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