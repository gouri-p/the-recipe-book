<?php
session_start();
require_once "pdo.php";
require_once "util.php";
?>
<?php
if (!isset($_SESSION['email']))
{
    header('Location: login.php');
}
elseif (isset($_POST['logout']) && $_POST['logout'] == 'Logout')
{
    header('Location: logout.php');
}
$failure = false;
$success = false;
$msg = false;
if(isset($_POST["postit"]) && isset($_POST["postit"])=="postit"){

  $msg=validate_recipi();
  if(is_string($msg)){
    $_SESSION['error']=$msg;
    header('location:postrecipi.php');
    return;
  }
  $filename = $_FILES["foodfile"]["name"]; 
  $tempname = $_FILES["foodfile"]["tmp_name"];     
  $folder = "image/".$filename; 
  $stmt=$pdo->prepare("INSERT into recipies (category,recipi,ingrediants,steps,foodfile,tips,email) values(:category,:rname,:ingrediants,:steps,:foodfile,:tips,:email)");
  $stmt->execute(array(
    ':category'=>$_POST['category'],
    ':rname'=>$_POST['rname'],
    ':ingrediants'=>$_POST['ingrediants'],
    ':steps'=>$_POST['steps'],
    ':foodfile'=>$filename,
    ':tips'=>$_POST['tips'],
    ':email'=>$_SESSION['email']
  )
); 
if (move_uploaded_file($tempname, $folder))  { 
    $msg = "Image uploaded successfully"; 
  }
  else{ 
    $msg = "Failed to upload image"; 
  } 
   $success="posted new recipe";
   if(is_string($success)){
    $_SESSION['success']=$success;
    header('location:postrecipi.php');
    return;
  }
 }
elseif (isset($_POST["cancel"]) && isset($_POST["cancel"])=="cancel") {
  header("Location:home.php");
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
    <title>post recipe</title>
</head>
<body class="body">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  <div class="sidebar">
  <header>
   <nav class="navbar navbar-expand-lg navbar-light bg-dark">
   <a class="navbar-brand text-white" href="/the_recipi_book/home.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand text-white" href="/the_recipi_book/postrecipi.php">New Recipe</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand text-white" href="/the_recipi_book/myrecipies.php">My Recipe</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand text-white" href="/the_recipi_book/logout.php">Logout</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
   </nav>
   </header>
 </div>
 <h1 class="text-white row col-md-8 offset-md-4"><u>New Recipe</u></h1>
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
    <div class="body text-center col-md-8 offset-md-4">
    <form method="POST" enctype="multipart/form-data">
    <br>
        <div class="form-group row ">
        <label for="rname" class="col-sm-2 col-form-label text-white">Category</label>
        <div class="col-sm-1 text-center">
        <select name="category" id="category">
          <option value="sweets">sweets</option>
          <option value="spicy">spicy</option>
          <option value="juices">juices</option>
          <option value="cakes">cakes</option>
          <option value="icecreams">icecreams</option>
        </select>
        </div>
        </div>
        <div class="form-group row ">
        <label for="rname" class="col-sm-2 col-form-label text-white">recipi Name</label>
        <div class="col-sm-1 text-center">
        <input type="text" name="rname" id="rname">
        </div>
        </div>
        <div class="form-group row">
        <label for="ingrediants" class="col-sm-2 col-form-label text-white">ingrediants</label>
        <div class="col-sm-1 text-center">
        <textarea type="text" name="ingrediants" id="ingrediants" rows="3" cols="50"></textarea>
        </div>
        </div>
        <div class="form-group row">
        <label for="steps" class="col-sm-2 col-form-label text-white">steps</label>
        <div class="col-sm-1 text-center">
        <textarea type="text" name="steps" id="steps" rows="3" cols="50"></textarea>
        </div>
        </div>
        <div class="form-group row">
        <label for="foodfile" class="col-sm-2 col-form-label text-white">upload image</label>
        <div class="col-sm-1 text-center">
        <input type="file" name="foodfile" id="foodfile">
        </div>
        </div>
        <div class="form-group row">
        <label for="tips" class="col-sm-2 col-form-label text-white">extra tips</label>
        <div class="col-sm-1 text-center">
        <input type="text" name="tips" id="tips">
        </div>
        </div>
        <div class="form-group row col-md-8 offset-md-2">
        <input class="btn bg-black text-white border-white" type="submit" value="post It" name="postit"> &nbsp; &nbsp;
        <input class="btn bg-black text-white border-white" type="submit" name="cancel" value="Cancel">
        </div>
        </div>
    </form>
</body>
</html>