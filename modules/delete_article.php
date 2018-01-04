usuwamy artykul z bazy

<?php

if (isset($_GET['id'])) {
    $id_article = $_GET['id'];

    //sprawdzam czy nie ma komentarzy
    $sths = $pdo->prepare('select COUNT(comments.id) as qty FROM comments where comments.article_id= :id_value');
    $sths->bindParam(':id_value', $id_article);
    $sths->execute();
    $comments_qty = $sths->fetch();

    if ($comments_qty['qty'] == 0) {
        $sth = $pdo->prepare('DELETE FROM articles WHERE id = :id_value');
        $sth->bindParam(':id_value', $id_article);
        $sth->execute();
        header('location: index.php?module=articles');
    } else {
        //dd('blad artykul posiada komentarze !!');
        //header('Wybrany artykul posiada komentarz ');
        echo 'Artykul ma komentarze';
    }
}


?>
