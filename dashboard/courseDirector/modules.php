<?php  

    $con = mysqli_connect("localhost", "root", "root");
                                    
    // Select DB
    mysqli_select_db($con,"nttms");

    $code = $_POST["bcode"]; 
  
    $sql1 = "SELECT * FROM batch where batch_code = '$code';";
    $ret = mysqli_query($con, $sql1);
    $course = "";
  
    if ($row1 = mysqli_fetch_array($ret)){
        $course = $row1[0];
    }
    
    $sql2 = "SELECT * FROM modules WHERE course_code = '$course';";
    $ret2 = mysqli_query($con,$sql2);

    echo "<option>-- Select Modules --</option>";

    while($row = mysqli_fetch_array($ret2)){
      echo "<option value='{$row[0]}'>{$row[2]}</option>";
    }
     
    //Disconnect from server
    mysqli_close($con);
  
  

?>