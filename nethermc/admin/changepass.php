
<?php
    session_start();
    if (!isset($_POST['changepass'])) {
        $_SESSION["error_changepass"] = "<span style='color: red;'>Musisz podac haslo! </span>";
        unset($_SESSION['success_changepass']);
    } else if (isset($_POST['changepass'])){
        $_SESSION["success_changepass"] = "<span style='color: green;'>Twoje haslo zostalo zmienione! </span>";
        unset($_SESSION['error_changepass']);
    }
    require_once "config.php";
$db_connect = @new mysqli($host, $db_user, $db_pass, $db_name);
if ($db_connect->connect_errno!=0) {
    echo "MySQL ERROR :(";
} else {
    $id = $_SESSION['user'];
    if ($rezultat = @$db_connect->query(("SELECT * FROM users where nickname='$id'"))) {
        $wiersz = $rezultat->fetch_assoc();
        $test =$_POST['changepass'];
        $test2 = $wiersz['pass'];
        $haslo_hash = password_hash($test, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET pass = REPLACE (pass, '$test2', '$haslo_hash') ";
        if ($rezultat = @$db_connect->query($sql)) {
            header('Location: userpanel');
        }

    }
}





?>