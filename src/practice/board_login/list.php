<?php
// session을 사용하고 로그인한 유자인지 확인
require_once("./header.php");

// 로그인한 User -> 로그인하면 session에 이름와 아이디를
//                 저장하고 화면에 표시. 로그아웃버튼 제공 
if ($flag) {
    echo "<button><a href='logout.php'>로그아웃</a></button>";
// Gest -> 회원가입, 로그인 버튼을 제공.
} else {
    echo "<br>";
    echo "<button><a href='login.php'>로그인</a></button>";
    echo "<button><a href='register.php'>회원가입</a></button>";
}

// login한경우 UserID를 POST로 받는다
if (isset($_POST["id"])) {
    $user_id = $_POST["id"];
}

// DB연결
require_once("./db_conf.php");

if ($db_conn->connect_errno) {
    $_SESSION["error"] = "DB연결 오류가 발생했습니다.";
}

// DB에서 글을 가져오기(select)
$select_posts_sql = "SELECT * FROM posts ORDER BY id DESC";
$select_posts_result = $db_conn->query($select_posts_sql);

// 작성자 이름 가져오기
$select_users_sql = "SELECT * FROM users";
$select_users_result = $db_conn->query($select_users_sql);
$row_user = $select_users_result->fetch_assoc();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판</title>
</head>

<body>
    <h1>게시판</h1><hr>

    <!--
         title,name,content,조회 수,작성 날짜,수정 날짜 표시 
    -->
    <table border="1">
        <th>번호</th>
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
                echo "<td>" . "$row[id]". "</td>";
                echo "<td>" . "$row_user[name]" . "</td>";
                echo "<td>" . "<a href='view.php?id={$row['id']}'>$row[title]</a>" . "</td>";
                echo "<td>" . "$row[created_at]" . "</td>";
                echo "</tr>";
            }
        }
        ?>

    </table>
    <br>

    <?php
    // 로그인한 User에게 글쓰기버튼 제공
    if ($flag) {
        echo "<button><a href='write.php'>글쓰기</a></button>";
    }
    ?>


</body>

</html>