<?php require_once("Includes/DB.php");  ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'init.php');?>


<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Cart || Sellshop</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
		<!-- google fonts -->
		<link href='https://fonts.googleapis.com/css?family=Lato:400,900,700,300' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Bree+Serif' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
		<!-- all css here -->
		<!-- bootstrap v3.3.6 css -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- animate css -->
        <link rel="stylesheet" href="css/animate.css">
		<!-- pe-icon-7-stroke -->
		<link rel="stylesheet" href="css/materialdesignicons.min.css">
		<!-- pe-icon-7-stroke -->
		<link rel="stylesheet" href="css/jquery.simpleLens.css">
		<!-- jquery-ui.min css -->
        <link rel="stylesheet" href="css/jquery-ui.min.css">
		<!-- meanmenu css -->
        <link rel="stylesheet" href="css/meanmenu.min.css">
		<!-- nivo.slider css -->
        <link rel="stylesheet" href="css/nivo-slider.css">
		<!-- owl.carousel css -->
        <link rel="stylesheet" href="css/owl.carousel.css">
		<!-- style css -->
		<link rel="stylesheet" href="style.css">
		<!-- responsive css -->
        <link rel="stylesheet" href="css/responsive.css">
		<!-- modernizr js -->
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- header section start -->
		<header class="header-one header-two header-page">

			<div class="container text-center">
				<div class="row">
					<div class="col-sm-2">
						<div class="logo">
							<a href="index.php"><img src="img/logo2.png" alt="Sellshop" /></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="header-middel">
							<div class="mainmenu">
								<nav>
									<ul>
										<li><a href="index.php">SHOP</a></li>
										<li><a href="cart.php">CART</a>
										</li>
										<li><a href="checkout.php">CHECK OUT</a></li>
									</ul>
								</nav>
							</div>
							<!-- mobile menu start -->
							<div class="mobile-menu-area">
								<div class="mobile-menu">
									<nav id="dropdown">
										<ul>
											<li><a href="index.php">SHOP</a></li>
											<li><a href="cart.php">CART</a></li>
											<li><a href="checkout.php">CHECK OUT</a></li>
										</ul>
									</nav>
								</div>
							</div>
						</div>
					</div>

					<div class="col-sm-2">
						<div class="cart-itmes">
							<a class="cart-itme-a" href="cart.php">
								<i class="mdi mdi-cart"></i>
								<?php echo liveCart::getTotalItems();?>  items : <strong><?php echo liveCart::getTotalPrice();?> $</strong>
							</a>
							<div class="cartdrop">
								<a class="goto" href="cart.php">go to cart</a>
								<a class="out-menu" href="checkout.php">Check out</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
        <!-- header section end -->
        <!-- pages-title-start -->
		<div class="pages-title section-padding">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="pages-title-text text-center">
							<h2>Cart</h2>
							<ul class="text-left">
								<li><a href="index.php">Home </a></li>
								<li><span> // </span>Cart</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- pages-title-end -->
		<!-- cart content section start -->
		<section class="pages cart-page section-padding">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="table-responsive padding60">
							<table class="wishlist-table text-center">
								<thead>
									<tr>
										<th>Product</th>
										<th>Price</th>
										<th>quantity</th>
										<th>Total Price</th>
										<th>Remove</th>
									</tr>
								</thead>
								<tbody>

								<?php
								$sum = 0;
								$productIds = liveCart:: getIdFromProducts();
								foreach($productIds as $x=>$val){
								
								 global $ConnectionDB;
								 $sql = "SELECT* FROM products WHERE id='$val'"; 
								 $Execute = $ConnectionDB->query($sql);
								 $row=$Execute->fetch();
								 
								 $ProductId = $row["id"];
								 $ProductImage = $row["image"];
								 $ProductName = $row["name"];
								 $ProductPrice = $row["price"];
								 $ProductDescription = $row["description"];  
								 
								 $sum = $sum + $ProductPrice * getCountofProduct($val);
								 
								?>
									<tr>
										<td class="td-img text-left">
											<a href="ProductPage.php?id=<?php echo htmlentities($ProductId); ?>"><?php echo '<img src="data:image/jpeg;base64,' . base64_encode($ProductImage) . '" />'; ?></a>
											<div class="items-dsc">
												<h5><a href="#"><?php echo htmlentities($ProductName);?></a></h5>
												<p class="itemcolor">Color : <span>Blue</span></p>
												<p class="itemcolor">Size   : <span>SL</span></p>
											</div>
										</td>
										<td><?php echo htmlentities($ProductPrice)." $";?></td>
										<td>
											<div class="plus-minus">
											       <a href="decreaseProduct.php?id=<?php echo htmlentities($ProductId); ?>" class="dec qtybutton">-</a>
													<input type="text" value="<?php echo getCountofProduct($ProductId); ?>" name="qtybutton" class="plus-minus-box">
													<a href="plusProduct.php?id=<?php echo htmlentities($ProductId); ?>" class="inc qtybutton">+</a>
											</div>
										</td>
										<td>
											<strong><?php echo htmlentities($ProductPrice *getCountofProduct($ProductId) )." $";?></strong>
										</td>
										<td>
										<a href="deleteproduct.php?id=<?php echo $ProductId; ?>" class="btn btn-danger"> Delete</a>
									    </td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="row margin-top">
					<div class="col-sm-6">
						<div class="single-cart-form padding60">
							<div class="log-title">
								<h3><strong>coupon discount</strong></h3>
							</div>
							<div class="cart-form-text custom-input">
								<p>Enter your coupon code if you have one!</p>
								<form action="mail.php" method="post">
									<input type="text" name="subject" placeholder="Enter your code here..." />
									<div class="submit-text coupon">
										<button type="submit">apply coupon </button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="single-cart-form padding60">
							<div class="log-title">
								<h3><strong>payment details</strong></h3>
							</div>
							<div class="cart-form-text pay-details table-responsive">
								<table>
									<tbody>
										<tr>
											<th>Cart Subtotal</th>
											<td id="Price"><?php echo $sum; ?></td>
										</tr>
										<tr>
											<th>Shipping and Handing</th>
											<td id="shipping">15</td>
										</tr>
										<tr>
											<th>Vat</th>
											<td id="vat">0</td>
										</tr>
									</tbody>
									<tfoot>
										<tr>
											<th class="tfoot-padd">Order total</th>
											<td id="totalCount" class="tfoot-padd">0</td>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</div>
			
			</div>
		</section>
		<!-- footer section start -->
				<footer class="footer-two fixed-bottom">
					<div class="footer-bottom">
						<div class="container">
						<div class="row">
							<div>
							<p class="text-center">&copy; Kourpidis Paris 2020</p>
							</div>
						</div>
						</div>
					</div>
				</footer>
    <!-- footer section end -->
        
		<!-- all js here -->
		<!-- jquery latest version -->
		<script type="text/javascript" src="js/main2.js"></script>

        <script src="js/vendor/jquery-1.12.3.min.js"></script>
		<!-- bootstrap js -->
        <script src="js/bootstrap.min.js"></script>
		<!-- owl.carousel js -->
        <script src="js/owl.carousel.min.js"></script>
		<!-- meanmenu js -->
        <script src="js/jquery.meanmenu.js"></script>
		<!-- countdown JS -->
        <script src="js/countdown.js"></script>
		<!-- nivo.slider JS -->
        <script src="js/jquery.nivo.slider.pack.js"></script>
		<!-- simpleLens JS -->
        <script src="js/jquery.simpleLens.min.js"></script>
		<!-- jquery-ui js -->
        <script src="js/jquery-ui.min.js"></script>
		<!-- load-more js -->
        <script src="js/load-more.js"></script>
		<!-- plugins js -->
        <script src="js/plugins.js"></script>
		<!-- main js -->
        <script src="js/main.js"></script>
    </body>
</html>
