<?php
$con = mysqli_connect('127.0.0.1', 'root','','yeticave');
mysqli_set_charset($con, 'utf8');

$sql='SELECT*FROM users';
$result=mysqli_query($con,$sql);

if($result){
    echo mysqli_error($con);
}
$users_list=mysqli_fetch_all($result,MYSQLI_ASSOC);




