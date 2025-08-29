<?php
session_start();

// 입력 값을 POST로 처리
// 제목 과 내용
$title = isset($_POST["title"]) ? trim($_POST["title"]) : '';
$content = isset($_POST["content"]) ? trim($_POST["content"]) : '';
$id = $_SESSION["id"];

// 유호한 입력인지 확인
// 공백이 있음 오류 표시 + “write.php”로 이동
if ($title === '' || $content === '') {
    $_SESSION["error"] = "모든 빌드를 입력하세요.";
    header("Location: write.php");
    exit;
}

// DB연결하기
require_once("./db_conf.php");

// DB연결오류 발생 시 오류메시지 출력
if ($db_conn->connect_errno) {
    $_SESSION["error"] = "DB연겨 오류 발생";
    header("Location: write.php");
    exit;
}

// DB에 INSERT
$insert_sql = "INSERT INTO posts (userid, title, content, created_at) 
            VALUES ('$id', '$title', '$content', NOW())";
$insert_result = $db_conn->query($insert_sql);

// INSERT 성공 시 오류 발생 시 오류메시지 출력
if ($insert_result){
    // list.php로 이동
    header("Refresh: 2; URL='list.php'");
    echo "글을 작성했습니다. 목록에 이동하겠습니다.";
    exit;
} else {
    $_SESSION["error"] = "글 작성 실패했습니다.";
    header("Locatiom: write.php");
    exit;
}

?>