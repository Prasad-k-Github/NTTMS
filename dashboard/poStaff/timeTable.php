

                    <?php
                        
                        $date = $_POST["day"];

                        try {
                            //Connection String
                            $con = mysqli_connect("localhost","root","root");
                
                            //Select Database
                            mysqli_select_db($con,"nttms");
                            
                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }

                        //Perform SQL 
                        $sql = "SELECT * FROM asign_module where date = '$date';";

                        $result = mysqli_query($con,$sql);

                       echo ' <table id="tbl">';
                       echo '<th >Batch</th>';
                       echo  '<th>Modeul</th>';
                       echo '<th>Lecturer</th>';
                       echo '<th>Session Type</th>';


                        //Print Result
                        while($row = mysqli_fetch_array($result)){
                            print("<tr>"); 

                            echo "<td>$row[2]</td>";

                            echo "<td >$row[1]</td>";

                            echo "<td>$row[0]</td>";

                            echo "<td >$row[3]</td>";

                            print("</tr>");
                            
                        }
                        
                        echo ' </table>';
                         //Disconnect from server
                         mysqli_close($con);
    
                    ?>
