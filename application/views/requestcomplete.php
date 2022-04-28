<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>Checkout - EASY SHOP</title>

    <meta name="keywords" content="" />
    <meta name="description" content="">
    <meta name="author" content="Pro PC Solution">

    <?php include "include/headerscript.php"; ?>
</head>

<body>
    <div class="page-wrapper">
        <?php include "include/menu.php"; ?>

        <!-- Start of Main -->
        <main class="main checkout">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb shop-breadcrumb bb-no">
                        <li class="passed"><a href="#">Shopping Cart</a></li>
                        <li class="passed"><a href="#">Checkout</a></li>
                        <li class="active"><a href="#">Order Complete</a></li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of PageContent -->
            <div class="page-content">
                <div class="container">
                    <div class="banner-content text-center mb-5">
                        <h2 class="banner-title">
                            <span class="text-secondary">Thank You</span> Your order is confirmed
                        </h2>
                        <p class="text-light">We will reply soon your order<br> please check your mail, for check your order.</p>
                        <a href="<?php echo base_url(); ?>" class="btn btn-dark btn-rounded btn-icon-right">Go Back Home<i class="w-icon-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- End of PageContent -->
        </main>
        <!-- End of Main -->

        <?php include "include/footercontent.php"; ?>
    </div>
    <!-- End of Page Wrapper -->

    <?php include "include/footerscript.php"; ?>
    <script>
        $(document).ready(function(){
            
        });
    </script>
</body>

</html>