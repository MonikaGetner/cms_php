<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Front</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

    <header>
        Nagłowek
    </header>
    <section>
        <nav>

            <ul>
                <?php


                $categories = $pdo->query('SELECT * FROM categories')->fetchAll();

                foreach ($categories as $category) {
                    echo '<li>';

                    if(isset($_GET['catId']) and $_GET['catId']===$category['id'] ){
                         echo '<a  style="font-weight: bold; color:red;" href="?module=front&catId='.$category['id'].'">'.$category['name'].'</a>';
                    } else{
                       echo '<a href="?module=front&catId='.$category['id'].'">'.$category['name'].'</a>';
                    }

                    echo '</li>';
                }

                ?>
            </ul>

        </nav>

        <main>

