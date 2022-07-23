<?php
    include 'my.php';
    $mail = mailme('devferanmi@gmail.com', 'EventBackend',' EventBackend','Eventbackend', 'testmail');
    return say(200, $mail);
?>