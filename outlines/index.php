<?php
    include '../user/auth.php';
    include '../queries/index.php';
    allowedMethod('GET');
    if($user = auth(getBearer())){
        $result = new stdClass;
        $id = $user['userid'];
        
        $outlines = [];
        $sql = query("SELECT * FROM outlines WHERE userid='$id'");
        while($row = fetch($sql)){
            array_push($outlines, $row);
        }
        $result->outlines = $outlines;
        say(200, $result);
    }


?>