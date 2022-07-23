<?php
    include '../user/auth.php';
    include '../queries/index.php';
    allowedMethod('POST');
    if($user = auth(getBearer())){
        $data = request();
        try {
            $result = new stdClass;
            $code = 203;
            $eventName = parse($data->eventName);
            $eventDate = parse($data->eventDate);
            $eventType = parse($data->eventType);
            $eventDesc = parse($data->eventDesc);
            $eventTime = parse($data->eventTime);
            $eventLocation = parse($data->eventLocation);
            $id = $user['userid'];
            $sql = insertData([
                "table"=>"events",
                "eventname"=>"'$eventName'",
                "eventdate"=>"'$eventDate'",
                "eventtime"=>"'$eventTime'",
                "eventtype"=>"'$eventType'",
                "eventdesc"=>"'$eventDesc'",
                "eventlocation"=>"'$eventLocation'",
                "userid"=>"'$id'"
            ]);
            if($sql){
                $code = 200;
                $result->event = [
                    "eventname"=>"$eventName",
                    "eventdate"=>"$eventDate",
                    "eventtime"=>"$eventTime",
                    "eventtype"=>"$eventType",
                    "eventdesc"=>"$eventDesc",
                    "eventlocation"=>"$eventLocation"
                ];
            }
            say($code, $result);
        }
        catch(Exception $err){
            say(203,"Error Occured");
        }


    }


?>