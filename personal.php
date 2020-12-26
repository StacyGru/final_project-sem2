<?php      
    switch ($_SESSION['user_type']) 
    {
        case 'author':
        {                                                               // открытие 
            echo '<div class="row justify-content-center">  
            <h1 class="text-dark text-center">Личный кабинет</h1>
            <div class="col-sm-10">
                <h3 class="text-success">Вы автор</h3>
                <h4 class="text-success text-dark">Ваши работы</h4>';

            $mysqli = mysqli_connect ('std-mysql', 'std_940', '12345678', 'std_940');

            $authors_sql = mysqli_query($mysqli, "SELECT id FROM authors WHERE nickname = '{$_SESSION['user_login']}';");
            $authors_arr = mysqli_fetch_row($authors_sql);   
            $authors = $authors_arr[0];

            $sql_rows = mysqli_query($mysqli, "SELECT * FROM stories WHERE author_id = '{$authors}';");
            while ($rows = mysqli_fetch_assoc($sql_rows))
            { 
                $categories = $rows['category'];
                $scores = $rows['score'];
                $stories = $rows['story'];
                echo '
                    <div>
                    <span class="text-success">Автор: '.$_SESSION['user_login'].'</span><br>
                    <span class="text-info">Категория: '.$categories.'</span><br>
                    <span class="text-danger">Количество баллов: '.$scores.'</span>
                    <p class="text-secondary">'.$stories.'</p>
                    </div>
                    </div>
                    
                    <a href="logout.php" class="btn btn-outline-success" style="margin: 20px;">Добавить работу</a>
                    <a href="logout.php" class="btn btn-outline-danger" style="margin: 20px;">Выйти</a>
                    </div>
                    ';    // закрытие row
            }
            break;
        }
        case 'reader':
        {
            echo '<div class="row justify-content-center">  
            <h1 class="text-dark">Личный кабинет</h1>
            <div class="col-sm-10 text-center">
            <h3 class="text-info">Вы читатель</h3><br>
            <a href="logout.php" class="btn btn-outline-primary" style="margin: 10px;">Проголосовать баллами</a>
            <a href="logout.php" class="btn btn-outline-info" style="margin: 10px;">Оставить отзыв</a>
            <a href="logout.php" class="btn btn-outline-danger" style="margin: 10px;">Выйти</a>
            </div>
            </div>';
            break;
        }
        case 'expert':
        {
            echo '<div class="row justify-content-center">  
            <h1 class="text-dark">Личный кабинет</h1>
            <div class="col-sm-10 text-center">
            <h3 class="text-danger">Вы эксперт</h3><br>
            <a href="logout.php" class="btn btn-outline-primary" style="margin: 10px;">Проголосовать звёздами</a>
            <a href="logout.php" class="btn btn-outline-info" style="margin: 10px;">Оставить отзыв</a>
            <a href="logout.php" class="btn btn-outline-danger" style="margin: 10px;">Выйти</a>
            </div>
            </div>';
            break;
        }
    }


?>