<?php
session_start();

$id = isset($_POST['id']) ? (int)($_POST['id']) : 0;
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$title = isset($_POST['title']) ? trim($_POST['title']) : '';
$content = isset($_POST['content']) ? trim($_POST['content']) : '';
$pw = isset($_POST['pw']) ? trim($_POST['pw']) : '';

// POST방식으로 id, name, title, content, pw를 받는다.
if ($id === '' || $name === '' || $title === ''
    || $content === '' || $pw === '') {
    $_SESSION['error'] = "모든 빌드를 입력하세요.";
    header("Location: edit.php?id=$id");
    exit;
}

// DB연결
require_once("./db_conn.php");
$db_conn = new mysqli(
    db_info::DB_HOST,
    db_info::DB_USER,
    db_info::DB_PASSWORD,
    db_info::DB_NAME
);

if ($db_conn->connect_errno) {
    $_SESSION['error'] = "DB연결 오류발생";
    header("Location: edit.php?id=$id");
    exit;
}

// id로 pw 가져오기
$pw_sql = "SELECT pw FROM posts WHERE id='$id'";
$pw_result = $db_conn->query($pw_sql);
$row = $pw_result->fetch_assoc();

// password_verify로 비밀번호 비교
// ** 맞으면 -> 수정 내용을 UPDATE
if (password_verify($pw, $row['pw'])) {

    $update_sql = " UPDATE posts SET name='$name', title='$title', 
                    content='$content', updated_at=NOW() WHERE id='$id'";

    $update_result = $db_conn->query($update_sql);
    if ($update_result) {
        header("Refresh: 2; URL='view.php?id=$id'");
        echo "수정이 완료 되었습니다.";
        exit;
    } else {
        header("Refresh: 2; URL='edit.php?id=$id'");
        echo "시스템 오류가 발생했습니다.";
        exit;
    }
    // ** 안 맞으면 -> 오류 메시지 표시 & edit.php로 이동하기
} else {
    $_SESSION['error'] = "비밀번호가 들렸습니다.";
    header("Location: edit.php?id=$id");
    exit;
}
