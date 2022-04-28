<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>Account Activate - EASY SHOP</title>

    <meta name="keywords" content="" />
    <meta name="description" content="">
    <meta name="author" content="Pro PC Solution">

    <?php include "include/headerscript.php"; ?>
    <style>
        .vendor-widget-2:hover {
            border-color: #eee
        }
    </style>
</head>

<body>
    <div class="page-wrapper">
        <?php include "include/menu.php"; ?>
        <!-- Start of Page Header -->
        <div class="page-header">
            <div class="container">
                <h1 class="page-title mb-0">Login</h1>
                <h4 class="page-subtitle">Welcome to EASY SHOP Holdings</h4>
            </div>
        </div>
        <!-- End of Page Header -->

        <!-- Start of Main -->
        <main class="main">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav mb-3 pb-1">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li>Login</li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of Page Content -->
            <div class="page-content mb-10 pb-2">
                <div class="container">
                    <section class="mb-10">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <div class="row category-cosmetic-lifestyle appear-animate mt-7">
                                    <?php 
                                    if(count($topofferbanner->result())>0){
                                        foreach($topofferbanner->result() as $rowtopoffer){
                                    ?>
                                    <div class="col-md-12 mb-4 d-none d-lg-block d-xl-none">
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
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <div class="login-popup">
                                    <div class="vendor-widget">
                                        <div class="vendor-widget-2">
                                            <form action="<?php echo base_url().'Account/Loginaccount' ?>" method="post" autocomplete="off">
                                                <?php if($this->session->flashdata('msg')) { ?>
                                                <div class="alert alert-icon alert-error alert-bg alert-inline mb-4 text-center" role="alert">
                                                    <h4 class="alert-title"><i class="w-icon-exclamation-circle"></i> Error</h4>
                                                    <?php echo $this->session->flashdata('msg'); ?>
                                                </div>
                                                <?php } ?>
                                                <div class="form-group">
                                                    <label>Mobile or Email address *</label>
                                                    <input type="text" class="form-control" name="logusername" id="logusername" required>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <label>Password *</label>
                                                    <input type="password" class="form-control" name="logpassword" id="logpassword" required>
                                                </div>
                                                <div class="form-checkbox d-flex align-items-center justify-content-between">
                                                    <a href="<?php echo base_url().'Account/Register' ?>" class="text-primary">New member? Register here</a>
                                                    <a href="<?php echo base_url().'Account/Lostpassword' ?>">Lost your password?</a>
                                                </div>
                                                <p>Your personal data will be used to support your experience 
                                                throughout this website, to manage access to your account, 
                                                and for other purposes described in our <a href="#" class="text-primary">privacy policy</a>.</p>
                                                <button type="submit" class="btn btn-primary w-100 mb-3">Sign In</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <h2 class="title title-center mb-5">Enter your security code</h2> -->
                    </section>
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