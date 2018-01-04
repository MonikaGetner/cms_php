<?php

if( isset( $_GET['id'] ) ) {

    $id_photo = $_GET['id'];
    //pobieramy z bazy nazwe pliku
    $sth = $pdo->prepare('select file from photos WHERE photos.id = :id_value');
    $sth->bindParam(':id_value',$id_photo);
    $sth->execute();
    $fileName = getcwd() . '/photos/' . $sth->fetch()['file'];

    $delete_file=unlink($fileName );
    if(!$delete_file){
        echo 'nie mozna usunac pliku';
    }else{
        echo 'plik '.$fileName.' zostal usuniety ';
     }

    $sth = $pdo->prepare('DELETE FROM photos WHERE id = :id_value');
    $sth->bindParam(':id_value',$id_photo);
    $sth->execute();

     /// usuniecie powiazanan do artykułow
    $sth = $pdo->prepare('DELETE FROM articles_photos WHERE photo_id= :id_value');
    $sth->bindParam(':id_value',$id_photo);
    $sth->execute();



}

header('location: index.php?module=galleries&page=' . $_SESSION['photos_page']);




?>
