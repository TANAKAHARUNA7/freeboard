<?php
session_start();

// session을 사용하고 로그인한 유자인지 확인
if (isset($_SESSION["name"]) && isset($_SESSION["username"])) {
    $name = $_SESSION["name"];
    $username = $_SESSION["username"];
} 
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글쓰기</title>
</head>
<body>
<?php
    // 미입력이 있으면 오류표시
    if (isset($_SESSION["error"])) {
        echo htmlspecialchars($_SESSION["error"]);
        unset($_SESSION["error"]);
    }
?>

<h1>게시판 > 글쓰기</h1>
<?= $name ?> 님✨

<hr>
<!-- 
    제목/이름/내용/ 입력 form
    ation:write_process.php, method:post -->
    <form action="write_process.php" method="post">
        <fieldset>
            제목: <input type="text" name="title" required><br><br>
            내용: <textarea name="content" rows="5" cols="20" required ></textarea>
        <br><br>    
        <button>글쓰기</button> 
        </fieldset>
    </form>
    <br>
    <button><a href="list.php">돌아가기</a></button>   
</body>
</html>