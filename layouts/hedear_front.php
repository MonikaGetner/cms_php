<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Front</title>
    <link rel="stylesheet" href="css/reset.css">
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
                        echo '<a href="?module=front&catId='.$category['id'].'">'.$category['name'].'</a>';
                    echo '</li>';
                }

                ?>
            </ul>

        </nav>

        <main>

