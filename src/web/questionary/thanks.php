<?php
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
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

if ($errmsg != '') {
    //エラーメッセージが空ではない場合には、エラーメッセージを表示する
    echo $errmsg;

    //[前のページへ戻る]ボタンを表示する
    echo '<form method="post" action="form.html">';
    echo '<input type="submit" name="backbtn" value="前のページへ戻る">';
    echo '</form>';
} else {
    $data = array($shimei, $sex, $raiten, $today, $kanso);
    $output = implode(', ', $data);
    $ary = array();
    $ary = array('date' => date("Y-m-d H:i:s"), 'post' => $output);

    // jsonファイル作成
    $J_file = "data2.json";

    if ($file = file_get_contents($J_file)) {
        // ファイルがある場合の処理
        $file = mb_substr($file,0,mb_strlen($file)-1); //　#2
        $json = json_encode($ary, JSON_UNESCAPED_UNICODE); //　#3
        $json = $file . ',' . $json . ']'; //　#4
        file_put_contents($J_file, $json, LOCK_EX); //　#5
        // 次の処理はここに書いていく
    } else {
        // ファイルがない場合の処理
        $json = json_encode($ary, JSON_UNESCAPED_UNICODE); //　$1
        $json = '['.$json.']'; //　$2
        file_put_contents($J_file, $json, LOCK_EX); //　$3
    }
}


?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>うさぎうどん　アンケート</title>
</head>

<body>
    <?php if ($errmsg != '') : ?>
        <p></p>
    <?php else : ?>
        <h1>ご協力ありがとうございました。</h1>
    <?php endif; ?>
</body>

</html>