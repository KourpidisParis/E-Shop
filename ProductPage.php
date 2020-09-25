<?php require_once("Includes/DB.php");  ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'init.php');?>
<?php
   if(isset($_GET["id"])){ 
     $SearchQueryParameter = $_GET["id"];
   }else{
     $_SESSION["ErorrMessage"] = "Bad Request";
   }
?>
<!-- Fetcing the product item that clicked from user -->
<?php 
 if(isset($_GET["id"])){
 global $ConnectionDB;
 $sql = "SELECT* FROM products WHERE id='$SearchQueryParameter'"; 
 $Execute = $ConnectionDB->query($sql);
 $row=$Execute->fetch();
 
 $ProductId = $row["id"];
 $ProductImage = $row["image"];
 $ProductName = $row["name"];
 $ProductPrice = $row["price"];
 $ProductDescription = $row["description"];  
 }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Product Page</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="apple-touch-icon" href="apple-touch-icon.png" />
    <!-- Place favicon.ico in the root directory -->
    <!-- google fonts -->
    <link
      href="https://fonts.googleapis.com/css?family=Lato:400,900,700,300"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Bree+Serif"
      rel="stylesheet"
      type="text/css"
    />
    <!-- all css here -->
    <!-- bootstrap v3.3.6 css -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- animate css -->
    <link rel="stylesheet" href="css/animate.css" />
    <!-- pe-icon-7-stroke -->
    <link rel="stylesheet" href="css/materialdesignicons.min.css" />
    <!-- pe-icon-7-stroke -->
    <link rel="stylesheet" href="css/jquery.simpleLens.css" />
    <!-- jquery-ui.min css -->
    <link rel="stylesheet" href="css/jquery-ui.min.css" />
    <!-- meanmenu css -->
    <link rel="stylesheet" href="css/meanmenu.min.css" />
    <!-- nivo.slider css -->
    <link rel="stylesheet" href="css/nivo-slider.css" />
    <!-- owl.carousel css -->
    <link rel="stylesheet" href="css/owl.carousel.css" />
    <!-- style css -->
    <link rel="stylesheet" href="style.css" />
    <!-- responsive css -->
    <link rel="stylesheet" href="css/responsive.css" />
    <!-- modernizr js -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
  </head>
<body>
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
     
    <div class="product-details" id="quick-view">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="d-table">
							<div class="d-tablecell">
								<div >
									<div class="main-view ">
										<div class="row">
											<div class="col-xs-12 col-sm-5 col-md-4">
												<div class="quick-image">
													<div class="single-quick-image text-center">
														<div class="list-img">
															<div class="product-img tab-content">
																<div class="simpleLens-container tab-pane fade in" id="q-sin-1">
																	<div class="pro-type">
																		<span>new</span>
																	</div>
																	<a class="simpleLens-image"  href="#"><?php echo '<img src="data:image/jpeg;base64,' . base64_encode($ProductImage) . '" />'; ?></a>
																</div>
																<div class="simpleLens-container tab-pane active fade in" id="q-sin-2">
																	<div class="pro-type sell">
																		<span>sell</span>
																	</div>
																	<a class="simpleLens-image" data-lens-image="img/products/z2.jpg" href="#"><?php echo '<img src="data:image/jpeg;base64,' . base64_encode($ProductImage) . '"  />'; ?></a>
																</div>
																<div class="simpleLens-container tab-pane fade in" id="q-sin-3">
																	<div class="pro-type">
																		<span>-15%</span>
																	</div>
																	<a class="simpleLens-image" data-lens-image="img/products/z3.jpg" href="#"><?php echo '<img src="data:image/jpeg;base64,' . base64_encode($ProductImage) . '"  />'; ?></a>
																</div>
																<div class="simpleLens-container tab-pane fade in" id="q-sin-4">
																	<div class="pro-type">
																		<span>new</span>
																	</div>
																	<a class="simpleLens-image" data-lens-image="img/products/z4.jpg" href="#"><?php echo '<img src="data:image/jpeg;base64,' . base64_encode($ProductImage) . '"  />'; ?></a>
																</div>
															</div>
														</div>
													</div>
													<div class="quick-thumb">
														<ul class="product-slider">
															<li><a data-toggle="tab" href="#q-sin-1"> <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($ProductImage) . '"  />'; ?> </a></li>
                              <li><a data-toggle="tab" href="#q-sin-1"> <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($ProductImage) . '"  />'; ?> </a></li>
															<li><a data-toggle="tab" href="#q-sin-1"> <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($ProductImage) . '"  />'; ?> </a></li>
														</ul>
													</div>
												</div>						
											</div>
											<div class="col-xs-12 col-sm-7 col-md-8">
												<div class="quick-right">
													<div class="list-text">
														<h3><?php echo htmlentities($ProductName); ?></h3>
														<span>Summer men’s fashion</span>
														<h5><?php echo htmlentities($ProductPrice)." $"; ?></h5>
														<p> <?php echo htmlentities($ProductDescription); ?></p>
														<form>
                            <div class="all-choose">
															<div class="s-shoose">
																<h5>size</h5>
																<div class="size-drop">
																	<div class="btn-group">
																		<button type="button" class="btn">XL</button>
																		<button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class=""><i class="mdi mdi-chevron-down"></i></span>
																		</button>
																		<ul class="dropdown-menu">
																			<li><a href="#">Xl</a></li>
																			<li><a href="#">SL</a></li>
																			<li><a href="#">S</a></li>
																			<li><a href="#">L</a></li>
																		</ul>
																	</div>
																</div>
															</div>
														</div>
														<div class="list-btn">
                              <a
                               href="./productAdded.php?id=<?php echo htmlentities($ProductId);?>"
                               class="btn" name="add">Add to cart
                              </a>
														</div>
                            </form>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

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