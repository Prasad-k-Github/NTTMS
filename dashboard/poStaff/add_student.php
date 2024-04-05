<?php

    if(isset($_POST["btnSubmit"])){

        try {
            //Connection String
            $con = mysqli_connect("localhost","root","root");

            //Select Database
            mysqli_select_db($con,"nttms");
            
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $index = $_POST["txtIndex"];
        $name = $_POST["txtName"];
        $password = $_POST["txtPassword"];
        $batch = $_POST["txtBatch"];
        $image = "";

        //sql command 
        $sql = "SELECT * FROM student WHERE index_no ='$index'";
        $ret = mysqli_query($con,$sql);

        if($row =mysqli_fetch_array($ret)){

            echo " <center style='margin:10px'> <img src='http://localhost/FInal%20Project/dashboard/assets/images/error.png' alt='' width='25px' height='25px'> This Index number already has been added. </center>";

        }
        else{

            //sql command
            $sql2 = "INSERT INTO student VALUES ('$batch','$index','$name','$password','$image');";

            $ret2 = mysqli_query($con,$sql2);

            
            if($ret2 == 1){
                echo " <center style='margin:10px'> <img src='http://localhost/FInal%20Project/dashboard/assets/images/successfull.png' alt='' width='25px' height='25px'> Student successfully Added.</center>";
            }
        }
       
   
        mysqli_close($con);

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
        <title>Dashboard | NTTMS</title>
            
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

            #input{
                margin-left: 80px;
            }

            #input input{
                width: 300px;
                height: 35px;
                margin-top: 30px;
                border: 1px solid #435ebe;
                border-radius: 0.5rem;
            }

            #input select{
                width: 300px;
                height: 35px;
                margin-top: 30px;
                border: 1px solid #435ebe;
                border-radius: 0.5rem;
            }

            #btn{
                margin-top: 25px;
                margin-left: 148px;
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
                            <a href="add_course.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Add Course </span>
                            </a>
                        </li>
                        
                        <li
                            class="sidebar-item">
                            <a href="add_lecturer.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Add Lecturer</span>
                            </a>
                        </li>
                        

                        <li
                            class="sidebar-item">
                            <a href="add_batch.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Add Batch</span>
                            </a>
                        </li>

                        <li class="sidebar-item active">
                            <a href="add_student.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Add Student</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="add_module.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Add Modules</span>
                            </a>
                        </li>

                        
                        <li class="sidebar-item">
                            <a href="add_postaff.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Add PO Staff</span>
                            </a>
                        </li>

                        
                        <li class="sidebar-item">
                            <a href="assignLecturer.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Assign Lecturer</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
                

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                   <i class="bi bi-justify fs-3"></i>
                 </a>

                 <div class="user-account" id="user-account">
                    <img src="http://localhost/FInal%20Project/dashboard/assets/images/pic.png" alt="" style="width: 50px; height: 50px; border-radius: 50px; margin-right: 10px; ">
                    <span class="user-name"><?php  echo  $_SESSION['name']; ?></span>    
                    <div class="user-dropdown">
                        <ul>
                            <li><a href="">My Profile</a></li>
                            <li><a href="">Settings</a></li>
                            <li><a href="">Notifications</a></li>
                            <li><a href="http://localhost/FInal%20Project/">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </header>



            <section>
                <form action="#" method="post">

                    <div id="input">
     
                        <?php
                            $con = mysqli_connect("localhost", "root", "root");

                            // Select DB
                            mysqli_select_db($con,"nttms");

                            // Perform SQL 
                                    
                            $sql = "SELECT * FROM batch";
    
                            $result = mysqli_query($con, $sql);

                            echo "<select name='txtBatch' id='txtBatch' required>";
                            echo " <option value=''>--Select Batch--</option>";
    
                            // Print Result
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='{$row[1]}'>{$row[1]}</option>";
                            }
                                    
                            echo"</select><br>";

                            //Disconnect from server
                             mysqli_close($con);
                        ?>   
    
                        <input type="text" name="txtIndex" id="" placeholder="Enter Index No." required><br>
                        <input type="text" name="txtName" id="" placeholder="Enter Name" required><br>
                        <input type="text" name="txtPassword" id="" placeholder="Enter Password" required><br>
       
                    </div>
    
                    <input type="submit" value="Submit" name="btnSubmit" id="btn">
    
                </form>
            </section>

        </div>
    </div>
       
    <script src="http://localhost/FInal%20Project/dashboard/assets/js/bootstrap.js"></script>
    <script src="http://localhost/FInal%20Project/dashboard/assets/js/app.js"></script>
    <script src="http://localhost/FInal%20Project/dashboard/assets/js/pages/dashboard.js"></script>

    </body>

</html>
