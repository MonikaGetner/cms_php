<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>CMS</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
</head>

<body>
<div class="container">
        <?php

        if(isset($_SESSION['login']) && $_SESSION['login'] === 1 &&
            isset($_SESSION['user_agent']) && $_SESSION['user_agent'] === $_SERVER['HTTP_USER_AGENT'])
        {
        ?>
        <nav class="navbar navbar-expand-lg navbar-light bg-faded">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">CMS</a>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="?module=categories">Kategorie<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?module=articles">Artykuly</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?module=galleries">Galerie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?module=comments">Komentarze</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?module=logout">Wyloguj (<b><?php echo $_SESSION['user']; ?></b>)</a>
                    </li>
                </ul>
            </div>
        </nav>

    <?php } ?>



