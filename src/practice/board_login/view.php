<?php
require_once("./header.php");

// GET방식으로 글의 ID를 받는다
$posts_id = isset($_GET["id"]) ? intval($_GET["id"]) : '';

// DB연결
require_once("./db_conf.php");

// 해당 id의 글을 표시 “SELECT * FROM posts WHERE id=’$id’”;
$posts_check_sql = "SELECT * FROM posts WHERE id='$posts_id'";
$posts_check_result = $db_conn->query($posts_check_sql);

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
    if (isset($_SESSION["error"])) {
        echo htmlspecialchars($_SESSION["error"]);
        unset($_SESSION["error"]);
    }
    ?>

    <fieldset>
        <?php if ($posts_check_result && $posts_check_result->num_rows > 0): ?> 
            <!--**제목, 작성자, 작성일, 수정일(있으면), 본문을 표시 -->
                <?php $row = $posts_check_result->fetch_assoc();?>
                <strong>제목: </strong><?=$row['title']?>
                <br><br>
                <strong>이름: </strong><?=$row['name']?>
                <br><br>
                <strong>내용: </strong><?=$row['content']?>
                <br><br>
                <strong>작성일: </strong><?=$row['created_at']?>
                <?php if (isset($row['updated_at'])):?>
                    <strong>수정일: </strong><?=$row['updated_at']?>
                <?php endif?>
        <?php endif ?>
            

            <!-- 본인에게만 수정 , 삭제 버튼 제공 
            // ** 수정 -> edit.php로 이동
            // ** 삭제 -> delete.php로 이동 -->
            <?php if ($flag) {
                if ($_SESSION['id'] === $row['userid']) {
                    echo "<br><br>";
                    echo "<a href='edit.php?id=$posts_id'><button>수정</button></a>";
                    echo "<a href='delete.php?id$posts_id'><button>삭제</button></a>";
                }
            }
            ?>




        

    </fieldset>
    <br>
    <a href="list.php"><button>돌아가기</button></a>

</body>

</html>