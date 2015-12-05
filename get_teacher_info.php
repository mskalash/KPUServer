<?php

$response = array();

 $link = mysqli_connect( 
'localhost',
'u280771585_rot',
'qwerty12' ,
'u280771585_dipl' );
 if (!$link) { 
   printf("error %s\n", mysqli_connect_error()); 
   exit(); 
} 
if (isset($_GET["id"])) {
    $id = $_GET['id'];
    $result = mysqli_query($link," SELECT pname,local FROM `teacher` WHERE id=$id ");
$response["teacher"] = array();
    if (!empty($result)) {
        // check for empty result
        if (mysqli_num_rows($result) > 0) {

             $row = mysqli_fetch_array($result)
            $product = array();
			
           
			 $product["teacher"] = $row["pname"];
	 $product["local"] = $row["local"];
            // success
           


            // user node
           
            array_push($response["teacher"], $product);
			 
			  
			  $response["success"] = 1;
            // echoing JSON response
            echo json_encode($response);
        } 
		else {
            // no product found
            $response["success"] = 0;
            $response["message"] = "No product found";

            // echo no users JSON
            echo json_encode($response);
        }
    }
	else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No product found";

        // echo no users JSON
        echo json_encode($response);
    }
} 
else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);

}
mysqli_close($link);
?>
