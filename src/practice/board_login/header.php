<?php
// session에 아이디 & 이름이 저장되어 있는지 확인
// 로그인한 User -> 이름 & 아이디 표시
if (!empty($_SESSION["name"]) && !empty($_SESSION["username"])) {
    echo "환영합니다! " . 
         htmlspecialchars($_SESSION["name"]) . "님✨";
    exit;
} else {
    echo "안녕하세요! Gest님! ";
    echo "<br>";
    echo "<button><a href='login.php'>로그인</a></button>";
    echo "<button><a href='register.php'>회원가입</a></button>";
    exit;
}

?>