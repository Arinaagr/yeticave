<?php
require_once ('functions.php');
require 'bd_connect.php';

if ($_SERVER['REQUEST_METHOD']== 'POST') {

    $required_fields = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date'];
    $errors = [];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[$field] = "form__item--invalid";
            $form_errors='form--invalid';

        }
        if ($field == 'lot-rate') {
            if (!filter_var($_POST[$field], FILTER_VALIDATE_INT)) {
                $errors[$field] = 'Начальная цена должна быть корректной';
            }
            if (intval($_POST[$field]) <= 0) {
                $errors[$field] = 'Начальная цена должна быть корректной';
            }
        }
        if ($field == 'lot-step') {
            if (!filter_var($_POST[$field], FILTER_VALIDATE_INT)) {
                $errors[$field] = 'Шаг ставки должен быть корректным';
            }
            if (intval($_POST[$field]) < 0) {
                $errors[$field] = 'Начальная цена должна быть корректнойм';
            }
        }
    }
    if(isset($_FILES['lotPhotos'])){
        $finfo = finfo_open(FILEINFO_NINE_TYPE);
        $file_name = $_FILES['lotPhotos']['name'];
        $file_path = __DIR__ . '/img/';
        $file_tmpname = $_FILES['lotPhotos']['tmp_name'];
        $file_type = finfo_file($finfo, $file_tmpname);
        if($file_type == 'image/gif'){
            move_uploaded_file($_FILES['lotPhotos']['tmp_name'], $file_path . $file_name);
        }
        $file_url='img/' . $file_name;

    }

    if (count($errors) !== 0) {
        $page_content = compile_template('add.php',
            ['errors' => $errors,
            'categories_list' => $categories_list]);
    } else {
        $lot = [
            "image" => file_url ? 'img/user.jpg' : '',
            "name" => $_POST['lot-name'],
            "start_price" => $_POST['lot_rate'],
            "rate" => $_POST['lot-step'],
            "timer" => $_POST['lot-date'],
            "category" => $_POST['category'],
            "description" => $_POST['message'],
            "account_id" => $_SESSION['auth']['account_id']

        ];
        $addLotContent = renderTemplate('templates/lotTemplace.php', [
            'lot' => $lot,
            'rates' => [],
            'price' => $lot['start_price']+$lot['rate']
        ]);
        $con = mysqli_connect('127.0.0.1', 'root','','yeticave');
        mysqli_set_charset($con, 'utf8');
        $sql="SELECT categ_id FROM categories WHERE name='{$lot['category']}'";
        $result=mysqli_query($con,$sql);
        $lot['category']=mysqli_fetch_assoc($result)['categ_id'];

        $sql="INSERT INTO lots(lot_name, lot_description, lot_img, lot_categ_id, lot_first_price, lot_end_date, lot_step, lot_categ_id)
VALUE ('{$lot['lot_name']}', '{$lot['lot_description']}', '{$lot['lot_img']}', '{$lot['lot_categ_id']}', '{$lot['lot_first_price']}', '{$lot['lot_end_date']}', '{$lot['lot_step']}' , '{$lot['lot_categ_id']}')" ;
        $result=mysqli_query($con,$sql);
        if(!$result = mysqli_error($con));
    }
}
 else{
     $page_content = compile_template('add.php',
         ['categories_list' => $categories_list,
             'data_list' => $data_list
         ]);
 }



$layout_content = compile_template('layout.php',
    ['page_layout'=>'Главная страница',
        'is_auth' => $is_auth,
        'user_avatar' => $user_avatar,
        'user_name'=>$user_name,
        'page_content'=>$page_content,
        'categories_list'=>$categories_list]);

print($layout_content);
