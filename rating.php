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
                    <a class="nav-link" href="/index">Главная</a>
                    </li>

                <li class="nav-item">
                    <a class="nav-link" href="/stories.php">Работы</a>
                    </li>

                <li class="nav-item active">
                    <a class="nav-link" href="/rating.php">Рейтинг участников<span class="sr-only">(current)</span></a>
                    </li>

                <li class="nav-item"></li>
                    <a class="nav-link pers_cab" href="/login.php">Личный кабинет</a>
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
                    
                            $sql_rate = mysqli_query($mysqli, "SELECT * FROM authors RIGHT JOIN stories USING(id) ORDER BY score DESC;");  // запрос на рейтинг по кол-ву баллов

                            if (!mysqli_errno($mysqli))
                            {
                                echo '<table rules="all" class="table">';   // начало таблицы БД
                                echo '<tr><th>Место в рейтинге</th>
                                    <th>Количество очков</th>
                                    <th>Автор</th></tr>';

                                $i = 1;

                                while ($row = mysqli_fetch_assoc($sql_rate)) // пока есть записи
                                {                                           // выводим каждую запись как строку таблицы
                                    echo '<tr><td>'.$i.'</td>
                                        <td>'.$row['score'].'</td>
                                        <td>'.$row['nickname'].'</td></tr>'; 
                                    $i++;
                                }
                                echo '</table>'; // конец таблицы
                            }
                            
                        ?>
                </div>
                    </div>
                        </div>

            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        </body>
    </html>

