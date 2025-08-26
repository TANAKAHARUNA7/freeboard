<?php
session_start();

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
        if (isset($_SESSION['error'])) {
            echo htmlspecialchars($_SESSION['error']);
            unset($_SESSION['error']);
        }   
    ?>

    <!--
        ・이름
        ・제목
        ・내용
        ・비밀번호
        form : action"write_process.php" method:post
        글쓰기 버튼, 초기화 버튼
    -->
    <h1>글쓰기</h1>
    <hr>
    <form action="write_process.php" method="post">
        <fieldset>
        이름: 
        <input type="text" name="name" required><br>
        제목:
        <input type="text" name="title" required><br>
        내용:
        <textarea name="content" id="content" rows="5" cols="60" required></textarea><br>
        비미번호:
        <input type="password" name="pw" required><br><br>
        <button>글쓰기</button>
        <input type="reset" value="초기화">
        </fieldset>
    </form>
    <br>
    <button><a href="index.php">목록</a></button>

</body>

</html>