<?php
include("connection.php");
require 'obrezka_photo.php';

$user_data = check_login($con);

$id = $_GET['com'];
$sql = "SELECT * from community where id_community='$id'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

if (isset($_POST['upload'])) {
if (isset($_FILES['uploadfile'])) {
$foto_name = time()."_".basename($_FILES['uploadfile']['name']);
$error_flag = $_FILES['uploadfile']['errors'];

if ($error_flag == 0) {
$upfile = getcwd()."/pic/profiles_photos/full_img/".time()."_".basename(iconv('utf-8', 'windows-1251', $_FILES['uploadfile']['name']));
if ($_FILES['uploadfile']['tmp_name']) {
$allowed = array('jpg', 'jpeg' , 'png');
$ext = pathinfo($_FILES['uploadfile']['name'], PATHINFO_EXTENSION);
if (!in_array($ext, $allowed)) {
$errors[] = "Неверный формат";
} else if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $upfile)) {
$uploaddir = "pic/profiles_photos/full_img/";
$uploaddir2 = "pic/profiles_photos/small_img/";

pg_query($con, "UPDATE socialmedia.community SET avatar = '$foto_name' WHERE id_community = $id");
cropImage($uploaddir.$foto_name, $uploaddir2.$foto_name, 240, 240);
}
} else {
$errors[] = "Ошибка";
}
}
}
else if ($_FILES['uploadfile']['size'] == 0)$errors[] = "Выберите изображение";
}