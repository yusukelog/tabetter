<?php

session_start();
require('dbconnect.php');

// ログイン状態の確認
if (!empty($_SESSION['id'])) {
    $post_id = $_POST['post_id'];

    $posts = $db->prepare('SELECT * FROM posts WHERE id=:post_id');
    $posts->execute(array(
        ':post_id' => $post_id
    ));
    $post = $posts->fetch();
    if($post['user_id'] == $_SESSION['id']){
        $del = $db->prepare('DELETE FROM posts WHERE id=:post_id');
        $del->execute(array(
            ':post_id' => $post_id
        ));

        $del = $db->prepare('DELETE FROM media WHERE post_id=:post_id');
        $del->execute(array(
            ':post_id' => $post_id
        ));
    }
}

header('Location:create.php');
exit();

?>