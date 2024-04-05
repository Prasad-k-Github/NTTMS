<?php                   
                                                    
    try {
        //Connection String
        $con = mysqli_connect("localhost","root","root");
                    
        //Select Database
        mysqli_select_db($con,"nttms");
                                
    } catch (PDOException $e) {
          echo "Error: " . $e->getMessage();
    }

      $batch = $_POST["bcode"];

      $order = 'ASC';
      $currentDate = date("Y-m-d");
      // Perform SQL 
                            
      $sql = "SELECT * FROM asign_module WHERE batch_code = '$batch' AND date >= '$currentDate' ORDER BY date $order;";

      $result = mysqli_query($con, $sql);
      
      echo "<table id = 'tbl'>";
      // Print Result
      echo "<th >Date</th>";
      echo "<th>Modeul</th>";
      echo "<th>Lecturer</th>";
      echo "<th>Session Type</th>";
                            
      while ($row = mysqli_fetch_array($result)) {
        print("<tr>");
                                    
        echo "<td>$row[4]</td>";
        echo "<td>$row[1]</td>";
        echo "<td>$row[0]</td>";
        echo "<td>$row[3]</td>";
                                    
        print("</tr>");
      }
      echo "</table>";                  

      //Disconnect from server
      mysqli_close($con);
  
?>