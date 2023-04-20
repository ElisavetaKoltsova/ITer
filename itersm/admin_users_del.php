<?php
  header('Content-type: text/html; charset=utf-8');
  session_start();
  include("connection.php");
include("functions.php");

$user_data = check_login($con);

function countPeople($result) 
{ 
    // Проверка на то, что строк больше нуля
    if ($result -> num_rows > 0) {
        // Цикл для вывода данных
        while ($row = $result -> fetch_assoc()) {
            // Получаем массив с строками которые нужно выводить
            //$arr = doesItExist($row);
            // Вывод данных
            echo  '<div class="feed">
            <div class="head">
                <div class="user">
                    <div class="profile-photo">
                    <img src="/pic/profiles_photos/small_img/'.$row['avatar'].'" alt="">
                    </div>
                    <div class="info">
                        <h3>' . $row["user_name"] . '</h3>
                        <small class="text-muted">' . $row["user_id"] . '</small>                           
                    </div>                                
                </div>
                <div>';
                if($user_data['role'] == 3)
                {
                    echo '<a class="btn btn-active" href="?del=' . $row["iduser"] . '">Удалить</a>';
                } 
                
                echo '</div>
                                          
            </div>
        </div>';  
        }
    // Если данных нет
    } else {
        echo "Никто не найден";
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
                <img src="/pic/profiles_photos/small_img/<?= $user_data['avatar']?>" alt="">
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
                    
                    <?php
                    if($user_data['role'] == 3)
                    {
                        echo '<a class="menu-item active" href="admin_users_del.php">
                        <span><i class="uil-user-times"></i></span><h3>Пользователи</h3>                  
                        </a>';
                    }
                    ?>
                </div>
                <!--END of SIDEBAR-->
                <label class = "btn btn-primary" for="create-post">Создать статью</label>               
            </div>
            <!--MIDDLE SECTION           create community-->
            <div class="middle">

           
                
                <!--feeds(posts)-->
               <!--
                <form action="" method = "post">
                    <button class = "btn btn-primary" name="button1" id="b1">
                    <h2>Все пользователи</h4>
                    </button>
                    <button class = "btn btn-primary" name="button2" id="b2">
                    <h2>Нарушители</h4>
                    </button>
                </form>-->

                <form action="" class="create-post" method="post">
                    <div class="profile-photo">
                    <img src="/pic/profiles_photos/small_img/<?= $user_data['avatar']?>" alt="">
                    </div>
                    <input type="text" placeholder="Найти пользователя" id="create-post" name="search">
                    <input type="submit" value="Найти пользователя" class="btn btn-primary">
                </form>

                <div class="feeds">
                <?php

                if($_SERVER['REQUEST_METHOD'] != "POST")
                {
                    $id = $user_data['iduser'];
                    $sql = "SELECT * from users where iduser!='$id'";
                    $result = mysqli_query($con, $sql);

                    if (!$result) {
                       echo "Ошибка выполнения запроса: " . mysql_error();
                       exit;
                    }
                   if (mysqli_num_rows($result) == 0) {
                       echo '<br><br>';
                       echo "Пользователи не найдены";
                        exit;
                    }

                    // Создание списка.


                    // Разбор данных. Создание списка из поля field.
                   while ($row = mysqli_fetch_assoc($result)) {
                        echo  '<div class="feed">
                     <div class="head">
                        <div class="user">
                            <div class="profile-photo">
                            <img src="/pic/profiles_photos/small_img/'.$row['avatar'].'" alt="">
                            </div>
                            <div class="info">
                                <h3>' . $row["user_name"] . '</h3>
                                <small class="text-muted">' . $row["user_id"] . '</small>                           
                            </div>                                
                        </div>
                        <div>';
                        if($user_data['role'] == 3)
                        {
                            echo '<a class="btn btn-active" href="?del=' . $row["iduser"] . '">Удалить</a>';
                        } 
                        
                        echo '</div>
                                                  
                    </div>
                    </div>';  
                     // Функция вывода пользователей
                   
                    
                   
                    }
                   
                    if (isset($_GET['del']))
                    {
                        $id = $_GET['del'];
                        $query = "DELETE FROM users WHERE iduser = $id";
                        mysqli_query($con, $query) or die(mysqli_error($con));
                    }
                   
                   

                    // Очищаем результат.
                    mysqli_free_result($result);


                } else if($_SERVER['REQUEST_METHOD'] == "POST")
                {
                    // Получаем запрос
                    $inputSearch = $_POST['search']; 


                    //$id = $user_data['iduser'];
                    $sql = "SELECT * from users where name_user='$inputSearch' ||
                     user_name='$inputSearch' || surname_user='$inputSearch' ||
                     middle_name='$inputSearch'";
                    $result = mysqli_query($con, $sql);

                    if (!$result) {
                    echo "Ошибка выполнения запроса: " . mysql_error();
                    exit;
                    }
                if (mysqli_num_rows($result) == 0) {
                    echo '<br><br>';
                    echo "Пользователи не найдены";
                        exit;
                    }

                    // Создание списка.


                    // Разбор данных. Создание списка из поля field.
                while ($row = mysqli_fetch_assoc($result)) {
                        echo  '<div class="feed">
                        <div class="head">
                        <div class="user">
                            <div class="profile-photo">
                            <img src="/pic/profiles_photos/small_img/'.$row['avatar'].'" alt="">
                            </div>
                            <div class="info">
                                <h3>' . $row["user_name"] . '</h3>
                                <small class="text-muted">' . $row["user_id"] . '</small>                           
                            </div>                                
                        </div>
                        <div>';
                        if($user_data['role'] == 3)
                        {
                            echo '<a class="btn btn-active" href="?del=' . $row["iduser"] . '">Удалить</a>';
                        } 
                        
                        echo '</div>
                                                
                    </div>
                    </div>';  
                    // Функция вывода пользователей
                
                    
                
                    }
                
                    if (isset($_GET['del']))
                    {
                        $id = $_GET['del'];
                        $query = "DELETE FROM users WHERE iduser = $id";
                        mysqli_query($con, $query) or die(mysqli_error($con));
                    }
                
                

                    // Очищаем результат.
                    mysqli_free_result($result);
                
                }
                    
                


                ?>
                    

                    
                    
                </div>
            </div>
            <!--RIGHT SECTION-->
            <div class="right">
                
                    
                
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