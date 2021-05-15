<?php
// Start Session
session_start();
// Include Functions
require_once('functions.php');

$authors = getAuthors();

// Error Array
$errors = array();

if(!isset($_GET['book_id'])) {
    $book_id = $_POST['book_id'];
} else {
    $book_id = $_GET['book_id'];
}

$book_info = query('SELECT *
FROM books
WHERE book_id = "'.$book_id.'"');

// Update Book Info
if(isset($_POST['update_book'])) {
    // Form validation
    if($_POST['book_name'] == '') {
        array_push($errors, 'Please enter a valid book name.');
    }
    if($_POST['book_year'] == '') {
        array_push($errors, 'Please enter a valid book year.');
    }
    if($_POST['book_genre'] == '') {
        array_push($errors, 'Please enter a valid book genre.');
    }
    if($_POST['age_group'] == '') {
        array_push($errors, 'Please enter a valid age group.');
    }
    // Update Book
    if(count($errors) == 0) {
        if($_POST['select_author'] != '') {
            updateBook(
                e($_POST['book_id']),
                e($_POST['book_name']),
                e($_POST['book_year']),
                e($_POST['book_genre']),
                e($_POST['age_group']),
                e($_POST['select_author'])
            );
        } else {
            array_push($errors, 'Please select an author.');
        }
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
                <h1 class="h2">Book Administration</h1>
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
                        <div class="col-md-12 col-lg-12">
                            <h4 class="mb-3">Update Book</h4>
                            <form class="needs-validation" action="book_edit.php" method="post">
                            <?php foreach($book_info as $bi) { ?>
                            <div class="row g-3">
                                <!-- Book ID -->
                                <input type="hidden" value="<?php echo $book_id; ?>" name="book_id">
                                <!-- Book Name -->
                                <div class="col-6">
                                    <label for="book_name" class="form-label">Book Name / Title</label>
                                    <input type="text" class="form-control" id="book_name" placeholder="Example: Book Name" name="book_name" value="<?php echo $bi['book_name']; ?>">
                                </div>
                                <!-- Book Year -->
                                <div class="col-6">
                                    <label for="book_year" class="form-label">Book Year</label>
                                    <input type="text" class="form-control" id="book_year" placeholder="Example: 1982" name="book_year" value="<?php echo $bi['year']; ?>">
                                </div>
                                <!-- Book Genre -->
                                <div class="col-sm-6">
                                    <label for="book_genre" class="form-label">Book Genre</label>
                                    <input type="text" class="form-control" id="book_genre" placeholder="Example: Novel" name="book_genre" value="<?php echo $bi['genre']; ?>">
                                </div>
                                <!-- Age Group -->
                                <div class="col-sm-6">
                                    <label for="age_group" class="form-label">Age Group</label>
                                    <input type="text" class="form-control" id="age_group" placeholder="Example: 16 - 18yrs" name="age_group" value="<?php echo $bi['age_group']; ?>">
                                </div>
                                <!-- Select Author -->
                                <div class="col-md-6">
                                    <label for="select_author" class="form-label">Select Author</label>
                                    <select class="form-select" id="select_author" name="select_author">
                                        <option value="">Choose...</option>
                                        <?php foreach($authors as $a) { ?>
                                            <option value="<?php echo $a['author_id']; ?>" class=""><?php echo $a['author_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <?php } ?>
                            <hr class="my-4">

                            <button class="w-100 btn btn-primary btn-lg" type="submit" name="update_book">Update Book</button>
                            <a href="index.php"><button class="w-100 btn btn-secondary btn-lg my-2" type="button">Back</button></a>
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
