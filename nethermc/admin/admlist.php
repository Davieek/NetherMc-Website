<?php
session_start();
if (!isset($_SESSION['player_login'])) {
    header('Location: login');
    exit();
}

require_once "config.php";
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
echo '<link rel="icon" href='.$web_icon.' >';
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/adm-menu.css" type="text/css">
    <link rel="stylesheet" href="/../nethermc/css/fontello.css" type="text/css">
    <link rel="stylesheet" href="css/adm-panel.css" type="text/css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Strony | NetherMc</title>
</head>
<body>
<div class="web-center">
    <div class="menu">
        <div class="menu-title">
            <img src="https://cdn.discordapp.com/attachments/757684683654955121/885002724591140944/dsadsad.png" style="width: 80%">
        </div>
        <div class="menu-buttnos-box">
            <div class="user-box">
                <div class="user-img"><?php $img = $_SESSION['img']; echo '<img src='.$img.' style="height: 100%; border-radius: 50px;" id="player-avatar">'; ?></div>
                <div class="user-nickname"><?php echo $_SESSION['user']?> <a href="logout.php"><p class="passwordchange">wyloguj</p></a></div>
            </div>
            <hr class="user-hr">
            <div class="button"><a href="admpanel.php"><p class="icon-cog"> Ustawienia Strony</p></a></div>
            <div class="button"><a href="userprofile.php"><p class="icon-cog"> Profile Settings</p></a></div>
            <div class="button"><a href="admregulamin.php"><p class="icon-newspaper"> Regulamin</p></a></div>
            <div class="button"><a href="adm-news.php"><p class="icon-calendar-empty"> Nowości z serwera</p></a></div>
            <div class="button"><a href="admnotifications.php"><p class="icon-users"> Zgłoszenia</p></a></div>
            <div class="button1"><p class="icon-cog"> Administracja</p></div>
            <hr class="button-hr">


        </div>
    </div>
</div>

</body>
</html>