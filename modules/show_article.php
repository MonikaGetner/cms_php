<h1>Artykuł treść </h1>

<a href="?module=front"> powrót do strony glownej</a>


<?php


if(isset($_GET['article_id']) ) {
    $sth = $pdo->prepare('SELECT * FROM articles WHERE articles.id = :id_value');
    $sth->bindParam(':id_value', $_GET['article_id']);
    $sth->execute();
    $article = $sth->fetch();

    $sth = $pdo->prepare('select photos.* from photos join articles_photos on photos.id=articles_photos.photo_id where articles_photos.article_id = :id_value');
    $sth->bindParam(':id_value', $_GET['article_id']);
    $sth->execute();
    $photos = $sth->fetchAll();

}
?>

<div><strong><?php echo $article['title'] ?></strong></div>
<div><strong>Autor: <?php echo $article['author'] ?></strong></div>
<div class=".initialism"> <?php echo $article['body'];?> </div>


<?php
echo '<table class="table table-hover">';

foreach ($photos as $photo) {
    echo '<tr>';
    echo '<td>' . $photo['id'] . '</td>';
    echo '<td><img src="' . FOTO_URL . $photo['file'] . '" style="width: 120px;"><hr></td>';
    echo '</tr>';
    echo '</table>';
}
?>