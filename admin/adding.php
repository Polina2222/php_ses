
<?php


if( isset($_POST['button']) && $_POST['button'] == 'Добавить сессию'){

    $mysqli = mysqli_connect('localhost', 'root', '', 'opros');
    mysqli_query($mysqli, 'SET NAMES UTF8');
    if( mysqli_connect_errno() ) // проверяем корректность подключения
        echo 'Ошибка подключения к БД: '.mysqli_connect_error();
// формируем и выполняем SQL-запрос для добавления записи
    $id = mysqli_query( $mysqli, 'SELECT id
    FROM   all_session   WHERE  id=(SELECT MAX(id) FROM all_session)');
    $sql_res=mysqli_query( $mysqli, '
    CREATE TABLE `'.$_POST['name'].'` (
      `id` int(11) NOT NULL,
      `question` varchar(1000) NOT NULL,
      `type` int(100) NOT NULL,
      `variants` varchar(1000) NOT NULL,
      `answere` varchar(1000) NOT NULL,
      `mark` int(255) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;' );
    while ($row = mysqli_fetch_assoc($id)){
        $sql_res=mysqli_query($mysqli, 'INSERT INTO all_session VALUES ("'.($row['id']+1).'",
        "'.htmlspecialchars($_POST['name']).'", 
        "'.htmlspecialchars(str_replace(' ', '', $_POST['links'])).'", 
        "1")');
    }
// если при выполнении запроса произошла ошибка – выводим сообщение
    if ( mysqli_errno($mysqli) )
        echo '<div class="error">Нельзя добавлять сессии с одинаковыми именами!</div>';
    else{ // если все прошло нормально – выводим сообщение
        echo '<div class="ok">Сессия добавлена</div>
        
        <input type="hidden" id="step" value="0">

        <div class="container">
        <div class="row">
            <div class="col-12 mt-4 align-middle">
        

        <h3> Теперь добавим вопросы</h3>
        Тип вопроса:
        <input type="hidden" id="nameSend" value="'.$_POST['name'].'">  
        
        <input type="radio" name="type" id="1" value="1" onclick="add(1)">
        Ответ(число)
        <input type="radio" name="type" id="2" value="2"  onclick="add(2)">
        Ответ(Положительное число)
        <input type="radio" name="type" id="3" value="3"  onclick="add(3)">
        Ответ(строка)
        <input type="radio" name="type" id="4" value="4"  onclick="add(4)">
        Ответ(текст)
        <input type="radio" name="type" id="5" value="5"  onclick="add(5)">
        Один выбор
        <input type="radio" name="type" id="6" value="6"  onclick="add(6)">
        Несколько выборов
        <div id="makeQ">

        </div>
        </div>
        </div>
        </div>';
    }
}else if (isset($_GET['type'])){
   
    $mysqli = mysqli_connect('localhost', 'root', '', 'opros');
    mysqli_query($mysqli, 'SET NAMES UTF8');
    if( mysqli_connect_errno() ) // проверяем корректность подключения
        echo 'Ошибка подключения к БД: '.mysqli_connect_error();
    
    $id = mysqli_query( $mysqli, 'SELECT id FROM '.$_GET['name'].' WHERE  id=(SELECT MAX(id) FROM '.$_GET['name'].')');
    if ( isset($_GET['step']) && $_GET['step']=='1222'){
        $sql_res=mysqli_query($mysqli, 'INSERT INTO '.$_GET['name'].' VALUES ("1",
        "'.htmlspecialchars($_GET['question']).'", 
        "'.htmlspecialchars($_GET['type']).'",  
        "'.htmlspecialchars($_GET['variants']).'",  
        "'.htmlspecialchars($_GET['answere']).'", 
        "'.htmlspecialchars($_GET['mark']).'")');
        echo 'here';
    }else{
    
        while ( $row = mysqli_fetch_assoc($id)){
            $sql_res=mysqli_query($mysqli, 'INSERT INTO '.$_GET['name'].' VALUES ("'.($row['id']+1).'",
            "'.htmlspecialchars($_GET['question']).'", 
            "'.htmlspecialchars($_GET['type']).'",  
            "'.htmlspecialchars($_GET['variants']).'",  
            "'.htmlspecialchars($_GET['answere']).'", 
            "'.htmlspecialchars($_GET['mark']).'")');
        }
    }
// формируем и выполняем SQL-запрос для добавления записи

    echo '
    <input type="hidden" id="nameSend" value="'.$_GET['name'].'">  
    <button type="button" onclick="addQ()">Добавить вопрос</button>';
    
}else{
    echo '

    
    <div class="container">
    <div class="row">
        <div class="col-12 mt-4 align-middle">
        <div class="addSession" id="addSession">
        <h3>Вначале создадим сессию:</h3>
        <form name="form_add" method="post" action="?add">
        <div class="form-group">
        
            <label for="exampleInputPassword1">Введите название сессии</label><br>
           
            <input type="text"  class="form-control" name="name" id="name" placeholder="Название сессии" required><br>
            <label for="exampleFormControlTextarea1">Введите ссылки через запятую</label>
          
            <textarea type="text"  class="form-control" rows="3" name="links" id="links" placeholder="Например: link1, link2" required></textarea><br>
         
            <input type="submit"  class="btn btn-primary" name="button" value="Добавить сессию">
      
            
        </div>
        </form>
        </div>
        </div>
        </div>
        </div>


    ';
}

?>

<div id="addQ">
</div>

<script>
    const q1 =`

<form action="" method="get">
    <input type="hidden" name="variants" value="0">
    <input type="hidden" name="type" value="1"> Придумайте вопрос:  
<input class="form-control" type="text" name="question" required>
 Введите ответ: 
<input type="text" class="form-control"  name="answere" pattern="^[-0-9]+$" required>
Начислите баллы:
<input type="text" class="form-control" name="mark" pattern="^[0-9]+$" required>
   
  
`;

    const q2 = `
<form action="" method="get">
    <input type="hidden" name="type" value="2">
    <input type="hidden" name="variants" value="0">
Вопрос:  
<input type="text" class="form-control" name="question" " required>
Ответ: 
<input type="text"class="form-control"  name="answere" pattern="^[0-9]+$" required>
Баллы:
<input type="text" class="form-control" name="mark" pattern="^[0-9]+$" required>
   
  `;
    const q3 = `
<form action="" method="get">
    <input type="hidden" name="variants" value="0">
    <input type="hidden" name="type" value="3">Вопрос:  
<input type="text" class="form-control"  name="question" =required>
Ответ: 
<input type="text" class="form-control" name="answere" pattern="^[А-Яа-яЁё/s]{1,30}" required>
Баллы:
<input type="text" class="form-control" name="mark" pattern="^[0-9]+$" required>
   
  `;
    const q4 = `
<form action="" method="get">
    <input type="hidden" name="variants" value="0">
    <input type="hidden" name="type" value="4">Вопрос:  
<input type="text" class="form-control" name="question" required>
Ответ: 
<input type="text" class="form-control" name="answere" required>
Баллы:
<input type="text" class="form-control"  name="mark" pattern="^[0-9]+$" required>
   
  `;
    const q5 = "llllll";
    const q6 = "lllllll";

    function add(type){
    const makeQ = document.getElementById('makeQ');
    if (document.getElementById('nameSend')){
    const name = document.getElementById('nameSend');

    inputName ='';
    if (document.querySelector('input#step')){
        inputName += '<input type="hidden" id="step" name="step" value="1222">'
    }
    inputName += `
    <input type="hidden" id="nameSend" name="name" value="${name.value}">
    <input type="submit" class="btn btn-primary mt-2" value="submit">  
    </form>`
    }

    
    console.log(inputName);
        if (type == 1)
            makeQ.innerHTML = q1 + inputName;
        else if (type == 2)
            makeQ.innerHTML = q2 + inputName;
        else if (type == 3)
            makeQ.innerHTML = q3 + inputName;
        else if (type == 4)
            makeQ.innerHTML = q4 + inputName;
        else if (type == 5)
            makeQ.innerHTML = q5 + inputName;
        else if (type == 6)
            makeQ.innerHTML = q6 + inputName;
    }
    

    const addQ =  () => {
        document.querySelector('#addQ').innerHTML = `
        Тип вопроса:
        <input type="radio" name="type" id="1" value="1" onclick="add(1)">
        Ответ(число)
        <input type="radio" name="type" id="2" value="2"  onclick="add(2)">
        Ответ(Положительное число)
        <input type="radio" name="type" id="3" value="3"  onclick="add(3)">
        Ответ(строка)
        <input type="radio" name="type" id="4" value="4"  onclick="add(4)">
        Ответ(текст)
        <input type="radio" name="type" id="5" value="5"  onclick="add(5)">
        Один выбор
        <input type="radio" name="type" id="6" value="6"  onclick="add(6)">
        Несколько выборов
        <div id="makeQ">
        </div>`
    }

</script>

