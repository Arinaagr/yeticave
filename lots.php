<?php
require_once ('functions.php');
require 'bd_connect.php';



$currentlot = null;
if(isset($_GET['id'])){
    $lotID = intval($_GET['id']);
    foreach ($data_list as $lot){
        if (intval($lot['lot_id']) == $lotID){
            $currentlot=$lot;
            break;
        }
    }
}

if (!$data_list[$lotID]) {
    http_response_code(404);
    exit;
}

$page_content = compile_template('lot.php',
    ['categories_list' => $categories_list,
        'lot'=>$currentlot,
        'lotID'=>$lotID,
        'data_list' =>$data_list,
        'lot_time_remaining'=>$lot_time_remaining]);

$layout_content = compile_template('layout.php',
    ['page_layout'=>'Главная страница',
        'is_auth' => $is_auth,
        'user_avatar' => $user_avatar,
        'user_name'=>$user_name,
        'page_content'=>$page_content,
        'categories_list'=>$categories_list]);

print($layout_content);


