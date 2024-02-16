<?php
include_once('userstorage.php');
include_once('auth.php');
include_once('utils.php');

// functions
function validate($post, &$data, &$errors) {
  $data = $post;
  if (!isset($data['username']) || empty($data['username'])) {
    $errors['username'] = "Username is required";
  }

  if (!isset($data['password']) || empty($data['password'])) {
    $errors['password'] = "Password is required";
  }

  if (!isset($data['email']) || empty($data['email'])) {
    $errors['email'] = "Email is required";
  } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Invalid email format";
  }

  return count($errors) === 0;
}

// main
$user_storage = new UserStorage();
$auth = new Auth($user_storage);
$errors = [];
$data = [];
if (count($_POST) > 0) {
  if (validate($_POST, $data, $errors)) {
    if ($auth->user_exists($data['username'])) {
      $errors['global'] = "User already exists";
    } else {
      $auth->register($data);
      redirect('login.php');
    } 
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="register.css">
</head>
<body>
    <div class="register_box">
    <h1>Register</h1>
  <?php if (isset($errors['global'])) : ?>
    <p><span class="error"><?= $errors['global'] ?></span></p>
  <?php endif; ?>
  <form action="" method="post" novalidate>
    <div class="us">
      <label for="username">Username: </label><br>
      <input type="text" name="username" id="username" value="<?= $_POST['username'] ?? "" ?>">
      <span></span>
      <?php if (isset($errors['username'])) : ?>
        <span class="error"><?= $errors['username'] ?></span>
      <?php endif; ?>
    </div>
    <div class="pas">
      <label for="password">Password: </label><br>
      <input type="password" name="password" id="password">
      <?php if (isset($errors['password'])) : ?>
        <span class="error"><?= $errors['password'] ?></span>
      <?php endif; ?>
    </div>
    <div class="ful">
      <label for="email">Email: </label><br>
      <input type="mail" name="email" id="email" value="<?= $_POST['email'] ?? "" ?>">
      <?php if (isset($errors['email'])) : ?>
        <span class="error"><?= $errors['email'] ?></span>
      <?php endif; ?>
    </div>
    <div>
      <button type="submit">Register</button>
    </div>
    <a href="login.php">Login Page</a>
  </form>
    </div>
  
  <script src="register.js"></script>
</body>
</html>