<?php

    $catId = isset($_GET['catId']) ? $_GET['catId'] : false;
    $limit = 5;

    if($catId) {

        $sth = $pdo->prepare('SELECT count(*) as page_cnt FROM articles WHERE category_id = :category_id_value');
        $sth->bindParam(':category_id_value', $catId);
        $sth->execute();
        $pages = $sth->fetch()['page_cnt'];

        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $from = ($page-1) * $limit;    //pomniejszenie o 1 !!!

        //pobranie listy artykułów
        $sth = $pdo->prepare('SELECT * FROM articles WHERE category_id = :category_id_value LIMIT :from_value, :limit_value');
        $sth->bindParam(':from_value', $from, PDO::PARAM_INT);
        $sth->bindParam(':limit_value', $limit, PDO::PARAM_INT);
        $sth->bindParam(':category_id_value', $catId);
        $sth->execute();
        $articles = $sth->fetchAll();

    } else {

        $pages = $pdo->query('SELECT count(*) as page_cnt FROM articles')->fetch()['page_cnt'];
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $from = ($page-1) * $limit;    //pomniejszenie o 1 !!!

        //pobranie listy artykułów
        $sth = $pdo->prepare('SELECT * FROM articles LIMIT :from_value, :limit_value');
        $sth->bindParam(':from_value', $from, PDO::PARAM_INT);
        $sth->bindParam(':limit_value', $limit, PDO::PARAM_INT);
        $sth->execute();
        $articles = $sth->fetchAll();

    }

    dd($pages);



?>

<div>
    <?php
    foreach ($articles as $article) {?>

        <div><strong><?php echo $article['title'] ?></strong></div>
        <div><?php echo substr($article['body'], 0, 200);?>... <a href="?module=show_article&article_id=<?php echo $article['id'] ?>">czytaj więcej</a></div>
        <div>Autor: <?php echo $article['author'] ?></div>
        <hr>

    <?php
    }
    echo paginator_monia($page, $pages,2,'front');
    ?>
</div>
