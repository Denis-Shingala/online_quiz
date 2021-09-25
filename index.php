<?php
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./CSS-Files/style.css">
    <style>
        ::-webkit-scrollbar {
            display: none;
        }

        body {
            animation: top_bottom 1s;
        }
        @media only screen and (max-width:710px){
            .img-fluid{
                  margin-bottom:60px;
            }
        }
    </style>
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" style="width:70%; padding-top: 20px; padding-left: 10%;" href="#"><img src="./images/logo.png" alt="logo" height="100" width="150"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="d-flex justify-content-center px-lg-3">
                    <a href="#" class="contactus">Contact Us</a>
                </div>
            </div>
        </div>

    </nav>
    <div class="d-flex flex-wrap-reverse justify-content-around overflow-hidden">
        <div class="d-flex justify-content-center flex-column flex-wrap align-items-center animation">
            <h1 class="head">Welcome To iQuiz</h1>
            <div class="btn">
                <a href="PHP-Files/login.php"><button type="button" style="text-shadow: 1px 3px 10px rgb(128, 127, 165);" class="btn btn-outline-success px-4 mx-2">Login</button></a>
                <a href="PHP-Files/signup.php"><button type="button" style="text-shadow: 1px 3px 10px rgb(128, 127, 165);" class="btn btn-outline-danger px-4 mx-2">SignUp</button></a>
            </div>
        </div>
        <img class="img-fluid" src="./images/image.png" alt="image" height="450" width="450">
    </div>
 
<footer class="page-footer font-small dark">

  <div class="footer-copyright text-center py-3">© 2021 Copyright:
    <a href="https://iquiztest.herokuapp.com/">iQuiz</a>
  </div>
</footer>
</body>

</html>
