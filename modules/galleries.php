<h1>Galeria zdjęć</h1>

<a href="?module=add_photo" class="btn btn-success" >Dodaj zdjecie</a>

<?php
$limit = 2;

$count = $pdo->query('SELECT COUNT(id) as cnt FROM photos')->fetch()['cnt'];
$pages = ceil($count / $limit);

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$from = ($page-1) * $limit;    //pomniejszenie o 1 !!!


$sth = $pdo->prepare('SELECT * FROM photos LIMIT :from_value, :limit_value');
$sth->bindParam(':from_value', $from, PDO::PARAM_INT);
$sth->bindParam(':limit_value', $limit, PDO::PARAM_INT);
$sth->execute();

$photos = $sth->fetchAll();

$_SESSION['photos_page'] = $page;
//$photos = $pdo->query('SELECT * FROM photos')->fetchAll();

echo '<table class="table table-hover">';
echo '<tr>';
echo '<th>id</th>';
echo '<th>Photo</th>';
echo '<th>Edytuj</th>';
echo '<th>Usun</th>';
echo '</tr>';
foreach ($photos as $photo) {

    echo '<tr>';
    echo '<td>'.$photo['id'].'</td>';

    echo '<td> <img src="' . FOTO_URL .$photo['file'].'" style="width: 120px;"><hr></td>';
    echo '<td> <a class="btn btn-primary" href="?module=modify_photo&id='.$photo['id'].'">Edytuj</a> </td>';
    echo '<td> <a class="btn btn-danger" href="?module=delete_photo&id='.$photo['id'].'">Usun</a> </td>';
    echo '</tr>';
}
echo '</table>';

echo paginator_monia($page, $pages, 5,'galleries');

?>