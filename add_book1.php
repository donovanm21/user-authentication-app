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

    // Include Header
require('header.php');
?>
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
