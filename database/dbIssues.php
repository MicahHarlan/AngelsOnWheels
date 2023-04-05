<?php

function report_issue($id,$name, $issues, $date, $evid) {
    $con=connect();
    $query = "INSERT INTO dbissues(`id`, `name`, `issue`, `date`, `event_id`) VALUES ('$id','$name','$issues','$date','$evid')";
    $result = mysqli_query($con,$query);
    mysqli_close($con);
    if (!$result) {
        die("Error reporting Issue");
    } else{
        echo("Successfully reported Issue!");
    }
}

?>