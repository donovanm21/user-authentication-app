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

// Include Header
require('header.php');
?>
    <main class="mx-2 merriweather">
        <div class="p-2 rounded">
            <!-- Header Elements for Table -->
            <div class="d-flex justify-content-sm-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2 mb-2 roboto">Library Books</h1>
                <div class="d-inline-flex mb-2 me-auto">
                <?php if(isAdmin()) { ?>
                    <a href="add_book.php"><button class="btn btn-outline-secondary ms-2 roboto" type="button" name="book_add" @click="clearFormVars">Add</button></a>
                <?php }; ?>
                </div>
                <div class="btn-toolbar mb-2 mb-md-0 flex-grow-1 mb-2">
                    <form class="d-flex ms-sm-auto "  method="post" action="index.php">
                        <input class="form-control" type="search" placeholder="Search" aria-label="Search" name="book_search_input">
                        <button class="btn btn-outline-success roboto" type="submit" name="book_search">Search</button>
                    </form>
                </div>
            </div>
            <!-- Books Table -->
            <div class="d-inline-flex flex-wrap">
                <div class="d-inline p-2">
                    <a class="text-decoration-none text-uppercase text-dark fw-bold roboto" href="index.php?book_name=1">Book Name</a>
                    <img src="includes/img/down-arrow.png" alt="down-arrow" class="" width="15">
                </div>
                <div class="d-inline p-2">
                    <a class="text-decoration-none text-uppercase text-dark fw-bold roboto" href="index.php?author_name=1">Author</a>
                    <img src="includes/img/down-arrow.png" alt="down-arrow" class="" width="15">
                </div>
                <div class="d-inline p-2">
                    <a class="text-decoration-none text-uppercase text-dark fw-bold roboto" href="index.php?year=1">Year</a>
                    <img src="includes/img/down-arrow.png" alt="down-arrow" class="" width="15">
                </div>
                <div class="d-inline p-2">
                    <a class="text-decoration-none text-uppercase text-dark fw-bold roboto" href="index.php?genre=1">Genre</a>
                    <img src="includes/img/down-arrow.png" alt="down-arrow" class="" width="15">
                </div>
                <div class="d-inline p-2">
                    <a class="text-decoration-none text-uppercase text-dark fw-bold roboto" href="index.php?age_group=1">Age Group</a>
                    <img src="includes/img/down-arrow.png" alt="down-arrow" class="" width="15">
                </div>
            </div>
            <!-- Showmax Style -->
            <div class="d-inline-flex flex-wrap">
            <?php foreach($all_books as $book) { ?>
            <div class="rounded rounded-3 border border-2 border-dark flex-grow-1 m-1 d-inline-flex bg-light">
                <div class="p-3 flex-grow-1">
                    <h3 class="text-end roboto"><?php echo $book['book_name']; ?></h3>
                    <p class="text-end"><?php echo $book['author_name']; ?></p>
                    <ul class="list-unstyled">
                        <li class="text-end"><?php echo $book['year']; ?></li>
                        <li class="text-end"><?php echo $book['genre']; ?></li>
                        <li class="text-end"><?php echo $book['age_group']; ?></li>
                    </ul>
                </div>
                <div class="flex-shrink-1" style="width: 35px;">
                <?php if(isAdmin()) { ?>
                    <a href="delete_book.php?id=<?php echo $book['book_id']; ?>" class="" onclick="return confirm('Want to delete this book?');">
                        <img src="includes/img/remove.png" alt="delete_icon" class="p-2" width="35">
                    </a>
                <?php }; ?>
                </div>
                </div>
            <?php }; ?>
            </div>
        </div>
    </main>
    <?php require('footer.php'); ?>
