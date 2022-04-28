<?php 
$getUrl=$_SERVER['SCRIPT_NAME'];
$url=explode('/', $getUrl);
$lastElement=end($url);

if($lastElement=='useraccount.php'){
    $addcheck=checkprivilege($menuprivilegearray, 1, 1);
    $editcheck=checkprivilege($menuprivilegearray, 1, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 1, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 1, 4);
}
else if($lastElement=='usertype.php'){
    $addcheck=checkprivilege($menuprivilegearray, 2, 1);
    $editcheck=checkprivilege($menuprivilegearray, 2, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 2, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 2, 4);
}
else if($lastElement=='userprivilege.php'){
    $addcheck=checkprivilege($menuprivilegearray, 3, 1);
    $editcheck=checkprivilege($menuprivilegearray, 3, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 3, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 3, 4);
}
else if($lastElement=='productcategory.php'){
    $addcheck=checkprivilege($menuprivilegearray, 4, 1);
    $editcheck=checkprivilege($menuprivilegearray, 4, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 4, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 4, 4);
}
else if($lastElement=='productsubcategory.php'){
    $addcheck=checkprivilege($menuprivilegearray, 5, 1);
    $editcheck=checkprivilege($menuprivilegearray, 5, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 5, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 5, 4);
}
else if($lastElement=='product.php'){
    $addcheck=checkprivilege($menuprivilegearray, 6, 1);
    $editcheck=checkprivilege($menuprivilegearray, 6, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 6, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 6, 4);
}
else if($lastElement=='customer.php'){
    $addcheck=checkprivilege($menuprivilegearray, 7, 1);
    $editcheck=checkprivilege($menuprivilegearray, 7, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 7, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 7, 4);
}
else if($lastElement=='orderlist.php'){
    $addcheck=checkprivilege($menuprivilegearray, 8, 1);
    $editcheck=checkprivilege($menuprivilegearray, 8, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 8, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 8, 4);
}
else if($lastElement=='productcolour.php'){
    $addcheck=checkprivilege($menuprivilegearray, 9, 1);
    $editcheck=checkprivilege($menuprivilegearray, 9, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 9, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 9, 4);
}
else if($lastElement=='productflavour.php'){
    $addcheck=checkprivilege($menuprivilegearray, 10, 1);
    $editcheck=checkprivilege($menuprivilegearray, 10, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 10, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 10, 4);
}
else if($lastElement=='slideshow.php'){
    $addcheck=checkprivilege($menuprivilegearray, 11, 1);
    $editcheck=checkprivilege($menuprivilegearray, 11, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 11, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 11, 4);
}
else if($lastElement=='homeoffer.php'){
    $addcheck=checkprivilege($menuprivilegearray, 12, 1);
    $editcheck=checkprivilege($menuprivilegearray, 12, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 12, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 12, 4);
}
else if($lastElement=='productbrand.php'){
    $addcheck=checkprivilege($menuprivilegearray, 13, 1);
    $editcheck=checkprivilege($menuprivilegearray, 13, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 13, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 13, 4);
}
else if($lastElement=='city.php'){
    $addcheck=checkprivilege($menuprivilegearray, 14, 1);
    $editcheck=checkprivilege($menuprivilegearray, 14, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 14, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 14, 4);
}
else if($lastElement=='coastalarea.php'){
    $addcheck=checkprivilege($menuprivilegearray, 15, 1);
    $editcheck=checkprivilege($menuprivilegearray, 15, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 15, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 15, 4);
}
else if($lastElement=='shippingrate.php'){
    $addcheck=checkprivilege($menuprivilegearray, 16, 1);
    $editcheck=checkprivilege($menuprivilegearray, 16, 2);
    $statuscheck=checkprivilege($menuprivilegearray, 16, 3);
    $deletecheck=checkprivilege($menuprivilegearray, 16, 4);
}

function checkprivilege($arraymenu, $menuID, $type){
    foreach($arraymenu as $array){
        if($array->menuid==$menuID){
            if($type==1){
                return $array->add;
            }
            else if($type==2){
                return $array->edit;
            }
            else if($type==3){
                return $array->statuschange;
            }
            else if($type==4){
                return $array->remove;
            }
        }
    }
}
?>
<textarea class="d-none" id="actiontext"><?php echo $actionJSON; ?></textarea>
<input type="hidden" id="userType" value="<?php echo $_SESSION['type']; ?>">
<nav class="sidenav shadow-right sidenav-light">
    <div class="sidenav-menu">
        <div class="nav accordion" id="accordionSidenav">
            <div class="sidenav-menu-heading">Core</div>
            <a class="nav-link p-0 px-3 py-2" href="dashboard.php">
                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                Dashboard
            </a>
            <?php if(menucheck($menuprivilegearray, 8)==1){ ?> 
            <a class="nav-link p-0 px-3 py-2" href="orderlist.php">
                <div class="nav-link-icon"><i data-feather="list"></i></div>
                Order list
            </a>
            <?php //} if(menucheck($menuprivilegearray, 17)==1){ ?> 
            <!-- <a class="nav-link p-0 px-3 py-2" href="ordertracking.php">
                <div class="nav-link-icon"><i data-feather="map-pin"></i></div>
                Order Tracking
            </a> -->
            <?php }if(menucheck($menuprivilegearray, 7)==1){ ?> 
            <a class="nav-link p-0 px-3 py-2" href="customer.php">
                <div class="nav-link-icon"><i data-feather="user"></i></div>
                Customer
            </a>
            <?php }if(menucheck($menuprivilegearray, 14)==1){ ?> 
            <a class="nav-link p-0 px-3 py-2" href="city.php">
                <div class="nav-link-icon"><i data-feather="map-pin"></i></div>
                City
            </a>
            <?php }if(menucheck($menuprivilegearray, 15)==1){ ?> 
            <a class="nav-link p-0 px-3 py-2" href="coastalarea.php">
                <div class="nav-link-icon"><i class="fas fa-map"></i></div>
                Coastal Area
            </a>
            <?php }if(menucheck($menuprivilegearray, 16)==1){ ?> 
            <a class="nav-link p-0 px-3 py-2" href="shippingrate.php">
                <div class="nav-link-icon"><i class="fas fa-truck"></i></div>
                Shipping Rate
            </a>
            <?php } if(menucheck($menuprivilegearray, 4)==1 | menucheck($menuprivilegearray, 5)==1 | menucheck($menuprivilegearray, 6)==1 | menucheck($menuprivilegearray, 9)==1 | menucheck($menuprivilegearray, 10)==1 | menucheck($menuprivilegearray, 13)==1){ ?>
            <a class="nav-link p-0 px-3 py-2 collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseProduct" aria-expanded="false" aria-controls="collapseProduct">
                <div class="nav-link-icon"><i data-feather="briefcase"></i></div>
                Product
                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse <?php if($lastElement=="productcategory.php" | $lastElement=="productsubcategory.php" | $lastElement=="product.php" | $lastElement=="productcolour.php" | $lastElement=="productflavour.php" | $lastElement=="productbrand.php"){echo 'show';} ?>" id="collapseProduct" data-parent="#accordionSidenav">
                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                    <?php if(menucheck($menuprivilegearray, 4)==1){ ?> 
                    <a class="nav-link p-0 px-3 py-1" href="productcategory.php">Product Category</a>
                    <?php }if(menucheck($menuprivilegearray, 5)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1" href="productsubcategory.php">Product Sub Category</a>
                    <?php }if(menucheck($menuprivilegearray, 9)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1" href="productcolour.php">Product Colour</a>
                    <?php }if(menucheck($menuprivilegearray, 10)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1" href="productflavour.php">Product Flavour</a>
                    <?php }if(menucheck($menuprivilegearray, 13)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1" href="productbrand.php">Product Brand</a>
                    <?php }if(menucheck($menuprivilegearray, 6)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1" href="product.php">Product</a>
                    <?php } ?>
                </nav>
            </div>
            <?php }if(menucheck($menuprivilegearray, 11)==1){ ?> 
            <a class="nav-link p-0 px-3 py-2" href="slideshow.php">
                <div class="nav-link-icon"><i data-feather="image"></i></div>
                Main Slider
            </a>
            <?php }if(menucheck($menuprivilegearray, 12)==1){ ?> 
            <a class="nav-link p-0 px-3 py-2" href="homeoffer.php">
                <div class="nav-link-icon"><i data-feather="percent"></i></div>
                Home Offer
            </a>
            <?php } if(menucheck($menuprivilegearray, 1)==1 | menucheck($menuprivilegearray, 2)==1 | menucheck($menuprivilegearray, 3)==1 | menucheck($menuprivilegearray, 10)==1){ ?>
            <a class="nav-link p-0 px-3 py-2 collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseUser" aria-expanded="false" aria-controls="collapseUser">
                <div class="nav-link-icon"><i data-feather="user"></i></div>
                User Account
                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse <?php if($lastElement=="useraccount.php" | $lastElement=="usertype.php" | $lastElement=="userprivilege.php" | $lastElement=="employee.php" | $lastElement=="useractivatecode.php"){echo 'show';} ?>" id="collapseUser" data-parent="#accordionSidenav">
                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                    <?php if(menucheck($menuprivilegearray, 1)==1){ ?> 
                    <a class="nav-link p-0 px-3 py-1" href="useraccount.php">User Account</a>
                    <?php }if(menucheck($menuprivilegearray, 2)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1" href="usertype.php">Type</a>
                    <?php }if(menucheck($menuprivilegearray, 3)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1" href="userprivilege.php">Privilege</a>
                    <?php //}if(menucheck($menuprivilegearray, 10)==1){ ?>
                    <!-- <a class="nav-link p-0 px-3 py-1" href="useractivatecode.php">User Activate Code</a> -->
                    <?php } ?>
                </nav>
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="sidenav-footer">
        <div class="sidenav-footer-content">
            <div class="sidenav-footer-subtitle">Logged in as:</div>
            <div class="sidenav-footer-title"><?php echo ucfirst($_SESSION['name']); ?></div>
        </div>
    </div>
</nav>
