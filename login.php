<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POSTIFY Arbetsprov</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
		<?php 	
		if (isset($_POST['loginuser'])) {
			$validation = false;
			/* Form validation */
			if (isset($_POST['email'])) {
				$email = $_POST['email'];
				if (isset($_POST['password']) AND strlen($_POST['password']>1)) {
					$password = $_POST['password'];
					require_once('functions.php');
					if (checkLogin($email,$password)) {
						$validation = true;	
						echo "<h2>Inloggad</h2>";
						lastLogins($email);
					}
				}
				
			} 
			
			if (!$validation) {
				echo "Error! Kunde inte logga in. Försök igen.";
			}
		}
		
		if (!isset($validation) or !$validation) {
	?>
      <form class="form-signin" name="login" action="" method="post">
        <h2 class="form-signin-heading">Inloggning</h2>
        <input type="text" name="email" class="form-control" placeholder="Email" required autofocus>
        <input type="password" name="password"  class="form-control" placeholder="Lösenord" required>
        <button class="btn btn-lg btn-primary btn-block" name="loginuser" type="submit">Logga in</button>
      </form>
	   <div class="row">
			<div class="col-md-12">
				Inte redan en medlem? Registrera dig <a href="registration.php">här</a>
			</div>
		</div>
		<?php } ?>
    </div> <!-- /container -->
  </body>
</html>
