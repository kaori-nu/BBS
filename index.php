<?php
function h($str)
{
    return htmlspecialchars($str);
}

// ファイルの存在確認
$file_name = "data.txt";
if (!file_exists($file_name)) {
    touch($file_name);
}

// 投稿ボタンが押された場合
if (isset($_POST["submit"])) {

    // 入力チェック
    if ($_POST["name"]) {
        $name = h($_POST["name"]);
    } else {
        // 名前が未入力の場合、デフォルト名を代入
        $name = "名無しさん";
    }
    if ($_POST["comment"]) {
        // コメントの改行のHTML置換とエスケープ
        $comment = h($_POST["comment"]);
    } else {
        exit("コメントが未入力です。");
    }

    $data = "名前: {$name} <br/> コメント: <br/>{$comment}";

    // 保存されているコメントを取得する
    $saved_comment = file_get_contents($file_name);
    $saved_comment = $data ."\n". "<hr>$saved_comment";

    // 保存処理
    $result = file_put_contents($file_name, $saved_comment);
    if ($result === 0 ) {
        // 保存に失敗したらその旨を表示
        echo "書き込み失敗";
    } else {
        // 保存に成功したら保存した文字を表示
        // コメントを改行して表示
        echo nl2br($saved_comment);
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
        名前:<br/>
        <input type ="text" name ="name"><br/>
        コメント:<br/>
        <textarea name="comment" rows="5" cols="50" wrap="hard"></textarea><br>
        <input type="submit" name="submit" value="投稿">
        </form>
    </body>
</html>
