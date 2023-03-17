<?php
//This script will handle login
session_start();

// check if the user is already logged in
if(isset($_SESSION['username']))
{
    header("location: landing.html");
    exit;
}
require_once "config.php";

$name = $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['name'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter name + password";
    }
    else{
        $name = trim($_POST['name']);
        $password = trim($_POST['password']);
    }


if(empty($err))
{
    $sql = "SELECT id, name , password FROM patients WHERE name = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_name);
    $param_name = $name;
    
    
    // Try to execute this statement
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $id, $name, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashed_password))
                        {
                            // this means the password is corrct. Allow user to login
                            session_start();
                            $_SESSION["name"] = $name;
                            $_SESSION["id"] = $id;
                            $_SESSION["loggedin"] = true;

                            //Redirect user to welcome page
                            header("location: patient-dashboard.php");
                            
                        }
                    }

                }

    }
}    


}


?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="google-site-verification" content="gv4CERFXGI7o0TijKFPi9Scno2eGsaItVzsDtt8hb2Y" />
   
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="./styles/notice_style.css">
  <link rel="stylesheet" href="./styles/style.css">
  <link rel="stylesheet" href="./styles/styles.css">
  <link rel="stylesheet" href="./styles/styles_animation.css">
  <link
    href="https://fonts.googleapis.com/css2?family=Allerta&family=Kanit:wght@300&family=Lobster&family=Open+Sans:wght@400;600&display=swap"
    rel="stylesheet">
  <title></title>

  
</head>


<body >
  <header>
    <nav class="navbar navbar-dark py-4" style="background-color: #03a9d3;">
      <div class="div-logo container-fluid">
        <img class="logo" src="./images/hospitell_logo.png" alt="logo" height="100"> 
      </a>
      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class=" main-ul navbar-nav ml-auto" style="margin-left: 10px;">
        <li class="nav-item">
          <a class="nav-link" style="color: rgb(249, 249, 249);" href="register.php"><b>Patient Register</b></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" style="color: rgb(249, 249, 249);" href="login.php"><b>Patient Login</b></a>
        </li>
          
        </li>
        <li class="nav-item">
          <a class="nav-link" style="color: rgb(249, 249, 249);" href=""><b>About Us</b></a>
        </li>
          
        </li>
        <li class="nav-item active">
          <a class="nav-link" style="color: rgb(249, 249, 249);" href="register.php"><b>Register</b></a>
        </li>
        
        </ul>
      </div>
    </nav>
  </header>
  <img class="bg" src="./images/hospital.jpg" alt="background"> </i>
<div class="container mt-4">
<h3 style="color: #03a9d3">Please Login Here:</h3>
<hr>

<form action="" method="post">
  <div class="form-group">
    <label for="examplename" style="color: #03a9d3">Patient Name</label>
    <input type="text" name="name" class="form-control" id="examplename" aria-describedby="namehelp" placeholder="Enter Patient Name">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1" style="color: #03a9d3">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Password">
  </div>
  <br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>



</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>