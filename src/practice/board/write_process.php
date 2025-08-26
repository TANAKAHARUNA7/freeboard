<?php
session_start();
// 1. 입력 값을 POST로 처리
// 이름
// 제목
// 내용
// 비밀번호
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$title = isset($_POST['title']) ? trim($_POST['title']) : '';
$content = isset($_POST['content']) ? trim($_POST['content']) : '';
$pw = isset($_POST['pw']) ? trim($_POST['pw']) : '';

// **공백이 있으면 -> 오류 표시 + “write.php”로 이동
if ($name === '' || $title === '' || $content === '' || $pw === '') {
    $_SESSION['error'] = "모든 빌드를 입력하세요.";
    header("Location: 'write.php'");
    exit;
} 

// PW 해시 처리
$pw_hash = password_hash($pw, PASSWORD_DEFAULT);
// DB연결하기
require_once("./db_conn.php");

$db_conn = new mysqli(
    db_info::DB_HOST,
    db_info::DB_USER,
    db_info::DB_PASSWORD,
    db_info::DB_NAME
);

if ($db_conn->connect_errno) {
    $_SESSION['error'] = "DB연결 오류가 발생했습니다.";
    header("Location: 'write.php'");
    exit;
}

//  DB에 INSERT
$sql = " INSERT INTO posts (id, title, name, pw, content, created_at)
        VALUES (NULL, '$title', '$name', '$pw_hash', '$content', NOW())";
$result = $db_conn->query($sql);

// 성공하면 목록으로 이동
if ($result) {
    header("Refresh: 2; URL='index.php'");
    echo "글쓰기 완료 됐습니다.";
    exit;
} else {
    header("Refresh: 2; URL='write.php'");
    echo "시스템 오류가 발생했습니다.";
    exit;
}



