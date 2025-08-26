<?php
session_start();

// id를 GET방식으로 받는다
$id = isset($_GET['id']) ? intval($_GET['id']) : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글 삭제</title>
</head>

<body>

        <?php
            if (isset($_SESSION['error'])){
                echo "<p style='color:red'>". 
                        htmlspecialchars($_SESSION['error']) ."</p>";
                unset($_SESSION['error']);
            }
        ?>
        <!--
        POST방식으로 pw를 받는다
        -->
    <h1>글 삭제</h1>
    <hr>
    <form action="delete_process.php" method="post">
        <fieldset>
            비밀번호:
            <input type="hidden" name="id" value="<?=$id?>">
            <input type="password" name="pw">
            <button>삭제하기</button>
        </fieldset>
    </form>
</body>

</html>