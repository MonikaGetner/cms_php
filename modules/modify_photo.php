<?php
if( isset( $_GET['id'] ) ) {
    $id_photo = $_GET['id'];

    //pobieramy z bazy nazwe pliku
    $sth = $pdo->prepare('select file from photos WHERE photos.id = :id_value');
    $sth->bindParam(':id_value', $id_photo);
    $sth->execute();
    $fileName = $sth->fetch()['file'];

    if(isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {

        unlink('photos/' . $fileName);

        $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);

        $fotoName = uniqid() . '.' . $ext;

        move_uploaded_file($_FILES['photo']['tmp_name'], getcwd() . '/photos/' . $fotoName );

        $sth = $pdo->prepare('UPDATE photos SET `file`= :file_value WHERE photos.id = :id_value');
        $sth->bindParam(':id_value', $id_photo);
        $sth->bindParam(':file_value',  $fotoName);
        $sth->execute();

        header('location: index.php?module=galleries&page=' . $_SESSION['photos_page']);
    }


}
?>


<form enctype="multipart/form-data" method="post">
    <div class="form-group">
        <input type="file" name="photo" placeholder="file" class="form-control">
        <span> <?php echo $fileName;?> </span>
    </div>


    <button class="btn btn-primary">zapisz</button>
</form>