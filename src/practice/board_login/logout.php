<?php
// session 활성화
session_start();

// session 변수 초기화
$_SESSION = [];

// sessionID를 처장하는 쿠키를 삭제
// ini정보를 읽기
if (ini_get("session.use_cookies")) {
    // 현재 세션용 쿠키 설정을 배열로 취득
    $params = session_get_cookie_params();
    setcookie(
        session_name(),     // 쿠키명
        '',                 // 값을 비우기
        time() - 42000,     // 시간을 과거로 설정
        $params['path'],    // 쿠키 유호 파스
        $params['domain'],  // 쿠키 유호 도매인
        $params['secure'],  // HTTPS일 때만 전성
        $params['httponly'] // JavaScript에서 접근 불가
    );
}

// 서버 쪽 session데이터를 삭제
session_destroy();

// login.php로 가기
header("Refresh: 2; URL='login.php'");
echo "로그아웃 중입니다.";


?>