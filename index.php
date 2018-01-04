<?php
session_start();

define('FOTO_URL', 'http://localhost/php_001/photos/');

include('db/pdo.php');
include('utils/func.php');

include('router.php');





    if( isset( $_GET['module'] ) ) {
        $module_name = $_GET['module'];
    } else {
        $module_name = 'categories';     //ustawiamy domyslny modul
    }

    if(!isset($router[$module_name])) {
        header('HTTP/1.0 404 Not Found');
        echo '404 ';
    } else {




        if($router[$module_name]['admin'] === 1) {
            include ('layouts/header.php');

            if (
                !isset($_SESSION['login']) || $_SESSION['login'] !== 1 ||
                (!isset($_SESSION['user_agent']) || $_SESSION['user_agent'] != $_SERVER['HTTP_USER_AGENT'])
            ) {
                $module_name = 'login';
            }
        } else {
            include ('layouts/hedear_front.php');
        }

        $filePath = 'modules/' . $module_name . '.php';
        if (file_exists($filePath)) {
            include($filePath);              /// jeste jeszcze funkcja require jak jest roznica?
        } else {
            header('HTTP/1.0 404 Not Found');
            echo '404 ';
        }

//    if($_GET['module'] == 'categories') {
//        include ('modules/categories.php');
//    } else if($_GET['module'] == 'articles') {
//        include ('modules/articles.php');
//    } else if($_GET['module'] == 'galleries') {
//        include ('modules/galleries.php');
//    }


        if($router[$module_name]['admin'] === 1) {
            include('layouts/footer.php');
        } else {
            include('layouts/footer_front.php');
        }

    }

