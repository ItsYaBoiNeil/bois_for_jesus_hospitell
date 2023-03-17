<?php
require_once "config.php";

$name = $password = $confirm_password = "";
$name_err = $password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST["name"]))){
        $name_err = "Invalid Name";
    }
else{
    $sql = "SELECT id FROM patients WHERE name = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_name);

            $param_name = trim($_POST['name']);

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
            $name = trim($_POST['name']);
        }
        else{
            echo "Unexpected Error";
        }
    }
}
mysqli_stmt_close($stmt);

if(empty(trim($_POST['password']))){
    $password_err = "Invalid Password";
}elseif(strlen(trim($_POST['password'])) < 5){
        $password_err = "Password cannot be less than 5 characters";
    }
else{
        $password = trim($_POST['password']);
    }

if(trim($_POST['password']) !=  trim($_POST['confirm_password'])){
        $password_err = "Passwords are not matching";
    }
    
if(empty($name_err) && empty($password_err) && empty($confirm_password_err))
{
    $sql = "INSERT INTO patients (name, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);    
    if ($stmt)
    {
     mysqli_stmt_bind_param($stmt, "ss", $param_name, $param_password);

     $param_name = $name;
     $param_password = password_hash($password, PASSWORD_DEFAULT);

if (mysqli_stmt_execute($stmt))
 {
 header("location: login.php");
 }
else{
    echo "Something Went Wrong ..... Cannot Redirect";
   }
 }
 mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/notice_style.css">
  <link rel="stylesheet" href="./styles/style.css">
  <link rel="stylesheet" href="./styles/styles.css">
  <link rel="stylesheet" href="./styles/styles_animation.css">
    <title></title>
  </head>
  <body>
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
  
  <img class="bg" src="./images/hospital.jpg" alt="background"> </i>

<div class="container mt-4">
<h3 style="color: #03a9d3">Please Register Here:</h3>
<hr>
<form action="" method="post">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4" style="color: #03a9d3">Patient Name</label>
      <input type="text" class="form-control" name="name" id="inputEmail4" placeholder="Name">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4" style="color: #03a9d3">Password</label>
      <input type="password" class="form-control" name ="password" id="inputPassword4" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
      <label for="inputPassword4" style="color: #03a9d3">Confirm Password</label>
      <input type="password" class="form-control" name ="confirm_password" id="inputPassword" placeholder="Confirm Password">
    </div>
  <div class="form-group">
  </div>
  <button type="submit" class="btn btn-primary">Sign Up</button>
</form>
</div>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
