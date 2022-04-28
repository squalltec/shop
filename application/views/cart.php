<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>Cart - EASY SHOP</title>

    <meta name="keywords" content="" />
    <meta name="description" content="">
    <meta name="author" content="Pro PC Solution">

    <?php include "include/headerscript.php"; ?>
    <style>
        .table-danger,.table-danger>td,.table-danger>th{background-color:#f5c6cb}.table-hover .table-danger:hover{background-color:#f1b0b7}.table-hover .table-danger:hover>td,.table-hover .table-danger:hover>th{background-color:#f1b0b7}
    </style>
</head>

<body>
    <div class="page-wrapper">
        <?php include "include/menu.php"; ?>

        <!-- Start of Main -->
        <main class="main cart">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb shop-breadcrumb bb-no">
                        <li class="active"><a href="<?php echo base_url().'Cart' ?>">Shopping Cart</a></li>
                        <li><a href="<?php echo base_url().'Cart/Checkout' ?>">Checkout</a></li>
                        <li><a href="#">Order Complete</a></li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of PageContent -->
            <div class="page-content">
                <div class="container">
                    <div class="row gutter-lg mb-10">
                        <div class="col-lg-8 pr-lg-4 mb-6">
                            <?php if($this->session->flashdata('msg')) { ?>
                            <div class="alert alert-icon alert-error alert-bg alert-inline mb-4 text-center" role="alert">
                                <h4 class="alert-title"><i class="w-icon-exclamation-circle"></i> Error</h4>
                                <?php echo $this->session->flashdata('msg'); ?>
                            </div>
                            <?php } ?>
                            <table class="shop-table cart-table">
                                <thead>
                                    <tr>
                                        <th class="product-name"><span>Product</span></th>
                                        <th></th>
                                        <th class="product-price"><span>Price</span></th>
                                        <th class="product-quantity text-center"><span>Quantity</span></th>
                                        <th class="product-subtotal"><span>Subtotal</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    foreach($this->cart->contents() as $rowshopcart){ 
                                        $productID=$rowshopcart['id'];
                                        $productqty=$rowshopcart['qty'];
                                        
                                        $sqlcheck="SELECT COUNT(*) AS `count` FROM `tbl_product` WHERE `status`=? AND `idtbl_product`=? AND `stock`>=?";
                                        $respondcheck=$this->db->query($sqlcheck, array(1, $productID, $productqty)); 
                                    ?>
                                    <tr class="<?php if($respondcheck->row(0)->count==0){echo 'table-danger';} ?>">
                                        <td class="product-thumbnail">
                                            <div class="p-relative">
                                                <a href="#">
                                                    <figure>
                                                        <img src="<?php echo base_url().$rowshopcart['options']['listimagepath'] ?>" alt="product"
                                                            width="300" height="338">
                                                    </figure>
                                                </a>
                                                <button type="button" class="btn btn-close cartremove" id="<?php echo $rowshopcart['rowid'] ?>"><i
                                                        class="fas fa-times"></i></button>
                                            </div>
                                        </td>
                                        <td class="product-name">
                                            <a href="#">
                                                <?php echo $rowshopcart['name'] ?>
                                            </a>
                                        </td>
                                        <td class="product-price"><span class="amount">Rs <?php echo $rowshopcart['price'] ?></span></td>
                                        <td class="product-quantity text-center">
                                            <span class="amount"><?php echo $rowshopcart['qty'] ?></span>
                                        </td>
                                        <td class="product-subtotal">
                                            <span class="amount">Rs <?php echo number_format($rowshopcart['qty']*$rowshopcart['price']); ?></span>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                            <div class="cart-action mb-6">
                                <a href="<?php echo base_url() ?>Shop" class="btn btn-dark btn-rounded btn-icon-left btn-shopping mr-auto"><i class="w-icon-long-arrow-left"></i>Continue Shopping</a>
                                <!-- <button type="submit" class="btn btn-rounded btn-default btn-clear" name="clear_cart" value="Clear Cart">Clear Cart</button> 
                                <button type="submit" class="btn btn-rounded btn-update disabled" name="update_cart" value="Update Cart">Update Cart</button> -->
                            </div>

                            <!-- <form class="coupon">
                                <h5 class="title coupon-title font-weight-bold text-uppercase">Coupon Discount</h5>
                                <input type="text" class="form-control mb-4" placeholder="Enter coupon code here..." required />
                                <button class="btn btn-dark btn-outline btn-rounded">Apply Coupon</button>
                            </form> -->
                        </div>
                        <div class="col-lg-4 sticky-sidebar-wrapper">
                            <div class="sticky-sidebar">
                                <div class="cart-summary mb-4">
                                    <h3 class="cart-title text-uppercase">Cart Totals</h3>
                                    <div class="cart-subtotal d-flex align-items-center justify-content-between">
                                        <label class="ls-25">Subtotal</label>
                                        <span>Rs <?php echo $this->cart->format_number($this->cart->total()) ?></span>
                                    </div>
                                    <hr class="divider">
                                    <div class="cart-subtotal d-flex align-items-center justify-content-between">
                                        <label class="ls-25">Shipping</label>
                                        <span>Rs 0.00</span>
                                    </div>

                                    <!-- <hr class="divider">

                                    <ul class="shipping-methods mb-2">
                                        <li>
                                            <label
                                                class="shipping-title text-dark font-weight-bold">Shipping</label>
                                        </li>
                                        <li>
                                            <div class="custom-radio">
                                                <input type="radio" id="free-shipping" class="custom-control-input"
                                                    name="shipping">
                                                <label for="free-shipping"
                                                    class="custom-control-label color-dark">Free
                                                    Shipping</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-radio">
                                                <input type="radio" id="local-pickup" class="custom-control-input"
                                                    name="shipping">
                                                <label for="local-pickup"
                                                    class="custom-control-label color-dark">Local
                                                    Pickup</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-radio">
                                                <input type="radio" id="flat-rate" class="custom-control-input"
                                                    name="shipping">
                                                <label for="flat-rate" class="custom-control-label color-dark">Flat
                                                    rate:
                                                    $5.00</label>
                                            </div>
                                        </li>
                                    </ul>

                                    <div class="shipping-calculator">
                                        <p class="shipping-destination lh-1">Shipping to <strong>CA</strong>.</p>

                                        <form class="shipping-calculator-form">
                                            <div class="form-group">
                                                <div class="select-box">
                                                    <select name="country" class="form-control form-control-md">
                                                        <option value="default" selected="selected">United States
                                                            (US)
                                                        </option>
                                                        <option value="us">United States</option>
                                                        <option value="uk">United Kingdom</option>
                                                        <option value="fr">France</option>
                                                        <option value="aus">Australia</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="select-box">
                                                    <select name="state" class="form-control form-control-md">
                                                        <option value="default" selected="selected">California
                                                        </option>
                                                        <option value="ohaio">Ohaio</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control form-control-md" type="text"
                                                    name="town-city" placeholder="Town / City">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control form-control-md" type="text"
                                                    name="zipcode" placeholder="ZIP">
                                            </div>
                                            <button type="submit" class="btn btn-dark btn-outline btn-rounded">Update
                                                Totals</button>
                                        </form>
                                    </div> -->

                                    <hr class="divider mb-6">
                                    <div class="order-total d-flex justify-content-between align-items-center">
                                        <label>Total</label>
                                        <span class="ls-50">Rs <?php echo $this->cart->format_number($this->cart->total()) ?></span>
                                    </div>
                                    <a href="<?php echo base_url().'Cart/Checkout' ?>"
                                        class="btn btn-block btn-dark btn-icon-right btn-rounded  btn-checkout">
                                        Proceed to checkout<i class="w-icon-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of PageContent -->
        </main>
        <!-- End of Main -->

        <?php include "include/footercontent.php"; ?>
    </div>
    <?php include "include/footerscript.php"; ?>
    <script>
        $(document).ready(function(){
			$('.cartremove').click(function(e){
                e.preventDefault();

                var rowID = $(this).attr("id");
                
                $.ajax({
                    url: "<?php echo base_url('Cart/Removeminicart');?>",
                    method: "POST",
                    data: {
                        rowID: rowID
                    },
                    success: function(data) { 
                        location.reload();
                    }
                });
            });
		});
    </script>
</body>

</html>