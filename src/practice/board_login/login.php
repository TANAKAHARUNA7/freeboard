<?php
session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인</title>
</head>
<body>
    <?php
    if(isset($_SESSION["error"])){
        echo htmlspecialchars($_SESSION["error"]);
        unset($_SESSION["error"]);
    }
    ?>
    <h1>로그인</h1>
        <!-- 
        아이디
        비밀번호
        입력 받음
         -->
    <form action="login_process.php" method="post">
    <fieldset>
        <legend>
            정보를 입력하세요
        </legend>
        아이디: <input type="text" name="username"><br>
        비밀번호: <input type="password" name="pw"><br>
        <button>로그인</button>
    </fieldset>
    </form>
    
</body>
</html>