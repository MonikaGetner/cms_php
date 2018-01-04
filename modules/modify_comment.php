
<?php

if( isset( $_GET['id'] ) ) {
    $id_comment = $_GET['id'];

    if(isset($_POST['body'])) {

        $sth = $pdo->prepare('UPDATE comments SET `body` = :body_value, `author` = :author_value, `article_id` = :article_id_value  WHERE id = :id_value');

        $sth->bindParam(':author_value', $_POST['author']);
        $sth->bindParam(':body_value', $_POST['body']);
        $sth->bindParam(':article_id_value', $_POST['article_id']);
        $sth->bindParam(':id_value', $id_comment);
        $sth->execute();
        header('location: index.php?module=comments&page='. $_SESSION['comments_page']);
    }

    $sth = $pdo->prepare('SELECT * FROM comments WHERE id = :id_value');
    $sth->bindParam(':id_value',  $id_comment);
    $sth->execute();
    $comments = $sth->fetch();
    if(!$comments) {
        header('location: index.php?module=comments&page='. $_SESSION['comments_page']);
    }
} else {
    header('location: index.php?module=comments&page='. $_SESSION['comments_page']);
}

?>


<h1>Edytuj Komentarz</h1>

<form method="post">

    <div class="form-group">
        <label class="font-wteight-bold" >Autor</label>
        <input type="text" value="<?php echo $comments['author'];?>" name="author" class="form-control" >
    </div>

    <div class="form-group">
        <label class="font-weight-bold" >Tresc</label>
        <textarea  class="form-control" name="body" rows="4" cols="50"><?php echo $comments['body'];?></textarea>
    </div>

    <div class="form-group">
        <label class="font-weight-bold">Artykul którego dotyczy</label>
        <select class="form-control" name="article_id">

            <?php

            $sth = $pdo->query('SELECT * FROM articles');
            $articles = $sth->fetchAll();
            foreach ($articles as $article) {
                if($article['id'] == $comments['article_id']) {
                    echo '<option selected value="'.$article['id'].'">';
                } else {
                    echo '<option value="'.$article['id'].'">';
                }
                echo $article['title'];
                echo '</option>';
            }

            ?>

        </select>
    </div>
    <div class="form-group">
        <button class="btn btn-success">Zapisz</button>
    </div>
</form>


