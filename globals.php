<?php require_once("Includes/DB.php");  ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/functions.php"); ?>
<?php require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'init.php');?>

<?php

class liveCart
{
  public static $totalPrice;
  public static $totalItems;
  public static $arr_data;


  public static function getIdFromProducts(){

	$myFile = "cart.json";
	$arr_data = array(); // create empty array

	try
	{
		//Get data from existing json file
		$jsondata = file_get_contents($myFile);
		// converts json data into array
                $arr_data = json_decode($jsondata, true);
        
	}
	catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
    

    $arrayWithid = array();
    
    foreach($arr_data as $x => $subarr) {
        array_push($arrayWithid,$subarr["id"]);
   }

   return $arrayWithid;
}

public static function getTotalPrice(){
  $products = self::getIdFromProducts();
   
  // if table is empty then the price will be zero
  if(count($products)==0){
    return 0;
  }

  foreach($products as $x=>$val){
    global $ConnectionDB;
    $sql = "SELECT* FROM products WHERE id='$val'"; 
    $Execute = $ConnectionDB->query($sql);
    $row=$Execute->fetch();
    
    $ProductPrice = $row["price"];
    self::$totalPrice = self::$totalPrice + $ProductPrice * getCountofProduct($val);


  }

  return self::$totalPrice;
}

public static function getTotalItems(){
  $totalItems = 0 ;
  $products = self::getIdFromProducts();
  foreach($products as $x=>$val){
    $totalItems = $totalItems + getCountofProduct($val);
  }
  return $totalItems;
}

}

?>
