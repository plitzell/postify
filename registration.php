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
		if (isset($_POST['saveuser'])) {
			/* Form validation */
			$validation = false;
			if (isset($_POST['email']) ) {
				if (isset($_POST['password1']) AND (strlen($_POST['password1']>1)) ) {
					if (isset($_POST['password2']) AND (strlen($_POST['password2']>1)) ) {
						if ($_POST['password1'] == $_POST['password2']) {
							$validation = true;
							require_once('functions.php');
							if (registerUser($_POST['email'],$_POST['password1'])) {
								echo "<h2>Registrad! Gå vidare till <a href='login.php'>login</h2>";
							} else {
								echo "<h2>Kunde ej registera. Försök igen!</h2>";
							}
						}
					}
					
				}
				
			} 
			
			if (!$validation) {
				echo "Error! Kunde inte spara. Försök igen.";
			}
		}
		
	?>
      <form class="form-signin" name="registration" action="" method="post">
        <h2 class="form-signin-heading">Ny medlem</h2>
        <input type="text" name="email" class="form-control" placeholder="Email" required autofocus>
        <input type="password" name="password1" class="form-control" placeholder="Lösenord" required>
         <input type="password" name="password2" class="form-control" placeholder="Lösenord igen" required>
        <button class="btn btn-lg btn-primary btn-block" name="saveuser" type="submit">Spara</button>
      </form>

    </div> <!-- /container -->

  </body>
</html>
