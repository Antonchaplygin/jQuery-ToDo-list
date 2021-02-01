<?php
session_start();

ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);


require_once "config/config.php";

$status = 0;

if(isset($_POST['login']) && isset($_POST['pass'])){

  $user = $mysqli->query("SELECT * FROM user WHERE login = '".$_POST['login']."';")->fetch_assoc();
  if($user == false){
    $status = 1;
  }else{
    if($_POST['pass'] == $user['passw']){
      $_SESSION['user'] = $user;
      header("Location: view_admin.php");
    }else{
      $status = 2;
    }
  }
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mapservice</title>

    <link href="http://localhost:8888/jQuery-ToDo-list/public/css/bootstrap.css" rel="stylesheet">
    <link href="http://localhost:8888/jQuery-ToDo-list/public/css/sign.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script src="bootstrap/bootstrap.min.js"></script>
  </head>
      <?php
      switch($status){
        case 1:
          ?><div class="alert alert-danger" role="alert">
              <span class="glyphicon glyphicon-warning-sign"></span> <strong>Error:</strong> Login/password are incorrect
            </div>
          <?php
          break;
        case 2:
          ?><div class="alert alert-warning" role="alert">
              <span class="glyphicon glyphicon-warning-sign"></span> <strong>Error:</strong> Login/password are incorrect
            </div>
          <?php
          break;
      }
    ?>
  <body>
    <div class="container">
          <form class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="inputLogin" class="sr-only">Login</label>
        <input type="text" id="inputLogin" name="login" class="form-control" placeholder="Login" required="" autofocus="">

        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Password" required="">

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
    </div>
  </body>
</html>
