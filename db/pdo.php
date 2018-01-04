<?php

try {

    $pdo = new PDO('mysql:host=localhost;dbname=cms;encoding=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch(Exception $e) {
    echo $e->getCode();
    echo '<br>';
    echo $e->getLine();
    echo '<br>';
    echo $e->getFile();
    echo '<br>';
    echo $e->getMessage();
}