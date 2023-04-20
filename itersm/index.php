<?php
  header('Content-type: text/html; charset=utf-8');
  session_start();
  include("connection.php");
include("functions.php");

$user_data = check_login($con);

if($_SERVER['REQUEST_METHOD'] == "POST")
{
//something was posted
$title = ' ';
$text = $_POST['text_text'];
$id_user = $user_data['iduser'];
$theme_article = 'Пост';



if(!empty($title) && !empty($text))
    {
        //save to database
        $query = "insert into socialmedia.article (id_user, title, text, theme_article) 
        values ('$id_user','$title','$text','$theme_article')";
        pg_query($con, $query);

        header("Location: index.php");
        die;
    } else{
        echo "Пожалуйта, вводите корректные данные";
    }
}
?>


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
                    <a class="menu-item active">
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
                    
                    <?php

                    if($user_data['role'] == 3)
                    {
                        echo '<a class="menu-item" href="admin_users_del.php">
                        <span><i class="uil-user-times"></i></span><h3>Пользователи</h3>                  
                        </a>';
                    }
                        
                    ?>
                </div>
                <!--END of SIDEBAR-->
                <a href="create_post.php" class = "btn btn-primary">
                Создать статью
                </a>             
            </div>
            <!--MIDDLE SECTION-->
            <div class="middle">
                
                <form method="post" class="create-post" name="post-simple">
                    <div class="profile-photo">
                    <img src="/pic/profiles_photos/small_img/<?= $user_data['avatar']?>" alt="">
                    </div>
                    <input type="text" placeholder="Что вы хотите рассказать?" id="create-post" name="text_text">
                    <input type="submit" value="Запостить" class="btn btn-primary">
                </form>

                
                <!--feeds(posts)-->
                <div class="feeds">
                    
                         <?php

                        $id = $user_data['iduser'];
                        $sql = "SELECT * from socialmedia.article, socialmedia.users where id_user = iduser order by id_article desc";
                        $result = pg_query($con, $sql);

                        if (!$result) {
                            echo "Ошибка выполнения запроса: " . pg_last_error();
                            
                        }
                        if (pg_num_rows($result) == 0) {
                            echo "Постов нет.";
                            
                        }

                        // Создание списка.


                        // Разбор данных. Создание списка из поля field.
                        while ($row = pg_fetch_assoc($result)) {
                            echo '<div class="feed">
                            <div class="head">
                                <div class="user">
                                    <div class="profile-photo">
                                    <img src="/pic/profiles_photos/small_img/'.$row['avatar'].'" alt="">
                                    </div>
                                    <div class="info">
                                        <h3>'.$row['user_name'].'</h3>
                                        <small>'.$row['theme_article'].'</small>                           
                                    </div>                                
                                </div>
                                <span class="edit"> 
                                    <i class="uil uil-ellipsis-h"></i>                                      
                                </span>                           
                            </div>
                            <div class="photo">
                            '.$row['text'].'';
                            
                            if($row['image']!= NULL)
                            {
                                echo '<img src="/pic/profiles_photos/full_img/'.$row['image'].'" alt="">';
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
                            <!--
                            <div class="liked-by">
                                <span><img src="./pic/pic_block/blogging.jpg" alt=""></span>
                                <span><img src="./pic/pic_block/coding.jpg" alt=""></span>
                                <span><img src="./pic/pic_block/sturtup.jpg" alt=""></span>
                                <p>Понравилось <b>Имя пользователя</b> и <b>число другим</b></p>
                            </div>
                            
                            <div class="comments text-muted">
                                Показать какое-то кол-во комментариев
                            </div>-->
                            <div class="comments text-muted">
                            '.$row['date'].'
                            </div>
                        </div>';
                            
                        }
                        // Очищаем результат.
                        pg_free_result($result);


                        ?>
                    <!--
                    <div class="feed">
                        <div class="head">
                            <div class="user">
                                <div class="profile-photo">
                                    <img src="./pic/articles/weber.jpg">
                                </div>
                                <div class="info">
                                    <h3>Имя пользователя</h3>
                                    <small>Тематика поста</small>                           
                                </div>                                
                            </div>
                            <span class="edit"> 
                                <i class="uil uil-ellipsis-h"></i>                                      
                            </span>                           
                        </div>
                        <div class="photo">
                            <img src="./pic/mainpic/mainpic6.jpg">
                        </div>
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
                    </div>
                    -->
                </div>
            </div>
            <!--RIGHT SECTION-->
            <div class="right">
                <div class="messages">
                    <div class="heading">
                        <h4>Популярные блогеры</h4><i class="uil uil-signal-alt-3"></i>
                    </div>
                    <!--search bar-->
                    <div class="search-bar">
                        <i class="uil uil-search search"></i>
                        <input class="search-bar-pole" type="search" placeholder="Найти блогера" id="message-search">
                    </div>
                    <!--Blogers category-->
                    <div class="category">
                        <h6 class="active">Авторы</h6>
                        <h6>Статьи</h6>
                        <h6 class="socials">Сообщества</h6>
                    </div>
                    <!--Blogers-->
                    
                    <?php

                        $id = $user_data['iduser'];
                        $sql = "SELECT * from socialmedia.users where iduser!=$id";
                        $result = pg_query($con, $sql);

                        if (!$result) {
                            echo "Ошибка выполнения запроса: " . pg_last_error();
                            exit;
                        }
                        if (pg_num_rows($result) == 0) {
                            echo "Запрос не вернул данных.";
                            exit;
                        }

                        // Создание списка.


                        // Разбор данных. Создание списка из поля field.
                        while ($row = pg_fetch_assoc($result)) {
                            echo '<a href="profile_user.php?com='.$row['iduser'].'">';
                            echo '<div class="bloger">
                            <div class="profile-photo">
                            <img src="/pic/profiles_photos/small_img/'.$row['avatar'].'" alt="">
                        </div>
                        <div class="bloger-body">';
                            echo '<h3>' . $row["user_name"] . '</h3>';
                            
                            echo '</div>
                            </div>';
                            echo '</a>';
                            echo '<br>';
                            
                        }
                        // Очищаем результат.
                        pg_free_result($result);


                        ?>
                    
                </div>
                <!--Blogers list-->
                <div class="bloger-requests">
                    <h4>Хотите создать сообщество?</h4>
                    <div class="request">
                        
                        <div class="action">
                            <form action="com_create.php">
                            <button class="btn btn-primary">
                                Создать
                            </button>
                            </form>
                            <form action="community.php">
                            <button class="btn btn-primary">
                                Ваши сообщества
                            </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

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