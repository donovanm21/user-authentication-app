<?php
// Start Session
session_start();
// Include Functions
require_once('functions.php');

$authors = getAuthors();

// Error Array
$errors = array();

// Add New Book
if(isset($_POST['add_book'])) {
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
    // Add Client to Database
    if(count($errors) == 0) {
        if($_POST['select_author'] != '') {
            addBookAuthor(
                e($_POST['book_name']),
                e($_POST['book_year']),
                e($_POST['book_genre']),
                e($_POST['age_group']),
                e($_POST['select_author'])
            );
        } else {
            if(isset($_POST['author_name']) && isset($_POST['author_age']) && isset($_POST['author_genre'])) {
                addBookNoAuthor(
                    e($_POST['book_name']),
                    e($_POST['book_year']),
                    e($_POST['book_genre']),
                    e($_POST['age_group']),
                    e($_POST['author_name']),
                    e($_POST['author_age']),
                    e($_POST['author_genre'])
                );
            }
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
                        <div class="col-md-12 col-lg-12" v-if="membertype == 'client'">
                            <h4 class="mb-3">Add New Book</h4>
                            <form class="needs-validation" action="add_book.php" method="post">
                            <div class="row g-3">
                                <!-- Book Name -->
                                <div class="col-6">
                                    <label for="book_name" class="form-label">Book Name / Title</label>
                                    <input type="text" class="form-control" id="book_name" placeholder="Example: Book Name" name="book_name" v-model="formVars.bookname">
                                </div>
                                <!-- Book Year -->
                                <div class="col-6">
                                    <label for="book_year" class="form-label">Book Year</label>
                                    <input type="text" class="form-control" id="book_year" placeholder="Example: 1982" name="book_year" v-model="formVars.bookyear">
                                </div>
                                <!-- Book Genre -->
                                <div class="col-sm-6">
                                    <label for="book_genre" class="form-label">Book Genre</label>
                                    <input type="text" class="form-control" id="book_genre" placeholder="Example: Novel" name="book_genre" v-model="formVars.bookgenre">
                                </div>
                                <!-- Age Group -->
                                <div class="col-sm-6">
                                    <label for="age_group" class="form-label">Age Group</label>
                                    <input type="text" class="form-control" id="age_group" placeholder="Example: 16 - 18yrs" name="age_group" v-model="formVars.agegroup">
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
                                <!-- Spacer -->
                                <div class="col-md-6"></div>
                                <!-- Spacer -->
                                <div class="col-12">
                                    <span><b>OR</b></span>
                                </div>
                                <!-- Author Name -->
                                <div class="col-sm-6">
                                    <label for="author_name" class="form-label">Author Name</label>
                                    <input type="text" class="form-control" id="author_name" placeholder="Example: Vikram" name="author_name">
                                </div>
                                <!-- Author Age -->
                                <div class="col-sm-6">
                                    <label for="author_age" class="form-label">Author Age</label>
                                    <input type="text" class="form-control" id="author_age" placeholder="Example: 67" name="author_age">
                                </div>
                                <!-- Author Genre -->
                                <div class="col-sm-6">
                                    <label for="author_genre" class="form-label">Author Genre</label>
                                    <input type="text" class="form-control" id="author_genre" placeholder="Example: Novelist" name="author_genre">
                                </div>
                            </div>
                            <hr class="my-4">

                            <button class="w-100 btn btn-primary btn-lg" type="submit" name="add_book" @click="memberFormSubmit">Add New Book</button>
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
