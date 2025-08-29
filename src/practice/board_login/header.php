<?php

session_start();
// session에 저장된 사용자 아이디(username)와 이름(name)를
// 병수에 저장
$flag = false;
if (isset($_SESSION["username"]) && isset($_SESSION["name"])){
    $username = $_SESSION["username"];
    $name = $_SESSION["name"];
    $flag = true;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if ($flag) {
    echo "환연합니다!" .$name ."님✨";
    } else {
        echo "안녕하세요! Gest님!";
    }
    ?>
</body>
</html>
