<?php
session_start();

if (isset($_POST['login'])) {
    if (isset($_POST['usertype']) && isset($_POST['username']) && isset($_POST['pass'])) {
        require_once 'connect.php';
        $conn = mysqli_connect($host, $user, $ps, $project);
        if (!$conn) {
            echo "<script>alert(\"Database error retry after some time !\")</script>";
        }
        $type = mysqli_real_escape_string($conn, $_POST['usertype']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['pass']);
        $password = crypt($password, 'azbycxdwevf');
        $sql = "select * from " . $type . " where mail='{$username}'";
        $res =   mysqli_query($conn, $sql);
        if (mysqli_num_rows($res) != 0) {
            global $dbmail, $dbpw;
            while ($row = mysqli_fetch_array($res)) {
                $dbpw = $row['pw'];
                $dbmail = $row['mail'];
            }
            if ($dbpw === $password) {
                $_SESSION["name"] = $row['name'];
                $_SESSION["type"] = $type;
                $_SESSION["username"] = $dbmail;
                if ($type === 'student') {
                    header("Location:student.php");
                } elseif ($type === 'staff') {
                    header("Location:staff.php");
                }
            } elseif ($dbpw !== $password && $dbmail === $username) {
                echo "<script>alert('password is wrong');</script>";
                // session_unset();
                session_destroy();
                header("loaction:login.php");
            }
        } else {
            echo "<script>alert('username name not found sing up');</script>";
            // session_unset();
            session_destroy();
            header("loaction:login.php");
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

    <!-- Google fonts     -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@200&family=PT+Serif&display=swap" rel="stylesheet">

    <!-- bootstrap 5.1.0 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../CSS-Files/style.css">
    <title>iQuiz</title>
</head>
<style>
    body {
        animation: boom 1s;
    }

    ::-webkit-scrollbar {
        display: none;
    }

    .seluser {
        font-family: 'Mukta', sans-serif;
    }

    .sub {
        height: 3vw;
        width: 10vw;
        border-radius: 20px;
        text-align: center;
        padding-bottom: 5px;
        border: 2px solid black;
        transition: 0.5ms;
        background-color: #0093E9;
        background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%);
        box-shadow: 1px 10px 10px black;
    }

    .sub:hover {
        box-shadow: none;
    }

    .signin label {
        font-family: 'Mukta', sans-serif;
    }

    .inp {
        box-sizing: content-box !important;
        width: 30vw;
        height: 3vw;
        border-radius: 10px;
        border: 2px solid black;
        padding-left: 2vw;
        outline: none;
    }

    ::placeholder {
        font-family: initial;
    }
    input{
        backdrop-filter: blur(20px);
    }

    button:hover {
        background-color: #fff !important;
    }

    a {
        color: #042A38;
    }

    .login {
        font-family: 'Mukta', sans-serif;
        background-color: #D9AFD9;
        background-image: linear-gradient(222deg, #D9AFD9 0%, #97D9E1 100%);
        box-shadow: 0 7px 20px 0 rgba(0, 0, 0, 0.2), 0 7px 20px 0 gray;
        color: #042A38;
        width : 500px;
        padding: 2vw;
        font-weight: bolder;
        margin-top: 1%;
        margin-bottom: 10px;
        border-radius: 10px;
        padding: top 15px;
        padding: bottom 15px;
    }
    @media only screen and (max-width:750px){
        .login{
            width: 350px;
        }
    }
    @media only screen and (max-width:350px){
        .login{
            width: 300px;
        }
    }
</style>

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
    <div>
        <center>
            <img class="img-fluid" src="../images/logo.png" alt="image" height="100" width="150">
        </center>
        <center>
            <div class="login">
                <form action="login.php" method="POST">
                    <div class="form-check form-check-inline seluser">
                        <input class="form-check-input" type="radio" name="usertype" id="inlineRadio1" value="student">
                        <label class="form-check-label" for="inlineRadio1">STUDENTS</label>
                    </div>
                    <div class="form-check form-check-inline seluser">
                        <input class="form-check-input" type="radio" name="usertype" id="inlineRadio2" value="staff">
                        <label class="form-check-label" for="inlineRadio2">FACULTY</label>
                    </div><br>
                    <hr>

                    <label for="username" class="form-label" style="text-transform:uppercase;">E-mail</label>
                    <input class="form-control" type="email" name="username" placeholder=" Email" class="inp" required>
                    <br><br>
                    <label for="password" class="form-label" style="text-transform: uppercase;">Password</label>
                    <input class="form-control" type="password" name="pass" placeholder="******" class="inp" required>
                    <br><br>
                    <div class="d-grid gap-2">
                    <input class="btn btn-success" name="login" class="sub" type="submit" value="Login">
                    </div>
                </form><br>
                New user!&nbsp;&nbsp;<a href="signup.php">SIGN UP</a>
            </div>

        </center>

</body>

</html>
