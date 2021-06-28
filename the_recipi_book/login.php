<?php
    session_start();
?>
<?php
require_once "pdo.php";
require_once "util.php";
if (isset($_POST['cancel']))
{
    header('Location: logout.php');
    return;
}
if(isset($_SESSION['email'])){
  header('Location: userhome.php');
  return;
}
if(isset($_POST["email"]) && isset($_POST["pass"])){
    $msg=validate_login();
    if(is_string($msg)){
      $_SESSION['error']=$msg;
      header('location:login.php');
      return;
    }
    $email=$_POST["email"];
    $pass=$_POST["pass"];
    $stmt = $pdo->query("SELECT email,pass FROM register where email='$email' and pass='$pass'");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      if(count($rows) == 1) {
         $_SESSION['email'] = $_POST['email'];
         header("location: home.php");
      }else {
         $_SESSION['error']= "Your Login Name or Password is invalid";
      }
   }
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="project.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Login</title>
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
 <h1 class="text-white row col-md-8 offset-md-4"><u>Log In</u></h1>
 </br>
 <?php
    if (isset($_SESSION['error']))
    {
        echo('<h6 class="text-danger row col-md-8 offset-md-4">' . htmlentities($_SESSION['error']) . "</h6>\n");
        unset($_SESSION['error']);
    }
    ?>
<div class="body text-center col-md-8 offset-md-4">
    <form method="POST" >
  </br>
    <div class="form-group row">
        <label for="nam" class="col-sm-2 col-form-label text-white">User Name</label>
        <div class="col-sm-1 text-center">
        <input type="text" name="email" id="name">
        </div>
        </div><br/>
        <div class="form-group row">
        <label for="id_1723" class="col-sm-2 col-form-label text-white">Password</label>
        <div class="col-sm-1 text-center">
        <input type="password" name="pass" id="id_1723">
        </div>
        </div><br/>
        <div class="form-group row col-md-8 offset-md-2">
        <input class="btn bg-black text-white border-white" type="submit" value="Log In"> &nbsp; &nbsp;
        <input class="btn bg-black text-white border-white" type="submit" name="cancel" value="Cancel"></br>
        </div>
        <div class="form-group row col-md-8 offset-md-2">
        <a href="register.php" class="form-group badge badge-info">for new user Register</a>
        </div>
    </form>
</div>
</body>
</html>
