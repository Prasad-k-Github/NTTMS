<?php  

    $con = mysqli_connect("localhost", "root", "root");
                                    
    // Select DB
    mysqli_select_db($con,"nttms");

    $code = $_POST["ccode"]; 
  
    
    $sql2 = "SELECT * FROM modules WHERE course_code = '$code';";
    $ret2 = mysqli_query($con,$sql2);

    echo "<option>-- Select Modules --</option>";

    while($row = mysqli_fetch_array($ret2)){
      echo "<option value='{$row[0]}'>{$row[2]}</option>";
    }
     
    //Disconnect from server
    mysqli_close($con);
  
  

?>