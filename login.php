<?php include('functions.php') ?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <title>Public Library</title>
        <!-- Bootstrap core CSS -->
        <link href="includes/css/bootstrap.min.css" rel="stylesheet">

        
        <!-- Custom styles for this template -->
        <link href="includes/css/signin.css" rel="stylesheet">
    </head>
    <body class="text-center">
        <main class="form-signin">
        <form method="post" action="login.php">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
            <label for="username" class="visually-hidden">Email address</label>
            <input type="text" id="username" class="form-control topinput" placeholder="Username" name="username">
            <label for="inputPassword" class="visually-hidden">Password</label>
            <input type="password" id="inputPassword" class="form-control bottominput" placeholder="Password" name="password">
            <?php echo display_error(); ?>
            <button class="w-100 btn btn-lg btn-primary mt-3" type="submit" name="login_btn">Sign in</button>
        </form>
		<p class="mt-4">
			Not yet a member? <a href="register.php">Sign up</a>
		</p>
        </main>
    </body>
</html>
