<?php require_once("Includes/DB.php");  ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/functions.php"); ?>
<?php require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'init.php');?>


<?php
if(isset($_POST["Submit"])){
    $name = $_POST["name"];
	$phone = $_POST["phone"];
	$country = $_POST["country"];
	$city = $_POST["city"];
	$address = $_POST["address"];
	
	//products
	$products = sendTheOrderToOwner();

	// time and data of order
	date_default_timezone_set("Europe/Athens");
    $CurrentTime = time();
    $DateTime = strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);

	if(liveCart::getTotalPrice()>0){
		if (empty($name) || empty($phone)){
			$_SESSION["ErrorMessage"] = "Name and sphone can't be empty!!";
			Redirect_to("checkout.php");
		}

		$sql = "INSERT INTO delivery(date,name,phone,country,city,address,products)";
		$sql .= "VALUES(:datetime,:orderName,:orderPhone,:orderCountry,:orderCity,:orderAddress,:products)";
		$stmt = $ConnectionDB->prepare($sql);
		$stmt->bindValue(':datetime',$DateTime);
		$stmt->bindValue(':orderName',$name);
		$stmt->bindValue(':orderPhone',$phone);
		$stmt->bindValue(':orderCountry',$country);
		$stmt->bindValue(':orderCity',$city);
		$stmt->bindValue(':orderAddress',$address);
		$stmt->bindValue(':products',$products);

		$Execute = $stmt->execute();

		if($Execute){
			$_SESSION["SuccessMessage"]= "Order Added Successfully";
			clearFile();
		}else{
			$_SESSION["ErrorMessage"] = "Something went wrong. Try again !";
			Redirect_to("checkout.php");
		}
		}
    else{
		$_SESSION["ErrorMessage"] = "Sorry your shopping cart is empty";
		Redirect_to("checkout.php");
	}
}
?>

<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Successful product addition</title>
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
							<h2>ORDER COMPLETED</h2>
							<ul class="text-left">
								<li><a href="index.php">Home </a></li>
								<li><span> // </span>Order Complete</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- pages-title-end -->
		<!-- order-complete content section start -->
		<section class="pages checkout order-complete section-padding">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 text-center">
						<div class="complete-title">
							<p>Thank you. Your order has been received.</p>
						</div>
					</div>
				</div>
        
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
