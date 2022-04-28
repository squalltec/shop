<?php
$controllermenu=$this->router->fetch_class();
$functionmenu=$this->router->fetch_method();
?>
<!-- Top Bar
		============================================= -->
<div id="top-bar">
    <div class="container">

        <div class="row justify-content-between align-items-center">
            <div class="col-12 col-md-auto">
                <p class="mb-0 py-2 text-center text-md-start"><strong>Call:</strong> <a class="text-decoration-none text-dark" href="tel:+94 77 722 0632">+94 77 722 0632</a> |
                    <strong>Email:</strong> <a class="text-decoration-none text-dark" href="mailto:info@laolmart.com">info@laolmart.com</a></p>
            </div>

            <div class="col-12 col-md-auto">

                <!-- Top Links
						============================================= -->
                <div class="top-links on-click">
                    <ul class="top-links-container">
                        <li class="top-links-item"><a href="#">LKR</a>
                        </li>
                        <li class="top-links-item"><a href="#">EN</a>
                        </li>
                        <li class="top-links-item"><a href="#">Login</a>
                            <div class="top-links-section">
                                <form id="top-login" autocomplete="off">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="email" class="form-control form-control-sm rounded-0" placeholder="Email address">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control form-control-sm rounded-0" placeholder="Password" required="">
                                    </div>
                                    <div class="form-group form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="top-login-checkbox">
                                        <label class="form-check-label" for="top-login-checkbox">Remember Me</label>
                                    </div>
                                    <button class="btn btn-danger w-100 btn-sm" type="submit">Sign in</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div><!-- .top-links end -->

            </div>
        </div>

    </div>
</div><!-- #top-bar end -->

<!-- Header
		============================================= -->
<header id="header">
    <div id="header-wrap">
        <div class="container">
            <div class="header-row">

                <!-- Logo
						============================================= -->
                <div id="logo">
                    <a href="<?php echo base_url() ?>" class="standard-logo" data-dark-logo="<?php echo base_url() ?>images/logo-dark.png"><img
                            src="<?php echo base_url() ?>images/logo.png" alt="Canvas Logo"></a>
                    <a href="<?php echo base_url() ?>" class="retina-logo" data-dark-logo="<?php echo base_url() ?>images/logo-dark@2x.png"><img
                            src="<?php echo base_url() ?>images/logo@2x.png" alt="Canvas Logo"></a>
                </div><!-- #logo end -->

                <div class="header-misc">

                    <!-- Top Search
							============================================= -->
                    <div id="top-search" class="header-misc-icon">
                        <a href="#" id="top-search-trigger"><i class="icon-line-search"></i><i
                                class="icon-line-cross"></i></a>
                    </div><!-- #top-search end -->

                    <!-- Top Cart
							============================================= -->
                    <div id="top-cart" class="header-misc-icon d-none d-sm-block">
                        <a href="#" id="top-cart-trigger"><i class="icon-line-bag"></i><span
                                class="top-cart-number">5</span></a>
                        <div class="top-cart-content">
                            <div class="top-cart-title">
                                <h4>Shopping Cart</h4>
                            </div>
                            <div class="top-cart-items">
                                <div class="top-cart-item">
                                    <div class="top-cart-item-image">
                                        <a href="#"><img src="<?php echo base_url() ?>images/shop/small/1.jpg"
                                                alt="Blue Round-Neck Tshirt" /></a>
                                    </div>
                                    <div class="top-cart-item-desc">
                                        <div class="top-cart-item-desc-title">
                                            <a href="#">Blue Round-Neck Tshirt with a Button</a>
                                            <span class="top-cart-item-price d-block">$19.99</span>
                                        </div>
                                        <div class="top-cart-item-quantity">x 2</div>
                                    </div>
                                </div>
                                <div class="top-cart-item">
                                    <div class="top-cart-item-image">
                                        <a href="#"><img src="<?php echo base_url() ?>images/shop/small/6.jpg"
                                                alt="Light Blue Denim Dress" /></a>
                                    </div>
                                    <div class="top-cart-item-desc">
                                        <div class="top-cart-item-desc-title">
                                            <a href="#">Light Blue Denim Dress</a>
                                            <span class="top-cart-item-price d-block">$24.99</span>
                                        </div>
                                        <div class="top-cart-item-quantity">x 3</div>
                                    </div>
                                </div>
                            </div>
                            <div class="top-cart-action">
                                <span class="top-checkout-price">$114.95</span>
                                <a href="#" class="button button-3d button-small m-0">View Cart</a>
                            </div>
                        </div>
                    </div><!-- #top-cart end -->

                </div>

                <div id="primary-menu-trigger">
                    <svg class="svg-trigger" viewBox="0 0 100 100">
                        <path
                            d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20">
                        </path>
                        <path d="m 30,50 h 40"></path>
                        <path
                            d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20">
                        </path>
                    </svg>
                </div>

                <!-- Primary Navigation
						============================================= -->
                <nav class="primary-menu">

                    <ul class="menu-container">
                        <li class="menu-item <?php if($controllermenu=='welcome'){echo 'current';} ?>"><a class="menu-link" href="<?php echo base_url() ?>">
                            <div>Home</div>
                        </a></li>
                        <li class="menu-item <?php if($controllermenu=='Shop'){echo 'current';} ?>"><a class="menu-link" href="<?php echo base_url() ?>Shop">
                            <div>Shop</div>
                        </a></li>
                        <li class="menu-item mega-menu"><a class="menu-link" href="#"><div>Product Category</div></a>
                            <div class="mega-menu-content mega-menu-style-2">
                                <div class="container">
                                    <div class="row">
                                        <ul class="sub-menu-container mega-menu-column col-lg-3">
                                            <?php //print_r($topmenucategory->result()) ?>
                                            <li class="menu-item mega-menu-title">
                                                <ul class="sub-menu-container">
                                                    <?php 
                                                    foreach(array_slice($topmenucategory->result(), 0, 10) as $menucategory){ 
                                                        $rejectcontent=[" ", "(", ")", "&"]; 
                        	                            $replaceword=["", "", "", ""];    
                                                    ?>
                                                    <li class="menu-item"><a class="menu-link" href="<?php echo base_url() ?>Shop/Category/<?php echo $menucategory->idtbl_product_category.'/'.str_replace($rejectcontent, $replaceword, $menucategory->category); ?>"><div><?php echo $menucategory->category; ?></div></a></li>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        </ul>
                                        <ul class="sub-menu-container mega-menu-column col-lg-3">
                                            <li class="menu-item mega-menu-title">
                                                <ul class="sub-menu-container">
                                                    <?php 
                                                    foreach(array_slice($topmenucategory->result(), 10, 20) as $menucategory){ 
                                                        $rejectcontent=[" ", "(", ")", "&"]; 
                        	                            $replaceword=["", "", "", ""];  
                                                    ?>
                                                    <li class="menu-item"><a class="menu-link" href="<?php echo base_url() ?>Shop/Category/<?php echo $menucategory->idtbl_product_category.'/'.str_replace($rejectcontent, $replaceword, $menucategory->category); ?>"><div><?php echo $menucategory->category; ?></div></a></li>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        </ul>
                                        <ul class="sub-menu-container mega-menu-column col-lg-3">
                                            <li class="menu-item mega-menu-title">
                                                <ul class="sub-menu-container">
                                                    <?php 
                                                    foreach(array_slice($topmenucategory->result(), 20, 30) as $menucategory){ 
                                                        $rejectcontent=[" ", "(", ")", "&"]; 
                        	                            $replaceword=["", "", "", ""];      
                                                    ?>
                                                    <li class="menu-item"><a class="menu-link" href="<?php echo base_url() ?>Shop/Category/<?php echo $menucategory->idtbl_product_category.'/'.str_replace($rejectcontent, $replaceword, $menucategory->category); ?>"><div><?php echo $menucategory->category; ?></div></a></li>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        </ul>
                                        <ul class="sub-menu-container mega-menu-column col-lg-3">
                                            <li class="menu-item mega-menu-title">
                                                <ul class="sub-menu-container">
                                                    <?php 
                                                    foreach(array_slice($topmenucategory->result(), 30, 40) as $menucategory){ 
                                                        $rejectcontent=[" ", "(", ")", "&"]; 
                        	                            $replaceword=["", "", "", ""];      
                                                    ?>
                                                    <li class="menu-item"><a class="menu-link" href="<?php echo base_url() ?>Shop/Category/<?php echo $menucategory->idtbl_product_category.'/'.str_replace($rejectcontent, $replaceword, $menucategory->category); ?>"><div><?php echo $menucategory->category; ?></div></a></li>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li><!-- .mega-menu end -->
                        <li class="menu-item <?php if($controllermenu=='Aboutus'){echo 'current';} ?>"><a class="menu-link" href="<?php echo base_url() ?>Aboutus">
                                <div>About Us</div><span>All About Us</span>
                            </a></li>
                        <li class="menu-item <?php if($controllermenu=='Contactus'){echo 'current';} ?>"><a class="menu-link" href="<?php echo base_url() ?>Contactus">
                                <div>Contact</div><span>Get In Touch</span>
                            </a></li>
                        <li class="menu-item <?php if($controllermenu=='Account'){echo 'current';} ?>"><a class="menu-link" href="<?php echo base_url() ?>Account">
                                <div>Account</div><span>Your Profile</span>
                            </a></li>
                    </ul>

                </nav><!-- #primary-menu end -->

                <form class="top-search-form" action="search.html" method="get">
                    <input type="text" name="q" class="form-control" value="" placeholder="Type &amp; Hit Enter.."
                        autocomplete="off">
                </form>

            </div>
        </div>
    </div>
    <div class="header-wrap-clone"></div>
</header><!-- #header end -->