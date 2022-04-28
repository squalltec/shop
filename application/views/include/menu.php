<?php 
$rejectcontent=[" ", "(", ")", "&", "'", ","]; 
$replaceword=["", "", "", "", "`", ""]; 
?>
<!-- Start of Header -->
<header class="header header-border">
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <p class="welcome-msg">Welcome to LAOL Mart Store!</p>
            </div>
            <div class="header-right">
                <div class="dropdown">
                    <a href="#currency">LKR</a>
                    <div class="dropdown-box">
                        <a href="#LKR">LKR</a>
                    </div>
                </div>
                <!-- End of DropDown Menu -->

                <div class="dropdown">
                    <a href="#language"><img src="<?php echo base_url() ?>images/flags/eng.png" alt="ENG Flag" width="14"
                            height="8" class="dropdown-image" /> ENG</a>
                    <div class="dropdown-box">
                        <a href="#ENG">
                            <img src="<?php echo base_url() ?>images/flags/eng.png" alt="ENG Flag" width="14" height="8"
                                class="dropdown-image" />
                            ENG
                        </a>
                    </div>
                </div>
                <!-- End of Dropdown Menu -->
                <span class="divider d-lg-show"></span>
                <a href="<?php if(!empty($_SESSION['user_id'])){echo base_url().'Account'; }else{echo base_url().'Account/Accountlogin';} ?>" class="d-lg-show">My Account</a>
                <?php if(!empty($_SESSION['user_id'])){ ?>
                <a href="#" class="d-lg-show">
                    <div class="dropdown">
                        <i class="w-icon-account"></i>
                        <?php echo $_SESSION['accountname'] ?>
                        <div class="dropdown-box">
                            <a href="<?php echo base_url().'Account/Logout' ?>">Logout</a>
                        </div>
                    </div>
                </a>
                <?php }else{ ?>
                <a href="<?php echo base_url().'Account/Accountlogin'; ?>" class="d-lg-show login"><i
                        class="w-icon-account"></i>Sign In</a>
                <span class="delimiter d-lg-show">/</span>
                <a href="<?php echo base_url().'Account/Register'; ?>" class="ml-0 d-lg-show login">Register</a>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- End of Header Top -->

    <div class="header-middle">
        <div class="container">
            <div class="header-left mr-md-4">
                <a href="#" class="mobile-menu-toggle  w-icon-hamburger">
                </a>
                <a href="<?php echo base_url() ?>" class="logo ml-lg-0">
                    <img src="<?php echo base_url() ?>images/logo.png" alt="logo" width="144" height="45" />
                </a>
                <form method="POST" action="<?php echo base_url().'Shop/Topform' ?>" class="header-search hs-expanded hs-round d-none d-md-flex input-wrapper">
                    <input type="text" class="form-control" name="search" id="search" placeholder="Search in..." required />
                    <button class="btn btn-primary" type="submit"><i class="w-icon-search"></i>
                    </button>
                </form>
            </div>
            <div class="header-right ml-4">
                <div class="header-call d-xs-show d-lg-flex align-items-center">
                    <a href="tel:94777220632" class="w-icon-call"></a>
                    <!-- <div class="call-info d-lg-show">
                        <h4 class="chat font-weight-normal font-size-md text-normal ls-normal text-light mb-0">
                            <a href="mailto:#" class="text-capitalize">Live Chat</a> or :</h4>
                        <a href="tel:94777220632" class="phone-number font-weight-bolder ls-50"></a>
                    </div> -->
                </div>
                <div class="dropdown cart-dropdown cart-offcanvas mr-0 mr-lg-2" id="topmenucart">
                    <!-- <div class="cart-overlay"></div>
                    <a href="#" class="cart-toggle label-down link">
                        <i class="w-icon-cart">
                            <span class="cart-count">2</span>
                        </i>
                        <span class="cart-label">Cart</span>
                    </a>
                    <div class="dropdown-box">
                        <div class="cart-header">
                            <span>Shopping Cart</span>
                            <a href="#" class="btn-close">Close<i class="w-icon-long-arrow-right"></i></a>
                        </div>

                        <div class="products">
                            <div class="product product-cart">
                                <div class="product-detail">
                                    <a href="product-default.html" class="product-name">Beige knitted
                                        elas<br>tic
                                        runner shoes</a>
                                    <div class="price-box">
                                        <span class="product-quantity">1</span>
                                        <span class="product-price">$25.68</span>
                                    </div>
                                </div>
                                <figure class="product-media">
                                    <a href="product-default.html">
                                        <img src="<?php echo base_url() ?>images/cart/product-1.jpg" alt="product" height="84"
                                            width="94" />
                                    </a>
                                </figure>
                                <button class="btn btn-link btn-close">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>

                            <div class="product product-cart">
                                <div class="product-detail">
                                    <a href="product-default.html" class="product-name">Blue utility
                                        pina<br>fore
                                        denim dress</a>
                                    <div class="price-box">
                                        <span class="product-quantity">1</span>
                                        <span class="product-price">$32.99</span>
                                    </div>
                                </div>
                                <figure class="product-media">
                                    <a href="product-default.html">
                                        <img src="<?php echo base_url() ?>images/cart/product-2.jpg" alt="product" width="84"
                                            height="94" />
                                    </a>
                                </figure>
                                <button class="btn btn-link btn-close">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="cart-total">
                            <label>Subtotal:</label>
                            <span class="price">$58.67</span>
                        </div>

                        <div class="cart-action">
                            <a href="cart.html" class="btn btn-dark btn-outline btn-rounded">View Cart</a>
                            <a href="checkout.html" class="btn btn-primary  btn-rounded">Checkout</a>
                        </div>
                    </div> -->
                    <!-- End of Dropdown Box -->
                </div>
            </div>
        </div>
    </div>
    <!-- End of Header Middle -->

    <div class="header-bottom sticky-content fix-top sticky-header has-dropdown">
        <div class="container">
            <div class="inner-wrap">
                <div class="header-left">
                    <div class="dropdown category-dropdown has-border" data-visible="true">
                        <a href="#" class="category-toggle text-dark" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="true" data-display="static"
                            title="Browse Categories">
                            <i class="w-icon-category"></i>
                            <span>Categories</span>
                        </a>

                        <div class="dropdown-box">
                            <ul class="menu vertical-menu category-menu">
                                <?php foreach(array_slice($topmenucategory, 0, 11) as $menucategory){ ?>
                                <li>
                                    <a href="<?php echo base_url() ?>Shop/Category/<?php echo $menucategory->idtbl_product_category.'/'.str_replace($rejectcontent, $replaceword, $menucategory->category); ?>">
                                        <i class="flaticon-<?php echo $menucategory->iconclass; ?>"></i><?php echo $menucategory->category; ?>
                                    </a>
                                    <?php if(count($menucategory->subcategory)>0){ ?>
                                    <ul class="megamenu">
                                        <li>
                                            <ul>
                                                <?php
                                                foreach(array_slice($menucategory->subcategory, 0, 10) as $menusubcategory){ 
                                                ?>
                                                <li><a href="<?php echo base_url().'Shop/Subcategory/'.$menusubcategory->idtbl_product_sub_category.'/'.$menusubcategory->subcategory ?>"><?php echo $menusubcategory->subcategory ?></a>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <li>
                                            <ul>
                                                <?php
                                                foreach(array_slice($menucategory->subcategory, 10, 20) as $menusubcategory){ 
                                                ?>
                                                <li><a href="<?php echo base_url().'Shop/Subcategory/'.$menusubcategory->idtbl_product_sub_category.'/'.$menusubcategory->subcategory ?>"><?php echo $menusubcategory->subcategory ?></a>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <li>
                                            <ul>
                                                <?php
                                                foreach(array_slice($menucategory->subcategory, 20, 30) as $menusubcategory){ 
                                                ?>
                                                <li><a href="<?php echo base_url().'Shop/Subcategory/'.$menusubcategory->idtbl_product_sub_category.'/'.$menusubcategory->subcategory ?>"><?php echo $menusubcategory->subcategory ?></a>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    </ul>
                                    <?php } ?>
                                </li>
                                <?php } ?>
                                <li>
                                    <a href="<?php echo base_url() ?>Shop"
                                        class="font-weight-bold text-primary text-uppercase ls-25">
                                        View All Categories<i class="w-icon-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <nav class="main-nav">
                        <ul class="menu active-underline">
                            <!-- <li class="<?php //if($controllermenu=='welcome'){echo 'active';} ?>">
                                <a href="<?php //echo base_url() ?>">Home</a>
                            </li> -->
                            <li class="<?php if($controllermenu=='Shop'){echo 'active';} ?>">
                                <a href="<?php echo base_url() ?>Shop">Shop</a>
                            </li>
                            <li>
                                <a href="#">Product Category</a>

                                <!-- Start of Megamenu -->
                                <ul class="megamenu">
                                    <li>
                                        <ul>
                                            <?php foreach(array_slice($topmenucategory, 0, 10) as $menucategory){ ?>
                                            <li><a href="<?php echo base_url() ?>Shop/Category/<?php echo $menucategory->idtbl_product_category.'/'.str_replace($rejectcontent, $replaceword, $menucategory->category); ?>"><?php echo $menucategory->category; ?></a></li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <?php foreach(array_slice($topmenucategory, 10, 20) as $menucategory){ ?>
                                            <li><a href="<?php echo base_url() ?>Shop/Category/<?php echo $menucategory->idtbl_product_category.'/'.str_replace($rejectcontent, $replaceword, $menucategory->category); ?>"><?php echo $menucategory->category; ?></a></li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <?php foreach(array_slice($topmenucategory, 20, 30) as $menucategory){ ?>
                                            <li><a href="<?php echo base_url() ?>Shop/Category/<?php echo $menucategory->idtbl_product_category.'/'.str_replace($rejectcontent, $replaceword, $menucategory->category); ?>"><?php echo $menucategory->category; ?></a></li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <?php foreach(array_slice($topmenucategory, 30, 40) as $menucategory){ ?>
                                            <li><a href="<?php echo base_url() ?>Shop/Category/<?php echo $menucategory->idtbl_product_category.'/'.str_replace($rejectcontent, $replaceword, $menucategory->category); ?>"><?php echo $menucategory->category; ?></a></li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                </ul>
                                <!-- End of Megamenu -->
                            </li>
                            <li>
                                <a href="<?php echo base_url() ?>">Corporate & Bulk Purchasing</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url() ?>Aboutus">About Us</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url() ?>Contactus">Contact Us</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="header-right">
                    <a href="#" class="d-xl-show"><i class="w-icon-map-marker mr-1"></i>Track My Order</a>
                    <a href="#"><i class="w-icon-sale"></i>Daily Deals</a>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- End of Header -->