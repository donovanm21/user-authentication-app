<?php

include('functions.php');

if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}

if(isset($_GET['id'])) {
    $sql = 'DELETE FROM users WHERE id = "'.$_GET['id'].'"';
    query($sql);
    header("location: members.php");
}

?>