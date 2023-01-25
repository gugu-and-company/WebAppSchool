<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>

  <?php
  require_once('./Post.php');

  $POSTS_FILE_NAME = "./posts.json";

  $posts;
  $message = "";
  $error_message = "";

  if (file_exists($POSTS_FILE_NAME)) {

    // Postクラスの配列を取得する
    $posts = readPostsFromJson($POSTS_FILE_NAME);

    $message = "Read Posts from JSON file data.";
  } else {

    $error_message = "JSON file Not found.";
  }

  ?>

  <? if ($error_message) : ?>
    <h3 class='text-danger'><?= $error_message ?></h3>
  <? else : ?>
    <h3 class='text-success'><?= $message ?></h3>
    <?php foreach ($posts as $post) : ?>
      <div class='card'>
        <div class='dttm'> <?= $post->getDatetime(); ?> </div>
        <div class='post'> <?= $post->getPost(); ?> </div>
      </div>
    <?php endforeach; ?>
  <? endif; ?>

  <?php

  function readPostsFromJson($path)
  {
    // data read from json file
    $data = file_get_contents($path);
    // debug
    // echo "---raw json--------------------<br>";
    // print_r($data);
    // echo "<br>";
    // echo "-------------------------------<br>";

    // decode a data
    $json = json_decode($data); // Objectとしてdecode
    // debug
    // echo "---decode json-----------------<br>";
    // print_r($json);
    // echo "<br>";
    // echo "-------------------------------<br>";

    $posts = array();
    foreach ($json as $post) {
      // echo $post->datetime . "<br>";
      // echo $post->post . "<br>";
      $post = new Post($post->datetime, $post->post);
      array_push($posts, $post);
    }

    return $posts;
  }

  ?>

</body>

</html>