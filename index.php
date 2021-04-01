<?php 
    include('functions.php');
    if (!isLoggedIn()) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }

    if($_GET['book_name'] == 1) {
        $all_books = sortBooks('books.book_name');
    } elseif ($_GET['author_name'] == 1) {
        $all_books = sortBooks('authors.author_name');
    } elseif ($_GET['year'] == 1) {
        $all_books = sortBooks('books.year');
    } elseif ($_GET['genre'] == 1) {
        $all_books = sortBooks('books.genre');
    } elseif ($_GET['age_group'] == 1) {
        $all_books = sortBooks('books.age_group');
    } else {
        $all_books = getBooks();
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
                    <form class="d-flex"  method="post" action="index.php">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="book_search_input">
                        <button class="btn btn-outline-success" type="submit" name="book_search">Search</button>
                    </form>
                    <a href="add_book.php"><button class="mx-2 btn btn-outline-primary" type="button" name="book_add">Add</button></a>
                </div>
            </div>
            <!-- Books Table -->
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th></th>
                            <th><a href="index.php?book_name=1">Book Name</a></th>
                            <th><a href="index.php?author_name=1">Author</a></th>
                            <th><a href="index.php?year=1">Year</a></th>
                            <th><a href="index.php?genre=1">Genre</a></th>
                            <th><a href="index.php?age_group=1">Age Group</a></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($all_books as $book) { ?>
                        <tr>
                            <td>
                            <?php if(isAdmin()) { ?>
                                <a href="delete_book.php?id=<?php echo $book['book_id']; ?>">D</a>
                            <?php }; ?>
                            </td>
                            <td><?php echo $book['book_name']; ?></td>
                            <td><?php echo $book['author_name']; ?></td>
                            <td><?php echo $book['year']; ?></td>
                            <td><?php echo $book['genre']; ?></td>
                            <td><?php echo $book['age_group']; ?></td>
                        </tr>
                    <?php }; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <script src="includes/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
