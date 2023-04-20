<?php
  header('Content-type: text/html; charset=utf-8');
  session_start();
  include("connection.php");
include("functions.php");
require 'load_photo.php';

$user_data = check_login($con);


$id = $_GET['com'];
$sql = "SELECT * from socialmedia.users where iduser='$id'";
$result = pg_query($con, $sql);
$row = pg_fetch_assoc($result);

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
                    <a href = "index.php" class="menu-item active">
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
                    <a class="menu-item" href="chat.php">
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
               
                
                <!--feeds(posts)-->
                <div class="feeds">
                            
                            <?php

                        $id = $_GET['com'];
                        $sql2 = "SELECT * from socialmedia.article, socialmedia.users where iduser = '$id' and id_user = '$id' order by id_article desc";
                        $result2 = pg_query($con, $sql2);

                    

                        if (!$result2) {
                            echo "Ошибка выполнения запроса: " . pg_error();
                        }
                        if (pg_num_rows($result2) == 0) {
                            echo "Здесь нет постов или профиль приватный.";
                            
                        }

                        // Создание списка.


                        // Разбор данных. Создание списка из поля field.
                        while ($row2 = pg_fetch_assoc($result2)) {
                            echo '<div class="feed">
                            <div class="head">
                                <div class="user">
                                    <div class="profile-photo">
                                    <img src="/pic/profiles_photos/small_img/'.$row2['avatar'].'" alt="">
                                    </div>
                                    <div class="info">
                                        <h3>'.$row2['user_name'].'</h3>
                                        <small>'.$row2['theme_article'].'</small>                           
                                    </div>                                
                                </div>
                                <span class="edit"> 
                                    <i class="uil uil-ellipsis-h"></i>                                      
                                </span>                           
                            </div>
                            <div class="photo">
                            '.$row2['text'].'';
                            
                            if($row2['image']!= NULL)
                            {
                                echo '<img src="/pic/profiles_photos/full_img/'.$row2['image'].'" alt="">';
                            }

                            echo '</div>
                            <div class="action-buttons">
                                <div class="interaction-buttons">
                                    <span>
                                        <i class="uil uil-heart"></i>
                                    </span>
                                    <span>
                                        <i class="uil uil-comment-dots"></i>
                                    </span>
                                    <span>
                                        <i class="uil uil-share-alt"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="liked-by">
                                <span><img src="./pic/pic_block/blogging.jpg" alt=""></span>
                                <span><img src="./pic/pic_block/coding.jpg" alt=""></span>
                                <span><img src="./pic/pic_block/sturtup.jpg" alt=""></span>
                                <p>Понравилось <b>Имя пользователя</b> и <b>число другим</b></p>
                            </div>
                            <div class="caption">
                                <p><b>Имя пользователя</b> Коротко о статье 
                                <span class = "harsh-tag">хештеги</span></p>
                            </div>
                            <div class="comments text-muted">
                                Показать какое-то кол-во комментариев
                            </div>
                            <div class="comments text-muted">
                            '.$row2['date'].'
                            </div>
                        </div>';
                            
                        }
                        // Очищаем результат.
                        pg_free_result($result2);


                        ?>
                    
                </div>
            </div>
            <!--RIGHT SECTION-->
            <div class="right">
                <div class="messages">  
                <div class="heading">
                        <h4><?php echo $row['user_name'] ?></h4>
                </div> 
                <img src="/pic/profiles_photos/full_img/<?php echo $row['avatar']?>" alt="">
                <br>
                
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

</body>
</html>