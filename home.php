<?php
session_start();
?>
<?php

require_once "pdo.php";
$failure = false;
$success = false;

if (isset($_POST['logout']) && $_POST['logout'] == 'Logout')
{
    header('Location: logout.php');
}

$stmt = $pdo->query("SELECT recipi,ingrediants,steps,foodfile,tips FROM recipies");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="cards.css"><link rel="stylesheet" href="project.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <?php require_once "bootstrap.php"; ?>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
    <title>Reciepies</title>
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
<div class="container">
    <h1 class="text-white"><u>Recipies</u></h1>
    </br>
    <?php
    if (isset($_SESSION['error']))
    {
        // Look closely at the use of single and double quotes
        echo('<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n");
        unset($_SESSION['error']);
    }
    ?>
    <div class="cards">
        <?php
        foreach ($rows as $row)
        {
            echo '<div class="card" style="width: 20rem;">';
            echo '<img class="card__image" src="image/'.$row['foodfile'].'" >';
            echo '<div class="body">';
            echo '<div class="card_info">';
            echo '<h3 class="card-title"><b>'.$row['recipi'].'</b></h3>';
            echo '</div>';
            // echo '<h4 class="card-text"><b>'.$row['ingrediants'].'</b></h4>';
            // echo '<h4><b>'.$row['steps'].'</b></h4>';
            echo '<p><div class="card_footer">';
            // echo '<span class="material-icons">star</span>';
            echo '&nbsp; &nbsp;<a href="view.php?recipi='.$row['recipi'].'" class="btn bg-wite text-black border-dark"/>view recipe</a>';
            echo '</div></p>';
            echo '</div>';
            echo '</div>';
        };
        ?>
        </div>
</div>
</body>
