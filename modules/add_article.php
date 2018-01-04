<?php

if(isset($_POST['title'])) {

    $sth = $pdo->prepare('INSERT INTO articles (`title`, `body`, `author`, `category_id`) VALUES( :title_value, :body_value, :author_value, :category_id_value )');
    $sth->bindParam(':title_value', $_POST['title']);
    $sth->bindParam(':author_value', $_POST['author']);
    $sth->bindParam(':body_value', $_POST['body']);
    $sth->bindParam(':category_id_value', $_POST['category_id']);
    $sth->execute();

    $articleId = $pdo->lastInsertId();

    foreach ($_POST['foto'] as $foto) {

        $sth = $pdo->prepare('INSERT INTO articles_photos (`article_id`, `photo_id`) VALUES(:article_id_value, :photo_id_value)');
        $sth->bindParam('article_id_value', $articleId);
        $sth->bindParam('photo_id_value', $foto);
        $sth->execute();

    }

    header('location: index.php?module=articles&page=' . $_SESSION['articles_page']);
}

?>


<h1>Dodaj Artykul</h1>

<form method="post">
    <div class="form-group">
        <label class="font-weight-bold" >Tytul artykulu</label>
        <input type=text" name="title" class="form-control" >
    </div>

    <div class="form-group">
        <label class="font-weight-bold" >Autor</label>
        <input type=text" name="author" class="form-control" >
    </div>

    <div class="form-group">
        <label class="font-weight-bold" >Zdjecia</label>

        <?php

        $fotos = $pdo->query('SELECT * FROM photos')->fetchAll();

        foreach ($fotos as $foto) {
            echo '<div class="m-3">';

                echo '<img src="'.FOTO_URL. $foto['file'].'" style="width:140px"><br>';
                echo '<input type="checkbox" name="foto[]" value="'.$foto['id'].'">';

            echo '</div>';
        }

        ?>

    </div>

    <div class="form-group">
        <label class="font-weight-bold" >Tresc</label>
        <textarea class="form-control" name="body" rows="4" cols="50"></textarea>
    </div>

    <div class="form-group">
        <label class="font-weight-bold">Kategoria</label>
        <select class="form-control" name="category_id">

            <?php

            $sth = $pdo->query('SELECT * FROM categories');
            $categories = $sth->fetchAll();
            foreach ($categories as $category) {
                echo '<option value="'.$category['id'].'">';
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
