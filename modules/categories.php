<h1>Lista Kategorii</h1>

<a href="?module=add_category" class="btn btn-success">Dodaj kategorie</a>
<?php

$limit = 10;

$count = $pdo->query('SELECT COUNT(id) as cnt FROM categories')->fetch()['cnt'];
$pages = ceil($count / $limit);

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$from = ($page-1) * $limit;    //pomniejszenie o 1 !!!


$sth = $pdo->prepare('SELECT * FROM categories LIMIT :from_value, :limit_value');
$sth->bindParam(':from_value', $from, PDO::PARAM_INT);
$sth->bindParam(':limit_value', $limit, PDO::PARAM_INT);
$sth->execute();

$categories = $sth->fetchAll();


echo '<table class="table table-hover">';
echo '<tr>';
echo '<th>id</th>';
echo '<th>category</th>';
echo '<th>Edytuj</th>';
echo '<th>Usun</th>';
echo '</tr>';

foreach ($categories as $item) {
    echo '<tr>';
    echo '<th>' . $item['id'] . '</th>';
    echo '<th>' . $item['name'] . '</th>';
    echo '<th> <a  class="btn btn-primary" href="?module=modify_category&id=' . $item['id'] . '">Edytuj</a> </th>';
    echo '<th> <a  class="btn btn-danger" href="?module=delete_category&id=' . $item['id'] . '">Usun</a> </th>';
    echo '</tr>';
}
echo '</table>';

echo paginator_monia($page, $pages, 3,'categories');

?>



