<h1>Lista Artykulow</h1>

<a href="?module=add_article" class="btn btn-success" >Dodaj Artykul</a>
<?php

$limit = 10;

$count = $pdo->query('SELECT COUNT(id) as cnt FROM articles')->fetch()['cnt'];
$pages = ceil($count / $limit);


$page = isset($_GET['page']) ? $_GET['page'] : 1;

$from = ($page-1) * $limit;    //pomniejszenie o 1 !!!

$sth = $pdo->prepare('SELECT articles.*, categories.name FROM articles LEFT JOIN categories ON articles.category_id = categories.id LIMIT :from_value, :limit_value');
$sth->bindParam(':from_value', $from, PDO::PARAM_INT);
$sth->bindParam(':limit_value', $limit, PDO::PARAM_INT);
$sth->execute();
$articles = $sth->fetchAll();


$_SESSION['articles_page'] = $page;


echo '<table class="table table-hover">';
echo '<tr>';
    echo '<th>id</th>';
    echo '<th>tytul</th>';
    echo '<th>autor</th>';
    echo '<th>kategoria</th>';
    echo '<th>Ile komentarzy</th>';
    echo '<th>Edytuj</th>';
    echo '<th>Usun</th>';
echo '</tr>';

foreach($articles as $item) {
    echo '<tr>';
        echo '<td>'.$item['id'].'</td>';
        echo '<td>'.$item['title'].'</td>';
        echo '<td>'.$item['author'].'</td>';
        echo '<td>'.$item['name'].'</td>';

         $sth = $pdo->prepare('select count(comments.id) as ile from comments left join articles on comments.article_id=articles.id WHERE articles.id = :id_value');
         $sth->bindParam(':id_value', $item['id']);
         $sth->execute();
         $comments_qty = $sth->fetch();

         echo '<td>'.$comments_qty['ile'].'</td>';

        echo '<td> <a class="btn btn-primary" href="?module=modify_article&id='.$item['id'].'">Edytuj</a> </td>';
        echo '<td> <a class="btn btn-danger" href="?module=delete_article&id='.$item['id'].'">Usun</a> </td>';
    echo '</tr>';

}
echo '</table>';

//echo paginator($page, $pages, 'articles');
echo paginator_monia($page, $pages,2,'articles');



?>