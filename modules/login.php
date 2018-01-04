<?php


if(isset($_POST['login'])) {

    $salt = '-m098uec4yh0krh9juech908drteg58m7yrdgt87%^DDF';

    $password = md5($_POST['password'] . $salt);

    $sth = $pdo->prepare('SELECT * FROM users WHERE login = :login_value and password = :password_value');
    $sth->bindParam(':login_value', $_POST['login']);
    $sth->bindParam(':password_value',  $password);
    $sth->execute();

    $user = $sth->fetch();

    if($user) {
        $_SESSION['login'] = 1;
        $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
//        $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['user'] = $user['login'];

        header('location: ?module=articles');
    }

}




?>

<form method="post">
    <div class="form-group">
        <input type="text" name="login" placeholder="login" class="form-control">
    </div>
    <div class="form-group">
        <input type="password" name="password"  class="form-control">
    </div>

    <button class="btn btn-primary">Zaloguj</button>
</form>
