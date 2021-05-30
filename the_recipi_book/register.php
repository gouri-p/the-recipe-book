<?php
session_start();
require_once "pdo.php";
require_once "util.php";
?>
<?php
$failure = false;
$success = false;
$msg = false;
if(isset($_POST["register"]) && isset($_POST["register"])=="register"){

  $msg=validate_register();
  if(is_string($msg)){
    $_SESSION['error']=$msg;
    header('location:Register.php');
    return;
  } 
  $stmt=$pdo->prepare("INSERT into register (uname,email,mobile,pass) values(:uname,:email,:mobile,:pass)");
  $stmt->execute(array(
    ':uname'=>$_POST['uname'],
    ':email'=>$_POST['email'],
    ':mobile'=>$_POST['mobile'],
    ':pass'=>$_POST['pass']
  )
); 
   $regsuccess="registered succesfully";
   if(is_string($regsuccess)){
    $_SESSION['regsuccess']=$regsuccess;
    $_SESSION['email']=$_POST['email'];
    header('location:userhome.php');
    return;
  }
 }
elseif (isset($_POST["cancel"]) && isset($_POST["cancel"])=="cancel") {
  header("Location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="project.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body class="body">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <div class="sidebar">
  <header>
   <nav class="navbar navbar-expand-lg navbar-light bg-dark">
   <a class="navbar-brand text-white" href="/the_recipi_book/index.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand text-white" href="/the_recipi_book/login.php">Login</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand text-white" href="/the_recipi_book/register.php">Register</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
   </nav>
   </header>
 </div>
 <h1 class="text-white row col-md-8 offset-md-4"><u>Register</u></h1>
</br>
<?php
    if (isset($_SESSION['error']))
    {
        echo('<h6 class="text-danger row col-md-8 offset-md-4">' . htmlentities($_SESSION['error']) . "</h6>\n");
        unset($_SESSION['error']);
    }
    if (isset($_SESSION['success']))
    {
        echo('<h6 class="text-info row col-md-8 offset-md-4">' . htmlentities($_SESSION['success']) . "</h6>\n");
        unset($_SESSION['success']);
    }
    ?>
<br/>
<div class="body text-center col-md-8 offset-md-4">
<form method="POST" enctype="multipart/form-data">
        <div class="form-group row ">
        <label for="uname" class="col-sm-2 col-form-label text-white">User Name</label>
        <div class="col-sm-1 text-center">
        <input type="text" name="uname" id="uname">
        </div>
        </div><br/>
        <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label text-white">Email-ID</label>
        <div class="col-sm-1 text-center">
        <input type="text" name="email" id="email">
        </div>
        </div><br/>
        <div class="form-group row">
        <label for="mobile" class="col-sm-2 col-form-label text-white">Mobile</label>
        <div class="col-sm-1 text-center">
        <input type="text" name="mobile" id="mobile">
        </div>
        </div><br/>
        <div class="form-group row">
        <label for="password" class="col-sm-2 col-form-label text-white">Password</label>
        <div class="col-sm-1 text-center">
        <input type="password" name="pass" id="pass">
        </div>
        </div><br/>
        <div class="form-group row col-md-8 offset-md-2">
        <input class="btn bg-black text-white border-white" type="submit" value="Register" name="register">&nbsp; &nbsp;
        <input class="btn bg-black text-white border-white" type="submit" name="cancel" value="Cancel">
        </div>
    </form>
  </div>
</body>
</html>