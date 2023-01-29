<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>

</head>

<body>
    <a href="index.html">投稿する</a>
    <?php
    require_once('Post.php');

    // jsonファイルからPostクラスの配列を取得する
    $posts = readPostsFromJson();

    // 画面から入力した値を変数に入れる
    if (isset($_GET["newpost"])) {
        $newpost = $_GET["newpost"];
        // 現在日時を取得
        $newdate = new DateTime('now');
        $newdate = $newdate->format('Y-m-d H:i');

        // 入力された投稿と現在日時でPostクラスを作る
        $p = new Post($newdate, $newpost);
        array_push($posts, $p);
    }

    // Post配列を連想配列に詰め替える
    $ary = array();
    foreach ($posts as $i) {
        $ary2 = array('date' => $i->getDatetime(), 'post' => $i->getPost());
        array_push($ary, $ary2);
    }

    // data.jsonを配列で書き込み
    $newjson = json_encode($ary, JSON_UNESCAPED_UNICODE);
    file_put_contents("data.json", $newjson);

    // それぞれの投稿を取り出す
    foreach ($posts as $post2) {
        //Postクラスのget関数を使って表示
        echo "<div class ='card'>";
        echo "<div class ='dttm'>" .  $post2->getDatetime() . "</br></div>";
        echo "<div class ='post'>" .  $post2->getPost() . "</br></div>";
        echo "</div>";
    }

    // data.jsonを読み込んで配列化
    function readPostsFromJson()
    {
        //data.jsonを開く
        $data_file_name = "data.json";
        $data = file_get_contents($data_file_name);
        // data.jsonを配列で読み込み
        $json = json_decode($data, true);

        $arr = array();
        foreach ($json as $j) {
            $post = new Post($j['date'], $j['post']);
            array_push($arr, $post);
        }
        return $arr;
    }

    ?>
    <a href="index.html">投稿する</a>
</body>

</html>