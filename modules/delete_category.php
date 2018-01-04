
usuwamy kategorie z bazy

<?php

if( isset( $_GET['id'] ) ) {
    $id_category = $_GET['id'];

    $sth = $pdo->prepare('DELETE FROM categories WHERE id = :id_value');
    $sth->bindParam(':id_value', $id_category);
    $sth->execute();

}

header('location: index.php?module=categories');

?>