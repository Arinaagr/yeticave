<?php
$con = mysqli_connect('127.0.0.1', 'root','','yeticave');
mysqli_set_charset($con, 'utf8');

$sql='SELECT*FROM categories';
$result=mysqli_query($con,$sql);
$sql2='SELECT*FROM lots';
$result2=mysqli_query($con,$sql2);
if($result){
    echo mysqli_error($con);
}
if($result2){
    echo mysqli_error($con);
}

$categories_list=mysqli_fetch_all($result,MYSQLI_ASSOC);

$data_list=mysqli_fetch_all($result2, MYSQLI_ASSOC);

