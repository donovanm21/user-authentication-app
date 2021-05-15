<?php
// Start Session
session_start();
// Include Functions
require_once('functions.php');

//$ws = get_workspaces();

// Error Array
$errors = array();

// Add New Member
if(isset($_POST['add_submit'])) {
    // Form validation
    if($_POST['firstname'] == '') {
        array_push($errors, 'Please enter a name.');
    }
    if($_POST['lastname'] == '') {
        array_push($errors, 'Please enter a surname.');
    }
    if($_POST['email'] == '') {
        array_push($errors, 'Please enter a valid email address.');
    }
    if($_POST['username'] == '') {
        array_push($errors, 'Please enter a valid username.');
    }
    if($_POST['password'] == '') {
        array_push($errors, 'Please enter a valid password.');
    }
    if($_POST['confirm_password'] != $_POST['password']) {
        array_push($errors, 'Please ensure passwords match.');
    }
    if($_POST['user_type'] == '') {
        array_push($errors, 'Please select a valid member type.');
    }
    // Add Member to Database
    if(count($errors) == 0) {
        addMember(
            e($_POST['firstname']),
            e($_POST['lastname']),
            e($_POST['email']),
            e($_POST['username']),
            e($_POST['user_type']),
            e($_POST['password'])
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
                <h1 class="h2">Members Administration</h1>
                <select id="member_select" class="btn btn-outline-secondary dropdown-toggle me-1" name="member_select" v-model="membertype" @change="onChange($event, membertype, 'membertype')">
                    <option value="client" class="">Member</option>
                </select>
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
                    <!-- Add Client Form -->
                    <div class="row g-3 mt-2">
                        <div class="col-md-12 col-lg-12" v-if="membertype == 'client'">
                            <h4 class="mb-3">Add New Member</h4>
                            <form class="needs-validation" action="member_add.php" method="post">
                            <div class="row g-3">
                                <!-- Firstname -->
                                <div class="col-sm-6">
                                    <label for="firstName" class="form-label">First name</label>
                                    <input type="text" class="form-control" id="firstName" placeholder="Example: Donovan" name="firstname" v-model="formVars.clientfirstname">
                                </div>
                                <!-- Lastname -->
                                <div class="col-sm-6">
                                    <label for="lastName" class="form-label">Last name</label>
                                    <input type="text" class="form-control" id="lastName" placeholder="Example: Muskett-Yetts" name="lastname" v-model="formVars.clientlastname">
                                </div>
                                <!-- Email -->
                                <div class="col-sm-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Example: donovan@cubeworkspace.co.za" name="email" v-model="formVars.clientemail">
                                </div>
                                <!-- Username -->
                                <div class="col-sm-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" placeholder="Example: donovan" name="username" v-model="formVars.username">
                                </div>
                                <!-- User Type -->
                                <div class="col-md-3">
                                    <label for="user_type" class="form-label">User Type</label>
                                    <select class="form-select" id="workspace" name="user_type" v-model="formVars.usertype">
                                        <option value="">Choose...</option>
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select>
                                </div>
                                <!-- Password -->
                                <div class="col-sm-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" v-model="formVars.clientextension">
                                </div>
                                <!-- Confirm Password -->
                                <div class="col-sm-3">
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" v-model="formVars.clientlandline">
                                </div>
                            </div>
                            <hr class="my-4">

                            <button class="w-100 btn btn-primary btn-lg" type="submit" name="add_submit" @click="memberFormSubmit">Add Member</button>
                            <a href="members.php"><button class="w-100 btn btn-secondary btn-lg my-2" type="button">Back</button></a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
          </main>
        </div>
      </div>
      
</main>
<?php require('footer.php'); ?>
