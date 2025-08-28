<?php
session_start();
// 세션을 통해 로그인 여부 확인
// 로그인된 사용자의 이름 표시 & 환영 메시지 출력
if (isset($_SESSION["username"]) && isset($_SESSION["name"])) {
    echo "환영합니다! " . htmlspecialchars($_SESSION["name"]) . "님✨";
} else {
    $_SESSION["error"] = "로그인 해주세요.";
    header("Location: login.php");
    exit;
}

?>
<!-- // 로그아웃 버튼 제공 -->
<br><br>
<a href="logout.php">로그아웃</a>