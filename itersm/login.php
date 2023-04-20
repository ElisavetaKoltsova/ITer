
<?php

header('Content-type: text/html; charset=utf-8');
session_start();

include("connection.php");
include("functions.php");


if($_SERVER['REQUEST_METHOD'] == "POST")
{
    //something was posted
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
    {

    //read from database
    $query = "select * from socialmedia.users where user_name = '$user_name' limit 1";
    $result = pg_query($con, $query);

    if($result)
    {
        if($result && pg_num_rows($result) > 0)
        {

        $user_data = pg_fetch_assoc($result);

            if(password_verify($password, $user_data['password']))
            {
                $_SESSION['user_id'] = $user_data['user_id'];
                header("Location: index.php");
                die;
            }
        }
    }

    ?>
    <script>
        alert("Пожалуйта, вводите корректные данные ппп");
    </script>

    <?php
    }else
    {
        ?>
        <script>
            alert("Пожалуйта, вводите корректные данные");
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
        <h2 class="block-item_title">У вас нет аккаунта?</h2>
        <form action="singup.php"><button class="block-item_btn signup-btn">Зарегистрироваться</button></form>
        
        </section>
        </div>
        
        <!--Блок формы-->
        
        <div class="form-box">
        
        <!--Форма входа-->
        
        <form method="post" class="form form_signin">
        <h3 class="form_title">Вход</h3>
        
        <p>
        <input type="text" name="user_name" class="form_input" placeholder="Логин">
        </p>
        
        <p>
        <input type="password" name="password" class="form_input" placeholder="Пароль">
        </p>
        
        <p>
        <button type="submit" class="form_btn">Войти</button>
        </p>
        
        </form>
        
        
        </div>
        
        </article>
</body>
</html>