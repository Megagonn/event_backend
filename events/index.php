<?php
    include '../user/auth.php';
    include '../queries/index.php';
    allowedMethod('GET');
    if($user = auth(getBearer())){
        $result = new stdClass;
        $id = $user['userid'];
        $sql = query("SELECT * FROM events WHERE userid='$id'");
        $events = [];
        while($row = fetch($sql)){
            array_push($events, $row);
        }
        $result->events = $events;
        say(200, $result);
    }


?>