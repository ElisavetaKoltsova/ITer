<?php
header('Content-type: text/html; charset=utf-8');
session_start();
include("connection.php");
include("functions.php");

//$user_data = check_login($con);

$sql = "SELECT * from socialmedia.users";
$result = pg_query($con, $sql);


if($_SERVER['REQUEST_METHOD'] == "POST")
{
    //something was posted
    $user_name = $_POST['user_name'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];
    $avatar = "noavatar.jpg";
    $role = $_POST['user_type'];

    while ($row = pg_fetch_assoc($result)) 
    {
        if($user_name == $row['user_name']) $otv = 1; 
        
    }

    if(!empty($user_name) && !empty($password) && !is_numeric($user_name) && $otv != 1)
    {
        //save to database
        $user_id = random_num(20);
        $query = "insert into socialmedia.users (user_id,user_name,password,email,avatar,role) values ('$user_id','$user_name','$password','$email','$avatar','$role')";
        pg_query($con, $query);

        header("Location: login.php");
        die;
    } else{
        ?>
            <script>
                alert("Пожалуйта, вводите корректные данные или данный пользователь уже существует");
            </script>
        <?php
    }

}





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="./pic/logo/icons8-покебол-100 (1).png">
    <link rel="stylesheet" href="./css/reg.css" type="text/css">
    
    <title>Регистрация/Вход</title>
</head>
<body>
    <article class="container">

        <!--Внутренний блок-->
        
        <div class="block">
        <section class="block_item block-item">
        <h2 class="block-item_title">У вас уже есть аккаунт?</h2>
        <button class="block-item_btn signin-btn">Войти</button>
        </section>
        
        <section class="block_item block-item">
        <h2 class="block-item_title">У вас уже есть аккаунт?</h2>
        <form action="login.php"><button class="block-item_btn signup-btn">Войти</button></form>
        </section>
        </div>
        
        <!--Блок формы-->
        
        <div class="form-box">
        
        
        <!--Форма регистрации-->
        
        <form method="post" class="form form_signin">
            <h3 class="form_title">Регистрация</h3>
            
            <p>
            <input type="text" name="user_name" class="form_input" placeholder="Логин">
            </p>
        
            <p>
            <input type="email" name="email" class="form_input" placeholder="E-mail">
            </p>

            <p>
            <input type="password" name="password" class="form_input" placeholder="Пароль">
            </p>
            
      
            <p>
                <input class = "form_radio" name="user_type" type="radio" name="radio" value="1">Компания
            
                <input class = "form_radio" name="user_type" type="radio" name="radio" value="2" checked>Пользователь
            </p>
            <p>
            <button class="form_btn form_btn_signup">Зарегистрироваться</button>
            </p>
        </form>
        </div>
        
        </article>
</body>
</html>