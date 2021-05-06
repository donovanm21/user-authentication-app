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
	$firstname   =  e($_POST['firstname']);
	$lastname    =  e($_POST['lastname']);
	$username    =  e($_POST['username']);
	$email       =  e($_POST['email']);
	$password_1  =  e($_POST['password_1']);
	$password_2  =  e($_POST['password_2']);

	// form validation: ensure that the form is correctly filled
	if (empty($firstname)) { 
		array_push($errors, "Firstname is required"); 
	}
	if (empty($lastname)) { 
		array_push($errors, "Lastname is required"); 
	}
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
			$query = "INSERT INTO users (firstname, lastname, username, email, user_type, password) 
					  VALUES('$firstname', '$lastname', '$username', '$email', '$user_type', '$password')";
			mysqli_query($mysqli, $query);
			$_SESSION['success']  = "New user successfully created!!";
			header('location: index.php');
		}else{
			$query = "INSERT INTO users (firstname, lastname, username, email, user_type, password) 
					  VALUES('$firstname', '$lastname', '$username', '$email', 'user', '$password')";
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
	$query = "SELECT * FROM users WHERE user_type = 'user'";
	$result = query($query);

	return $result;
}

// return admin array
function getAdmins(){
	global $mysqli;
	$query = "SELECT * FROM users WHERE user_type = 'admin'";
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
		$sql = 'SELECT books.book_id, books.book_name, books.year, books.genre, books.age_group, authors.author_name
		FROM books
		INNER JOIN authors
		ON books.author_id = authors.author_id;';
		$books = query($sql);
		if($books){
			return $books;
		}
	}
}
// Add Book Function
function addBook($book_name, $book_year, $book_genre, $age_group, $author_name, $author_age, $author_genre) {
	$sql = '';

	query($sql);
	header("location: index.php");
}
// Sort books function
function sortBooks($input) {
	$sql = 'SELECT books.book_id, books.book_name, books.year, books.genre, books.age_group, authors.author_name
		FROM books
		INNER JOIN authors
		ON books.author_id = authors.author_id
		ORDER BY '.$input.';';
		$books = query($sql);
		if($books){
			return $books;
		}
}

// Activate and Update User
function updateUser($id, $firstname, $lastname, $email, $username, $password1, $access_level){
    if(isset($access_level)) {
        $password = md5($password1);
		$sql = 'UPDATE users SET firstname="'.$firstname.'", 
		lastname="'.$lastname.'", 
		email="'.$email.'", 
		username="'.$username.'", 
		password="'.$password.'", 
		user_type = "'.$access_level.'" 
		WHERE id = "'.$id.'"';
		query($sql);
		echo $sql;
        header("location: users.php");
    } else {
        $password = md5($password1);
        $sql = 'UPDATE users SET firstname="'.$firstname.'", 
		lastname="'.$lastname.'", 
		email="'.$email.'", 
		username="'.$username.'", 
		password="'.$password.'", 
		user_type = "user" 
		WHERE id = "'.$id.'"';
        query($sql);
        header("location: users.php");
    }
    
}

// Add new member
function addMember($firstname, $lastname, $email, $username, $user_type, $password1) {
	$password = md5($password1);
    $sql = 'INSERT INTO users (firstname, lastname, email, username, user_type, password)
    VALUES ("'.$firstname.'", 
    "'.$lastname.'", 
    "'.$email.'", 
    "'.$username.'", 
    "'.$user_type.'", 
    "'.$password.'")';

    query($sql);
	header("location: users.php");
}

// Get all existing authors
function getAuthors() {
	$sql = "SELECT * FROM authors";
	$results = query($sql);
	return $results;
}

// Add book with author
function addBookAuthor($book_name, $book_year, $book_genre, $age_group, $author_id) {
	$sql = "INSERT INTO books (book_name, year, genre, age_group, author_id) VALUES ('".$book_name."', '".$book_year."', '".$book_genre."', '".$age_group."', ".$author_id.")";
	query($sql);
	header("location: index.php");
}