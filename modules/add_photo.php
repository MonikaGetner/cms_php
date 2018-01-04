<?php

if(isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {

    $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);

    $fotoName = uniqid() . '.' . $ext;

    move_uploaded_file($_FILES['photo']['tmp_name'], getcwd() . '/photos/' . $fotoName);

   // $varible = file_get_contents($_FILES['photo']['tmp_name']);

    //wykonac jakies przeslanie na inny serwer

   // file_put_contents(getcwd() . '/photos/' . $fotoName, $varible);

//    echo $varible;
//    die;


    $sth = $pdo->prepare('INSERT INTO photos (`file`) VALUES(:file_value)');
    $sth->bindParam(':file_value', $fotoName);
    $sth->execute();

    header('location: index.php?module=galleries&page=' . $_SESSION['photos_page']);
}

?>


<form enctype="multipart/form-data" method="post">
    <div class="form-group">
        <input type="file" name="photo" placeholder="file" class="form-control">
    </div>

    <button class="btn btn-primary">zapisz</button>
</form>