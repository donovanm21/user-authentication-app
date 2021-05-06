<?php
// Start Session
session_start();
// Include Functions
require_once('functions.php');

$members= getMembers();
$admins= getAdmins();

/*/ Check if user is an admin
if(isAdmin() == false) {
    redirect('index.php');
}

$cms_staff = getStaff();

$cms_users = getUsers();

$cms_users_admins = getAdmins();

$ws = get_workspaces();

// POST to SESSION vars
if(isset($_POST['client_filter'])) {
  if(isset($_POST['client_workspace'])) {
    $_SESSION['client_workspace'] = $_POST['client_workspace'];
  }
  if(isset($_POST['client_records'])) {
    $_SESSION['client_records'] = $_POST['client_records'];
  }
}

*/
// Include Header
require('header.php');
?>
<main class="">
    <div class="container-fluid">
        <div class="row">
          <main class="ms-sm-auto px-md-4">
            <div class="d-flex justify-content-start flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
              <h1 class="h2">Members Administration</h1>
              <a href="member_add.php"><button class="btn btn-outline-secondary ms-2" @click="addClient">Add</button></a>
              <div class="btn-toolbar mb-2 mb-md-0 ms-auto">
                <!--
                <div class="btn-group me-2">
                  <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                </div>
                -->
              </div>
            </div>
            <!-- Box Style Admin Members -->
            <h1 class="h3 p-2">Librarians</h1>
            <div class="d-inline-flex flex-wrap">
            <?php foreach($admins as $u) { ?>
            <div class="rounded rounded-3 border border-2 border-dark flex-grow-1 m-1 d-inline-flex bg-light">
                <div class="p-3 flex-grow-1">
                    <h3 class="text-start roboto"><?php echo $u['firstname']; ?> <?php echo $u['lastname']; ?></h3>
                    
                    <ul class="list-unstyled">
                        <li class="text-start">Username: <b><?php echo $u['username']; ?></b></li>
                        <li class="text-start">Email: <?php echo $u['email']; ?></li>
                        <li class="text-start">Last Login: <b><?php echo $u['timestamp']; ?></b></li>
                    </ul>
                </div>
                <div class="flex-shrink-1" style="width: 35px;">
                <?php if(isAdmin()) { ?>
                    <a href="delete_member.php?id=<?php echo $u['id']; ?>" class="" onclick="return confirm('Want to delete this user?');">
                        <img src="includes/img/remove.png" alt="delete_icon" class="p-2" width="35">
                    </a>
                    <a href="core_users_edit.php?id=<?php echo $u['id']; ?>" class="">
                        <img class="p-2" src="includes/img/edit.png" width="35">
                    </a>
                    <a href="member_amend.php?id=<?php echo $u['id']; ?>&demote=1" class="" onclick="return confirm('Want to demote user?');">
                      <img class="p-2" src="includes/img/down-arrow.png" width="35">
                    </a>
                <?php }; ?>
                </div>
                </div>
            <?php }; ?>
            </div>
            <!-- Box Style Basic Members -->
            <h1 class="h3 p-2">Members</h1>
            <div class="d-inline-flex flex-wrap">
            <?php foreach($members as $b) { ?>
            <div class="rounded rounded-3 border border-2 border-dark m-1 d-inline-flex bg-light">
                <div class="p-3">
                    <h3 class="text-start roboto"><?php echo $b['firstname']; ?> <?php echo $b['lastname']; ?></h3>
                    
                    <ul class="list-unstyled">
                        <li class="text-start">Username: <b><?php echo $b['username']; ?></b></li>
                        <li class="text-start">Email: <?php echo $b['email']; ?></li>
                        <li class="text-start">Last Login: <b><?php echo $b['timestamp']; ?></b></li>
                    </ul>
                </div>
                <div class="flex-shrink-1" style="width: 35px;">
                <?php if(isAdmin()) { ?>
                    <a href="delete_member.php?id=<?php echo $b['id']; ?>" class="" onclick="return confirm('Want to delete this user?');">
                        <img src="includes/img/remove.png" alt="delete_icon" class="p-2" width="35">
                    </a>
                    <a href="core_users_edit.php?id=<?php echo $b['id']; ?>" class="">
                        <img class="p-2" src="includes/img/edit.png" width="35">
                    </a>
                    <a href="member_amend.php?id=<?php echo $b['id']; ?>&promote=1" class="" onclick="return confirm('Want to promote user?');">
                      <img class="p-2" src="includes/img/up-arrow.png" width="35">
                    </a>
                <?php }; ?>
                </div>
                </div>
            <?php }; ?>
            </div>
          </main>
        </div>
      </div>
      
</main>
<?php require('footer.php'); ?>