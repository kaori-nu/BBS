<?php
// ファイルの存在確認
$file_name = "data.txt";
if (!file_exists($file_name)) {
    touch($file_name);
}

// コメントの保存
if (isset($_POST["comment"])) {
    // 保存されているコメントを取得する
    $saved_comment = file_get_contents("data.txt");
    // 取得した保存済みのコメントの先頭に投稿を追加する
    $saved_comment = htmlspecialchars($_POST["comment"]) . "<hr>$saved_comment";

    // 保存処理
    $result = file_put_contents("data.txt", $saved_comment);
    if ($result === 0 ) {
        // 保存に失敗したらその旨を表示
        echo "書き込み失敗";
    } else {
        // 保存に成功したら保存した文字を表示
        // コメントを改行して表示
        echo nl2br(htmlspecialchars($_POST["comment"]));
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>掲示板</title>
    </head>
    <body>
        <form action="index.php" method="post">
        コメント: <textarea name="comment" rows="5" cols="50" wrap="hard"></textarea><br>
        <input type="submit" value="投稿">
        </form>
    </body>
</html>
