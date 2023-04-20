<?php
  header('Content-type: text/html; charset=utf-8');
  session_start();
  include("connection.php");
include("functions.php");

$user_data = check_login($con);

if($_SERVER['REQUEST_METHOD'] == "POST")
{
//something was posted
$title = $_POST['title'];
$text = $_POST['text_text'];
$id_user = $user_data['iduser'];
$theme_article = $_POST['theme_article'];
$image = $_FILES['picture']['name'];
$path = 'pic/profiles_photos/full_img/';

$uploaddir = 'pic/profiles_photos/full_img/';
$uploadfile = $uploaddir . basename($_FILES['picture']['name']);

echo '<pre>';
if (move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile)) {
    echo "Файл корректен и был успешно загружен.\n";
} else {
    echo "Возможная атака с помощью файловой загрузки!\n";
}

echo 'Некоторая отладочная информация:';
print_r($_FILES);

print "</pre>";


if(!empty($title) && !empty($text))
    {
        //save to database
        $query = "insert into socialmedia.article (id_user, title, text, theme_article,image) 
        values ('$id_user','$title','$text','$theme_article','$image')";
        pg_query($con, $query);

        header("Location: index.php");
        die;
    } else{
        echo "Пожалуйта, вводите корректные данные";
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
    <link rel="stylesheet" href="./css/soc_community.css">
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
                        <h4><?php echo $user_data['user_name']?></h4>
                        <p class="text-muted">
                        <?php echo $user_data['user_id']?>
                        </p>
                    </div>                 
                </a>
                <!--SIDEBAR-->
                <div class="sidebar">
                <a class="menu-item" href="index.php">
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
            </div>
            <!--MIDDLE SECTION           create community-->
            <div class="middle">
                
                <!--feeds(posts)-->
                <div class="feeds">


                <form method="post" enctype="multipart/form-data">

                <h3 class="form_title">Создать статью</h3>
                <br>
                <p>
                <input type="text" name="title" class="form_input" placeholder="Название статьи">
                </p>
                <br>
                <p>
                <input type="text" name="theme_article" class="form_input" placeholder="Тематика статьи">
                </p>
                <br>
                <p>
                <textarea type="text" class="form_input" name="text_text" placeholder="Содержание статьи" style="width: 40rem; height: 30rem"></textarea>
                </p>
                <br>
                
                <input class="btn-primary" type="file" name="picture"><br><br>
                <input class="btn btn-active" type="submit" name="upload" value="Загрузить">
               



                </form>


                    
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
                        <input class="search-bar-pole" type="search" placeholder="Найти сообщество" id="message-search">
                    </div>
                    <!--Blogers category-->
                    <div class="category">
                        <h6>Авторы</h6>
                        <h6>Статьи</h6>
                        <h6 class="socials active">Сообщества</h6>
                    </div>
                    <!--Blogers-->
                    
                    <?php

                        $id = $user_data['iduser'];
                        $sql = "SELECT * from socialmedia.community where id_user!=$id";
                        $result = pg_query($con, $sql);

                        if (!$result) {
                            echo "Ошибка выполнения запроса: " . pg_error();
                            
                        }
                        if (pg_num_rows($result) == 0) {
                            echo "Запрос не вернул данных.";
                            
                        }

                        // Создание списка.


                        // Разбор данных. Создание списка из поля field.
                        while ($row = pg_fetch_assoc($result)) {
                            echo '<div class="bloger">
                            <div class="profile-photo">
                            <img src="/pic/profiles_photos/small_img/'.$row['avatar'].'" alt="">
                        </div>
                        <div class="bloger-body">';
                            echo '<h5>' . $row["name_community"] . '</h5>';
                            echo '<small class="text-muted">' . $row["theme_community"] . '</small>';
                            echo '</div>
                            </div>';
                        }
                        // Очищаем результат.
                        pg_free_result($result);


                        ?>
                    
                </div>
                <!--Blogers list-->
                <div class="bloger-requests">
                    <h4></h4>
                    <div class="request">
                        
                        <div class="action">
                            <form action="community.php">
                            <button class="btn btn-primary">
                                Ваши сообщетсва
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