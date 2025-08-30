<?php
require_once("./header.php");
// 글의 id를 GET 방식으로 받기
$posts_id = isset($_GET['id']) ? intval($_GET['id']) : '';
if ($posts_id === '') {
    $_SESSION["error"] = "접근 오류";
    header("Location: view.php");
    exit;
}

// DB연결
require_once("./db_conf.php");
if ($db_conn->connect_errno) {
    $_SESSION["error"] = "DB연결 오류 발생";
    header("Location: view.php");
    exit;
}

// SELECT로 해당 ID의 글을 가져 오기
$check_sql = "SELECT * FROM posts WHERE id='$posts_id'";
$check_result = $db_conn->query($check_sql);
$row = $check_result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>수정</title>
</head>

<body>
    <h1>게시판 > 수정</h1>
    <hr>
    <fieldset>
        <form action="edit_process.php" method="post">
        <!--form에 value를 써서 기존 데이터 표시
            제목, 날짜, 내용
            POST방식으로 edit_process.php에 전달하기 -->
            <strong>제목: </strong>
            <input type="text" name="title" required value="<?= $row['title'] ?>">
            <br><br>
            <strong>내용: </strong>
            <textarea name="content" required rows="5" cols="20"><?= $row['content'] ?></textarea>
            <br><br>
            <a href="edit_process.php"><button>환료</button></a>
        </form>
    </fieldset>
    <br>
    <a href="view.php?id=<?=$posts_id?>"><button>돌아가기</button></a>
</body>

</html>