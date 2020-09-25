<?php require_once("Includes/DB.php");  ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/functions.php"); ?>
<?php require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'init.php');?>

<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Chcekout || Sellshop</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
		<!-- google fonts -->
		<link href='https://fonts.googleapis.com/css?family=Lato:400,900,700,300' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Bree+Serif' rel='stylesheet' type='text/css'>
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
							<h2>Chcekout</h2>
							<ul class="text-left">
								<li><a href="index.php">Home </a></li>
								<li><span> // </span>Chcekout</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- pages-title-end -->
		<!-- Checkout content section start -->
		<section class="pages checkout section-padding">
			<div class="container">
			<?php echo ErrorMessage();?>
				<div class="row margin-top">
					<div class="col-xs-12 col-sm-12">
						<div class="padding60">
							<div class="log-title">
								<h3><strong>ORDER</strong></h3>
							</div>
							<div class="cart-form-text pay-details table-responsive">
								<table>
									<thead>
										<tr>
											<th>Product</th>
											<td>Total</td>
										</tr>
									</thead>
									<tbody>
									<?php
										$sum = 0;
										$shipping = 15;
										$productIds = liveCart:: getIdFromProducts();
										foreach($productIds as $x=>$val){
										
										global $ConnectionDB;
										$sql = "SELECT* FROM products WHERE id='$val'"; 
										$Execute = $ConnectionDB->query($sql);
										$row=$Execute->fetch();
										
										$ProductId = $row["id"];
										$ProductName = $row["name"];
										$ProductPrice = $row["price"];  
										
										$sum = $sum + $ProductPrice * getCountofProduct($val);
								    ?>
										<tr>
											<th><?php echo htmlentities($ProductName); ?> x <?php  echo getCountofProduct($ProductId); ?> </th>
											<td><?php echo $ProductPrice* getCountofProduct($ProductId)." $" ; ?></td>
										</tr>
										<?php } ?>
										<tr>
										   <th>Shipping and Handing	</th>
										   <td><?php echo $shipping." $"; ?></td>
									    </tr>
									</tbody>
									<tfoot>
										<tr>
											<th>Order total</th>
											<td><?php echo ($sum+$shipping)." $"; ?></td>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>


						<div class="row">
					<div class="col-sm-12">
						<div class="main-input single-cart-form padding60">
							<div class="log-title">
								<h3><strong>billing details</strong></h3>
							</div>
							<div class="custom-input">
								<form action="ordercompleted.php" method="post">
									<input type="text" name="name" placeholder="Your name" />
									<input type="text" name="phone" placeholder="Phone here" />
									<div class="custom-select">
										<select name="country" class="form-control">
											<option> Greece </option>
											<option> Argentina </option>
											<option> Brazil </option>
										</select>
									</div>
									<div  class="custom-select">
										<select name="city" class="form-control">
											<option> Town / City</option>
											<option> Thessaloniki </option>
											<option> Athens </option>
											<option> Crete </option>
											<option> Patra </option>
										</select>
									</div>
									<div class="custom-mess">
										<textarea rows="2" placeholder="Your address here" name="address"></textarea>
									</div>

									<div class="submit-text">
										<button type="submit" name="Submit" class="btn btn-block">
									<i class="fas fa-check"></i>Send the order
										</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
					</div>
		</section>
		<!-- Checkout content section end -->

	<!--footer area  -->
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
