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
    $result = mysqli_query($link,"SELECT schedule.id, Week.type, time.tname, day.dname, group.gname, subject.name, teacher.pname, class.cname
FROM `schedule` , `Week` , `time` , `class` , `subject` , `group` , `day` , `teacher`
WHERE schedule.Week_idWeek = Week.idWeek
AND schedule.time_idtime = time.idtime
AND schedule.day_idday = day.idday
AND schedule.group_id = group.id
AND schedule.class_id1 = class.id
AND schedule.teacher_id1 = teacher.id
AND schedule.subject_id1 = subject.id AND  group.id=$id ");
$response["schedule"] = array();
    if (!empty($result)) {
        // check for empty result
        if (mysqli_num_rows($result) > 0) {

              while ( $row = mysqli_fetch_array($result)){
            $product = array();
			
            $product["id"] = $row["id"];
            $product["name"] = $row["name"];
            $product["time"] = $row["tname"];
            $product["day"] = $row["dname"];
            $product["week"] = $row["type"];
            $product["group"] = $row["gname"];
			 $product["teacher"] = $row["pname"];
			 $product["class"] = $row["cname"];
            // success
           


            // user node
           
            array_push($response["schedule"], $product);
			  }
			  
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
