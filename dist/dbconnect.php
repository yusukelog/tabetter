<?php
    try{
        $db = new PDO('mysql:dbname=tabetter;host=localhost;charaset=utf8','root','nS4GthtB_c7F');
    }catch (PDOException $e){
        print ('DB接続エラー：' . $e->getMessage());
    }
?>