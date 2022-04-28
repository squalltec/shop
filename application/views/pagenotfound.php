<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>Page Not Found - EASY SHOP</title>

    <meta name="keywords" content="" />
    <meta name="description" content="">
    <meta name="author" content="Pro PC Solution">

    <?php include "include/headerscript.php"; ?>
</head>

<body>
    <!-- Start of Page Wrapper -->
    <div class="page-wrapper">
        <?php include "include/menu.php"; ?>

        <!-- Start of Main -->
        <main class="main">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb bb-no">
                        <li><a href="<?php echo base_url() ?>">Home</a></li>
                        <li>Error 404</li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of Page Content -->
            <div class="page-content error-404">
                <div class="container">
                    <div class="banner">
                        <figure>
                            <img src="<?php echo base_url() ?>images/pages/404.png" alt="Error 404"  
                                width="820" height="460" />
                        </figure>
                        <div class="banner-content text-center">
                            <h2 class="banner-title">
                                <span class="text-secondary">Oops!!!</span> Something Went Wrong Here
                            </h2>
                            <p class="text-light">There may be a misspelling in the URL entered, or the page you are looking for may no longer exist</p>
                            <a href="<?php echo base_url() ?>" class="btn btn-dark btn-rounded btn-icon-right">Go Back Home<i class="w-icon-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Page Content -->
        </main>
        <!-- End of Main -->

        <?php include "include/footercontent.php"; ?>
    </div>
    <!-- End of Page Wrapper -->

    <?php include "include/footerscript.php"; ?>
</body>
</html>