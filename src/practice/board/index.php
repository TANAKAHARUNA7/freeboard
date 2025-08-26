<?php

// DB 연결
require_once("./db_conn.php");

$db_conn = new mysqli(
    db_info::DB_HOST,
    db_info::DB_USER,
    db_info::DB_PASSWORD,
    db_info::DB_NAME
);

// DB에서 글을 가져 오기
$sql = "SELECT * FROM posts ORDER BY id DESC";
$result = $db_conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글 목록</title>
</head>

<body>
    <!--
        이름
        제목 (클릭하면 view.php로 이동)
        내용
        작성 날자를 표시

        1. 글 리스트
        2. 글 쓰기 버튼  
        3. 페이지 이동 제공
    -->

    <h1>글 목록</h1>
    <hr>
    <table border="1">
        <tr>
            <th>이름</th>
            <th>제목</th>
            <th>내용</th>
            <th>날짜</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['name']}</td>";
                echo "<td><a href='view.php?id={$row['id']}'>{$row['title']}</a></td>";
                echo "<td>{$row['content']}</td>";
                echo "<td>{$row['created_at']}</td>";
                echo "</tr>";
            }
        } else {
            echo "글이 없습니다.";
        }
        ?>
    </table>
    <button><a href="write.php">글쓰기</a></button>

</body>
</html>