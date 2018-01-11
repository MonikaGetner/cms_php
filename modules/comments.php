<h1>Lista Komentarzy</h1>

<a href="?module=add_comment" class="btn btn-success" >Dodaj komentarz</a>
<?php
$limit = 3;

$count = $pdo->query('SELECT COUNT(id) as cnt FROM comments')->fetch()['cnt'];
$pages = ceil($count / $limit);


$page = isset($_GET['page']) ? $_GET['page'] : 1;

$from = ($page-1) * $limit;    //pomniejszenie o 1 !!!

$_SESSION['comments_page'] = $page;

$sth = $pdo->prepare('SELECT comments.*, articles.title  FROM comments LEFT JOIN articles ON comments.article_id = articles.id LIMIT :from_value, :limit_value');
$sth->bindParam(':from_value', $from, PDO::PARAM_INT);
$sth->bindParam(':limit_value', $limit, PDO::PARAM_INT);
$sth->execute();
$comments = $sth->fetchAll();

echo '<table class="table table-hover">';
echo '<tr>';
echo '<th>id</th>';
echo '<th>autor</th>';
echo '<th>date</th>';
echo '<th>artykul tytul</th>';
echo '<th>Edytuj</th>';
echo '<th>Usun</th>';
echo '</tr>';

foreach($comments as $item) {
    echo '<tr>';
    echo '<td>'.$item['id'].'</td>';
    echo '<td>'.$item['body'].'</td>';
    echo '<td>'.$item['date'].'</td>';
    echo '<td>'.$item['title'].'</td>';
    echo '<td> <a class="btn btn-primary" href="?module=modify_comment&id='.$item['id'].'">Edytuj</a> </td>';
    echo '<td> <a class="btn btn-danger" href="?module=delete_comment&id='.$item['id'].'">Usun</a> </td>';
    echo '</tr>';

}
echo '</table>';

echo paginator_monia($page, $pages,2,'comments');
?>

