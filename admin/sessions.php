<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table{
            display: block;
            margin-left: 600px;
        }
        th, td{
        
            padding: 10px;

        }
        th{
            background-color:  #e3f2fd;
            color: black;
        }
        td{
            background-color: white;
        }
    </style>
</head>
<body>
    
</body>
</html>
<?php


function getSessions(){
   
    $mysqli = mysqli_connect('localhost', 'root', '', 'opros');
    
    mysqli_query($mysqli, 'SET NAMES UTF8');

    if (!$mysqli){
        echo "Sorry <br>";
        echo mysqli_connect_error();
        exit();
    }

    if( mysqli_connect_errno() ) // проверяем корректность подключения
        return 'Ошибка подключения к БД: '.mysqli_connect_errno();

    // формируем и выполняем SQL-запрос 
    $sql_res=mysqli_query($mysqli, 'SELECT * FROM all_session');
    
    if (!(mysqli_errno($mysqli))){
        $row=mysqli_fetch_row($sql_res);
        if( !$row ) // если в таблице нет записей
            return 'В таблице нет данных'; // возвращаем сообщение
        
        
        $serial = 0;
        $ret='<main><table>
        <th>ID</th>
        <th>Title</th>
        <th>links</th>
        <th>Status</th>
    </tr>'; // строка с будущим контентом страницы
        while ($row = mysqli_fetch_assoc($sql_res)) {
            $serial++;
            $ret.='<tr><td class="serial">'.$serial.'</td><td>'.$row['name'].'</td><td>'.$row['links'].'</td><td>'.$row['status'].'</td><td>Протоколы</td><td> <a href="?sessions&disable='.$row['id'].'">Отключить</a></td><td><a href="?sessions&delete='.$row['id'].'">Удалить</a></td></tr>';
        }
        $ret.='</table></main>'; // заканчиваем формирование таблицы с контентом
        return $ret;
    }
}

if (isset($_GET['disable']) && $_GET['disable'] != null &&  $_GET['disable'] != ''){

    $disable = mysqli_query($mysqli, 'UPDATE all_session SET `status`=2 WHERE id = '.$_GET['disable'].'');
    echo 'Отключено'; // и выводим сообщение об изменении данных
}

if (isset($_GET['delete']) && $_GET['delete'] != null &&  $_GET['delete'] != ''){
    // $res_del = mysqli_query($mysqli, 'SELECT * FROM all_sessions WHERE id = '.$_GET['delete'].'');
    // while ($row = mysqli_fetch_assoc($res_del)) {
        
    // }
    $delete = mysqli_query($mysqli, 'DELETE FROM all_session WHERE id = '.$_GET['delete'].'');
    echo 'Удалено'; // и выводим сообщение об изменении данных
}

?>