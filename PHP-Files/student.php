<?php
session_start();

require_once 'connect.php';
$conn = mysqli_connect($host, $user, $ps, $project);
if (!$conn) {
    echo "<script>alert(\"Database error retry after some time !\")</script>";
} else {
    $type1 = $_SESSION["type"];
    $username1 = $_SESSION["username"];
    $sql = "select * from " . $type1 . " where mail='{$username1}'";
    $res =   mysqli_query($conn, $sql);
    if ($res == true) {
        global $dbmail, $dbpw, $dbusn;
        while ($row = mysqli_fetch_array($res)) {
            $dbmail = $row['mail'];
            $dbname = $row['name'];
            $dbusn = $row['usn'];
            $dbphno = $row['phno'];
            $dbgender = $row['gender'];
            $dbdob = $row['DOB'];
            $dbdept = $row['dept'];
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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../CSS-Files/style.css">
    <link rel="stylesheet" href="../CSS-Files/staff.css">
    <title>iQuiz</title>
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
    <nav class="navbar navbar-expand-lg navbar-light bg-none" style="position:-webkit-sticky; position:sticky; width:100%">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php" style="padding:0 30px"><img src="../images/logo.png" alt="logo" height="80" width="120"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                </ul>
                <div class="nav-item px-3 fs-5">
                    <a class="nav-link" style="color: #4f5557!important;" role="button" onclick="prof()">Profile</a>
                </div>
                <div class="nav-item px-3 fs-5">
                    <a class="nav-link" style="color: #4f5557!important;" onclick="score()" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Quiz's
                    </a>
                </div>
                <div class="nav-item px-4 fs-5" id="logout">
                    <a class="nav-link" onclick="logout()" role="button" style="padding: left 20px !important;margin-right: 50px;font-weight:350;color: #4f5557!important;">Log Out</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Navbar Profile  -->
    <center>
        <section class="prof" id="prof" style="color:#042A38; display:none" onclick="normal('prof')">
            <p><b>Type of User&nbsp;:&nbsp;<?php echo $type1 ?></b></p>
            <p><b>NAME&nbsp;:&nbsp;<?php echo $dbname ?></b></p>
            <p><b>EMAIL&nbsp;:&nbsp;<?php echo $dbmail ?></b></p>
            <p><b>Ph No.&nbsp;:&nbsp;<?php echo $dbphno ?></b></p>
            <p><b>STAFF ID.&nbsp;:&nbsp;<?php echo $dbusn ?></b></p>
            <p><b>GENDER&nbsp;:&nbsp;<?php echo $dbgender ?></b></p>
            <p><b>DOB&nbsp;:&nbsp;<?php echo $dbdob ?></b></p>
            <p><b>Dept.&nbsp;:&nbsp;<?php echo $dbdept ?></b></p>
        </section>
    </center>

    <!-- Navbar Quiz's list -->

    <section id="score" class="score table-responsive table-sm" style="display:none;" onclick="normal('score')">
        <?php
        $sql = "select * from score,quiz where score.mail='{$username1}' and score.quizid=quiz.quizid";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            echo "<h1 style='font-size:3vw; padding:10px; text-align:center;'>Scoreboard</h1>";
            echo "<table class='table table-dark' id='sc'><thead><tr><th scope='col'>Quiz Title</th><th scope='col'>Score Obtained</th><th scope='col'>Total Score</th><th scope='col'>Remarks</th></tr></thead>";
            while ($row = mysqli_fetch_assoc($res)) {
                echo "<tr><td>" . $row["quizname"] . "</td><td>" . $row["score"] . "</td><td>" . $row["totalscore"] . "</td><td>" . $row["remark"] . "</tr>";
            }
            echo "</table>";
        } else {
            echo " " . mysqli_error($conn);
        }
        ?><br><br><br>
    </section>

    <!-- Dashboard -->

    <center>
        <section class="head" style="width:100vw;margin:0vw;margin-top:4vw;font-size:3vw;">Welcome to Online Quiz System&nbsp;<?php echo $dbname ?></section>
    </center>
    <section style="color:#fff !important"><br><br><br>
        <?php
        global $username;
        $sql = "select mail from staff where dept='". $dbdept ."'";
        $res = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($res)){
            $username = $row['mail'];
        }
        $sql = "select * from quiz where mail='". $username ."'";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            echo "<center><h1 class='head' style='color: #48b31e;'>Take any Quiz</h1></center><br><br>";
            echo "<center><table class='table table-hover table-success'><thead><tr><th scope='col'>Quiz Title</th><th scope='col'>Created on</th><th scope='col'>Created By</th><th scope='col'>#</th></tr></thead>";
            while ($row = mysqli_fetch_assoc($res)) {
                $sql1 = "select * from score sc where sc.quizid='". $row['quizid'] ."' and sc.mail='". $dbmail ."' ORDER BY score DESC";
                $count = mysqli_num_rows(mysqli_query($conn, $sql1));
                if($count != 0){
                    echo "<tr><td>" . $row["quizname"] . "</td><td>" . $row["date_created"] . "</td><td>" . $row["mail"] . "</td><td>Completed</tr>";
                }
                else{
                    echo "<tr><td>" . $row["quizname"] . "</td><td>" . $row["date_created"] . "</td><td>" . $row["mail"] . "</td><td><a id=\"tq\" class='btn btn-success btn-sm my-0' href='take_quiz.php?qid=" . $row['quizid'] . "'>Take Quiz</button></tr>";
                }
            }
            echo "</table></center>";
        }
        ?>
    </section>


    <!-- script portion -->
    <script>
        function prof() {
            if (document.getElementById('score').style.display == "inherit")
                normal('score');
            document.getElementById('prof').style = "display: flex !important"
        }

        function normal(div) {
            document.getElementById(div).style = "animation: down_up 0.5s";
            setTimeout(
                () => {
                    document.getElementById(div).style = "display: none ";
                }, 400)
        }

        function score() {
            if (document.getElementById('prof').style.display == "flex")
                normal('prof');
            document.getElementById('score').style = "display: inherit !important";
        }

        function logout() {
            if (confirm("Are you sure... you want to logout !"))
                window.location.replace("login.php");
        }
    </script>

</body>

</html>