<?php
  header('Content-type: text/html; charset=utf-8');
  session_start();
  include("connection.php");
include("functions.php");

$user_data = check_login($con);


if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $from_user = $user_data["iduser"];
    $to_user = $_GET["to_user"];
    $message = $_POST["message"];
echo $message;
    if(!empty($message))
    {
        //save to database
        $query = "INSERT into socialmedia.messages (from_user, to_user, message_text) value ('$from_user', '$to_user', '$message')";
        pg_query($con, $query);

        //header("Location: chat.php");
        //die;
    } else{
        ?>
            <script>
                alert("Пожалуйта, не оставляйте поле пустым");
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
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style_soc.css">
    <link rel="icon" type="image/png" href="./pic/logo/icons8-покебол-100 (1).png">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
    <title>ITer</title>
</head>
<body>
    <!--HEADER-->
    <nav>
        <div class="container">
            <h2 class="log">
                ITer
            </h2>
            <div class="search-bar">
                <i class="uil uil-search"></i>
                <input type = "search" placeholder="Поиск блогеров и статей">
            </div>
            <div class="create">
                <label class = "btn btn-primary" for="create-post">Создать</label>
                <div class="profile-photo">
                    <a href="profile.php">
                    <img src="/pic/profiles_photos/small_img/<?= $user_data['avatar']?>" alt="">
                    </a>
                </div>
                <form action="logout.php"><button class = "btn btn-primary">Выйти</button></form>
            </div>
        </div>
    </nav>
    
    <!--MAIN SECTION-->
    <main>
        <div class="container">
            <!--LEFT SECTION-->
            <div class="left">
                <a href="profile.php" class="profile">
                    <div class="profile-photo">
                    <img src="/pic/profiles_photos/small_img/<?= $user_data['avatar']?>" alt="">
                    </div>   
                    <div class="handle">
                        <h4><?php
                        echo $user_data['user_name']?></h4>
                        <p class="text-muted">
                        <?php echo $user_data['user_id']?>
                        </p>
                    </div>                 
                </a>
                <!--SIDEBAR-->
                <div class="sidebar">
                    <a href = "index.php" class="menu-item">
                        <span><i class="uil uil-home"></i></span><h3>Главная</h3>                      
                    </a>
                    <a class="menu-item" id="notifications">
                        <span><i class="uil uil-bell"><small class="notification-count">9+</small></i></span><h3>Уведомления</h3>   
                        <!--notification popup-->  
                        <div class="notifications-popup">
                            <div class="profile-photo">
                                <img src="./pic/articles/weber.jpg">
                            </div>
                            <div class="notification-body">
                                <b>Имя пользователя</b> принял(а) вас в друзья
                                <small class="text-muted">2 дня назад</small>
                            </div>
                            <div class="profile-photo">
                                <img src="./pic/articles/tester.jpg">
                            </div>
                            <div class="notification-body">
                                <b>Имя пользователя</b> прокомментировал(а) ваш пост
                                <small class="text-muted">3 дня назад</small>
                            </div>
                        </div>  
                                      
                    </a>
                    <a class="menu-item active" href="chat.php">
                        <span><i class="uil uil-envelope-alt"><small class="notification-count">6</small></i></span><h3>Сообщения</h3>                    
                    </a>
                    <a class="menu-item" id="messages-notifications" href="community.php">
                    <span><i class="uil uil-users-alt"></i></span><h3>Сообщества</h3>                   
                    </a>
                    <a class="menu-item">
                        <span><i class="uil uil-user-exclamation"></i></span><h3>Вакансии</h3>                    
                    </a>
                    <a class="menu-item" id="theme">
                        <span><i class="uil uil-palette"></i></span><h3>Тема</h3>                    
                    </a>
                    
                </div>
                <!--END of SIDEBAR-->
                <a href="create_post.php" class = "btn btn-primary">
                Создать статью
                </a>                
            </div>
            <!--MIDDLE SECTION-->
            <div class="middle">             
                <!--feeds(posts)-->Выберите чат ->
                <div class="feeds">

                    <div class="feed">
                        <div class="head">
                            <div class="user">
                        <?php 

                            if(isset($_GET["to_user"]))
                            {
                                $user_name = pg_query($con, "Select * from socialmedia.users where iduser = '".$_GET["to_user"]."' ") or
                                die("Failed to query database".pg_last_error());
                                $uName = pg_fetch_assoc($user_name);
                                echo '<div class="profile-photo">
                                <img src="/pic/profiles_photos/small_img/'.$uName['avatar'].'" alt="">
                                </div>';
                                echo '<input type="text" value='.$_GET["to_user"].' id="to_user" hidden/>';
                                echo $uName['user_name'];
                            }
                            else
                            {
                                // $user_name = pg_query($con, "Select * from socialmedia.users where iduser = '".$_GET["to_user"]."' ") or
                                // die("Failed to query database".pg_last_error());
                                // $uName = pg_fetch_assoc($user_name);
                                // $_SESSION["to_user"];
                                // echo '<input type="text" value='.$_SESSION["to_user"].' id="to_user" hidden/>';
                                // echo $uName['user_name'];
                            }
                            
                        
                        ?>
                            </div>
                        </div>
                        
                    </div>
                    <?php
                        if(isset($_GET["to_user"]))
                        {
                            echo ' <div class="feed">
                            <div class="head">
                                <div class="user">
                                <form method="post">
                                    <textarea name="message" class="form-control" style="height: 30px; width: 35rem;"></textarea>
                                    <button id="send" class="btn btn-active">Отправить</button>
                                </form>
                                </div>
                            </div>
                        </div>';
                        }
                    ?>
                       
                    <div class="modal-body">
                            
                            <?php

                                if(isset($_GET["to_user"]))
                                {
                                    $from_user = $_SESSION["user_data.iduser"];
                                    $to_user = $_SESSION["to_user"];
                                    $to_user_get = $_GET["to_user"];
                                    $from_user_get = $_GET["iduser"];

                                    $id = $user_data["iduser"];

                                    $sql = "SELECT * from socialmedia.messages, socialmedia.users where ((to_user = '$to_user_get' and from_user = '$id') or (to_user = '$id' and from_user = '$to_user_get')) and iduser = '$to_user_get' order by id_messages desc";
                                    $result = pg_query($con, $sql);

                                    if (!$result) {
                                        echo "Ошибка выполнения запроса: " . pg_error();
                                        
                                    }
                                    if (pg_num_rows($result) == 0) {
                                        echo "У вас ещё нет диалога с этим пользователем. Хотите написать ему приветствие?";
                                        
                                    }
            
                                    // Создание списка.
            
            
                                    // Разбор данных. Создание списка из поля field.
                                    while ($row = pg_fetch_assoc($result)) 
                                    {
                                        if($row["to_user"] == $_GET["to_user"] && $row["from_user"] == $id)
                                        {
                                            echo '<div class="feed">
                                            <div class="head" id="msgBody">
                                            <div class = "user" style="text-align:left;">
                                            <p class = "mes" style="background-color:white; word-wrap:break-word; display:inline-block;
                                            padding: 5px; border-radius:10px; max-width: 80%; margin: 10px; color: black;">
                                            '.$row["message_text"].'</p>
                                            </div></div></div>';
                                        }
                                        if($row["to_user"] == $id && $row["from_user"] == $_GET["to_user"])
                                        {
                                            echo '<div class="feed">
                                            <div class="head" id="msgBody">
                                            <div class = "user" style="text-align:left;">
                                            <div class="profile-photo">
                                            <img src="/pic/profiles_photos/small_img/'.$row['avatar'].'" alt="">
                                            </div>
                                            <p style="background-color:#6b4ce6; word-wrap:break-word; display:inline-block;
                                            padding: 5px; border-radius:10px; max-width: 100%; margin: 10px; color: white;">
                                            '.$row["message_text"].'</p>
                                            </div></div></div>';
                                        }
                                        
                                    }
                                }
                               

                            ?>

                        </div>
                            </div>
                        
                           
            </div>
            <!--RIGHT SECTION-->
            <div class="right">
            <div class="messages">
                    <div class="heading">
                    <h3>Привет, <?= $user_data['user_name']?>! С кем хочешь пообщаться?</h3>
                    </div>
                    <!--search bar-->
                    <div class="search-bar">
                        <i class="uil uil-search search"></i>
                        <input class="search-bar-pole" type="search" placeholder="Найти пользователя" id="message-search">
                    </div>
                    <!--Blogers category-->
                    <div class="category">
                        <h6 class="active">Отправить сообщение:</h6>
                    </div>
                    <!--Blogers-->
                    
                    

                        <?php 
                        $id = $user_data["iduser"];
                        $msgs = pg_query($con, "SELECT * from socialmedia.users where iduser != '$id'") or
                        die("Failed to query database".pg_last_error());
                        while($msg = pg_fetch_assoc($msgs))
                        {
                            echo '<a href="?to_user='.$msg['iduser'].'">';
                            echo '<div class="bloger">
                            <div class="profile-photo">
                            <img src="/pic/profiles_photos/small_img/'.$msg['avatar'].'" alt="">
                        </div>
                        <div class="bloger-body">';
                            echo '<h3>' . $msg["user_name"] . '</h3>';
                            
                            echo '</div>
                            </div>';
                            echo '</a>';
                            echo '<br>';
                        }
                        ?>


                        
                    
                </div> 
            </div>
        </div>
    </main>

<!-- EDIT PROFILE -->


<!--THEME SECTOR-->

<div class="customize-theme">
    <div class="card">
        <h2>Поменяй свою тему</h2>
        <p class="text-muted">Управляй размером шрифта, цветами и фоном</p>
        <!--font sizes-->
        <div class="font-size">
            <h4>Размер шрифта</h4>
            <div>
                <h6>a</h6>
                <div class="choose-size">
                    <span class="font-size-1"></span>
                    <span class="font-size-2"></span>
                    <span class="font-size-3 active"></span>
                    <span class="font-size-4"></span>
                    <span class="font-size-5"></span>
                </div>
                <h3>A</h3>
            </div>
        </div>      
        <!--primary colors-->
    <div class="color">
        <h4>Цвета</h4>
        <div class="choose-color">
            <span class="color-1 active"></span>
            <span class="color-2"></span>
            <span class="color-3"></span>
            <span class="color-4"></span>
            <span class="color-5"></span>
        </div>
    </div>
    <!--background colors-->
    <div class="background">
        <h4>Фон</h4>
        <div class="choose-bg">
            <div class="bg-1">
                <span></span>
                <h5 for="bg-1">Тёмный</h5>
            </div>
            <div class="bg-2">
                <span></span>
                <h5 for="bg-2">Светлый</h5>
            </div>
            <div class="bg-3">
                <span></span>
                <h5 for="bg-3">Средний</h5>
            </div>
        </div>
    </div>
    </div>
</div>

<script src="./js/socmedia.js"></script>
<!-- <script type="text/javascript">
    $(document).ready(function(){
        $("#send").on("click", function(){
            $.ajax({
                url:"insertMessage.php", method: "POST",
                data:{
                    from_user: $("#from_user").val(),
                    to_user: $("#to_user").val(),
                    message: $("#message").val(),
                },
                dateType:"text",
                success: function(data)
                {
                    $("#message").val("");
                }
            })
        })
    })

</script> -->



</script>
</body>
</html>