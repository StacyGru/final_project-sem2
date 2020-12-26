<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Twist Master</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style>
            <?php
            require "style.css";
            ?>
            </style>
        </head>
    <body>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand text-info" href="/">Twist Master</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">

                <li class="nav-item">
                    <a class="nav-link" href="/">Главная</a>
                    </li>

                <li class="nav-item">
                    <a class="nav-link" href="/stories.php">Работы</a>
                    </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Рейтинг участников</a>
                    </li>

                <li class="nav-item active"></li>
                    <?php
                    if (isset($_COOKIE))
                        echo '<a class="nav-link pers_cab" href="/personal.php" style="color: #ffbb33;">Личный кабинет</a>';
                    else
                        echo '<a class="nav-link pers_cab" href="/login.php" style="color: #ffbb33;">Авторизация</a>';
                    ?>
                    </li>
                </ul>

              <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Поиск по сайту" aria-label="Search">
                    <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Поиск</button>
                    </form>
                </div>
            </nav>

        <div class="container">
            
            <div class="row justify-content-center">
                
                <div class="col-sm-4 text-center">
                
            <?php
              
                if (!isset($_POST['entrance']))
                    echo '<h1 class="text-dark">Авторизация</h1>
                        <form name="entrance" class="form-group" method="post">
                        <input type="text" id="nickname" name="nickname" placeholder="Логин" class="form-control"></input><br>
                        <input type="password" id="password" name="password" placeholder="Пароль" class="form-control"></input><br>
                        <input type="radio" name="user_type" id="author" value="author" class="form-check-radio"></input> <label for="author">Я автор</label><br>
                        <input type="radio" name="user_type" id="reader" value="reader" class="form-check-radio"></input> <label for="reader">Я читатель</label><br>
                        <input type="radio" name="user_type" id="expert" value="expert" class="form-check-radio"></input> <label for="expert">Я эксперт</label><br>
                        <input type="submit" name="entrance" value="Войти" class="btn btn-outline-warning" style="margin-top: 10px;">
                        </form>';

                if (isset($_POST['entrance']))
                {
                    $mysqli = mysqli_connect ('std-mysql', 'std_940', '12345678', 'std_940');
            
                    if (mysqli_connect_errno()) // если не удаётся подключиться выводим сообщение
                        return 'Ошибка подключения к БД: '.mysqli_connect_error();

                    // $_POST['nickname'] SELECT password FROM std_940.authors WHERE nickname = 'Osinka_Iudushki';

                    $user_type = $_POST['user_type'];
                    $nickname = $_POST['nickname'];
                    $password = $_POST['password'];

                    $sql_res = mysqli_query($mysqli, "SELECT password FROM std_940.{$user_type}s WHERE nickname = '{$nickname}' LIMIT 1;");

                    $row = mysqli_fetch_row($sql_res);

                    if (isset($_SESSION['user_id']))
                        echo htmlspecialchars($_SESSION['user_login']).', вы уже авторизованы';


                    if (empty($sql_res))
                
                        echo '<h1 class="text-dark">Авторизация</h1>
                            <form name="entrance" class="form-group" method="post">
                            <input type="text" id="nickname" name="nickname" placeholder="Логин" class="form-control"></input><br>
                            <input type="password" id="password" name="password" placeholder="Пароль" class="form-control"></input><br>
                            <input type="radio" name="user_type" id="author" value="author" class="form-check-radio"></input> <label for="author">Я автор</label><br>
                            <input type="radio" name="user_type" id="reader" value="reader" class="form-check-radio"></input> <label for="reader">Я читатель</label><br>
                            <input type="radio" name="user_type" id="expert" value="expert" class="form-check-radio"></input> <label for="expert">Я эксперт</label><br>
                            <input type="submit" name="entrance" value="Войти" class="btn btn-outline-warning" style="margin-top: 10px;">
                            </form>
                            <span style="color: red;">Неверный логин!</span>'.mysqli_error($mysqli);
                    else
                        if ($password != $row[0])
                        {
                            echo '<form name="entrance" class="form-group" method="post">
                                <input type="text" id="nickname" name="nickname" placeholder="Логин" class="form-control"></input><br>
                                <input type="password" id="password" name="password" placeholder="Пароль" class="form-control"></input><br>
                                <input type="radio" name="user_type" id="author" value="author" class="form-check-radio"></input> <label for="author">Я автор</label><br>
                                <input type="radio" name="user_type" id="reader" value="reader" class="form-check-radio"></input> <label for="reader">Я читатель</label><br>
                                <input type="radio" name="user_type" id="expert" value="expert" class="form-check-radio"></input> <label for="expert">Я эксперт</label><br>
                                <input type="submit" name="entrance" value="Войти" class="btn btn-outline-warning" style="margin-top: 10px;">
                                </form>
                                <span style="color: red;">Неверный пароль!</span>';
                        }
                        else
                        {                         
                            
                            
                            $sql_res = mysqli_query($mysqli, "SELECT id FROM std_940.{$user_type}s WHERE nickname = '{$nickname}' LIMIT 1;");

                            $row = mysqli_fetch_row($sql_res);



                            
                            $_SESSION['user_login'] = $nickname;
                            $_SESSION['user_password'] = $password;
                            $_SESSION['user_type'] = $user_type;
                           
                            //ставим куки и время их хранения 10 дней
                            setcookie("Cookie", $row[0], time()+60*60*24*10);

                            // БЕЗ ХЕША И АЙПИ

                            echo '</div></div>';
                            require 'personal.php';
                                                   
                        }
                       
                }
                ?>
                    
                
                
            </div>

            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        </body>
    </html>

