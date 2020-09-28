<?php
function Redirect_to($New_Location){
    header("Location:".$New_Location);
    exit;
}

function addProduct($ProductId){
	if(checkIfTheProductExist($ProductId)){
		addTheSameProduct($ProductId);
	}else{
		addNewProduct($ProductId);
	}

}

//Create an array with products
//Include every products and the times tha selected
// for example product with id 4 , 4 x 2 times
function sendTheOrderToOwner(){
	$owner_array = array();

	$products = liveCart::getIdFromProducts();
	foreach($products as $x => $id){
		$count = getCountofProduct($id);
		$temp = $id." x ". $count;
		array_push($owner_array,$temp); 	
	}

	return json_encode($owner_array);
}



function checkIfTheProductExist($ProductId){
	$jsondata = file_get_contents('cart.json');

	// decode json to associative array
	$arr_data = json_decode($jsondata, true);

	if(!empty($arr_data)){
		foreach ($arr_data as $key => $value) {
			if ($value['id'] == $ProductId) {
				return true;
			}
		}
    }
	return false;
}

//if the user selects tha same product 
//This function is also used for the + symbol on cart page.
//increment the quantitu of the product
function addTheSameProduct($id){
	//get all your data on file
	$myFile = "cart.json";
	$jsondata = file_get_contents($myFile);

	// decode json to associative array
	$arr_data = json_decode($jsondata, true);

	foreach ($arr_data as $key => $value) {
		if ($value['id'] == $id) {
                $arr_data[$key]['count'] =  $value['count'] + 1;
		}
    }


    $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
	   
    //write json data into data.json file
    file_put_contents($myFile, $jsondata);
}


function addNewProduct($ProductId){
  $myFile = "cart.json";
  $arr_data = array(); // create empty array


  try
  {
	   //Get form data
	   $formdata = array(
	      'name'=> "user",
		  'id'=> $ProductId,
		  'count'=>1
	   );

	   //Get data from existing json file
	   $jsondata = file_get_contents($myFile);

	   // converts json data into array
	   $arr_data = json_decode($jsondata, true);

	   // Push user data to array
	   array_push($arr_data,$formdata);

       //Convert updated array to JSON
	   $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
	   
	   //write json data into data.json file
	   file_put_contents($myFile, $jsondata);
   }
   catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
   }
}

// Return how many times the  user select the product with this id
function getCountofProduct($id){
	$myFile = "cart.json";
	$jsondata = file_get_contents($myFile);

	// decode json to associative array
	$arr_data = json_decode($jsondata, true);

	foreach ($arr_data as $key => $value) {
		if ($value['id'] == $id) {
                   return $arr_data[$key]['count'];
		}
    }
}

//Delete a product from cart
function deleteProduct($ProductΙd){
	//get all your data on file
	$data = file_get_contents('cart.json');

	// decode json to associative array
	$json_arr = json_decode($data, true);

	// get array index to delete
	$arr_index = array();
	foreach ($json_arr as $key => $value) {
		if ($value['id'] == $ProductΙd) {
			$arr_index[] = $key;
		}
	}

	// delete data
	foreach ($arr_index as $i) {
		unset($json_arr[$i]);
	}

	// rebase array
	$json_arr = array_values($json_arr);

	// encode array to json and save to file
	file_put_contents('cart.json', json_encode($json_arr));

  }
  

  //   Decrease for - symbol on cart page

  function decreaseProduct($id){
	//get all your data on file
	$myFile = "cart.json";
	$jsondata = file_get_contents($myFile);

	// decode json to associative array
	$arr_data = json_decode($jsondata, true);

	foreach ($arr_data as $key => $value) {
		if ($value['id'] == $id) {
			$arr_data[$key]['count'] =  $value['count'] -1 ;
		}
    }


    $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
	   
    //write json data into data.json file
    file_put_contents($myFile, $jsondata);
}  

function checkForZeroCounts($id){
	$myFile = "cart.json";
	$jsondata = file_get_contents($myFile);

	// decode json to associative array
	$arr_data = json_decode($jsondata, true);

	foreach ($arr_data as $key => $value) {
		if ($value['id'] == $id) {
			if($arr_data[$key]['count'] == 0) return true;
		}
	}
	
	return false;
}

// After the order complete clear the json file
function clearFile(){
	$myFile = "cart.json";
	$arr_data = array(); // create empty array
  

	//Get data from existing json file
	$jsondata = file_get_contents($myFile);
  
	// converts json data into array
	$arr_data = json_decode($jsondata, true);
  
	// Push user data to array

	$arr_data = [];
	//Convert updated array to JSON
	$jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
		 
	//write json data into data.json file
	file_put_contents($myFile, $jsondata);
	
}

?>

