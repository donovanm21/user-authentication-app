<?php
// Start Session
session_start();
// Include Functions
require_once('functions.php');

// Check if user is an admin
if(isAdmin() == false) {
    redirect('index.php');
}

if(!isset($_GET['id'])) {
    $user_id = $_POST['user_id'];
} else {
    $user_id = $_GET['id'];
}

$user_info = query('SELECT *
FROM users
WHERE id = "'.$user_id.'"');

foreach($user_info as $ci) {
    $username = $ci['username'];
    $email = $ci['email'];
}

// Error Array
$errors = array();

if(isset($_POST['user_update'])) {
    // Form validation
    if (empty($_POST['firstname'])) { 
		array_push($errors, "First name is required"); 
	}
    if (empty($_POST['lastname'])) { 
		array_push($errors, "Last name is required"); 
	}
    if (empty($_POST['email'])) { 
		array_push($errors, "Email is required"); 
	}
    if (empty($_POST['username'])) { 
		array_push($errors, "Username is required"); 
	}
    if (empty($_POST['password1'])) { 
		array_push($errors, "Password is required"); 
	}
	if ($_POST['password1'] != $_POST['password2']) {
		array_push($errors, "The two passwords do not match");
	}
	if (empty($_POST['access_level'])) {
		array_push($errors, "Need to select an access level");
	}
    if($errors == array()) {
        //include('mail.php');
        updateUser(
            e($_POST['user_id']),
            e($_POST['firstname']),
            e($_POST['lastname']),
            e($_POST['email']),
            e($_POST['username']),
            e($_POST['password1']),
            e($_POST['access_level'])
        );
    }
}

// Include Header
require('header.php');

?>
<main class="">
    <div class="container-fluid">
        <div class="row">
          <main class="ms-sm-auto px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom ">
              <h1 class="h2">Update CMS User</h1>
              <!--
              <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                  <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                </div>
                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                  <span data-feather="calendar"></span>
                  This week
                </button>
              </div>
              -->
            </div>
            <!-- Client Edit Form -->
            <div class="">
                <?php if(count($errors) != 0) { ?>
                <p>
                    <b class="text-danger">Please correct the following error(s):</b>
                    <ul>
                        <?php foreach($errors as $error) { echo '<li class="text-danger">'.$error.'</li>'; }; ?>
                    </ul>
                </p>
                <?php }; ?>
                <div class="">
                <div class="row g-3">
                <div class="col-md-12 col-lg-12">
                    <h4 class="mb-3"></h4>
                    <form class="needs-validation" action="core_users_edit.php" method="post">
                    <?php foreach($user_info as $ci) { ?>
                    <div class="row g-3">
                        
                        <!-- Client ID -->
                        <input type="hidden" value="<?php echo $user_id; ?>" name="user_id">
                        <!-- Firstname -->
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">First name</label>
                            <input type="text" class="form-control" id="firstName" placeholder="Example: Donovan" value="<?php echo $ci['firstname']; ?>" name="firstname">
                        </div>
                        <!-- Lastname -->
                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Last name</label>
                            <input type="text" class="form-control" id="lastName" placeholder="Example: Muskett-Yetts" value="<?php echo $ci['lastname']; ?>" name="lastname">
                        </div>
                        <!-- Email -->
                        <div class="col-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" value="<?php echo $ci['email']; ?>" name="email">
                        </div>
                        <!-- Username -->
                        <div class="col-sm-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" placeholder="Example: Muskett-Yetts" value="<?php echo $ci['username']; ?>" name="username">
                        </div>
                        <!-- Access Level -->
                        <div class="col-md-3">
                            <label for="access-level" class="form-label">Access Level</label>
                            <select class="form-select" id="access-level" name="access_level" value="<?php echo $ci['user_type']; ?>">
                                <option value="">Choose...</option>
                                <option value="admin" class="">Admin</option>
                                <option value="user" class="">Member</option>
                            </select>
                        </div>
                        <!-- Password -->
                        <div class="col-sm-3">
                            <label for="password1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password1" name="password1">
                        </div>
                        <!-- Confirm Password -->
                        <div class="col-sm-3">
                            <label for="password2" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password2" name="password2">
                        </div>
                    </div>
                    <?php } ?>
                    <hr class="my-4">

                    <button class="w-100 btn btn-primary btn-lg" type="submit" name="user_update">Update Member</button>
                    <a href="users.php"><button class="w-100 btn btn-secondary btn-lg my-2" type="button">Back</button></a>
                    </form>
                </div>
                </div>
            </div>
          </main>
        </div>
      </div>
      
</main>
<?php require('footer.php'); ?>