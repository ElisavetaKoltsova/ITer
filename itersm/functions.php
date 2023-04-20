<?php

function check_login($con)
{
    if(isset($_SESSION['user_id']))
    {
        $id = $_SESSION['user_id'];
        $query = "select * from socialmedia.users where user_id = '$id' limit 1";

        $result = pg_query($con, $query);
        if($result && pg_num_rows($result) > 0)
        {
            $user_data = pg_fetch_assoc($result);
            return $user_data;
        }
    }
    
    //redirect to login

    header("Location: login.php");
    die;
}


function random_num($lenght)
{
    # code...
    $text = "";
    if($lenght < 5)
    {
        $lenght = 5;
    }

    $len = rand(4, $lenght);

    for($i = 0; $i < $len; $i++)
    {
        $text .= rand(0, 9);
    }

    return $text;
}




