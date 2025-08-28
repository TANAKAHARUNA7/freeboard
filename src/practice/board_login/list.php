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
    <!--     
    Gest -> 회원가입, 로그인 버튼을 제공
    User -> 로그인하면 session에 이름, 아이디를 저장하고 화면에 표시 , 
            로그아웃버튼 제공 
    -->
    <?php
    if (isset($_SESSION["username"]) && isset($_SESSION["name"])) {
        echo "환영합니다! " . htmlspecialchars($_SESSION["name"]) . "님✨";
        echo "<a href='logout.php'>로그아웃</a>";
    } else {
        echo "안녕하세요Gest님! " . "<br>";
        echo "<button><a href='register.php'>회원가입</a></button>";
        echo "<button><a href='login.php'>로그인</a></button>";
    }
    ?>


    <hr>
    <!--
         title
         name
         content
         조회 수
         작성 날짜
         수정 날짜
         표시 
    -->

    <table border="1">
        <th>이름</th>
        <th>제목</th>
        <th>작성일</th>
        <th>조회수</th>

        <!-- whle문을 사용해서 DB내 계시 글을 표시하기
            $row = $result→fetch_assoc() -->

        <!-- title에 a테그를 사용해 id 링크하기
            같이 id를 보함해서 view.php로 이동
            <a href=’view.php?id=$row[‘id’]’ -->
        <?php
        if ($select_posts_result && $select_posts_result->num_rows > 0) {
            while ($row = $select_posts_result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . "$row_name[name]" . "</td>";
                echo "<td>" . "<a href='view.php?id={$row['id']}'>$row[title]</a>" . "</td>";
                echo "<td>" . "$row[created_at]" . "</td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
    <br>
    <button><a href="write.php">글쓰기</a></button>


</body>

</html>