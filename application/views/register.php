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
        .vendor-widget-2:hover{border-color:#eee}
        .border-danger {border-color: #e81500 !important;}
    </style>
</head>

<body>
    <div class="page-wrapper">
        <?php include "include/menu.php"; ?>
        <!-- Start of Page Header -->
        <div class="page-header">
            <div class="container">
                <h1 class="page-title mb-0">Register</h1>
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
                        <li>Register</li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of Page Content -->
            <div class="page-content mb-10 pb-2">
                <div class="container">
                    <section class="mb-10">
                        <!-- <h2 class="title title-center mb-5">Enter your security code</h2> -->
                        <div class="row justify-content-center">
                            <div class="login-popup">
                                <div class="vendor-widget">
                                    <div class="vendor-widget-2">                                        
                                        <form action="<?php echo base_url() ?>Account/Signup" method="post" autocomplete="off">
                                            <?php if($this->session->flashdata('msg')) { ?>
                                            <div class="alert alert-icon alert-error alert-bg alert-inline mb-4 text-center" role="alert">
                                                <h4 class="alert-title"><i class="w-icon-exclamation-circle"></i> Error</h4>
                                                <?php echo $this->session->flashdata('msg'); ?>
                                            </div>
                                            <?php } ?>
                                            <div class="row gutter-sm">
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label>First Name *</label>
                                                        <input type="text" class="form-control text-dark" name="regfirst" id="regfirst" required autofocus>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label>Last Name *</label>
                                                        <input type="text" class="form-control text-dark" name="reglast" id="reglast" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row gutter-sm mb-3">
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label>Country *</label>
                                                        <select class="form-control text-dark" name="regcountry" id="regcountry" required>
                                                            <option value="">Select</option>
                                                            <?php foreach($countrylist->result() as $rowcountrylist){ ?>
                                                            <option value="<?php echo $rowcountrylist->idtbl_country ?>" <?php if($rowcountrylist->idtbl_country==210){echo 'selected';} ?>><?php echo $rowcountrylist->country ?></option>
                                                            <?php } ?>
                                                        </select>                                                     
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label>Mobile *</label>
                                                        <input type="tel" class="form-control text-dark" name="regmobile" id="regmobile" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" minlength="10" maxlength="10" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Email address *</label>
                                                <input type="email" class="form-control text-dark" name="regemail" id="regemail" required>
                                            </div>
                                            <div class="row gutter-sm mb-3">
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label>Password *</label>
                                                        <input type="password" class="form-control text-dark" name="regpassword" id="regpassword" required>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label>Enter Confirm Password *</label>
                                                        <input type="password" class="form-control text-dark" name="regrepassword" id="regrepassword" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <p>Your personal data will be used to support your experience 
                                                throughout this website, to manage access to your account, 
                                                and for other purposes described in our <a href="<?php echo base_url() ?>Welcome/Privacy" class="text-primary">privacy policy</a>.</p>
                                            <div class="form-checkbox d-flex align-items-center justify-content-between mb-5">
                                                <input type="checkbox" class="custom-checkbox" id="agree" name="agree" required>
                                                <label for="agree" class="font-size-md">I agree to the <a  href="<?php echo base_url() ?>Welcome/Privacy" class="text-primary font-size-md">privacy policy</a></label>
                                            </div>
                                            <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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

    <script>
        $(document).ready(function(){
            $("#regcountry").select2();

            $("#regrepassword").keyup(checkPasswordMatch);
        });
        function checkPasswordMatch() {
            var password = $("#regpassword").val();
            var confirmPassword = $("#regrepassword").val();
            if (password != confirmPassword){
                $("#regpassword").addClass('border-danger');
                $("#regrepassword").addClass('border-danger');
            }                
            else{
                $("#regpassword").removeClass('border-danger');
                $("#regrepassword").removeClass('border-danger');
            }   
        }
    </script>
</body>

</html>