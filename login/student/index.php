
<?php

    if(isset($_POST["btnSubmit"])){

        $username = $_POST["txtUsername"];
        $password = $_POST["password"];

        try {
            //Connection String
            $con = mysqli_connect("localhost","root","root");

            //Select Database
            mysqli_select_db($con,"nttms");
            
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        //sql command for verified email & password
        $sql = "SELECT * FROM student WHERE index_no='$username' AND password='$password'";

        $ret = mysqli_query($con,$sql);

        if($row =mysqli_fetch_array($ret)){

            session_start();
            $_SESSION['name'] = $row[2];
            $_SESSION['image'] = $row[4];
            $_SESSION['batch'] = $row[0];
            header("Location: http://localhost/FInal%20Project/dashboard/student/");

        }
        else{
            echo " <center style='margin:10px; background:transparent;' > <img src='error.png' alt='' width='25px' height='25px'> Invalid Login Please Check Username or Password.</center>";
        }

        mysqli_close($con);

    }

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>NTTMS | Log in to the application</title>

        <meta name="description" content="Elevate Your Academic Experience with NTTMS: The Ultimate Solution for NIBM Sri Lanka Students That Keeps You in the Know and Ahead of the Curve"/>
        <meta name="keywords" content="NTTMS,nttms,nibm,NIBM Sri Lanka,NIBM,timetable,NIBM TimeTable Management System,nibm timetable,education"/>
        <meta name="author" content="Pasindu Aluthwalahewa | https://pasindualuthwalahewa.me/"/>
        <meta property="og:url" content=""/>
        <meta property="og:type" content="website"/>
        <meta property="og:title" content="NTTMS | NIBM TimeTable Management System"/>
        <meta property="og:description" content="Elevate Your Academic Experience with NTTMS: The Ultimate Solution for NIBM Sri Lanka Students That Keeps You in the Know and Ahead of the Curve"/>


    <link href="http://localhost/FInal%20Project/index page/img/minLog.png" rel="icon">
    <link href="http://localhost/FInal%20Project/index page/img/Logo.png" rel="apple-touch-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <style>
        .right {
            text-align: right;

        }

        .btnLog {
            font-weight: 400;
            transition: .5s;
        }

        .btnLog:hover {
            border: 1.5px solid #0080ff;
            background: transparent;
            color: #0080ff;
            font-weight: 500;
        }
    </style>

</head>

<body>
    <section class="text-center">
        <!-- Background image -->
        <div class="p-5 bg-image" style="
                    background: url('https://mdbootstrap.com/img/new/textures/full/171.jpg');
                    height: 300px;
                    ">
        </div>
        <!-- Background image -->


        <div class="card mx-4 mx-md-5 shadow-5-strong" style="
                        margin-top: -100px;
                        background: hsla(0, 0%, 100%, 0.8);
                        backdrop-filter: blur(30px);
                        ">
            <div class="card-body py-5 px-md-5">

                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <h2 class="fw-bold mb-5" style="color: #0080ff;">Login</h2>

                        <form action="" method="post">
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="text" id="form3Example3" class="form-control" name="txtUsername" placeholder="Username" required>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" id="form3Example4" class="form-control" name="password" placeholder="Password" required>
                            </div>


                            <!-- Checkbox -->
                            <div class="row-12">
                                <table width="100%">
                                    <tr>
                                        <td width="50%">
                                            <div class="form-check d-flex mb-4">
                                                <input class="form-check-input me-2" type="checkbox" value="" name="checkbox" id="form2Example33" checked />
                                                <label class="form-check-label" for="form2Example33">
                                                    Remember Me
                                                </label>
                                            </div>
                                        </td>

                                        <td class="right form-check mb-4">
                                            <a href="forgetPassword.php">Forget Password</a>
                                        </td>
                                    </tr>
                                </table>

                            </div>


                            <!-- Submit button -->
                            <div class="d-grid gap-2 col-6 mx-auto mb-4">
                                <button class="btn btn-primary btnLog" type="submit" name="btnSubmit">LOGIN</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div style="background: #f0f2f0;">
                Copyright © 2023 NIBM, All Rights Reserved.
            </div>
        </div>

    </section>
</body>

</html>