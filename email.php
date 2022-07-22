<?php

    include 'my.php';

    $type = $_POST['Content-Type'];
    // $body = $_POST['body_html'];
    $sender = $_POST['Sender'];
    $date = $_POST['Date'];

    $arr = '';
    $t = '';
    foreach($_POST as $key=>$value){
        $arr =  $key.':'.$value.'<br/>';;
        
        echo $arr;
        $t  = $t.$arr;
    }
    
    $dat = $t;
    $link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $date = now();

    if(logerror($dat,$link)){
        say(200,"Done");
    }
    else {
        say(203,'fake');
    }

?>