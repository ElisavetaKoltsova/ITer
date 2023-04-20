<?php

                        $id = $user_data['iduser'];
                        $sql = "SELECT * from users where iduser!=$id";
                        $result = mysqli_query($con, $sql);

                        if (!$result) {
                            echo "Ошибка выполнения запроса: " . mysqli_error();
                            exit;
                        }
                        if (mysqli_num_rows($result) == 0) {
                            echo "Запрос не вернул данных.";
                            exit;
                        }

                        // Создание списка.


                        // Разбор данных. Создание списка из поля field.
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<a href="profile.php">';
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
                        mysqli_free_result($result);


                        ?>

<?php

                    $id = $user_data['iduser'];
                    $sql = "SELECT * from users, article";
                    $result = mysqli_query($con, $sql);

                    if (!$result) {
                        echo "Ошибка выполнения запроса: " . mysqli_error();
                        exit;
                    }
                    if (mysqli_num_rows($result) == 0) {
                        echo "Запрос не вернул данных.";
                        exit;
                    }

                    // Создание списка.


                    // Разбор данных. Создание списка из поля field.
                    while ($row = mysqli_fetch_assoc($result)) {
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
                            <img src="./pic/mainpic/mainpic1.jpg">
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
                    </div>';
                        
                    }
                    // Очищаем результат.
                    mysqli_free_result($result);


                    ?>