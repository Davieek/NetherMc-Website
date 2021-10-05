<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/login.css" type="text/css">
    <link rel="stylesheet" href="/css/fontello.css" type="text/css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php    require_once "config.php";

    $db_connect = @new mysqli($host, $db_user, $db_pass, $db_name);
    if ($db_connect->connect_errno!=0) {
        echo "MySQL ERROR :(";
    } else {
        if ($rezultat = @$db_connect->query(("SELECT * FROM web_icon"))) {
            $all_users = $rezultat->num_rows;
            $wiersz = $rezultat->fetch_assoc();
            $_SESSION['webimg'] = $wiersz['webicon'];

        }
    }
    $web_icon = $_SESSION['webimg'];
    echo '<link rel="icon" href='.$web_icon.' >';?>
    <title>Logowanie | NetherMc</title>

</head>
<body>
    <div class="web-center">
        <div class="web-panel">
            <div class="web-panel-box">
                <div class="web-panel-img">
                    <img src="https://cdn.discordapp.com/attachments/757684683654955121/886887013087846410/32132131.png" style="width: 100%">
                </div>
                <div class="web-panel-logins">
                    <form action="checklogin.php" method="POST">
                        <div class="web-options-panel-login-box">
                            <span>Username:</span><br>
                            <input type="text" id="login-box" name="username"><br><br>
                            <span>Password:</span><br>
                            <input type="password" id="login-box" name="pass"><br><br>
                            <input type="submit" value=" Login " id="button-login">
                            <?php if (isset($_SESSION['error_login'])) echo $_SESSION['error_login']; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>