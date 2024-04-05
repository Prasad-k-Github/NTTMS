<?php

    if(isset($_POST["btnSubmit"])){

        $username = $_POST["txtUsername"];
        $password = $_POST["txtCurPassword"];
        $new_password = $_POST["txtNPassword"];
        $con_password = $_POST["txtConPassword"];

        try {
            //Connection String
            $con = mysqli_connect("localhost","root","root");

            //Select Database
            mysqli_select_db($con,"nttms");
            
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        //sql command for verified email & password
        $sql = "SELECT * FROM po_staff WHERE epf_no='$username' AND password='$password'";
        $ret = mysqli_query($con,$sql);

        if($row =mysqli_fetch_array($ret)){

          if($new_password == $con_password){

           $up = "UPDATE po_staff SET password = '$new_password' WHERE epf_no = '$username'";   
           $retUp = mysqli_query($con,$up);
           echo " <script type='text/javascript'> alert( 'Password change successfull.'); </script>";
          }
          else{
            echo " <center style='margin:10px; background:transparent;' > <img src='error.png' alt='' width='25px' height='25px'> New Password and Confirm Password not match.</center>";
          }

        }
        else{
            echo " <center style='margin:10px; background:transparent;' > <img src='error.png' alt='' width='25px' height='25px'> Invalid Username or Current Password.</center>";
        }

        mysqli_close($con);

    }

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>NTTMS | Forget Passowrd</title>

    <link href="http://localhost/FInal%20Project/index page/img/minLog.png" rel="icon">
    <link href="http://localhost/FInal%20Project/index page/img/Logo.png" rel="apple-touch-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
    <script  type="text/javascript"  src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    

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
                    height: 200px;
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
                        <h2 class="fw-bold mb-5" style="color: #0080ff;">Change Your Password</h2>

                        <form action="#" method="post">
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="text" id="form3Example3" class="form-control" name="txtUsername" placeholder="Enter your EPF No." required>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" id="form3Example4" class="form-control" name="txtCurPassword" placeholder="Current Password" required>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" id="form3Example4" class="form-control" name="txtNPassword" placeholder="New Password" required>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" id="form3Example4" class="form-control" name="txtConPassword" placeholder="Confirm Password" required>
                            </div>

                            <!-- Submit button -->
                            <div class="d-grid gap-2 col-6 mx-auto mb-4">
                                <button class="btn btn-primary btnLog" type="submit" id="btnSubmit" name="btnSubmit"> Change </button>
                            </div>

                            <div >
                                Back to <a href="index.php" style = "text-decoration:none;">Login</a>
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