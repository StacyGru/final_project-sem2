<?php

    echo '<h1 class="text-dark">Личный кабинет</h1>';

    switch ($_SESSION['user_type']) 
    {
        case 'author':
            echo '<h3 class="text-success">Вы автор</h3>';
            break;
        case 'reader':
            echo '<h3 class="text-info">Вы читатель</h3>';
            break;
        case 'expert':
            echo '<h3 class="text-danger">Вы эксперт</h3>';
            break;
    }

    echo '<a href="logout.php">Выйти</a>';
?>