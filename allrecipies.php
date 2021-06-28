<?php
session_start();
?>
<?php

require_once "pdo.php";
$failure = false;
$success = false;

// if (!isset($_SESSION['name']))
// {
//     die("Not logged in");
// }
// elseif (isset($_POST['logout']) && $_POST['logout'] == 'Logout')
// {
//     header('Location: logout.php');
// }

$stmt = $pdo->query("SELECT recipi,ingrediants,steps,foodfile,tips FROM recipies");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="cards.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <?php require_once "bootstrap.php"; ?>
    <title>my reciepies</title>
</head>
<body>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<div class="container" >
    <h1>my recipies </h1>
    <?php
    if (isset($_SESSION['error']))
    {
        // Look closely at the use of single and double quotes
        echo('<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n");
        unset($_SESSION['error']);
    }
    ?>
    <h2>recipies</h2>
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
            echo '<div class="card_footer">';
            echo '<p><input class="btn btn-dark" type="submit" name="view_recipi" value="view_recipi"/></p>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        };
        ?>
        </div>
</div>
</body>
