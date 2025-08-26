<?php

session_start();

// POST방식으로 id를 처리
$id = isset($_POST['id']) ? (int)($_POST['id']) : '';
if ($id === ''){
    $_SESSION['error'] = "시스템 오류 발생";
    header("Refresh: 2; URL='delete.php'");
    exit;
}

// POST방식으로 pw를 처리
$pw = isset($_POST['pw']) ? trim($_POST['pw']) : '';
if ($pw === '') {
    $_SESSION['error'] = "비밀번호를 입력하세요.";
    header("Location: delete.php?id=$id");
    exit;
}

// DB연결
require_once("./db_conn.php");
$db_conn = new mysqli (
    db_info::DB_HOST,
    db_info::DB_USER,
    db_info::DB_PASSWORD,
    db_info::DB_NAME
);

// DB연결 오류 발생 시 delete화면으로 이동
if ($db_conn->connect_errno) {
    header("Refresh: 2; URL='delete.php'");
    echo "데이터 베이스 연결 오류 발생";
    exit;
}

// DB에서 비밀번호 가져 오기 (SELECT)
$pw_sql = "SELECT pw FROM posts WHERE id='$id'";
$result_pw = $db_conn->query($pw_sql);
$row = $result_pw->fetch_assoc();

// 비밀번호 초회 
if (password_verify($pw, $row['pw'])) {
    // ** 맞으면 글을 삭제 (DELETE)
    $del_sql = "DELETE FROM posts WHERE id='$id'";
    $del_result = $db_conn->query($del_sql);

    // 삭제 성공하면 목록에 이동하기
    if ($del_result) {
        header("Refresh: 2; URL='index.php'");
        echo "삭제가 완료되었습니다.목록의 이동합니다.";
        exit;
    } else {
        header("Refresh: 2; URL='delete.php'");
        echo "삭제 못 했습니다. 다시 한번 실행해보세요.";
        exit;
    }
// ** 안 맞으면 오류 메시지 출력 delete.php 로 이동
} else {
    $_SESSION['error'] = "비밀번호가 들렸습니다.";
    header("Location:delete.php");
    exit;
}

?>