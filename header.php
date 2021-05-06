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
        <link href="includes/css/styles.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@1,300&family=Roboto&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    </head>
<body class="">
<div id="app-root">
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
                    <li class="nav-item">
                        <a class="nav-link" href="users.php">Members</a>
                    </li>
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