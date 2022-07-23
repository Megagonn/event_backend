<?php
    include '../user/auth.php';
    include '../queries/index.php';
    allowedMethod('POST');
        $data = request();
        try {
            $result = new stdClass;
            $code = 203;
            $eventId = parse($data->eventId);
            $sql = getData('events', 'eventid', $eventId);

            if($sql){
                $code = 200;
                $user = getUserById($sql['userid']);
                unset($user['userid']);
                unset($sql['userid']);
                unset($user['userpassword']);
                $result->event = $sql;
                $result->organizer = $user;
            }
            else {
                $code = 404;
                $result = "Event not found";
            }
            say($code, $result);
        }
        catch(Exception $err){
            say(203,"Error Occured");
        }


?>