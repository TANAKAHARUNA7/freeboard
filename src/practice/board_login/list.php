<?php
session_start();

// DB연결
require_once("./db_conf.php");
$db_conn = new mysqli(
    db_info::DB_HOST,
    db_info::DB_USER,
    db_info::DB_PASSWORD,
    db_info::DB_NAME
);

if ($db_conn->connect_errno) {
    $_SESSION["error"] = "DB연결 오류가 발생했습니다.";
}

// DB에서 글을 가져오기(select)
$select_posts_sql = "SELECT * FROM posts";
$select_posts_result = $db_conn->query($select_posts_sql);

// 작성자 이름 가져오기
$select_users_sql = "SELECT name FROM users";
$select_users_result = $db_conn->query($select_users_sql);
$row_name = $select_users_result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판</title>
</head>

<body>
    <h1>게시판</h1>
    <hr>
    <!-- title
         name
         content
         조회 수
         작성 날짜
         수정 날짜
         표시 -->

    <table border="1">
        <th>제목</th>
        <th>이름</th>
        <th>작성일</th>
        <th>조회수</th>

        <!-- whle문을 사용해서 DB내 계시 글을 표시하기
        $row = $result→fetch_assoc() -->
        <?php
        if ($select_posts_result && $select_posts_result->num_rows > 0) {
            while ($row = $select_posts_result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . "$row[title]" . "</td>";
                echo "<td>" . "$row_name[name]" . "</td>";
                echo "<td>" . "$row[created_at]" . "</td>";
                echo "</tr>";
            }
        }
        ?>




    </table>



    <!-- title에 a테그를 사용해 id 링크하기
    같이 id를 보함해서 view.php로 이동
    <a href=’view.php?id=$row[‘id’]’ -->





</body>

</html>