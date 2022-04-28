<!-- Start of Sticky Footer -->
<div class="sticky-footer sticky-content fix-bottom">
    <a href="<?php echo base_url() ?>" class="sticky-link active">
        <i class="w-icon-home"></i>
        <p>Home</p>
    </a>
    <a href="<?php echo base_url() ?>Shop" class="sticky-link">
        <i class="w-icon-category"></i>
        <p>Shop</p>
    </a>
    <a href="<?php if(!empty($_SESSION['user_id'])){echo base_url().'Account'; }else{echo base_url().'Account/Accountlogin';} ?>" class="sticky-link">
        <i class="w-icon-account"></i>
        <p>Account</p>
    </a>
    <div class="cart-dropdown dir-up">
        <a href="#" class="sticky-link">
            <i class="w-icon-cart"></i>
            <p>Cart</p>
        </a>
        <div class="dropdown-box">
            <div class="products">
                <div class="product product-cart">
                    <div class="product-detail">
                        <h3 class="product-name">
                            <a href="product-default.html">Beige knitted elas<br>tic
                                runner shoes</a>
                        </h3>
                        <div class="price-box">
                            <span class="product-quantity">1</span>
                            <span class="product-price">$25.68</span>
                        </div>
                    </div>
                    <figure class="product-media">
                        <a href="product-default.html">
                            <img src="<?php echo base_url() ?>images/cart/product-1.jpg" alt="product" height="84" width="94" />
                        </a>
                    </figure>
                    <button class="btn btn-link btn-close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="product product-cart">
                    <div class="product-detail">
                        <h3 class="product-name">
                            <a href="product-default.html">Blue utility pina<br>fore
                                denim dress</a>
                        </h3>
                        <div class="price-box">
                            <span class="product-quantity">1</span>
                            <span class="product-price">$32.99</span>
                        </div>
                    </div>
                    <figure class="product-media">
                        <a href="product-default.html">
                            <img src="<?php echo base_url() ?>images/cart/product-2.jpg" alt="product" width="84" height="94" />
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
        </div>
        <!-- End of Dropdown Box -->
    </div>

    <div class="header-search hs-toggle dir-up">
        <a href="#" class="search-toggle sticky-link">
            <i class="w-icon-search"></i>
            <p>Search</p>
        </a>
        <form action="#" class="input-wrapper">
            <input type="text" class="form-control" name="search" autocomplete="off" placeholder="Search"
                required />
            <button class="btn btn-search" type="submit">
                <i class="w-icon-search"></i>
            </button>
        </form>
    </div>
</div>
<!-- End of Sticky Footer -->

<!-- Start of Scroll Top -->
<a id="scroll-top" href="#top" title="Top" role="button" class="scroll-top"><i class="fas fa-chevron-up"></i></a>
<!-- End of Scroll Top -->

<!-- Start of Mobile Menu -->
<div class="mobile-menu-wrapper">
    <div class="mobile-menu-overlay"></div>
    <!-- End of .mobile-menu-overlay -->

    <a href="#" class="mobile-menu-close"><i class="close-icon"></i></a>
    <!-- End of .mobile-menu-close -->

    <div class="mobile-menu-container scrollable">
        <form action="#" method="get" class="input-wrapper">
            <input type="text" class="form-control" name="search" autocomplete="off" placeholder="Search"
                required />
            <button class="btn btn-search" type="submit">
                <i class="w-icon-search"></i>
            </button>
        </form>
        <!-- End of Search Form -->
        <div class="tab">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a href="#main-menu" class="nav-link active">Main Menu</a>
                </li>
                <li class="nav-item">
                    <a href="#categories" class="nav-link">Categories</a>
                </li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="main-menu">
                <ul class="mobile-menu">
                    <li><a href="<?php echo base_url() ?>">Home</a></li>
                    <li><a href="<?php echo base_url() ?>Shop">Shop</a></li>
                    <li>
                        <a href="shop-banner-sidebar.html">Product Category</a>
                        <ul>
                            <?php 
                            foreach(array_slice($topmenucategory, 0, 40) as $menucategory){ 
                                $rejectcontent=[" ", "(", ")", "&"]; 
                                $replaceword=["", "", "", ""];    
                            ?>
                            <li><a href="<?php echo base_url() ?>Shop/Category/<?php echo $menucategory->idtbl_product_category.'/'.str_replace($rejectcontent, $replaceword, $menucategory->category); ?>"><?php echo $menucategory->category; ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li><a href="<?php echo base_url() ?>Aboutus">About Us</a></li>
                    <li><a href="<?php echo base_url() ?>Contactus">Contact Us</a></li>
                </ul>
            </div>
            <div class="tab-pane" id="categories">
                <ul class="mobile-menu">
                    <?php 
                    foreach(array_slice($topmenucategory, 0, 11) as $menucategory){ 
                        $rejectcontent=[" ", "(", ")", "&"]; 
                        $replaceword=["", "", "", ""]; 
                    ?>
                    <li>
                        <a href="<?php echo base_url() ?>Shop/Category/<?php echo $menucategory->idtbl_product_category.'/'.str_replace($rejectcontent, $replaceword, $menucategory->category); ?>">
                            <i class="flaticon-<?php echo $menucategory->iconclass; ?>"></i><?php echo $menucategory->category; ?>
                        </a>
                        <?php if(count($menucategory->subcategory)>0){ ?>
                        <ul>
                            <?php
                            foreach(array_slice($menucategory->subcategory, 0, 30) as $menusubcategory){ 
                            ?>
                            <li><a href="<?php echo base_url().'Shop/Subcategory/'.$menusubcategory->idtbl_product_sub_category.'/'.$menusubcategory->subcategory ?>"><?php echo $menusubcategory->subcategory ?></a>
                            </li>
                            <?php } ?>
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
    </div>
</div>
<!-- End of Mobile Menu -->

<script>
    var url = 'https://wati-integration-service.clare.ai/ShopifyWidget/shopifyWidget.js?79072';
    var s = document.createElement('script');
    s.type = 'text/javascript';
    s.async = true;
    s.src = url;
    var options = {
  "enabled":true,
  "chatButtonSetting":{
      "backgroundColor":"#4dc247",
      "ctaText":"",
      "borderRadius":"25",
      "marginLeft":"0",
      "marginBottom":"50",
      "marginRight":"50",
      "position":"right"
  },
  "brandSetting":{
      "brandName":"LAOL Mart",
      "brandSubTitle":"For extended marketing experience ",
      "brandImg":"https://laolmart.com/sample/images/icons/favicon.png",
      "welcomeText":"Hi there!\nHow can I help you?",
      "messageText":"Hello, I have a question about",
      "backgroundColor":"#0a5f54",
      "ctaText":"Start Chat",
      "borderRadius":"25",
      "autoShow":false,
      "phoneNumber":"94767294942"
  }
};
    s.onload = function() {
        CreateWhatsappChatWidget(options);
    };
    var x = document.getElementsByTagName('script')[0];
    x.parentNode.insertBefore(s, x);
</script>

<!-- Plugin JS File -->
<script src="<?php echo base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/jquery.plugin/jquery.plugin.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/owl-carousel/owl.carousel.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/zoom/jquery.zoom.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/jquery.countdown/jquery.countdown.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/skrollr/skrollr.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/photoswipe/photoswipe.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/photoswipe/photoswipe-ui-default.js"></script>

<!-- Select2 JS -->
<script src="<?php echo base_url()?>assets/js/select2.full.js"></script>

<!-- Main JS -->
<script src="<?php echo base_url() ?>assets/js/main.js"></script>
<script>
$(document).ready(function(){
    showminicart();
});
function showminicart(){
    $.ajax({
        url: "<?php echo base_url('Cart/Showminicart');?>",
        method: "POST",
        data: {},
        success: function(data) { 
            $('#topmenucart').html(data);
            removecart();
        }
    });
}
function addtocart(productID, qty){
    $.ajax({
        url: "<?php echo base_url('Cart/Addtocart');?>",
        method: "POST",
        data: {
            productID: productID,
            qty: qty
        },
        success: function(data) { //alert(data);
            $('#topmenucart').html(data);
            removecart();
        }
    });
}
function removecart(){
    $('.removecartitem').click(function(e){
        e.preventDefault();

        var rowID = $(this).attr("id");
        
        $.ajax({
            url: "<?php echo base_url('Cart/Removeminicart');?>",
            method: "POST",
            data: {
                rowID: rowID
            },
            success: function(data) { 
                showminicart();
            }
        });
    });
}
</script>