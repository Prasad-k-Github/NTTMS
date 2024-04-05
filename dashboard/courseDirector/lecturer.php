<?php  

    $con = mysqli_connect("localhost", "root", "root");
                                    
    // Select DB
    mysqli_select_db($con,"nttms");

    $code = $_POST["mcode"]; 

    $sql2 = "SELECT * FROM lecturer_modules WHERE module_code = '$code';";
    $ret2 = mysqli_query($con,$sql2);

    echo "<option>-- Select Lecturer --</option>";

    while($row = mysqli_fetch_array($ret2)){
      echo "<option value='{$row[0]}'>{$row[0]}</option>";
    }
     
    //Disconnect from server
    mysqli_close($con);
  
  

?>