<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>入力内容の確認</title>
</head>

<body>

    <?php
    // データの受け取り
    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        $shimei = $_POST['shimei'];
        $sex = $_POST['sex'];
        $raiten = $_POST['raiten'];
        $today = $_POST['today'];
        $kanso = $_POST['kanso'];
    
        //危険な文字列を入力された場合にそのまま利用しない対策
        $shimei = htmlspecialchars($shimei, ENT_QUOTES);
        $sex = htmlspecialchars($sex, ENT_QUOTES);
        $raiten = htmlspecialchars($raiten, ENT_QUOTES);
        $today = htmlspecialchars($today, ENT_QUOTES);
        $kanso = htmlspecialchars($kanso, ENT_QUOTES);
    }
    
    // 未入力チェック
    $errmsg = '';    //エラーメッセージを空にしておく
    if (empty($shimei)) {
        $errmsg = '<p>お名前が入力されていません。</p>';
    }

    // 入力内容の確認
    if ($errmsg != '') {
        //エラーメッセージが空ではない場合には、エラーメッセージを表示する
        echo $errmsg;

        //[前のページへ戻る]ボタンを表示する
        echo '<form method="post" action="form.html">';
        echo '<input type="submit" name="backbtn" value="前のページへ戻る">';
        echo '</form>';
    } else {
        //エラーメッセージが空の場合には、入力された内容を画面表示する
        echo '<h3>入力内容を確認します</h3>';
        echo '<dl>';
        echo '<dt>【お名前】</dt><dd>' . $shimei . '</dd>';
        echo '<dt>【性別】</dt><dd>' . $sex . '</dd>';
        echo '<dt>【ご利用】</dt><dd>' . $raiten . '</dd>';
        echo '<dt>【満足度】</dt><dd>' . $today . '</dd>';
        echo '<dt>【ご感想】</dt><dd>' . $kanso . '</dd>';
        echo '</dl>';

        //[上記内容で送信する]ボタンを表示する
        echo '<form method="post" action="thanks.php">';
        echo '<input type="hidden" name="shimei" value="' . $shimei . '">';
        echo '<input type="hidden" name="sex" value="' . $sex . '">';
        echo '<input type="hidden" name="raiten" value="' . $raiten . '">';
        echo '<input type="hidden" name="today" value="' . $today . '">';
        echo '<input type="hidden" name="kanso" value="' . $kanso . '">';
        echo '<input type="submit" name="okbtn" value="上記内容で送信する">';
        echo '</form>';
    }
    ?>

</body>

</html>