zmieniamy artykul

<?php

if( isset( $_GET['id'] ) ) {
    $id_article = $_GET['id'];

    $sth = $pdo->prepare('SELECT photo_id FROM articles_photos WHERE article_id = :article_id_value');
    $sth->bindParam(':article_id_value', $id_article);
    $sth->execute();
    $articlePhotos = $sth->fetchAll();

    $photosIds = [];

//    dd($articlePhotos);

   // print_r($articlePhotos['photo_id']);
    foreach ($articlePhotos as $photoItem) {
        $photosIds[] = $photoItem['photo_id'];
    }



    if(isset($_POST['title'])) {
//
        $sth = $pdo->prepare('UPDATE articles SET `title` = :title_value, `body` = :body_value, `author` = :author_value, `category_id` = :category_id_value  WHERE id = :id_value');
        $sth->bindParam(':id_value', $id_article);
        $sth->bindParam(':title_value', $_POST['title']);
        $sth->bindParam(':author_value', $_POST['author']);
        $sth->bindParam(':body_value', $_POST['body']);
        $sth->bindParam(':category_id_value', $_POST['category_id']);
        $sth->execute();


        $diff1 = array_diff($photosIds, $_POST['foto']);
        $diff2 = array_diff($_POST['foto'], $photosIds);

        foreach ($diff1 as $foto) {

            $sth = $pdo->prepare('DELETE FROM articles_photos WHERE article_id = :article_id_value AND photo_id = :photo_id_value');
            $sth->bindParam('article_id_value', $id_article);
            $sth->bindParam('photo_id_value', $foto);
            $sth->execute();
        }


        foreach ($diff2 as $foto) {

            $sth = $pdo->prepare('INSERT INTO articles_photos (`article_id`, `photo_id`) VALUES(:article_id_value, :photo_id_value)');
            $sth->bindParam('article_id_value', $id_article);
            $sth->bindParam('photo_id_value', $foto);
            $sth->execute();
        }

//

        header('location: index.php?module=articles&page=' . $_SESSION['articles_page']);
    }


    $sth = $pdo->prepare('SELECT * FROM articles WHERE id = :id_value');
    $sth->bindParam(':id_value', $id_article);
    $sth->execute();
    $article = $sth->fetch();
    if(!$article) {
        header('location: index.php?module=articles');
    }





} else {
    header('location: index.php?module=articles');
}


?>


<h1>Edytuj Artykul</h1>

<form method="post">
    <div class="form-group">
        <label class="font-weight-bold" >Tytul artykulu</label>
        <input value="<?php echo $article['title'];?>" type=text" name="title" class="form-control" >
    </div>

    <div class="form-group">
        <label class="font-wteight-bold" >Autor</label>
        <input value="<?php echo $article['author'];?>" type=text" name="author" class="form-control" >
    </div>

    <div class="form-group">
        <label class="font-weight-bold" >Zdjecia</label>

        <?php

        $fotos = $pdo->query('SELECT * FROM photos')->fetchAll();

        foreach ($fotos as $foto) {
            echo '<div class="m-3">';

                echo '<img src="'.FOTO_URL. $foto['file'].'" style="width:140px"><br>';

                $checked = (in_array($foto['id'], $photosIds)) ? 'checked' : '';

                echo '<input '.$checked.' type="checkbox" name="foto[]" value="'.$foto['id'].'">';

            echo '</div>';
        }

        ?>

    </div>

    <div class="form-group">
        <label class="font-weight-bold" >Tresc</label>
        <textarea class="form-control" name="body" rows="4" cols="50"><?php echo $article['body']?></textarea>
    </div>

    <div class="form-group">
        <label class="font-weight-bold">Kategoria</label>
        <select class="form-control" name="category_id">
            <?php
            $sth = $pdo->query('SELECT * FROM categories');
            $categories = $sth->fetchAll();
            foreach ($categories as $category) {

                if($category['id'] == $article['category_id']) {
                    echo '<option selected value="'.$category['id'].'">';
                } else {
                    echo '<option value="'.$category['id'].'">';
                }

                    echo $category['name'];
                echo '</option>';

            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <button class="btn btn-success">Zapisz</button>
    </div>
</form>




