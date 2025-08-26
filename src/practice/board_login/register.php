<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>
</head>
<body>
    <?php
    if (isset($_SESSION["error"])) {
        echo htmlspecialchars($_SESSION["error"]);
        unset($_SESSION["erro"]);
    };
    ?>

    <!--// 아이디
        // 비밀번호
        // 이름
    입력 받는 HTML 폼 구성 -->
    <h1>회원가입</h1>
    
    <form action="register_process.php" method="post">
        <fieldset>
            <legend>
                정보를 입력하세요
            </legend>
            아이디: <input type="text" name="userid"><br>
            비밀번호: <input type="password" name="pw"><br>
            이름: <input type="text" name="name"><br>
            <button>회원가입</button>
        </fieldset>
    </form>
    
</body>
</html>