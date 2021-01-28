
<?php
    session_start();
 
    $mysqli = mysqli_connect('localhost', 'root', '', 'opros');
    

    if ( !isset($_SESSION['user']) && isset($_POST['password'])){

        if ( $_POST['password'] == '12345' ){
            $_SESSION['user']= 1;
            header('Location: index.php ', true, 303);
        }else{
            echo '<h3 class="error">Введен неверный пароль</h3>';
        }

    }else
    if (!isset($_SESSION['user'])){
        if (isset($_GET['sign'])){
            require "sign.php";
        }else{
            require "expert/header.php";
        }
    }else{
        require 'admin/header.php';
        
        if ( isset($_GET['adding']) ){
            include 'admin/adding.php';
        }else
        if ( isset($_GET['sessions']) ){
            include 'admin/sessions.php';
            echo getSessions();
        }else{
            include 'admin/adding.php';
        }
        
        if (isset($_GET['logout'])){
            session_unset();
            header('Location: index.php', true, 303);
        }
    }


    

?>