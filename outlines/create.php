<?php
    include '../user/auth.php';
    include '../queries/index.php';
    allowedMethod('POST');
    if($user = auth(getBearer())){
        $data = request();
        try {
            $result = new stdClass;
            $code = 203;
            
            say($code, $result);
        }
        catch(Exception $err){
            say(203,"Error Occured");
        }


    }


?>