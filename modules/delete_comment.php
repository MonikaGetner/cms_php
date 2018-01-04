usuwanie komentazra
<?php

if( isset( $_GET['id'] ) ) {
    $id_comment = $_GET['id'];
    $sth = $pdo->prepare('DELETE FROM comments WHERE id = :id_value');
    $sth->bindParam(':id_value',$id_comment);
    $sth->execute();
}

header('location: index.php?module=comments');


?>
