<?php

    $catId = isset($_GET['catId']) ? $_GET['catId'] : false;

    if($catId) {
        $sth = $pdo->prepare('SELECT * FROM articles WHERE category_id = :category_id_value');
        $sth->bindParam(':category_id_value', $catId);
        $sth->execute();
        $articles = $sth->fetchAll();
    } else {
        $articles = $pdo->query('SELECT * FROM articles')->fetchAll();
    }



?>

<div>
    <?php
    foreach ($articles as $article) {?>


        <div><strong><?php echo $article['title'] ?></strong></div>
        <div><?php echo substr($article['body'], 0, 200);?>... <a href="?module=show_article&id=<?php echo $article['id'] ?>">czytaj więcej</a></div>
        <div>Autor: <?php echo $article['author'] ?></div>
        <hr>

    <?php
    }
    ?>
</div>
