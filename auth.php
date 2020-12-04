<?php
    session_start();
    $url = 'http://nilepromotion.com/pa-test/wp-json/test/v2/creds?username='. $_POST["username"] .'&password=' . $_POST["password"];

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST'
        )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $login = json_decode($result, true);
    if ($login['login']) {
        $_SESSION["userName"] = $_POST["username"];
        header('Location: index.php?file='.$_POST["url"]);
    } else {
        header('Location: index.php');
    }
?>