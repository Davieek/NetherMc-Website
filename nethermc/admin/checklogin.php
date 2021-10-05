<?php 
    session_start();

    if ((!isset($_POST['username'])) || (!isset($_POST['pass']))) {
        header('Location: login');
    
    }
    require_once "config.php";

    $db_connect = @new mysqli($host, $db_user, $db_pass, $db_name);
    if ($db_connect->connect_errno!=0) {
        echo "MySQL ERROR :(";
    } else {
        $login = $_POST['username'];
        $haslo =  $_POST['pass'];
        $login = htmlentities($login, ENT_QUOTES, "UTF-8");
        if ($rezultat = @$db_connect->query(
            sprintf("SELECT * FROM users WHERE nickname='%s'", 
            mysqli_real_escape_string($db_connect,$login)))) {
            $all_users = $rezultat->num_rows;
            if ($all_users>0) {
                $wiersz = $rezultat->fetch_assoc();
                $pass_verify = password_verify($haslo, $wiersz['pass']);
                if ($pass_verify) {
                    $_SESSION['player_login'] = true;
                    $_SESSION['user'] = $wiersz['nickname'];
                    $_SESSION['ranks'] = $wiersz['rangs'];
                    $_SESSION['img'] = $wiersz['mcavatar'];
                    unset($_SESSION['error_login']);
    
                    $rezultat->free();
                    header('Location: webpanel');
                } else {
                    $_SESSION["error_login"] = "<span style='color: red;'>Nieprawidłowe dane. </span>";
                    header('Location: login');
                }
            } else {
                $_SESSION["error_login"] = "<span style='color: red;'>Nieprawidłowe dane. </span>";
                header('Location: login');

            }
        }
    }


?>