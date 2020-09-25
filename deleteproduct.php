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
 }
?>

<!-- Delete product and redirect back to cart page -->
<?php
  deleteProduct($ProductId);
  Redirect_to("cart.php");
?>
