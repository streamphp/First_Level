<?php
  include("includes/handler/config.php");
  include("includes/classes/Account.php");
    $account=new Account($con);
  include("includes/classes/Constants.php");
  include("includes/handler/register_handler.php");
  include("includes/handler/login_handler.php");

  //Remember values from input
   function getInputValue($input){
      if (isset($_POST['$input'])) {
        echo $_POST['$input'];
      }
   }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet"
          href="http://fonts.googleapis.com/css?family=Roboto">
    <style>
      body {
        font-family: 'Roboto', serif;
        font-size: 20px;
      }
    </style>
  </head>
  <body>
    <div id="inputContainer">
       <form id="loginForm" action="register.php" method="POST">
        <h4>Login to you account</h4>
        <div class="form-group">
          <?php echo $account->getError(Constants::$loginFailed); ?>
          <i class="fa fa-user" aria-hidden="true"></i>
          <label for="loginUsername">Username</label>
          <input type="text" class="form-control" id="loginUsername"  name="loginUsername" required>
          </div>
        <div class="form-group">
          <i class="fa fa-unlock-alt" aria-hidden="true"></i>
          <label for="loginPassword">Password</label>
          <input type="password" class="form-control " id="loginPassword" name="loginPassword"  required>
        </div>
        <button type="submit" name="loginButton" class="btn btn-outline-success btn-lg">Sign In</button>
     </form>


     <br><br><br><br>


     <form id="registerForm" action="register.php" method="POST">
      <h4>Create free account with Slotify</h4>
        <div class="form-group">
            <?php echo $account->getError(Constants::$usernameLength); ?>
            <?php echo $account->getError(Constants::$usernameExisting); ?>
            <label for="username">Username</label>
            <input type="text" class="form-control " id="username"  name="username" value="<?php getInputValue('username') ?>"  required ><br>


            <?php echo $account->getError(Constants::$firstNameLength); ?>
            <label for="firstName">First name</label>
            <input type="text" class="form-control " id="firstName"  name="firstName" value="<?php getInputValue('firstName') ?>" required><br>


            <?php echo $account->getError(Constants::$lastNameLength); ?>
            <label for="lastName">Last name</label>
            <input type="text" class="form-control " id="lastName"  name="lastName" value="<?php getInputValue('lastName') ?>"  required><br>



            <?php echo $account->getError(Constants::$emails_DontMatch); ?>
            <?php echo $account->getError(Constants::$email_InvalidFormat); ?>
            <?php echo $account->getError(Constants::$emailExisting); ?>
            <label for="email">Email</label>
            <input type="email" class="form-control " id="email"  name="email" value="<?php getInputValue('email') ?>" required><br>


            
            <label for="email2">Confirm email</label>
            <input type="email" class="form-control " id="email2"  name="email2" value="<?php getInputValue('email2') ?>" required><br>
        </div>
         <div class="form-group">
          <?php echo $account->getError(Constants::$passwords_DontMatch); ?>
          <?php echo $account->getError(Constants::$passwordsCharacters); ?>
          <?php echo $account->getError(Constants::$passwords_LengthChar); ?>
          <label for="password">Password</label>
          <input type="password" class="form-control " id="password" name="password"  required><br>

          <label for="password2">Confirm password</label>
          <input type="password" class="form-control " id="password2" name="password2"  required><br>
        </div>
        <button type="submit" name="registerButton" class="btn btn-outline-success btn-lg">Register</button>
     </form>
    </div>
    <br>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>