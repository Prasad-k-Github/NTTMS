<?php

    if(isset($_POST["btnSubmit"])){

        $module = $_POST["txtModule"];
        $batch = $_POST["txtBatch"];
        $lec = $_POST["txtLecture"];
        $type = "Morning and Evening";

        // Connect database 
        try {
            $dbh = new PDO("mysql:host=localhost;dbname=nttms", "root", "root");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        // Receive the two input dates
        $inputStartDate = $_POST["txtStart"]; // user's start date
        $inputEndDate = $_POST["txtEnd"];   //  user's end date

        // Calculate the 10 non-previously inserted dates
        $startDate = new DateTime($inputStartDate);
        $endDate = new DateTime($inputEndDate);

        // Query to retrieve previously inserted dates within the specified range
        $sql = "SELECT date FROM lecturer_timetable WHERE date BETWEEN :start_date AND :end_date AND lecturer = :lecturer_name";
    
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':start_date', $inputStartDate);
        $stmt->bindParam(':end_date', $inputEndDate);
        $stmt->bindParam(':lecturer_name', $lec);
        $stmt->execute();
        $previouslyInsertedDates = $stmt->fetchAll(PDO::FETCH_COLUMN);

        $nonInsertedDates = array();

        $currentDate = clone $startDate;

        while (count($nonInsertedDates) < 10 && $currentDate <= $endDate) {
            $currentDateStr = $currentDate->format('Y-m-d');
            
            // Check if the date has not been previously inserted
            if (!in_array($currentDateStr, $previouslyInsertedDates)) {
                $nonInsertedDates[] = $currentDateStr;
            }
            
            $currentDate->add(new DateInterval('P1D')); // Move to the next day
        }

        if (count($nonInsertedDates) < 10) {
            echo " <center style='margin:10px'> <img src='http://localhost/FInal%20Project/dashboard/assets/images/error.png' alt='' width='25px' height='25px'> There are not enough available dates.</center>";
        } else {
            // Generate and insert 10 non-previously inserted random dates
            $randomDates = array_rand($nonInsertedDates, 10);

        // Insert the non-previously inserted dates into the database
        $sql = "INSERT INTO asign_module (lecturer, module_code, batch_code, session_type, date) VALUES ( :epf_no, :module, :batch, :type, :inserted_date)";
        $stmt = $dbh->prepare($sql);

        foreach ($randomDates as $index) {
            $date = $nonInsertedDates[$index];
            $stmt->bindParam(':epf_no', $lec);
            $stmt->bindParam(':module', $module);
            $stmt->bindParam(':batch', $batch);
            $stmt->bindParam(':type', $type);
            $stmt->bindParam(':inserted_date', $date);
            $stmt->execute();
        }

        $sql2 = "INSERT INTO lecturer_timetable (lecturer, description, date) VALUES ( :epf_no, :dis, :inserted_date)";
        $stmt2 = $dbh->prepare($sql2);
        $dis = "Lectures";

        foreach ($randomDates as $index) {
            $date = $nonInsertedDates[$index];
            $stmt2->bindParam(':epf_no', $lec);
            $stmt2->bindParam(':dis', $dis);
            $stmt2->bindParam(':inserted_date', $date);
            $stmt2->execute();
        }

        echo "<center style='margin:10px'>  <img src='http://localhost/FInal%20Project/dashboard/assets/images/successfull.png' alt='' width='25px' height='25px'> TimeTable successfully generated.</center>";

        // Close the database connection
        $dbh = null;
     }

    }


?>


<?php
    session_start();
?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
            
        <link rel="stylesheet" href="http://localhost/FInal%20Project/dashboard/assets/css/main/app.css">
        <link rel="stylesheet" href="http://localhost/FInal%20Project/dashboard/assets/css/main/app-dark.css">
        
        <link rel="shortcut icon" href="http://localhost/FInal%20Project/dashboard/assets/images/logo/minLog.png" type="image/x-icon">
        <link rel="shortcut icon" href="http://localhost/FInal%20Project/dashboard/assets/images/logo/minLog.png" type="image/png">
            
        <link rel="stylesheet" href="http://localhost/FInal%20Project/dashboard/assets/css/shared/iconly.css">
        <link rel="stylesheet" href="http://localhost/FInal%20Project/dashboard/assets/css/style.css">


        <style type="text/css">
            #menu li{
                margin-bottom: 20px;
            }


            #btn{
                margin-top: 25px;
                margin-left: 80px;
                width: 150px;
                border: 1px solid #435ebe;
                border-radius: 0.5rem;
                background-color: #435ebe;
                color: aliceblue;
            }
            #btn:hover{
                background-color: transparent;
                color: #7c8db5;
                transition: 0.5s;
                font-weight: 500;
            }

        </style>

    </head>

    <body>
        <div id="app">
            <div id="sidebar" class="active">
                <div class="sidebar-wrapper active">
                    <div class="sidebar-header position-relative">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">
                                <a href="http://localhost/FInal%20Project/"><img src="http://localhost/FInal%20Project/dashboard/assets/images/logo/Logo.png" alt="Logo" srcset=""\></a>
                            </div>
                            <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21"><g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3"></path><g transform="translate(-210 -1)"><path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path><circle cx="220.5" cy="11.5" r="4"></circle><path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path></g></g></svg>
                                <div class="form-check form-switch fs-6">
                                    <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" >
                                    <label class="form-check-label" ></label>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z"></path></svg>
                            </div>
                            <div class="sidebar-toggler  x">
                                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                            </div>
                        </div>
                    </div>
                <div class="sidebar-menu">
                    <ul class="menu" id="menu">
                        <li class="sidebar-title">Menu</li>
                        
                        <li
                            class="sidebar-item ">
                            <a href="index.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>View Time Table</span>
                            </a>
                        </li>

                        <li
                            class="sidebar-item ">
                            <a href="timeTable.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Uptade Availability</span>
                            </a>
                        </li>

                        <li
                            class="sidebar-item active">
                            <a href="generateTimeTable.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Genetate TimeTable</span>
                            </a>
                        </li>

                        <li
                            class="sidebar-item">
                            <a href="BatchTimeTable.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Batch TimeTable</span>
                            </a>
                        </li>

                        <li
                            class="sidebar-item">
                            <a href="editTimetable.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Edit TimeTable</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
                

        <div id="main">
            <header class="mb-3">
                <div>
                    <a href="#" class="burger-btn d-block d-xl-none">
                        <i class="bi bi-justify fs-3"></i>                       
                      </a>
     
                      <div class="user-account" id="user-account">
                         <img src="http://localhost/FInal%20Project/dashboard/assets/images/pic.png" alt="" style="width: 50px; height: 50px; border-radius: 50px; margin-right: 10px; ">
                         <span class="user-name"><?php  echo  $_SESSION['name']; ?></span>
                         <div class="user-dropdown">
                             <ul>
                                 <li><a href="profile.html">My Profile</a></li>
                                 <li><a href="settings.html">Settings</a></li>
                                 <li><a href="notifications.html">Notifications</a></li>
                                 <li><a href="logout.html">Logout</a></li>
                             </ul>
                         </div>
                     </div>
                </div>
                
                 
            </header>


            <section>
                <form action="#" method="post">

                    <div id="input">

                        <form action="#" method="post">

                        <?php
                            $con = mysqli_connect("localhost", "root", "root");

                            // Select DB
                            mysqli_select_db($con,"nttms");

                            // Perform SQL 
                            $name = $_SESSION['name'];

                            $sql = "SELECT * FROM batch where course_director = '$name';";
    
                            $result = mysqli_query($con, $sql);

                            echo "<select name='txtBatch' id='txtBatch' required>";
                            echo " <option value=''>--Select Batch--</option>";
    
                            // Print Result
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='{$row[0]}'>{$row[1]}</option>";
                            }
                                    
                            echo"</select><br>";

                            //Disconnect from server
                             mysqli_close($con);
                        ?>


                        <!-- <select name='txtModule' id='txtModule' required>
                            <option value=''>--Select Module--</option>
                            <?php
                                if($_SERVER["REQUEST_METHOD"] == "POST"){

                                    $con = mysqli_connect("localhost", "root", "root");
                                    
                                    $code = $POST["txttxtBatch"]; 

                                    // Select DB
                                    mysqli_select_db($con,"nttms");

                                    // Perform SQL 

                                    $sql = "SELECT * FROM modules where course_code = '$code';";
                
                                    $result = mysqli_query($con, $sql);
                
                                    // Print Result
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo "<option value='{$row[2]}'>{$row[2]}</option>";
                                    }
                                                
                                    //Disconnect from server
                                    mysqli_close($con);     

                                }                         
                        ?>   
                        </select><br>       -->


                        <?php
                             
                            $con = mysqli_connect("localhost", "root", "root");

                            // Select DB
                            mysqli_select_db($con,"nttms");

                            // Perform SQL 

                            $sql = "SELECT * FROM modules";
        
                            $result = mysqli_query($con, $sql);

                            echo "<select name='txtModule' id='txtModule' required>";
                            echo " <option value=''>--Select Module--</option>";
        
                            // Print Result
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='{$row[0]}'>{$row[0]}</option>";
                            }
                                        
                            echo"</select><br>";

                            //Disconnect from server
                            mysqli_close($con);
                            
                        ?>   

                        <?php
                            $con = mysqli_connect("localhost", "root", "root");

                            // Select DB
                            mysqli_select_db($con,"nttms");

                            // Perform SQL 

                            $sql = "SELECT * FROM lecturer";
    
                            $result = mysqli_query($con, $sql);

                            echo "<select name='txtLecture' id='txtLecture' required>";
                            echo " <option value=''>--Select Lecturer--</option>";
    
                            // Print Result
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='{$row[1]}'>{$row[1]}</option>";
                            }
                                    
                            echo"</select><br>";

                            //Disconnect from server
                             mysqli_close($con);
                        ?>

                       Enter Start Date: <input type="date" name="txtStart" id="txtStart" required><br>
                       Enter End Date : <input type="date" name="txtEnd" id="txtEnd" required><br><br>

                        <button type="submit" id="btn" name="btnSubmit" >Submit</button>

                    </div>
                   
                </form>

            </section>

        
            <footer style="margin-top: 380px;">
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <div class="copyright" style="font-size: 14px;">
                            &copy; Copyright <strong><span>NTTMS</span></strong>. All Rights Reserved 2023
                            </div>
                    </div>
                        
                    <div class="float-end" style="font-size: 13px; font-weight: bold;">
                        <p>Developed  by <a
                            ref="https://saugi.me">DSE22.2F Batch</a></p>
                    </div>
                    </div>
            </footer>
        </div>
    </div>
       
    <script src="http://localhost/FInal%20Project/dashboard/assets/js/bootstrap.js"></script>
    <script src="http://localhost/FInal%20Project/dashboard/assets/js/app.js"></script>
    <script src="http://localhost/FInal%20Project/dashboard/assets/js/pages/dashboard.js"></script>


    </body>

</html>
