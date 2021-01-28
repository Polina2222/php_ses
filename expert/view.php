

<?php
    
    $mysqli = mysqli_connect('localhost', 'root', '', 'opros');

    
    mysqli_query($mysqli, 'SET NAMES UTF8');

    if (!$mysqli){
        echo "Sorry <br>";
        echo mysqli_connect_error();
        exit();
    }

    if( mysqli_connect_errno() ) // проверяем корректность подключения
        return 'Ошибка подключения к БД: '.mysqli_connect_errno();
    
    $sql_res=mysqli_query($mysqli, 'SELECT * FROM all_session WHERE status = 1');



    if (isset($_GET['session']) && $_GET['session'] != null && $_GET['session'] != ''){
        $row=mysqli_fetch_row($sql_res);
        while ($row=mysqli_fetch_assoc($sql_res)){
            $links = makeLinks($row['links']);
            for ($i = 0; $i < count($links); $i++){
                if ($links[$i] == $_GET['session']){
                    
                    echo '
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="../index.php">Zaplatina:)</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                        
                        <li class="nav-item">
                        <a class="nav-link" href="view.php">Поиск сессий</a>
                        </li>
                       
                        
                        </ul>

  </div>
</nav>
                   
                    <h2>'.$row['name'].'</h2>';
                    
                    $sql_res=mysqli_query($mysqli, 'SELECT * FROM '.$row['name']);
                    $outPut = '<form method="post">';
                    $number = 0;
                    while ($row = mysqli_fetch_assoc($sql_res)){
                        $number++;
                        $outPut .= '<div class="question">'.$number.'  Вопрос: '.$row['question'].'<br> Ваш ответ: '.setInput($row['type']).'</div>';
                    }
                    $outPut .= ' <input type="submit" name="submit" value="Отправить"></form>';
                    echo $outPut;
                    
                    exit();
                }
            }
        }
        echo ' 
        <header>
        <a href="view.php">Поиск сессий</a>

        </header>
        <h3>Не найдено</h3> <br>
               
<div class="container">
<div class="row">
    <div class="col-12 mt-4 align-middle">
        <form action="" method="GET">
            <input type="text" name="session" class="form-control" placeholder="Введите ссылку на сессию">
            <input type="submit"  class= "btn btn-primary" value="Найти">
        </form>
        </div>
        </div>
        </div>';

    }else{
        echo '
        
<div class="container">
<div class="row">
    <div class="col-12 mt-4 align-middle">
        <form action="" method="GET">
            <input type="text" name="session" class="form-control" placeholder="Введите ссылку на сессию">
            <input type="submit"  class= "btn btn-primary" value="Найти">
        </form>
        </div>
        </div>
        </div>';
    }

    function makeLinks($str){
        $str = explode(",", $str);
        return $str;
    }

    function setInput($type){
        if ($type == 1)
            return '<input type="text" name="answere" pattern="^[-0-9]+$" required>';
        else if ($type == 2)
            return '<input type="text" name="answere" pattern="^[0-9]+$" required>';
        else if ($type == 3)
            return '<input type="text" name="answere" pattern="^[А-Яа-яЁё/s]{1,30}" required>';
        else if ($type == 4)
            return '<input type="text" name="answere" pattern="^[А-Яа-яЁё/s]{1,255}" required>';
        else if ($type == 5)
            return '<input type="text" name="answere" pattern="^[А-Яа-яЁё/s]{1,255}" required>';
        else if ($type == 6)
            return '<input type="text" name="answere" pattern="^[0-9]+$" required>';
    }
?>
