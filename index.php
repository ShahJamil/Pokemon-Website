<?php
session_start();
include_once("pokemonstorage.php");

$ps = new PokemonStorage();

$pokemons = $ps->findAll();

function checkUser(){
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
    
        if (in_array('admin', $user['roles'])) {
            echo '<a class = "create_card" href="create.php">New Card</a>';
        }

        echo "<div class = \"user_details\">";
        echo "<div class = \"user_info\">";
        echo "<span>User: {$user['username']}</span>";
        echo "<span>Money: {$user['money']} coins</span>";
        echo "</div>";
        echo '<a class = "logout" href="logout.php">Log out</a>';
        echo "</div>";
    
    }
    else{
        echo '<a class = "login" href="login.php">LOGIN</a>';
    }

}


function displayDatas($pokemons)
{
    

    foreach ($pokemons as $pokemon) {
        $backgroundColor = $pokemon['type'];

        switch ($backgroundColor) {
            case 'electric':
                $backgroundColor = "yellow";
                break;
            case 'fire':
                $backgroundColor = "red";
                break;
            case 'grass':
                $backgroundColor = "green";
                break;
            case 'water':
                $backgroundColor = "blue";
                break;
            case 'bug':
                $backgroundColor = "brown";
                break;
            case 'normal':
                $backgroundColor = "gray";
                break;
            case 'poison':
                $backgroundColor = "purple";
                break;
            default:
                $backgroundColor = "white";
                break;
        }
        echo "<div class=\"grid_item\"> ";
        echo "<div class=\"grid_image_container\"> ";
        echo "<img style=\"background-color: $backgroundColor;\" class = \"logo\" src=\"{$pokemon['image']}\" alt=\"{$pokemon['name']}\"> ";
        echo "</div> ";
        echo "<div class=\"grid_data_container\">";
        echo "<a href=\"details.php?name={$pokemon['name']}\" class=\"name\">{$pokemon['name']}</a>";
        echo "<div class=\"type\"> ";
        echo "<span class=\"type\">{$pokemon['type']}</span> ";
        echo "</div> ";
        echo "<div class=\"grid_stats\"> ";
        echo "<div class=\"grid_health\"> ";
        echo "<p>❤️</p>";
        echo "<span class=\"health_number\">{$pokemon['hp']}</span> ";
        echo "</div> ";
        echo "<div class=\"grid_strength\"> ";
        echo "<p>⚔️</p>";
        echo "<span class=\"strength_number\">{$pokemon['attack']}</span> ";
        echo "</div> ";
        echo "<div class=\"grid_armor\"> ";
        echo "<p>🛡️</p>";
        echo "<span class=\"armor_number\">{$pokemon['defense']}</span> ";
        echo "</div> ";
        echo "</div> ";
        echo "<div class=\"grid_cost_container\"> ";
        echo "<div class=\"grid_cost\"> ";
        echo "<p>💲</p>";
        echo "<span class=\"price\">{$pokemon['price']}</span> ";
        echo "</div> ";
        echo "</div> ";
        echo "</div> ";
        echo "</div> ";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style3.css">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@500&family=Playpen+Sans:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">

</head>

<body>
    <header>
        <nav>
        <?php checkUser() ?>
        </nav>
        <div class="grid_box">
        <div class="grid_container">
            <?php displayDatas($pokemons) ?>
        </div>
        </div>
        
    </header>

</body>

</html>