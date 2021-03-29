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
        <img class="mb-4" src="includes/img/logo.svg" alt="" width="120">
        <form method="post" action="register.php">
            <h1 class="h3 mb-3 fw-normal">Please Register</h1>
            <div>
                <label for="username" class="visually-hidden">Username</label>
                <input type="text" id="username" class="form-control topinput" placeholder="Username" name="username" value="<?php echo $username; ?>">
            </div>
            <div>
                <label for="email" class="visually-hidden">Email</label>
                <input type="email" id="email" class="form-control" placeholder="Email" name="email" value="<?php echo $email; ?>">
            </div>
            <div>
                <label for="password_1" class="visually-hidden">Password 1</label>
                <input type="password" id="password_1" class="form-control" placeholder="Password" name="password_1" >
            </div>
            <div>
                <label for="password_2" class="visually-hidden">Password 2</label>
                <input type="password" id="password_2" class="form-control bottominput" placeholder="Confirm Password" name="password_2" >
            </div>
            <?php echo display_error(); ?>
            <button class="w-100 btn btn-lg btn-primary mt-3" type="submit" name="register_btn">Register</button>
        </form>
		<p class="mt-4">
            Already a member? <a href="login.php">Sign in</a>
		</p>
        </main>
    </body>
</html>
