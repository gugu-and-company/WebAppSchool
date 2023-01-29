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
    <?php
    require_once('Post.php');

    // jsonファイルからPostクラスの配列を取得する
    $posts = readPostsFromJson();
    // print_r($posts);
    // echo "<br/>";
    // echo "<br/>";

    // 画面から入力した値を変数に入れる
    $newpost = $_GET["newpost"];

    // 現在日時を取得
    $newdate = new DateTime('now');
    $newdate = $newdate->format('Y-m-d H:i');

    // 入力された投稿と現在日時でPostクラスを作る
    $p = new Post($newdate, $newpost);
    array_push($posts, $p);
    // print_r($posts);
    // echo "<br/>";
    // echo "<br/>";
    $ary = array();
    // print_r($ary);
    foreach ($posts as $i) {
        // echo "-----";
        // print_r($i);
        // echo "-----";
        // echo "<br/>";
        // 入力された投稿と現在日時を含めた連想配列を作る
        $ary2 = array('date' => $i->getDatetime(), 'post' => $i->getPost());
        array_push($ary, $ary2);
    }

    // print_r($ary);

    // 画面から入力した値をdata.jsonを配列で書き込み
    $newjson = json_encode($ary, JSON_UNESCAPED_UNICODE);
    file_put_contents("data.json", $newjson);

    // $array[0]['date'] = '2023/01/24';
    // $array[0]['post'] = '今日の投稿';
    // $array[1]['ddate'] = '2023/01/23';
    // $array[1]['post'] = '昨日の投稿';
    // $array[2]['date'] = '2023/01/25';
    // $array[2]['post'] = '明日の投稿';
    // print_r($array);

    // Postクラスのオブジェクトでは、json形式に変換できない
    // $newjson = json_encode($posts);
    // print_r($newjson);

    // それぞれの投稿を取り出す
    foreach ($posts as $post2) {
        // $post = new Post($post['date'], $post['post']);
        // $post->createNewPost($newpost);
        //Postクラスのget関数を使って表示
        echo "<div class ='card'>";
        echo "<div class ='dttm'>" .  $post2->getDatetime() . "</br></div>";
        echo "<div class ='post'>" .  $post2->getPost() . "</br></div>";
        echo "</div>";
    }
    // for ($i = 0; $i <= count($posts) - 1; $i++) {
    //   echo "<div class ='card'>";
    //   echo "<div class ='dttm'>" . $posts[$i]->dttm . "</br></div>";
    //   echo "<div class ='post'>" . $posts[$i]->post . "</br></div>";
    //   echo "</div>";
    // }

    // data.jsonを読み込んで配列化
    function readPostsFromJson()
    {
        //data.jsonを開く
        $data_file_name = "data.json";
        $data = file_get_contents($data_file_name);
        // data.jsonを配列で読み込み
        $json = json_decode($data, true);
        // print_r($json);

        $arr = array();
        foreach ($json as $j) {
            $post = new Post($j['date'], $j['post']);
            // print_r($post);
            // echo "<br/>";
            // echo "<br/>";
            array_push($arr, $post);
        }
        //  print_r($arr);
        return $arr;
    }

    ?>
</body>

</html>

</html>