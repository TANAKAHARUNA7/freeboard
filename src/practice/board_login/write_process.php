<?php
// 입력 값을 POST로 처리
// 제목 과 내용
$title = isset($_POST["title"]) ? trim($_POST["title"]) : '';
$content = isset($_POST["content"]) ? trim($_POST["content"]) : '';

// 유호한 입력인지 확인
// 공백이 있음 오류 표시 + “write.php”로 이동
if ($title === '' || $content === '') {
    $_SESSION["error"] = "모든 빌드를 입력하세요.";
    header("Location: write.php");
    exit;
}




?>