<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<?php include "include/headerscript.php"; ?>

	<!-- Document Title
	============================================= -->
	<title>Shop - LAOL Mart</title>

</head>

<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<?php include "include/menu.php" ?>

		<!-- Page Title
		============================================= -->
		<section id="page-title">

			<div class="container clearfix">
				<h1>Shop</h1>
				<span>All Products</span>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">Shop</li>
				</ol>
			</div>

		</section><!-- #page-title end -->

		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">

					<div class="row gutter-40 col-mb-80">
						<!-- Post Content
						============================================= -->
						<div class="postcontent col-lg-9 order-lg-last">
							<?php //print_r($loadproduct); ?>
							<!-- Shop
							============================================= -->
							<div id="shop" class="shop row grid-container gutter-20" data-layout="fitRows">
								<?php foreach($loadproduct as $rowproductlist){ ?>
								<div class="product col-md-4 col-sm-6 <?php echo $rowproductlist->category ?>">
									<div class="grid-inner">
										<div class="product-image">
											<a href="#"><img src="<?php echo base_url().$rowproductlist->imagepath ?>" alt="<?php echo $rowproductlist->product ?>"></a>
											<!-- <div class="sale-flash badge bg-secondary p-2">Out of Stock</div> -->
											<!-- <div class="bg-overlay">
												<div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">
													<a href="#" class="btn btn-dark me-2"><i class="icon-shopping-cart"></i></a>
													<a href="include/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"><i class="icon-line-expand"></i></a>
												</div>
												<div class="bg-overlay-bg bg-transparent"></div>
											</div> -->
										</div>
										<div class="product-desc">
											<div class="product-title"><h3><a href="<?php echo base_url() ?>Shop/Product"><?php echo $rowproductlist->product ?></a></h3></div>
											<div class="product-price"><ins>LKR <?php echo $rowproductlist->price ?></ins></div>
											<div class="product-rating">
												<i class="icon-star3"></i>
												<i class="icon-star3"></i>
												<i class="icon-star3"></i>
												<i class="icon-star3"></i>
												<i class="icon-star-half-full"></i>
											</div>
										</div>
									</div>
								</div>
								<?php } ?>
							</div><!-- #shop end -->

						</div><!-- .postcontent end -->

						<!-- Sidebar
						============================================= -->
						<div class="sidebar col-lg-3">
							<div class="sidebar-widgets-wrap">

								<div class="widget widget-filter-links">

									<h4>Select Category</h4>
									<ul class="custom-filter ps-2" data-container="#shop" data-active-class="active-filter">
										<li class="widget-filter-reset active-filter"><a href="#" data-filter="*">Clear</a></li>
										<?php foreach($leftcategory->result() as $rowleftcategory){ ?>
										<li><a href="#" data-filter=".<?php echo $rowleftcategory->category ?>"><?php echo $rowleftcategory->category ?></a></li>
										<?php } ?>
										<!-- <li><a href="#" data-filter=".sf-dress">Dress</a></li>
										<li><a href="#" data-filter=".sf-tshirts">Tshirts</a></li>
										<li><a href="#" data-filter=".sf-pants">Pants</a></li>
										<li><a href="#" data-filter=".sf-sunglasses">Sunglasses</a></li>
										<li><a href="#" data-filter=".sf-shoes">Shoes</a></li>
										<li><a href="#" data-filter=".sf-watches">Watches</a></li> -->
									</ul>

								</div>

								<div class="widget widget-filter-links">

									<h4>Sort By</h4>
									<ul class="shop-sorting ps-2">
										<li class="widget-filter-reset active-filter"><a href="#" data-sort-by="original-order">Clear</a></li>
										<li><a href="#" data-sort-by="name">Name</a></li>
										<li><a href="#" data-sort-by="price_lh">Price: Low to High</a></li>
										<li><a href="#" data-sort-by="price_hl">Price: High to Low</a></li>
									</ul>

								</div>

							</div>
						</div><!-- .sidebar end -->
					</div>

				</div>
			</div>
		</section><!-- #content end -->

		<?php include "include/footercontent.php" ?>

	</div><!-- #wrapper end -->

	<?php include "include/footerscript.php"; ?>

	<script>
		jQuery(document).ready( function($){
			$(window).on( 'pluginIsotopeReady', function(){
				$('#shop').isotope({
					transitionDuration: '0.65s',
					getSortData: {
						name: '.product-title',
						price_lh: function( itemElem ) {
							if( $(itemElem).find('.product-price').find('ins').length > 0 ) {
								var price = $(itemElem).find('.product-price ins').text();
							} else {
								var price = $(itemElem).find('.product-price').text();
							}

							priceNum = price.split("LKR");

							return parseFloat( priceNum[1] );
						},
						price_hl: function( itemElem ) {
							if( $(itemElem).find('.product-price').find('ins').length > 0 ) {
								var price = $(itemElem).find('.product-price ins').text();
							} else {
								var price = $(itemElem).find('.product-price').text();
							}

							priceNum = price.split("LKR");

							return parseFloat( priceNum[1] );
						}
					},
					sortAscending: {
						name: true,
						price_lh: true,
						price_hl: false
					}
				});

				$('.custom-filter:not(.no-count)').children('li:not(.widget-filter-reset)').each( function(){
					var element = $(this),
						elementFilter = element.children('a').attr('data-filter'),
						elementFilterContainer = element.parents('.custom-filter').attr('data-container');

					elementFilterCount = Number( jQuery(elementFilterContainer).find( elementFilter ).length );

					element.append('<span>'+ elementFilterCount +'</span>');

				});

				$('.shop-sorting li').click( function() {
					$('.shop-sorting').find('li').removeClass( 'active-filter' );
					$(this).addClass( 'active-filter' );
					var sortByValue = $(this).find('a').attr('data-sort-by');
					$('#shop').isotope({ sortBy: sortByValue });
					return false;
				});
			});
		});
	</script>

</body>
</html>