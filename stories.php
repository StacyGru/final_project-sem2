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

                <li class="nav-item active">
                    <a class="nav-link" href="#">Работы<span class="sr-only">(current)</span></a>
                    </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Рейтинг участников</a>
                    </li>

                <li class="nav-item"></li>
                    <a class="nav-link pers_cab" href="/login.php" style="color: #ffbb33;">Личный кабинет</a>
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
                <div class="col-sm-10">
                    

                    <?php
                        $mysqli = mysqli_connect ('std-mysql', 'std_940', '12345678', 'std_940');   // подключение к БД
                        
                        if (mysqli_connect_errno())
                            return 'Ошибка подключения к БД: '.mysqli_connect_error();
                
                        $sql_count = mysqli_query($mysqli, "SELECT COUNT(*) FROM stories;");  // запрос на кол-во записей
                        
                        if (!mysqli_errno($mysqli)) 
                        {
                            $count = mysqli_fetch_row($sql_count);   
                            $rows_count = $count[0];    // количество записей         

                            $sql_rows = mysqli_query($mysqli, "SELECT * FROM stories;");    // запрос на содержание всех записей
                            
                            while ($rows = mysqli_fetch_assoc($sql_rows))
                            {
                                $authors_sql = mysqli_query($mysqli, "SELECT nickname FROM authors WHERE id = '{$rows['author_id']}';");
                                $authors_arr = mysqli_fetch_row($authors_sql);   
                                $authors = $authors_arr[0];
                                $categories = $rows['category'];
                                $scores = $rows['score'];
                                $stories = $rows['story'];
                                echo '<div>
                                    <span class="text-success">Автор: '.$authors.'</span><br>
                                    <span class="text-info">Категория: '.$categories.'</span><br>
                                    <span class="text-danger">Количество баллов: '.$scores.'</span>
                                    <p class="text-secondary">'.$stories.'</p>
                                    </div><br>';
                            }

                               
                         
                               
                        
                        }
                        return 'Некорректный запрос';    // если запрос некорректный то вывести ошибку
                        
                    ?>

                    </div>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        </body>
    </html>

