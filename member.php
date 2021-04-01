<?php include('functions.php');

$accs = getMembers();

if(!isAdmin()) { 
    header('location: index.php');
}

?>
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
        <link href="includes/css/navbar-top-fixed.css" rel="stylesheet">
        <link href="includes/css/styles.css" rel="stylesheet">
    </head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="includes/img/logo.svg" height="35"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="member.php">Members</a>
                    </li>
                    <li class="nav-item text-nowrap">
                        <a class="nav-link" href="index.php?logout='1'">Sign out</a>
                    </li>
                </ul>
                <div class="d-flex text-light">
                    <?php  if (isset($_SESSION['user'])) { ?>
                        <strong><?php echo 'Hi, ' . $_SESSION['user']['username']; ?></strong>
                    <?php }; ?>
                </div>
            </div>
        </div>
    </nav>
<div class="container">
    <div class="text-center">
        <h2 class="center">Add New User Account</h2>
        <p class="center">Please fill out this form to create an account.</p>
    </div>
    <div class="flex-windows p-3 border rounded">
            <div class="user-form-container border-dark p-3">
                <div class="user-form-div">
                    <?php echo display_error(); ?>
                    <form class="member-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-item">
                            <label>Username</label>
                            <input type="text" name="username" class="w-100 mt-2 p-1" value="<?php echo $username; ?>">
                        </div>
                        <div class="form-item">
                            <label class="mt-2">Email</label>
                            <input type="text" name="email" class="w-100 mt-2 p-1" value="<?php echo $email; ?>">
                        </div>
                        <div class="input-group form-item">
                            <label class="mt-2">User type</label>
                            <select class="w-100 rounded" name="user_type" id="user_type" >
                                <option value=""></option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <div class="form-item">
                            <label class="mt-2">Password</label>
                            <input type="password" name="password_1" class="w-100 mt-2 p-1" value="<?php echo $password_1; ?>">
                        </div>
                        <div class="form-item">
                            <label class="mt-2">Confirm Password</label>
                            <input type="password" name="password_2" class="w-100 mt-2 p-1" value="<?php echo $password_2; ?>">
                        </div>
                        <div class="form-item">
                            <input type="submit" class="w-100 mt-3 btn btn-primary" name="register_btn" value="Submit">
                            <input type="reset" class="w-100 mt-2 btn btn-secondary" value="Reset">
                        </div>
                    </form>
                </div>
            </div>
            <div class="current-user-container">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Type</th>
                            <th scope="col">Last Login</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($accs as $acc) { ?>
                        <tr>
                            <td><?php echo $acc['username']; ?></td>
                            <th scope="row"><?php echo $acc['email']; ?></th>
                            <td><?php echo $acc['user_type']; ?></td>
                            <td><?php echo $acc['timestamp']; ?></td>
                            <td><a href="delete_member.php?id=<?php echo $acc['id']; ?>" onclick="return confirm('Are you sure?')">D</a></td>
                        </tr>
                    <?php }; ?>
                    </tbody>
                </table>
            </div>
        <div class="clear_both"></div>
    </div>
</div>
</body>
</html>