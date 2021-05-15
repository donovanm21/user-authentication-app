<?php

session_start();

include('functions.php');

if(isset($_GET['id'])) {
    if(isset($_GET['promote'])) {
        $sql = 'UPDATE users SET user_type = "admin" WHERE id = "'.$_GET['id'].'"';
        query($sql);
        header("location: users.php");
    }
    if(isset($_GET['demote'])) {
        $sql = 'UPDATE users SET user_type = "user" WHERE id = "'.$_GET['id'].'"';
        query($sql);
        header("location: users.php");
    }
}

?>