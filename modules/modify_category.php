<?php
print_r($_GET);

if( isset( $_GET['id'] ) ) {

    $id_category = $_GET['id'];

    if(isset($_POST['name'])) {

        $sth = $pdo->prepare('UPDATE categories SET `name` = :name_value WHERE id = :id_value');
        $sth->bindParam(':id_value', $id_category);
        $sth->bindParam(':name_value', $_POST['name']);
        $sth->execute();

        header('location: index.php?module=categories');
    }


    $sth = $pdo->prepare('SELECT * FROM categories WHERE id = :id_value');
    $sth->bindParam(':id_value', $id_category);
    $sth->execute();
    $category = $sth->fetch();
    if(!$category) {
        header('location: index.php?module=categories');
    }

} else {
    header('location: index.php?module=categories');
}




?>

<form method="post">
    <div class="form-group">
        <label class="font-weight-bold" >Zmień nazwę kategori</label>
        <input type=text" name="name" value="<?php echo $category['name']; ?>" class="form-control" >
    </div>

    <div class="form-group">
        <button class="btn btn-success">Zapisz</button>
    </div>
</form>


