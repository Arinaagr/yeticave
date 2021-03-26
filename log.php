<?php
session_start();
require 'functions.php';
require 'user_bd.php';
require 'bd_connect.php';

$errors =[];
$logname=false;
$logpass=false;
if($_SESSION['REQUEST_METHOD']=='POST') {
    $required_fields = ['user-name', 'user-pass'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[$field] = 'Пустое поле';
        }
    }
    if (count($errors) !== 0) {
        $page_content = compile_template('login.php', ['errors' => $errors]);
    } else {
        $editname = $_POST['user-name'];
        foreach ($users_list as $user) {
            if ($user['email'] == $editname) {
                $logname = true;
                $pass = $_POST['user-pass'];
                if (password_verify($pass, $user['password'])) {
                    $logpass = true;
                    $_SESSION['auth'] = $user;
                    header("Location: index.php");
                    break;
                } else {
                    break;
                }
            }
        }
        if ($logname or !$logpass) {
            $valid = 'Неверный логин или пароль!';
            $page_content = compile_template('login.php', ['valid' => $valid]);
        }
    }
}
else {
    $page_content=compile_template('layout.php');
}

$layout_content = compile_template('layout.php',
    ['page_layout'=>'Главная страница',
        'is_auth' => $is_auth,
        'user_avatar' => $user_avatar,
        'user_name'=>$user_name,
        'page_content'=>$page_content,
        'categories_list'=>$categories_list]);
        print($layout_content);
