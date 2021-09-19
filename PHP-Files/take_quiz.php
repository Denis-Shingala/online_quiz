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
    <style>
        input[type=radio]{
            margin-left:20px !important;
            float: none !important;
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
    <section style="margin-top: 4vw;width:80vw;margin-left:10vw;margin-right:10vw">
        <?php
        if (isset($_GET["qid"])) {
            $qid = $_GET["qid"];
            $sql = "select * from questions where quizid='{$qid}'";
            $res = mysqli_query($conn, $sql);
            if ($res) {
                $count = mysqli_num_rows($res);
                if (mysqli_num_rows($res) == 0) {
                    echo "No questions found under this quiz please come later";
                } else {
                    $i = 1;
                    echo "<form method=\"POST\">";
                    while ($row = mysqli_fetch_assoc($res)) {
                        echo '<div class="form-check">';
                        echo $i . ". " . $row["qs"] . "<br>";
                        echo "<input class='form-check-input' type='radio' value='" . $row['op1'] . "' name='ans{$i}' required>&nbsp;&nbsp;&nbsp;" . $row['op1'] . "<br>";
                        echo "<input class='form-check-input' type='radio' value='" . $row['op2'] . "' name='ans{$i}' required>&nbsp;&nbsp;&nbsp;" . $row['op2'] . "<br>";
                        echo "<input class='form-check-input' type='radio' value='" . $row['op3'] . "' name='ans{$i}' required>&nbsp;&nbsp;&nbsp;" . $row['op3'] . "<br>";
                        echo "<input class='form-check-input' type='radio' value='" . $row['op4'] . "' name='ans{$i}' required>&nbsp;&nbsp;&nbsp;" . $row['op4'] . "<br><br>";
                        echo '</div>';
                        $i++;
                    }
                    echo "<input id='btn' type='submit' class='btn btn-success mx-3' name=\"submit\" value=\"    submit   \"><br><br><br>";
                    echo "</form><br><br>";
                }
            } else {
                echo "error" . mysqli_error($conn) . ".";
            }

            if (isset($_POST["submit"])) {

                $i = 1;
                $qid = $_GET["qid"];
                $sql = "select * from questions where quizid='{$qid}'";
                $res = mysqli_query($conn, $sql);

                global $score;
                $score = 0;
                while ($row = mysqli_fetch_assoc($res)) {
                    if ($_POST["ans{$i}"] == $row[$row['answer']]) {
                        $score++;
                    }
                    $i++;
                }
                echo "<script>alert(\"You scored " . $score . " out of " . $count . "\");</script>";
                $sql = "insert into score(score,mail,quizid,totalscore) values('$score','$dbmail','$qid','$count');";
                $res = mysqli_query($conn, $sql);
                if ($res) {
                    echo "<script>window.location.replace(\"student.php\");</script>";
                } else {
                    echo "<script>alert(\"error occured updating score in database" . mysqli_error($conn) . "\");</script>";
                }
            }
        } ?>
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