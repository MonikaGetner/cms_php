<?php


if(isset($_POST['name'])) {



    //$pdo->query('INSERT INTO categories (`name`) VALUES( "'.$_POST['name'].'" )');

    $sth = $pdo->prepare('INSERT INTO categories (`name`) VALUES( :name_value )');
    $sth->bindParam(':name_value', $_POST['name']);
    $sth->execute();

    header('location: index.php?module=categories');
}

?>


<h1>Dodaj kategorie</h1>

<form method="post">
    <div class="form-group">
        <label class="font-weight-bold" >Nazwa kategorii</label>
        <input type=text" name="name" class="form-control" >
    </div>

    <div class="form-group">
    <button class="btn btn-success">Zapisz</button>
    </div>
</form>
