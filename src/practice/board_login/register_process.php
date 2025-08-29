<?php
// session을 사용하기 위해 
session_start();

// POST 요청 처리
// ID : userID
// PW : password
// Name : name
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$pw = isset($_POST['pw']) ? trim($_POST['pw']) : '';
$name = isset($_POST['name']) ? trim($_POST['name']) : '';

// 유호성 검사 (공백)
// ** 유호하지 않으면 register.php로 리디렉션 + 오류 메시지 표시
if ($username === '' || $pw === '' || $name === '') {
    $_SESSION["error"] = "모든 빌드를 입력하세요.";
    header("Location: register.php");
    exit;
}

// 데이터베이스 접속 설정을 클래스 형태로 정의 
// 호스트명
// 사용자명
// 비밀번호
// DB 이름
require_once("./db_conf.php");

// DB접속 안되면 오류 메시지 출력
if ($db_conn->connect_errno) {
    $_SESSION["error"] = "DB접속 오류 발생";
    header("Location: register.php");
    exit;
}

// 중복된 id 유무를 검사
$check_sql = "SELECT username FROM users WHERE username='$username'";
$check_result = $db_conn->query($check_sql);

// ** 중복되지 않는 경우 
if($check_result && $check_result->num_rows === 0){    
    // 1.비밀번호를 해시 처리
    $pw_hash = password_hash($pw,PASSWORD_DEFAULT);

    // 2.DB에 저장INSERT
    $insert_sql = "INSERT INTO users ( name, username, pw) 
    VALUES ('$name', '$username', '$pw_hash')";

    $insert_result = $db_conn->query($insert_sql);

    // 오류 처리
    if (!$insert_result) {
        $_SESSION["error"] = "시스템 오류가 발생했습니다.";
        header("Location: register.php");
        exit;
    }

    // 3.login.php로 리디렉션 + 회원가입 성공 메시지 표시
    $_SESSION["success"] = "회원가입 성공했습니다.";
    header("Location: login.php");
    exit;

} else {
    // ** 중복되는 경우
    // register.php로 리디렉션 + 오류 메시지 표시
    $_SESSION["error"] = "중복되는 ID입니다.";
     header("Location: register.php");
}

?>