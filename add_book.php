<?php 
    include('functions.php');
    if (!isLoggedIn()) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }

    // Add Book
    echo $_POST['book_name'];
    echo $_POST['book_year'];
    echo $_POST['book_genre'];
    echo $_POST['age_group'];
    echo $_POST['author_name'];
    echo $_POST['author_age'];
    echo $_POST['author_genre'];
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
                    <?php if(isAdmin()) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="member.php">Members</a>
                    </li>
                    <?php }; ?>
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

    <main class="mx-2">
        <div class="bg-light p-2 rounded">
            <!-- Header Elements for Table -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Library Books</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                </div>
            </div>
            <!-- Add New Book Form -->
            <div class="m-2">
                <form action="add_book.php" method="post">
                    <div class="">
                        <label for="book_name" class="">Book Name / Title</label>
                        <input type="text" id="book_name" name="book_name" class="p-1 my-2 d-block">
                    </div>
                    <div class="">
                        <label for="book_year" class="">Book Year</label>
                        <input type="text" id="book_year" name="book_year" class="p-1 my-2 d-block">
                    </div>
                    <div class="">
                        <label for="book_genre" class="">Book Genre</label>
                        <input type="text" id="book_genre" name="book_genre" class="p-1 my-2 d-block">
                    </div>
                    <div class="">
                        <label for="age_group" class="">Age Group</label>
                        <input type="text" id="age_group" name="age_group" class="p-1 my-2 d-block">
                    </div>
                    <div class="">
                        <label for="author_name" class="">Author Name</label>
                        <input type="text" id="author_name" name="author_name" class="p-1 my-2 d-block">
                    </div>
                    <div class="">
                        <label for="author_age" class="">Author Age</label>
                        <input type="text" id="author_age" name="author_age" class="p-1 my-2 d-block">
                    </div>
                    <div class="">
                        <label for="author_genre" class="">Author Genre</label>
                        <input type="text" id="author_genre" name="author_genre" class="p-1 my-2 d-block">
                    </div>
                    <button class="btn btn-primary">Add Book</button>
                </form>
            </div>
        </div>
    </main>
    <script src="includes/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
