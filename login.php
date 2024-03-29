  <?php
  include_once('userstorage.php');
  include_once('auth.php');
  include_once('utils.php');

  // functions
  function validate($post, &$data, &$errors) {
    // username, password not empty
    // ...
    $data = $post;

    return count($errors) === 0;
  }

  // main
  session_start();
  $user_storage = new UserStorage();
  $auth = new Auth($user_storage);
  $data = [];
  $errors = [];
  if (count($_POST) > 0) {
    if (validate($_POST, $data, $errors)) {
      $auth_user = $auth->authenticate($data['username'], $data['password']);
      if (!$auth_user) {
        $errors['global'] = "Login error";
      } else {
        $auth->login($auth_user);
        redirect('index.php');
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
    <h1>Login</h1>
    <?php if (isset($errors['global'])) : ?>
      <p><span class="error"><?= $errors['global'] ?></span></p>
    <?php endif; ?>
    <form action="" method="post" novalidate>
      <div class="us">
        <label for="username">Username: </label><br>
        <input type="text" name="username" id="username" value="<?= $_POST['username'] ?? "" ?>">
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
      <div>
        <button type="submit">Login</button>
      </div>
      <a href="register.php" >Register Page</a>

    </form>
    </div>
  </body>
  </html>