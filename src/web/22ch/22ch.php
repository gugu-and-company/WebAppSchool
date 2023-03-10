<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>22ちゃんねる</title>

</head>

<body>
    <h1>22ちゃんねる</h1>
    <a href="../index.html">HOME</a>
    </br>

    <?php
    require_once('Post.php');

    // 1.jsonファイルからPostクラスの配列を取得する
    $posts = readPostsFromJson();

    // 2.画面から入力した値を変数に入れてdata.jsonに保存
    if (isset($_GET["newpost"])) {
        $newname = $_GET["name"];
        $newpost = $_GET["newpost"];
        // 2-1.現在日時を取得
        $newdate = new DateTime('now');
        $newdate = $newdate->format('Y-m-d H:i');

        // 2-2.入力された投稿と現在日時でPostクラスを作る
        $p = new Post($newname, $newdate, $newpost);
        array_push($posts, $p);

        // 2-3.data.jsonに配列を保存
        savePostsToJson($posts);

        header('Location: ./22ch.php');
        exit;
    }

    // 3.それぞれの投稿を取り出す
    foreach ($posts as $post2) {
        echo "<div class ='card'>";
        echo "<div class ='dttm'>" .  $post2->getName() . "</br></div>";
        echo "<div class ='dttm'>" .  $post2->getDatetime() . "</br></div>";
        echo "<div class ='post'>" .  $post2->getPost() . "</br></div>";
        echo "</div>";
    }


    /**
     * data.jsonを読み込んで配列化する関数
     */
    function readPostsFromJson()
    {
        //data.jsonを開く
        $data_file_name = "data.json";
        $data = file_get_contents($data_file_name);
        // data.jsonを配列で読み込み
        $json = json_decode($data, true);

        $arr = array();
        foreach ($json as $j) {
            $post = new Post($j['name'], $j['date'], $j['post']);
            array_push($arr, $post);
        }
        return $arr;
    }

    /**
     * data.jsonに配列を保存する関数
     */
    function savePostsToJson($posts)
    {
        // Post配列を連想配列に詰め替える
        $ary = array();
        foreach ($posts as $i) {
            $ary2 = array('name' => $i->getName(), 'date' => $i->getDatetime(), 'post' => $i->getPost());
            array_push($ary, $ary2);
        }

        // data.jsonを連想配列で書き込み
        $newjson = json_encode($ary, JSON_UNESCAPED_UNICODE);
        file_put_contents("data.json", $newjson);
    }

    ?>

    <form action="" method="get">
        <p>お名前　<input type="text" name="name"></p>
        <p><textarea name="newpost" rows="4" cols="40"></textarea></p>
        <p><input type="submit" name="submitBtn" value="書き込む"></p>
    </form>
    </br></br>

    <a href="../index.html">HOME</a>
</body>

</html>