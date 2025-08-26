<?php
session_start();
// 1. POST 요청 처리
// ID : user_id
// PW : password
$user_id = isset($_POST["userid"]) ? trim($_POST["userid"]) : '';
$pw = isset($_POST["pw"]) ? trim($_POST["pw"]) : '';

// 2. 유호성 검사
// **유호하지 않는 경우 ->  login.php로 리디렉션 + 오류 표시
if ($user_id === '' || $pw === '') {
    $_SESSION["error"] = "모든 빌드를 입력하세요.";
    header("Location: login.php");
    exit;
}

// DB접속
require_once("./db_conf.php");
$db_conn = new mysqli(
    db_info::DB_HOST,
    db_info::DB_USER,
    db_info::DB_PASSWORD,
    db_info::DB_NAME
);

if ($db_conn->connect_errno) {
    $_SESSION["error"] = "DB접속 오류가 발생했습니다.";
    header("Location: login.php");
    exit;
}

// **유호하는 경우
// DB에서 해당 아이디 조회 (SELECT)
$check_sql = "SELECT * FROM user WHERE user_id='$user_id'";
$check_result = $db_conn->query($check_sql);
$row = $check_result->fetch_assoc();

// 3. DB에서 입력된 아이디 존재 여부 확인
// 아이디 존재하는 경우
if ($check_result && $check_result->num_rows > 0) {
    // password_verify()로 비밀번호 해시값 비교
    if (password_verify($pw, $row["pw"])) {
        // **비교 O -> 세션 생성 + 사용자 정보 저장
        $_SESSION["userid"] = $row["user_id"];
        $_SESSION["name"] = $row["name"];
        $_SESSION["success"] = "로그인 성공했습니다";

        // 5. welcome.php로 이동
        header("Location: welcome.php");
        exit;

        // **비교 X -> login.php로 리디렉션 + 오류 표시
    } else {
        $_SESSION["error"] = "로그인 실배했습니다.";
        header("Location: login.php");
        exit;
    }
}
