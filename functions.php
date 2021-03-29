<?php 
session_start();
require('config.php');

// variable declaration
$username = "";
$email    = "";
$errors   = array(); 

// call the register() function if register_btn is clicked
if (isset($_POST['register_btn'])) {
	register();
}

// REGISTER USER
function register(){
	// call these variables with the global keyword to make them available in function
	global $mysqli, $errors, $username, $email;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$username    =  e($_POST['username']);
	$email       =  e($_POST['email']);
	$password_1  =  e($_POST['password_1']);
	$password_2  =  e($_POST['password_2']);

	// form validation: ensure that the form is correctly filled
	if (empty($username)) { 
		array_push($errors, "Username is required"); 
	}
	if (empty($email)) { 
		array_push($errors, "Email is required"); 
	}
	if (empty($password_1)) { 
		array_push($errors, "Password is required"); 
	}
	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = md5($password_1);//encrypt the password before saving in the database

		if (isset($_POST['user_type'])) {
			$user_type = e($_POST['user_type']);
			$query = "INSERT INTO users (username, email, user_type, password) 
					  VALUES('$username', '$email', '$user_type', '$password')";
			mysqli_query($mysqli, $query);
			$_SESSION['success']  = "New user successfully created!!";
			header('location: index.php');
		}else{
			$query = "INSERT INTO users (username, email, user_type, password) 
					  VALUES('$username', '$email', 'user', '$password')";
			mysqli_query($mysqli, $query);

			// get id of the created user
			$logged_in_user_id = mysqli_insert_id($mysqli);

			$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
			$_SESSION['success']  = "You are now logged in";
			header('location: index.php');				
		}
	}
}

// return user array from their id
function getUserById($id){
	global $mysqli;
	$query = "SELECT * FROM users WHERE id=" . $id;
	$result = mysqli_query($mysqli, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}

// return user array
function getMembers(){
	global $mysqli;
	$query = "SELECT * FROM users";
	$result = query($query);

	return $result;
}

// escape string
function e($val){
	global $mysqli;
	return mysqli_real_escape_string($mysqli, trim($val));
}

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<p class="text-danger mt-2"><b>Please correct the following error(s):</b></p>';
		echo '<ul>';
			foreach ($errors as $error){
				echo '<li class="text-danger text-start">'.$error.'</li>';
			}
		echo '</ul>';
	}
}
function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}
// log user out if logout button clicked
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.php");
}
// call the login() function if register_btn is clicked
if (isset($_POST['login_btn'])) {
	login();
}

// LOGIN USER
function login(){
	global $mysqli, $username, $errors;

	// grap form values
	$username = e($_POST['username']);
	$password = e($_POST['password']);

	// make sure form is filled properly
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
		$results = mysqli_query($mysqli, $query);

		if (mysqli_num_rows($results) == 1) { // user found
			// check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);
			if ($logged_in_user['user_type'] == 'admin') {

				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";
				header('location: index.php');		  
			}else{
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";

				header('location: index.php');
			}
		}else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}
function isAdmin() {
	if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
		return true;
	}else{
		return false;
	}
}

function query($sql) {
	global $mysqli;
	$results = mysqli_query($mysqli, $sql);
	$rows = array();
	if(!is_bool($results)){
		while($row = mysqli_fetch_assoc($results)){
			$rows[] = $row;
		}
	}
	return $rows;
}

$book_search_input = '';

if (isset($_POST['book_search'])) {
	$book_search_input = e($_POST['book_search_input']);
}

function getBooks() {
	global $book_search_input;
	if ($book_search_input != '') {
		if($_SESSION['user']['user_type'] == 'admin'){
			$sql = 'SELECT books.book_name, books.year, books.genre, books.age_group, authors.author_name
			FROM books 
			INNER JOIN authors
			ON books.author_id = authors.author_id 
			WHERE books.book_name LIKE "%'.$book_search_input.'%"
			OR books.year LIKE "%'.$book_search_input.'%"
			OR books.genre LIKE "%'.$book_search_input.'%"
			OR books.age_group LIKE "%'.$book_search_input.'%"
			OR authors.author_name LIKE "%'.$book_search_input.'%";';
			$books = query($sql);
			if($books){
				return $books;
			}
		} else {
			$sql = 'SELECT books.book_name, books.year, books.genre, books.age_group, authors.author_name
			FROM books 
			INNER JOIN authors
			ON books.author_id = authors.author_id 
			WHERE books.book_name LIKE "%'.$book_search_input.'%"
			OR books.year LIKE "%'.$book_search_input.'%"
			OR books.genre LIKE "%'.$book_search_input.'%"
			OR books.age_group LIKE "%'.$book_search_input.'%";';
			$books = query($sql);
			if($books){
				return $books;
			}
		}
	} else {
		$sql = 'SELECT books.book_name, books.year, books.genre, books.age_group, authors.author_name
		FROM books
		INNER JOIN authors
		ON books.author_id = authors.author_id;';
		$books = query($sql);
		if($books){
			return $books;
		}
	}
}

