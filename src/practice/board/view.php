<?php
// index.php에서 넘겨 오는 id를 GET방식으로 처리
$id = $_GET['id'] ?? '';

// DB연결
require_once("./db_conn.php");

$db_conn = new mysqli(
    db_info::DB_HOST,
    db_info::DB_USER,
    db_info::DB_PASSWORD,
    db_info::DB_NAME
);

// 해당 id의 글을 표시
$sql = "SELECT * FROM posts WHERE id = '$id'";
$result = $db_conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글 상세 보기</title>
</head>

<body>

    <!--
        1. 제목, 작성자, 작성일, 수정일(있으면), 본문을 표시함 
        2. 수정/삭제 버튼 표시 
           - 수정 -> edit.php로 이동
           - 삭제 -> delete.php로 이동
    -->

    <h1>글 상세 보기</h1>
    <hr>
    <?php if ($row = $result->fetch_assoc()): ?>
        <p>제목: <?= $row['title'] ?></p>
        <p>이름: <?= $row['name'] ?></p>
        <p>내용: <?= $row['content'] ?></p>
        <p>날짜: <?= $row['created_at'] ?></p>
        <?php ?>
        <!-- 수정 -> edit.php에 id를 GET방식으로 보내기 -->
        <button><a href="edit.php?id=<?=$row['id'] ?>">수정</a></button>
        <!-- 삭제 -> delete.php에 id를 GET방식으로 보내기 -->
        <button><a href="delete.php?id=<?= $row['id'] ?>">삭제</a></button>     
    <?php else: ?>
        <p>해당 되는 데이터가 없습니다.</p>
    <?php endif; ?>
    <button><a href="index.php">목록</a></button>

</body>

</html>