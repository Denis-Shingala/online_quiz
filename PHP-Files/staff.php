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
            $dbusn = $row['staffid'];
            $dbphno = $row['phno'];
            $dbgender = $row['gender'];
            $dbdob = $row['DOB'];
            $dbdept = $row['dept'];
        }
    }
    if (isset($_POST['submit'])) {
        $qname = strtolower($_POST['quizname']);
        $_SESSION["qname"] = $qname;
        $sql1 = "insert into quiz(quizname,mail) values('$qname','$username1')";
        $res1 = mysqli_query($conn, $sql1);
        if ($res1 == true) {
            $sql = "select quizid from quiz where quizname='" . $qname . "';";
            $res = mysqli_query($conn, $sql);
            if ($res == true) {
                while($row = mysqli_fetch_assoc($res)){
                    $qid = $row['quizid'];
                }
                echo "<script>window.location.replace(\"add_quiz.php?qid=" . $qid . "\");</script>";
            } else {
                echo "<script>alert(\"some error occured\");</script>";
            }
        } else {
            echo "<script>alert(\"Already name exists\");</script>";
        }
    }
    if (isset($_POST['submit1'])) {
        $qid1 = strtolower($_POST['quizid']);
        $sql1 = "delete from quiz where quizid='{$qid1}'";
        $res1 = mysqli_query($conn, $sql1);
        if ($res1 == true) {
            echo "<script>alert(\"Quiz successfully deleted\");</script>";
        } else {
            echo "<script>alert(\"Unknown error occured during deletion of quiz\");</script>";
        }
    }
    if (isset($_POST['submit2'])) {
        $qid1 = $_POST['quizid'];
        $sql1 = "select * from quiz where quizid='{$qid1}'";
        $res1 = mysqli_query($conn, $sql1);
        if (mysqli_num_rows($res1) != 0) {
            echo "<script>window.location.replace(\"view_quiz.php?qid=" . $qid1 . "\");</script>";
        } else {
            echo "<script>alert(\"Quiz is not found please create new quiz...\");</script>";
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
        $sql = "select * from quiz where mail='{$username1}'";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            echo "<h1 style='font-size:3vw; padding:10px; text-align:center;'>List of Quiz added by you</h1><br>";
            echo "<table class='table table-dark' id='sc'><thead><tr><th scope='col'>Quiz id</th>&nbsp;<th scope='col'>Quiz Title</th><th scope='col'>Created on</th></tr></thead>";
            while ($row = mysqli_fetch_assoc($res)) {
                echo "<tr><td>" . $row["quizid"] . "</td><td>" . $row["quizname"] . "</td><td>" . $row["date_created"] . "</td></tr>";
            }
            echo "</table>";
        }
        ?>
    </section>

    <!-- Dashboard -->

    <center>
        <section class="head" style="width:100vw;margin:0vw;margin-top:4vw;font-size:3vw;">Welcome to Online Examination System&nbsp;<?php echo $dbname ?></section>
    </center>
    <section class="dash" style="margin: 5vw;width: 90vw;">
        <center>
            <button class="btn btn-success btn-sm my-2" onclick="addquiz()">Add Quiz</button>
            <button class="btn btn-danger btn-sm my-2" onclick="delquiz()">Delete Quiz</button>
            <button class="btn btn-primary btn-sm my-2" onclick="viewquiz()">View Quiz</button>
        </center>
        <center>
            <section id="addq" class="cont" style="display:none;">
                <form style="width: 70vw" method="post">
                    <h1 class="form-head">
                        <hr>Add quiz
                        <hr>
                    </h1>
                    <br>
                    <input type="text" name="quizname" placeholder="enter quiz name" required><br><br>
                    <input type="reset" value="  Back  " class="btn btn-primary" onclick="back('addq')">
                    <input type="submit" name="submit" value="Submit" class="btn btn-success">
                </form>
            </section>
        </center>
        <center>
            <section id="delq" class="cont" style="display:none;">
                <form style="width: 70vw" method="post">
                    <h1 class="form-head">
                        <hr>Delete Quiz
                        <hr>
                    </h1>
                    <br>
                    <input type="number" name="quizid" placeholder="enter quiz id" required><br><br>
                    <h7 onclick="score()" role="button" style="font-size:15px !important; padding:0; color:black; font-size:1vw; text-decoration:underline">Get Quiz ID</h7><br><br>
                    <input type="reset" value="  Back  " class="btn btn-primary" onclick="back('delq')">
                    <input type="submit" name="submit1" value="submit" class="btn btn-success">
                </form>
            </section>
        </center>
        <center>
            <section id="viewq" class="cont" style="display:none;">
                <form style="width: 70vw" method="post">
                    <h1 class="form-head">
                        <hr>View Quiz
                        <hr>
                    </h1>
                    <br>
                    <input type="number" name="quizid" placeholder="enter quiz id" required><br><br>
                    <h7 onclick="score()" role="button" style="font-size:15px !important; padding:0; color:black; font-size:1vw; text-decoration:underline">Get Quiz ID</h7><br><br>
                    <input type="reset" value="  Back  " class="btn btn-primary" onclick="back('viewq')">
                    <input type="submit" name="submit2" value="submit" class="btn btn-success">
                </form>
            </section>
        </center>
    </section>



    <!-- Leader board table -->

    <section style="color:#fff !important;">
        <?php
        $sql = "select quizname,s.name,score,totalscore from student s,staff st,score sc,quiz q where q.quizid=sc.quizid and s.mail=sc.mail and q.mail=st.mail and q.mail='{$username1}' ORDER BY score DESC";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            echo '<center><h1 class="head" style="color: #48b31e;">Leaderboard</h1></center>';
            echo '<table id="table" class="table table-success"><thead><tr><th scope="col">Quiz Title</th>&nbsp;<th scope="col">Student Name</th><th scope="col">Score Obtained</th><th scope="col">Max Score</th></tr></thead>';
            while ($row = mysqli_fetch_assoc($res)) {
                echo "<tr><td>" . $row["quizname"] . "</td><td>" . $row["name"] . "</td><td>" . $row["score"] . "</td><td>" . $row["totalscore"] . "</td></tr>";
            }
            echo "</table><br><br>";
        } else {
            echo mysqli_error($conn);
        }
        ?>
    </section>
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

        function addquiz() {
            document.getElementById('addq').style = "animation: opacity 0.5s;";
            setTimeout(
                () => {
                    document.getElementById('addq').style = "display:inherit !important";
                }, 400)
        }

        function delquiz() {
            document.getElementById('delq').style = "animation: opacity 0.5s;";
            setTimeout(
                () => {
                    document.getElementById('delq').style = "display:inherit !important";
                }, 400)
        }

        function viewquiz() {
            document.getElementById('viewq').style = "animation: opacity 0.5s;";
            setTimeout(
                () => {
                    document.getElementById('viewq').style = "display:inherit !important";
                }, 400)
        }

        function back(div) {
            document.getElementById(div).style = "animation: opposite 0.5s;";
            setTimeout(
                () => {
                    document.getElementById(div).style = "display:none !important";
                }, 400)
        }
    </script>
</body>

</html>