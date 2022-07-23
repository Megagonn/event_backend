<?php
    include 'auth.php';
    include '../queries/index.php';
    
    if($user = auth(getBearer())){
        $result = new stdClass;
        $result->user = $user;
        $id = $user['userid'];
        $sql = query("SELECT * FROM events WHERE userid='$id'");
        $events = [];
        while($row = fetch($sql)){
            array_push($events, $row);
        }
        $outlines = [];
        $sql = query("SELECT * FROM outlines WHERE userid='$id'");
        while($row = fetch($sql)){
            array_push($outlines, $row);
        }
        $result->events = $events;
        $result->outlines = $outlines;
        say(200, $result);
    }


?>