<?php
if (isset($_POST['studsu'])) {
    session_start();
    if (isset($_POST['name1']) && isset($_POST['usn1']) && isset($_POST['mail1']) && isset($_POST['phno1']) && isset($_POST['dept1']) && isset($_POST['dob1']) && isset($_POST['gender1']) && isset($_POST['password1']) && isset($_POST['cpassword1'])) {
        require_once 'connect.php';
        $conn = mysqli_connect($host, $user, $ps, $project);
        if (!$conn) {
            echo "<script>alert(\"Database error retry after some time !\")</script>";
        }
        $name1 = mysqli_real_escape_string($conn, $_POST['name1']);
        $usn1 = mysqli_real_escape_string($conn, $_POST['usn1']);
        $mail1 = mysqli_real_escape_string($conn, $_POST['mail1']);
        $phno1 = mysqli_real_escape_string($conn, $_POST['phno1']);
        $dept1 = mysqli_real_escape_string($conn, $_POST['dept1']);
        $dob1 = mysqli_real_escape_string($conn, $_POST['dob1']);
        $gender1 = mysqli_real_escape_string($conn, $_POST['gender1']);
        $password1 = mysqli_real_escape_string($conn, $_POST['password1']);
        $cpassword1 = mysqli_real_escape_string($conn, $_POST['cpassword1']);
        $password1 = crypt($password1, 'azbycxdwevf');
        $cpassword1 = crypt($cpassword1, 'azbycxdwevf');
        if ($password1 == $cpassword1) {
            $sql = "insert into student (usn,name,mail,phno,dept,gender,DOB,pw) values('$usn1','$name1','$mail1','$phno1','$dept1','$gender1','$dob1','$password1')";
            if (mysqli_query($conn, $sql)) {
                require 'success.html';
                session_destroy();
            } else {
                require 'database_error.html';
                session_destroy();
            }
        } else {
            
            session_destroy();
        }
    }
}

if (isset($_POST['staffsu'])) {
    session_start();
    if (isset($_POST['name2']) && isset($_POST['staffid']) && isset($_POST['mail2']) && isset($_POST['phno2']) && isset($_POST['dept2']) && isset($_POST['dob2']) && isset($_POST['gender2']) && isset($_POST['password2']) && isset($_POST['cpassword2'])) {
        require 'connect.php';
        $conn = mysqli_connect($host, $user, $ps, $project);
        if (!$conn) {
            echo "<script>alert(\"Database error retry after some time !\")</script>";
        }
        $name2 = mysqli_real_escape_string($conn, $_POST['name2']);
        $usn2 = mysqli_real_escape_string($conn, $_POST['staffid']);
        $mail2 = mysqli_real_escape_string($conn, $_POST['mail2']);
        $phno2 = mysqli_real_escape_string($conn, $_POST['phno2']);
        $dept2 = mysqli_real_escape_string($conn, $_POST['dept2']);
        $dob2 = mysqli_real_escape_string($conn, $_POST['dob2']);
        $gender2 = mysqli_real_escape_string($conn, $_POST['gender2']);
        $password2 = mysqli_real_escape_string($conn, $_POST['password2']);
        $cpassword2 = mysqli_real_escape_string($conn, $_POST['cpassword2']);
        $password2 = crypt($password2, 'azbycxdwevf');
        $cpassword2 = crypt($cpassword2, 'azbycxdwevf');
        if ($password2 == $cpassword2) {
            $sql = "insert into staff (staffid,name,mail,phno,dept,gender,DOB,pw) values('$usn2','$name2','$mail2','$phno2','$dept2','$gender2','$dob2','$password2')";
            if (mysqli_query($conn, $sql)) {
                require 'success.html';
                session_destroy();
            } else {
                require 'database_error.html';
                session_destroy();
            }
        } else {
            require 'error.html';
            session_destroy();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <!-- Google fonts     -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@200&family=PT+Serif&display=swap" rel="stylesheet">

    <!-- bootstrap 5.1.0 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../CSS-Files/style.css">
    <title>iQuiz</title>
    <style>
        body {
            padding: 0 10px;
            font-family: 'Mukta', sans-serif;
            font-weight: bolder;
            font-size: 20px;
        }

        ::-webkit-scrollbar {
            width: 5px;
        }

        .form {
            max-width: 600px;
            margin: 20px auto;
            background-color: #D9AFD9;
            background-image: linear-gradient(222deg, #D9AFD9 0%, #97D9E1 100%);
            box-shadow: 0 7px 20px 0 rgba(0, 0, 0, 0.2), 0 7px 20px 0 gray;
            border-radius: 10px;
        }

        .staff {
            display: none !important;
        }

        .formname {
            text-shadow: 0 0 20px #426cbb62, 0 0 20px #db38db78;
        }

        .type {
            background-color: #d470d46c;
            padding: 0%;
            margin: 0%;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            max-width: 600px;
            overflow: hidden;
            display: flex;
            justify-content: space-around;
        }

        .type-btn {
            width: 50%;
            background: none;
            border: none;
            font-weight: bolder;
            font-size: 20px;
            padding: 10px 0;
        }

        .type-btn:focus,
        .type-btn:nth-child(1):focus {
            background-color: #3EECAC;
            background-image: linear-gradient(45deg, #813eec 0%, #EE74E1 100%);
        }

        .type-btn:hover {
            background-color: rgba(116, 16, 209, 0.705);
        }

        .type-btn:nth-child(1) {
            border-top-left-radius: 10px;
        }


        .type-btn:nth-child(2) {
            border-top-right-radius: 10px;
            border-left: 1px solid rgba(0, 0, 0, 0.226);
        }

        .student {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        label {
            padding: 25px 0 10px 0;
        }

        input,
        select {
            width: 50vh;
            margin: 0 auto;
            border-radius: 5px;
            background-color: rgba(160, 97, 172, 0.144);
            border: 2px solid rgba(160, 97, 172, 0.144);
            outline: none;
            padding: 4px;
        }

        .radio input {
            width: 30px !important;
            margin: 6px;
        }

        @media only screen and (max-width:375px) {

            *,
            .type-btn {
                font-size: 13px;
            }

            input,
            select {
                width: 50vh;
            }
        }

        .btn {
            width: 200px;
            border-radius: 20px;
            font-weight: bolder;
            box-shadow: 0 7px 20px 0 rgba(0, 0, 0, 0.2), 0 7px 20px 0 gray;
            margin: 50px 0;
            background-color: #0093E9;
            background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%);
        }
    </style>
</head>

<body>
    <div class="animation-area">
        <ul class="box-area">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
    <div class="d-flex justify-content-center">
        <img class="img-fluid" src="../images/logo.png" alt="image" height="100" width="150">
    </div>
    <center class="form">
        <div class="type">
            <button class="type-btn" onclick="student_details()">STUDENT</button>
            <button class="type-btn" onclick="staff_details()">STAFF</button>
        </div>
        <div class="student" id="student">
            <form action="signup.php" name="form" method="POST">
                <br>
                <h1 class="formname"><b>Sign-Up as Student</b></h1><br>
                <label for="name">Name</label><br>
                <input type="text" name="name1" id="name"><br>
                <label for="enrollment">Enrollment</label><br>
                <input type="number" name="usn1" id="enrollment"><br>
                <label for="email">Email</label><br>
                <input type="email" name="mail1" id="email"><br>
                <label for="phone">Phone</label><br>
                <input type="tel" name="phno1" id="phone"><br>
                <label for="dept">Department</label><br>
                <select name="dept1">
                    <option disabled selected>Select</option>
                    <option value="IT">IT</option>
                    <option value="Computer">Com</option>
                    <option value="Electrical">Electrical</option>
                    <option value="Chemical">Chemical</option>
                    <option value="Civil">Civil</option>
                    <option value="Mechanical">Mechanical</option>
                    <option value="Power Electrical">Power Electrical</option>
                </select><br>
                <label for="DOB">Date of Birth</label><br>
                <input type="date" name="dob1" id="DOB"><br>
                <label for="gender">Gender</label><br>
                <div class="radio d-flex justify-content-center">
                    <input type="radio" name="gender1" id="gender" value="Male"><span style="margin-right: 20px;">Male</span>
                    <input type="radio" name="gender1" id="gender" value="Female">Female
                </div>
                <label for="Password">Password</label><br>
                <input type="password" name="password1" id="password"><br>
                <label for="repassword">Re-password</label><br>
                <input type="password" name="cpassword1" id="repassword"><br>
                <input class="btn" type="submit" name="studsu" value="Submit">
            </form>
        </div>
        <div class="staff" id="staff">
            <form action="signup.php" name="form" method="POST">
                <br>
                <h1 class="formname"><b>Sign-Up as Staff</b></h1><br>
                <label for="name">Name</label><br>
                <input type="text" name="name2" id="name"><br>
                <label for="staff-id">Staff Id</label><br>
                <input type="number" name="staffid" id="staff-id"><br>
                <label for="email">Email</label><br>
                <input type="email" name="mail2" id="email"><br>
                <label for="phone">Phone</label><br>
                <input type="tel" name="phno2" id="phone"><br>
                <label for="dept2">Department</label><br>
                <select name="dept2">
                    <option disabled selected>Select</option>
                    <option value="IT">IT</option>
                    <option value="Computer">Com</option>
                    <option value="Electrical">Electrical</option>
                    <option value="Chemical">Chemical</option>
                    <option value="Civil">Civil</option>
                    <option value="Mechanical">Mechanical</option>
                    <option value="Power Electrical">Power Electrical</option>
                </select><br>
                <label for="DOB">Date of Birth</label><br>
                <input type="date" name="dob2" id="DOB"><br>
                <label for="gender">Gender</label><br>
                <div class="radio d-flex justify-content-center">
                    <input type="radio" name="gender2" id="gender" value="Male"><span style="margin-right: 20px;">Male</span>
                    <input type="radio" name="gender2" id="gender" value="Female">Female
                </div>
                <label for="Password">Password</label><br>
                <input type="password" name="password2" id="password"><br>
                <label for="repassword">Re-password</label><br>
                <input type="password" name="cpassword2" id="repassword"><br>
                <input class="btn" type="submit" name="staffsu" value="Submit">
            </form>
        </div>

    </center>
    <script>
        const student = document.getElementById('student');
        const staff = document.getElementById('staff');

        function student_details() {
            student.style = "display:initial !important";
            staff.style = "display:none";
        }

        function staff_details() {
            student.style = "display:none";
            staff.style = "display:initial !important";
        }
    </script>
</body>

</html>