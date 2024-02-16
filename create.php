<?php
include_once("pokemonstorage.php");
include_once("userstorage.php");
include_once("auth.php");
include_once("utils.php");

// page protection
// $auth = new Auth(new UserStorage());
// if (!$auth->is_authenticated()) {
//   redirect("login.php");
// }


function validate($input, &$data, &$errors) {
  // $data = $input;
  if (!isset($input["name"]) || $input["name"] == "") {
    $errors["name"] = "Name is required";
  }
  else if (trim($input["name"]) === "") {
    $errors["name"] = "Name cannot be empty";
  }
  else {
    $data["name"] = trim($input["name"]);
  }

  if (!isset($input["type"])) {
    $errors["type"] = "type is required";
  }
  else {
    $data["type"] = $input["type"];
  }

  if (!isset($input["hp"]) || $input["hp"] == "") {
    $errors["hp"] = "hp is required";
  }
  else if (!filter_var($input["hp"], FILTER_VALIDATE_INT)) {
    $errors["hp"] = "hp must be number";
  }
  else if ((int)$input["hp"] < 0) {
    $errors["hp"] = "hp must be positive";
  }
  else {
    $data["hp"] = $input["hp"];
  }

  if (!isset($input["attack"]) || $input["attack"] == "") {
    $errors["attack"] = "attack is required";
  }
  else if (!filter_var($input["attack"], FILTER_VALIDATE_INT)) {
    $errors["attack"] = "attack must be number";
  }
  else if ((int)$input["attack"] < 0) {
    $errors["attack"] = "attack must be positive";
  }
  else {
    $data["attack"] = $input["attack"];
  }

  if (!isset($input["defense"]) || $input["defense"] == "") {
    $errors["defense"] = "defense is required";
  }
  else if (!filter_var($input["defense"], FILTER_VALIDATE_INT)) {
    $errors["defense"] = "defense must be number";
  }
  else if ((int)$input["defense"] < 0) {
    $errors["defense"] = "defense must be positive";
  }
  else {
    $data["defense"] = $input["defense"];
  }

  if (!isset($input["price"]) || $input["price"] == "") {
    $errors["price"] = "price is required";
  }
  else if (!filter_var($input["price"], FILTER_VALIDATE_INT)) {
    $errors["price"] = "price must be number";
  }
  else if ((int)$input["price"] < 0) {
    $errors["price"] = "price must be positive";
  }
  else {
    $data["price"] = $input["price"];
  }

  if (!isset($input["description"]) || $input["description"] == "") {
    $errors["description"] = "description is required";
  }
  else {
    $data["description"] = $input["description"];
  }

  if (!isset($input["image"]) || $input["image"] == "") {
    $errors["image"] = "image is required";
  }
  else {
    $data["image"] = $input["image"];
  }
  return count($errors) === 0;
}

$data = [];
$errors = [];
if (count($_POST) > 0) {
  if (validate($_POST, $data, $errors)) {

    $ps = new PokemonStorage();
    $ps->add($data);
    header("Location: index.php");
    exit();
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="add.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@500&family=Playpen+Sans:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <div class="form_container">
            <form method="post" novalidate>
                Name: <br>
                <input type="text" name="name" required value="<?= $_POST["name"] ?? "" ?>"> <br>
                <?php if (isset($errors["name"])) : ?>
                    <span><?= $errors["name"] ?></span>
                    <br>
                <?php endif ?>
                type: <br>
                <input type="text" name="type" value="<?= $_POST["type"] ?? "" ?>"> <br>
                <?php if (isset($errors["type"])) : ?>
                    <span><?= $errors["type"] ?></span>
                    <br>
                <?php endif ?>
                hp: <br>
                <input type="text" name="hp" value="<?= $_POST["hp"] ?? "" ?>"> <br>
                <?php if (isset($errors["hp"])) : ?>
                    <span><?= $errors["hp"] ?></span>
                    <br>
                <?php endif ?>
                attack: <br>
                <input type="text" name="attack" value="<?= $_POST["attack"] ?? "" ?>"> <br>
                <?php if (isset($errors["attack"])) : ?>
                    <span><?= $errors["attack"] ?></span>
                    <br>
                <?php endif ?>
                defense: <br>
                <input type="text" name="defense" value="<?= $_POST["defense"] ?? "" ?>"> <br>
                <?php if (isset($errors["defense"])) : ?>
                    <span><?= $errors["defense"] ?></span>
                    <br>
                <?php endif ?>
                price: <br>
                <input type="text" name="price" value="<?= $_POST["price"] ?? "" ?>"> <br>
                <?php if (isset($errors["price"])) : ?>
                    <span><?= $errors["price"] ?></span>
                    <br>
                <?php endif ?>
                description: <br>
                <input type="text" name="description" value="<?= $_POST["description"] ?? "" ?>"> <br>
                <?php if (isset($errors["description"])) : ?>
                    <span><?= $errors["description"] ?></span>
                    <br>
                <?php endif ?>
                image: <br>
                <input type="text" name="image" value="<?= $_POST["image"] ?? "" ?>"> <br>
                <?php if (isset($errors["image"])) : ?>
                    <span><?= $errors["image"] ?></span>
                    <br>
                <?php endif ?>
                <button>Add pokemon</button>
            </form>
            <a href="index.php">Cancel</a>

        </div>
    </header>
</body>

</html>