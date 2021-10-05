<?php
    $haslo = "tesdt";
    $hash_haslo = password_hash($haslo, PASSWORD_DEFAULT);
    echo $hash_haslo;
?>