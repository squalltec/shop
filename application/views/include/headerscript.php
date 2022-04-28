<?php
$controllermenu=$this->router->fetch_class();
$functionmenu=$this->router->fetch_method();
?>
<!-- Favicon -->
<link rel="icon" type="image/png" href="<?php echo base_url() ?>images/icons/favicon.png">

<!-- WebFont.js -->
<script>
    WebFontConfig = {
        google: {
            families: ['Poppins:400,500,600,700,800']
        }
    };
    (function (d) {
        var wf = d.createElement('script'),
            s = d.scripts[0];
        wf.src = 'assets/js/webfont.js';
        wf.async = true;
        s.parentNode.insertBefore(wf, s);
    })(document);
</script>

<link rel="preload" href="<?php echo base_url() ?>assets/vendor/fontawesome-free/webfonts/fa-regular-400.woff2" as="font" type="font/woff2">
<link rel="preload" href="<?php echo base_url() ?>assets/vendor/fontawesome-free/webfonts/fa-solid-900.woff2" as="font" type="font/woff2">
<link rel="preload" href="<?php echo base_url() ?>assets/vendor/fontawesome-free/webfonts/fa-brands-400.woff2" as="font" type="font/woff2">
<link rel="preload" href="<?php echo base_url() ?>assets/fonts/wolmart.ttf?png09e" as="font" type="font/ttf">

<!-- Vendor CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/vendor/fontawesome-free/css/all.min.css">

<!-- Plugins CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/vendor/owl-carousel/owl.carousel.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/vendor/animate/animate.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/vendor/magnific-popup/magnific-popup.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/vendor/photoswipe/photoswipe.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/vendor/photoswipe/default-skin/default-skin.min.css">

<!--Select2 css-->
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/select2.css">

<!-- Default CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/style.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/demo1.min.css">

<!-- Flaticon CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/flaticon/flaticon.css">

<style>
<?php if($controllermenu=='welcome'){ ?>
.header-bottom:not(.fixed) .category-dropdown > a {
    background-color: #f1f1f1;
}

.header-bottom:not(.fixed) .dropdown-box {
    opacity: 1;
    visibility: visible;
    transform: none;
}
<?php } else{ ?>
.header-bottom:not(.fixed) .category-dropdown > a {
    background-color: #FFF;
}
<?php } ?>
.category-dropdown:hover > a,
.category-dropdown.show > a {
    background-color: #f1f1f1;
}

/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>
<input type="hidden" id="hidebaseurl" value="<?php echo base_url(); ?>">