<?php
require_once("./header.php");

// GET방식으로 ID받기
$postsid = isset($_GET["id"]) ? intval($_GET["id"]) : ''; 

// DB연결
require_once("./db_conf.php");

// 해당 id의 글을 표시 “SELECT * FROM posts WHERE id=’$id’”;
$check_sql = "SELECT * FROM posts WHERE id='$postsid'";
$check_result = $db_conn->query($check_sql);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>자세히 보기</title>
</head>
<body>
    <h1>게시판 > 자세히 보기</h1>
    <hr>
    <?php
    if ($check_result && $check_result->num_rows > 0) {
        // $row = $result→fetch_assoc() 
        while($row = $check_result->fetch_assoc()){
            // **제목, 작성자, 작성일, 수정일(있으면), 본문을 표시
            echo "제목: " . "$row[title]";
            echo "<br><br>";
            echo "이름: " . "$name";




    
        }

        // 수정 버튼 제공 
        // **id를 GET방식으로 보내기
        // **edit.php로 이동

        // 삭제 버튼 제공
        // **id를 GET방식으로 보내기
        // **delete.php로 이동


    }
?>

</body>
</html>