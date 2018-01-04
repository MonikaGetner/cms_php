<h1>Dodaj Komentarz</h1>

<?php

$sth = $pdo->query('SELECT articles.*, categories.name FROM articles LEFT JOIN categories ON articles.category_id = categories.id');
$articles = $sth->fetchAll();

if(isset($_POST['body'])) {
    $data = Date("Y-m-d");
    $sth = $pdo->prepare('INSERT INTO comments (`body`, `author`,`date`, `article_id`) VALUES( :body_value, :author_value, :date_value, :article_id_value )');
    $sth->bindParam(':author_value', $_POST['author']);
    $sth->bindParam(':body_value', $_POST['body']);
    $sth->bindParam(':date_value', $data);   //!!!!!!!!!!!!!!!!!
    $sth->bindParam(':article_id_value', $_POST['article_id']);

    $sth->execute();
    dd( $_SESSION['comments_page']);
    header('location: index.php?module=comments&page='. $_SESSION['comments_page']);
}



echo '<table class="table table-hover">';
    echo '<tr>';
        echo '<th>id</th>';
        echo '<th>tytul</th>';
        echo '<th>autor</th>';
        echo '<th>kategoria</th>';
        echo '<th>Komentarz autor</th>';
        echo '<th>Komentarz tresc</th>';
        echo '</tr>';

    foreach($articles as $item) {
    echo '<tr>';
        echo '<td>'.$item['id'].'</td>';
        echo '<td>'.$item['title'].'</td>';
        echo '<td>'.$item['author'].'</td>';
        echo '<td>'.$item['name'].'</td>';
        echo '<form method="post">';
        echo '<td><input type="text" name="author" class="form-control" ></td>';
        echo '<td><textarea class="form-control" name="body" rows="4" cols="50"></textarea></td>';
        echo '<td><input type="hidden" name="article_id" value='.$item['id'].' class="form-control" ></td>';  ///  !!!!! nie widzial tej zmiennej
        echo '<td><button class="btn btn-success">Zapisz</button> </td>';
        echo '</form>';
        echo '</tr>';

    }
    echo '</table>'

?>







