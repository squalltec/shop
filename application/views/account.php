<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

	<title>My Account - EASY SHOP</title>

	<meta name="keywords" content="" />
    <meta name="description" content="">
    <meta name="author" content="Pro PC Solution">

	<?php include "include/headerscript.php"; ?>
</head>

<body class="my-account">
	<div class="page-wrapper">
		<?php include "include/menu.php"; ?>

		<!-- Start of Main -->
		<main class="main">
			<!-- Start of Page Header -->
			<div class="page-header">
				<div class="container">
					<h1 class="page-title mb-0">My Account</h1>
				</div>
			</div>
			<!-- End of Page Header -->

			<!-- Start of Breadcrumb -->
			<nav class="breadcrumb-nav">
				<div class="container">
					<ul class="breadcrumb">
						<li><a href="<?php echo base_url() ?>">Home</a></li>
						<li>My account</li>
					</ul>
				</div>
			</nav>
			<!-- End of Breadcrumb -->

			<!-- Start of PageContent -->
			<div class="page-content pt-2">
				<div class="container">
					<div class="tab tab-vertical row gutter-lg">
						<ul class="nav nav-tabs mb-6" role="tablist">
							<li class="nav-item">
								<a href="#account-dashboard" class="nav-link active">Dashboard</a>
							</li>
							<li class="nav-item">
								<a href="#account-orders" class="nav-link">Orders</a>
							</li>
							<li class="nav-item">
								<a href="#account-addresses" class="nav-link">Addresses</a>
							</li>
							<li class="nav-item">
								<a href="#account-details" class="nav-link">Account details</a>
							</li>
							<li class="link-item">
								<a href="<?php echo base_url().'Account/Logout' ?>">Logout</a>
							</li>
						</ul>

						<div class="tab-content mb-6">
							<div class="tab-pane active in" id="account-dashboard">
								<?php //print_r($profileinfo); ?>
								<p class="greeting">
									Hello
									<span
										class="text-dark font-weight-bold"><?php if(!empty($_SESSION['accountname'])){echo $_SESSION['accountname'];} ?></span>
									(not
									<span
										class="text-dark font-weight-bold"><?php if(!empty($_SESSION['accountname'])){echo $_SESSION['accountname'];} ?></span>?
									<a href="<?php echo base_url().'Account/Logout' ?>" class="text-primary">Log
										out</a>)
								</p>

								<p class="mb-4">
									From your account dashboard you can view your <a href="#account-orders"
										class="text-primary link-to-tab">recent orders</a>,
									manage your <a href="#account-addresses" class="text-primary link-to-tab">shipping
										and billing
										addresses</a>, and
									<a href="#account-details" class="text-primary link-to-tab">edit your password and
										account details.</a>
								</p>

								<div class="row">
									<div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
										<a href="#account-orders" class="link-to-tab">
											<div class="icon-box text-center">
												<span class="icon-box-icon icon-orders">
													<i class="w-icon-orders"></i>
												</span>
												<div class="icon-box-content">
													<p class="text-uppercase mb-0">Orders</p>
												</div>
											</div>
										</a>
									</div>
									<div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
										<a href="#account-addresses" class="link-to-tab">
											<div class="icon-box text-center">
												<span class="icon-box-icon icon-address">
													<i class="w-icon-map-marker"></i>
												</span>
												<div class="icon-box-content">
													<p class="text-uppercase mb-0">Addresses</p>
												</div>
											</div>
										</a>
									</div>
									<div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
										<a href="#account-details" class="link-to-tab">
											<div class="icon-box text-center">
												<span class="icon-box-icon icon-account">
													<i class="w-icon-user"></i>
												</span>
												<div class="icon-box-content">
													<p class="text-uppercase mb-0">Account Details</p>
												</div>
											</div>
										</a>
									</div>
									<div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
										<a href="#">
											<div class="icon-box text-center">
												<span class="icon-box-icon icon-logout">
													<i class="w-icon-logout"></i>
												</span>
												<div class="icon-box-content">
													<p class="text-uppercase mb-0">Logout</p>
												</div>
											</div>
										</a>
									</div>
								</div>
							</div>

							<div class="tab-pane mb-4" id="account-orders">
								<div class="icon-box icon-box-side icon-box-light">
									<span class="icon-box-icon icon-orders">
										<i class="w-icon-orders"></i>
									</span>
									<div class="icon-box-content">
										<h4 class="icon-box-title text-capitalize ls-normal mb-0">Orders</h4>
									</div>
								</div>

								<table class="shop-table account-orders-table mb-6">
									<thead>
										<tr>
											<th class="order-id">Order</th>
											<th class="order-date">Date</th>
											<th class="order-status">Status</th>
											<th class="order-total">Total</th>
											<th class="order-actions">Actions</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($orderlist->result() as $roworderlist){ ?>
										<tr>
											<td class="order-id">#<?php echo $roworderlist->idtbl_order; ?></td>
											<td class="order-date"><?php echo date("F j, Y", strtotime($roworderlist->orderdate)); ?></td>
											<td class="order-status">
												<?php 
												if($roworderlist->acceptstatus==1 && $roworderlist->paystatus==1 && $roworderlist->shipstatus==1 && $roworderlist->deliverystatus==1 && $roworderlist->status==1){
													echo 'Order delivered';
												} 
												else if($roworderlist->acceptstatus==1 && $roworderlist->paystatus==1 && $roworderlist->shipstatus==1 && $roworderlist->status==1){
													echo 'Order on the way';
												} 
												else if($roworderlist->acceptstatus==1 && $roworderlist->paystatus==1 && $roworderlist->status==1){
													echo 'Order payment done';
												}
												else if($roworderlist->acceptstatus==1 && $roworderlist->status==1){
													echo 'Order accept';
												}
												else if($roworderlist->status==2){
													echo 'Order canceled';
												}
												else{
													echo 'Order processing';
												}
												?>
											</td>
											<td class="order-total">
												<span class="order-price">Rs. <?php echo number_format($roworderlist->nettotal, 2); ?></span>
											</td>
											<td class="order-action">
												<button type="button"
													class="btn btn-outline btn-default btn-block btn-sm btn-rounded btn-quickview btnpopupview" id="<?php echo $roworderlist->idtbl_order; ?>">View</button>
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>

								<a href="<?php echo base_url() ?>Shop" class="btn btn-dark btn-rounded btn-icon-right">Go
									Shop<i class="w-icon-long-arrow-right"></i></a>
							</div>

							<div class="tab-pane" id="account-addresses">
								<div class="icon-box icon-box-side icon-box-light">
									<span class="icon-box-icon icon-map-marker">
										<i class="w-icon-map-marker"></i>
									</span>
									<div class="icon-box-content">
										<h4 class="icon-box-title mb-0 ls-normal">Addresses</h4>
									</div>
								</div>
								<p>The following addresses will be used on the checkout page
									by default.</p>
								<div class="row">
									<div class="col-sm-6 mb-6">
										<div class="ecommerce-address billing-address pr-lg-8">
											<h4 class="title title-underline ls-25 font-weight-bold">Billing Address
											</h4>
											<address class="mb-4">
												<?php if(!empty($profileinfo->billaddress)){ ?>
												<table class="address-table">
													<tbody>
														<tr>
															<th>Address 1:</th>
															<td><?php echo $profileinfo->billaddress[0]->address1; ?></td>
														</tr>
														<tr>
															<th>Address 2:</th>
															<td><?php echo $profileinfo->billaddress[0]->address2; ?></td>
														</tr>
														<tr>
															<th>City:</th>
															<td><?php echo $profileinfo->billaddress[0]->city; ?></td>
														</tr>
														<tr>
															<th>Country:</th>
															<td><?php echo $profileinfo->billaddress[0]->country; ?></td>
														</tr>
														<tr class="d-none">
															<th>Postcode:</th>
															<td><?php echo $profileinfo->billaddress[0]->postalcode; ?></td>
														</tr>
														<tr>
															<th>Phone:</th>
															<td><?php echo $profileinfo->profileinfo[0]->phone; ?></td>
														</tr>
													</tbody>
												</table>
												<?php } ?>
											</address>
											<a href="#"
												class="btn btn-link btn-underline btn-icon-right text-primary btn-quickview btnpopupview" id="cate1">Edit
												your billing address<i class="w-icon-long-arrow-right"></i></a>
										</div>
									</div>
									<div class="col-sm-6 mb-6">
										<div class="ecommerce-address shipping-address pr-lg-8">
											<h4 class="title title-underline ls-25 font-weight-bold">Shipping Address
											</h4>
											<address class="mb-4">
												<?php if(!empty($profileinfo->shipaddress)){ ?>
												<table class="address-table">
													<tbody>
														<tr>
															<th>Address 1:</th>
															<td><?php echo $profileinfo->shipaddress[0]->address1; ?></td>
														</tr>
														<tr>
															<th>Address 2:</th>
															<td><?php echo $profileinfo->shipaddress[0]->address2; ?></td>
														</tr>
														<tr>
															<th>City:</th>
															<td><?php echo $profileinfo->shipaddress[0]->city; ?></td>
														</tr>
														<tr>
															<th>Country:</th>
															<td><?php echo $profileinfo->shipaddress[0]->country; ?></td>
														</tr>
														<tr class="d-none">
															<th>Postcode:</th>
															<td><?php echo $profileinfo->shipaddress[0]->postalcode; ?></td>
														</tr>
													</tbody>
												</table>
												<?php } ?>
											</address>
											<a href="#"
												class="btn btn-link btn-underline btn-icon-right text-primary btn-quickview btnpopupview" id="cate1">Edit your
												shipping address<i class="w-icon-long-arrow-right"></i></a>
										</div>
									</div>
								</div>
							</div>

							<div class="tab-pane" id="account-details">
								<div class="icon-box icon-box-side icon-box-light">
									<span class="icon-box-icon icon-account mr-2">
										<i class="w-icon-user"></i>
									</span>
									<div class="icon-box-content">
										<h4 class="icon-box-title mb-0 ls-normal">Account Details</h4>
									</div>
								</div>
								<form class="form account-details-form" action="<?php echo base_url().'Account/Profileupdate' ?>" method="post">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="profilefirstname">First name *</label>
												<input type="text" id="profilefirstname" name="profilefirstname" value="<?php echo $profileinfo->profileinfo[0]->firstname; ?>"
													class="form-control form-control-md">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="profilelastname">Last name *</label>
												<input type="text" id="profilelastname" name="profilelastname" value="<?php echo $profileinfo->profileinfo[0]->lastname; ?>"
													class="form-control form-control-md">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="firstname">Mobile *</label>
												<input type="text" id="profilemobile" name="profilemobile" value="<?php echo $profileinfo->profileinfo[0]->phone; ?>"
													class="form-control form-control-md" readonly>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="lastname">Email *</label>
												<input type="text" id="profileemail" name="profileemail" value="<?php echo $profileinfo->profileinfo[0]->email; ?>"
													class="form-control form-control-md" readonly>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="firstname">Ref Code *</label>
												<input type="text" id="profilerefcode" name="profilerefcode" value="<?php echo $profileinfo->profileinfo[0]->refcode; ?>"
													class="form-control form-control-md" readonly>
											</div>
										</div>
									</div>
									<button type="submit" class="btn btn-dark btn-rounded btn-sm mb-4">Save
										Changes</button>
								</form>
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
	<!-- End of Page Wrapper -->

	<!-- Start of Quick View -->
    <div class="product product-single product-popup">
        <div class="row gutter-lg d-none" id="formaddress">
            <div class="col-md-6 mb-4 mb-md-0">
				<form action="<?php echo base_url() ?>Account/Accountbilladdress" method="post" autocomplete="off">
					<h5>YOUR BILLING ADDRESS</h5>
					<div class="form-group mb-2">
						<h5 class="font-weight-normal mb-1">Address Line 1 *</h5>
						<input type="text" class="form-control text-dark" name="billadd1" id="billadd1" value="<?php if(!empty($profileinfo->billaddress)){echo $profileinfo->billaddress[0]->address1;} ?>" required>
					</div>
					<div class="form-group mb-2">
						<h5 class="font-weight-normal mb-1">Address Line 2</h5>
						<input type="text" class="form-control text-dark" name="billadd2" id="billadd2" value="<?php if(!empty($profileinfo->billaddress)){echo $profileinfo->billaddress[0]->address2;} ?>">
					</div>
					<div class="form-group mb-2">
						<h5 class="font-weight-normal mb-1">City</h5>
						<input type="text" list="citylist" class="form-control text-dark" name="billcity" id="billcity" value="<?php if(!empty($profileinfo->billaddress)){echo $profileinfo->billaddress[0]->city;} ?>" required>
						<datalist id="citylist">
							<?php foreach($citylist->result() as $rowcitylist){ ?>
							<option value="<?php echo $rowcitylist->city ?>">
							<?php } ?>
						</datalist>
					</div>
					<div class="form-group mb-2">
						<h5 class="font-weight-normal mb-1">Country</h5>
						<input type="text" list="countrylist" class="form-control text-dark" name="billcountry" id="billcountry" value="<?php if(!empty($profileinfo->billaddress)){echo $profileinfo->billaddress[0]->country;} ?>" required>
						<datalist id="countrylist">
							<?php foreach($countrylist->result() as $rowcountrylist){ ?>
							<option value="<?php echo $rowcountrylist->country ?>">
							<?php } ?>
						</datalist>
					</div>
					<div class="form-group mb-2 d-none">
						<h5 class="font-weight-normal mb-1">Postal Code</h5>
						<input type="text" class="form-control text-dark" name="billpost" id="billpost" value="<?php if(!empty($profileinfo->billaddress)){echo $profileinfo->billaddress[0]->postalcode;} ?>">
					</div>
					<button type="submit" class="btn btn-primary">Add Billing</button>
				</form>
            </div>
            <div class="col-md-6 overflow-hidden p-relative">
                <form action="<?php echo base_url() ?>Account/Accountshipaddress" method="post" autocomplete="off">
					<h5>YOUR SHIPPING ADDRESS</h5>
					<div class="form-group mb-2">
						<h5 class="font-weight-normal mb-1">Address Line 1 *</h5>
						<input type="text" class="form-control text-dark" name="shipadd1" id="shipadd1" value="<?php if(!empty($profileinfo->shipaddress)){echo $profileinfo->shipaddress[0]->address1;} ?>" required>
					</div>
					<div class="form-group mb-2">
						<h5 class="font-weight-normal mb-1">Address Line 2</h5>
						<input type="text" class="form-control text-dark" name="shipadd2" id="shipadd2" value="<?php if(!empty($profileinfo->shipaddress)){echo $profileinfo->shipaddress[0]->address2;} ?>">
					</div>
					<div class="form-group mb-2">
						<h5 class="font-weight-normal mb-1">City</h5>
						<input type="text" list="citylist" class="form-control text-dark" name="shipcity" id="shipcity" value="<?php if(!empty($profileinfo->shipaddress)){echo $profileinfo->shipaddress[0]->city;} ?>" required>
						<datalist id="citylist">
							<?php foreach($citylist->result() as $rowcitylist){ ?>
							<option value="<?php echo $rowcitylist->city ?>">
							<?php } ?>
						</datalist>
					</div>
					<div class="form-group mb-2">
						<h5 class="font-weight-normal mb-1">Country</h5>
						<input type="text" list="countrylist" class="form-control text-dark" name="shipcountry" id="shipcountry" value="<?php if(!empty($profileinfo->shipaddress)){echo $profileinfo->shipaddress[0]->country;} ?>" required>
						<datalist id="countrylist">
							<?php foreach($countrylist->result() as $rowcountrylist){ ?>
							<option value="<?php echo $rowcountrylist->country ?>">
							<?php } ?>
						</datalist>
					</div>
					<div class="form-group mb-2 d-none">
						<h5 class="font-weight-normal mb-1">Postal Code</h5>
						<input type="text" class="form-control text-dark" name="shippost" id="shippost" value="<?php if(!empty($profileinfo->shipaddress)){echo $profileinfo->shipaddress[0]->postalcode;} ?>">
					</div>
					<button type="submit" class="btn btn-primary">Add Shipping</button>
				</form>
            </div>
        </div>
		<div class="row gutter-lg d-none" id="orderview">
			<div class="col-md-12 mb-4 mb-md-0">
				<div id="vieworder"></div>
    		</div>
    	</div>
    </div>
    <!-- End of Quick view -->

	<?php include "include/footerscript.php"; ?>
	<script>
		$(document).ready(function(){
			$('.btnpopupview').click(function(){
				var viewcate=$(this).attr('id');
				if(viewcate=='cate1'){
					$('#formaddress').removeClass('d-none');
					$('#orderview').addClass('d-none');
				}
				else{
					$('#orderview').removeClass('d-none');
					$('#formaddress').addClass('d-none');

					$.ajax({
						url: "<?php echo base_url('Account/Orderview');?>",
						method: "POST",
						data: {orderID:viewcate},
						success: function(data) { 
							$('#vieworder').html(data);
						}
					});
				}
			});
		});
	</script>
</body>

</html>