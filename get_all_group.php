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
if ($result = mysqli_query($link, "SELECT * FROM `group`")) {
if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["products"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $product = array();
        $product["id"] = $row["id"];
        $product["name"] = $row["gname"];
     // push single product into final response array
        array_push($response["products"], $product);
    }
    // success
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No products found";

    // echo no users JSON
    echo json_encode($response);
}
}
mysqli_close($link);
?>
